<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingModel;
use App\Models\UserModel;
use App\Models\PromoCode;
use Razorpay\Api\Api;
use App\Mail\PaymentSuccessMail;
use App\Mail\TicketCancelledMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;


class PaymentController extends Controller
{

public function index($bookingId)
{

    $booking = BookingModel::with([
        'movieData',
        'showData.theaterData'
    ])->findOrFail($bookingId);

    if ($booking->booking_status !== 'locked' || $booking->expires_at < now()) {
        return redirect('/')->with('error', 'Booking expired or invalid.');
    }

    $ticketPrice = $booking->total_price;
    $discount = $booking->discount_amount ?? 0;
    // Price after discount
    $priceAfterDiscount = $ticketPrice - $discount;
    // GST based on price
    $gstPercent = $priceAfterDiscount > 100 ? 18 : 12;
    $taxAmount = ($priceAfterDiscount * $gstPercent) / 100;
    $finalAmount = $priceAfterDiscount + $taxAmount;

    return view('userpanel.payment', compact(
        'booking',
        'discount',
        'gstPercent',
        'taxAmount',
        'finalAmount'
    ));
}

public function applyPromo(Request $request)
{
    $request->validate([
        'code' => 'required',
        'booking_id' => 'required'
    ]);

    $booking = BookingModel::findOrFail($request->booking_id);

    // Case insensitive search
    $promo = PromoCode::whereRaw('UPPER(code) = ?', [strtoupper($request->code)])
        ->where('is_active', true)
        ->first();

    if (!$promo) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid Promo Code'
        ]);
    }

    if ($promo->expires_at && $promo->expires_at < now()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Promo Code Expired'
        ]);
    }

    if ($promo->usage_limit && $promo->used_count >= $promo->usage_limit) {
        return response()->json([
            'status' => 'error',
            'message' => 'Promo usage limit reached'
        ]);
    }

    if ($booking->total_price < $promo->min_amount) {
        return response()->json([
            'status' => 'error',
            'message' => 'Minimum booking amount not reached'
        ]);
    }

    /* =========================
       🎟 CALCULATE DISCOUNT
    ========================= */

    if ($promo->discount_type === 'percentage') {
        $discount = ($booking->total_price * $promo->discount_value) / 100;
    } else {
        $discount = $promo->discount_value;
    }

    $discount = min($discount, $booking->total_price);

    /* =========================
       💰 RECALCULATE GST + FINAL
    ========================= */

    $taxableAmount = $booking->total_price - $discount;

    $gstPercent = $taxableAmount > 100 ? 18 : 12;

    $gstAmount = ($taxableAmount * $gstPercent) / 100;

    $finalPrice = $taxableAmount + $gstAmount;

    /* =========================
       💾 SAVE EVERYTHING
    ========================= */

    $booking->update([
        'promo_code' => $promo->code,
        'discount_amount' => round($discount, 2),
        'gst_amount' => round($gstAmount, 2),
        'final_price' => round($finalPrice, 2)
    ]);

    return response()->json([
        'status' => 'success',
        'discount' => round($discount, 2),
        'gst' => round($gstAmount, 2),
        'final' => round($finalPrice, 2)
    ]);
}


public function createRazorpayOrder(Request $request)
{
    try {

        $booking = BookingModel::findOrFail($request->booking_id);

        $keyId = "rzp_test_etrvuxfEs88FRd";
        $keySecret = "EGRyDqlhbdWdGlVUWpLBcvma";

        $api = new \Razorpay\Api\Api($keyId, $keySecret);

        // ✅ USE DB VALUES ONLY
        $finalAmount = $booking->final_price;

        if ($finalAmount <= 0) {
            return response()->json(['error' => 'Invalid amount'], 400);
        }

        // ✅ Razorpay Order
        $order = $api->order->create([
            'receipt' => 'BOOKING_'.$booking->id,
            'amount' => intval(round($finalAmount * 100)),
            'currency' => 'INR'
        ]);

        return response()->json([
            'order_id' => $order['id'],
            'amount' => intval(round($finalAmount * 100)),
            'key' => $keyId
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}

// public function createRazorpayOrder(Request $request)
// {
//     try {

//         $booking = BookingModel::findOrFail($request->booking_id);

//         $keyId = "rzp_test_etrvuxfEs88FRd";
//         $keySecret = "EGRyDqlhbdWdGlVUWpLBcvma";

//         $api = new \Razorpay\Api\Api($keyId, $keySecret);

//         $total = $booking->total_price;
//         $discount = $booking->discount_amount ?? 0;

//         $gstPercent = 18;

//         // Calculate GST properly
//         $taxableAmount = $total - $discount;
//         $gst = ($taxableAmount * $gstPercent) / 100;

//         $finalAmount = $taxableAmount + $gst;

//         if ($finalAmount <= 0) {
//             return response()->json(['error' => 'Invalid amount'], 400);
//         }

//         $order = $api->order->create([
//             'receipt' => 'BOOKING_'.$booking->id,
//             'amount' => intval(round($finalAmount * 100)),
//             'currency' => 'INR'
//         ]);

//         return response()->json([
//             'order_id' => $order['id'],
//             'amount' => intval(round($finalAmount * 100)),
//             'key' => $keyId
//         ]);

//     } catch (\Exception $e) {

//         return response()->json([
//             'error' => $e->getMessage()
//         ], 500);
//     }
// }


public function verifyRazorpayPayment(Request $request)
{
    $api = new Api("rzp_test_etrvuxfEs88FRd", "EGRyDqlhbdWdGlVUWpLBcvma");

    try {

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        $api->utility->verifyPaymentSignature($attributes);

        BookingModel::where('id', $request->booking_id)
        ->update([
            'payment_status' => 'completed',
            'booking_status' => 'confirmed',
            'payment_id' => $request->razorpay_payment_id,
            'expires_at' => null]);


        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        return response()->json(['success' => false]);
    }
}

public function cancelBooking($id)
{
    $booking = BookingModel::with(['showData','userData'])->findOrFail($id);

    $showDateTime = Carbon::parse(
        $booking->showData->show_date.' '.$booking->showData->show_time
    );

    $total = $booking->total_price;
    $discount = $booking->discount_amount ?? 0;

    $gstPercent = 18;

        // Calculate GST properly
    $taxableAmount = $total - $discount;
    $gst = ($taxableAmount * $gstPercent) / 100;

    $finalAmount = $taxableAmount + $gst;

    $minutesLeft = now()->diffInMinutes($showDateTime, false);

    if ($minutesLeft < 60) {
        return back()->with('status','Cancellation not allowed within 1 hour of showtime.');
    }

    /* ---------------- Refund ---------------- */

    if($booking->payment_id){

    try {

        $api = new Api("rzp_test_etrvuxfEs88FRd","EGRyDqlhbdWdGlVUWpLBcvma");

        $payment = $api->payment->fetch($booking->payment_id);

        if($payment->status == 'authorized'){
            $payment->capture([
                'amount' => $payment->amount
            ]);
        }

        // Skip real refund in testing
        $booking->payment_status = 'refunded';

    } catch (\Exception $e) {

        // $booking->payment_status = 'refund_pending';
    }
}

    /* ---------------- Cancel Booking ---------------- */

    $booking->booking_status = 'cancelled';
    $booking->save();

    /* ---------------- Email ---------------- */

    $details = $this->prepareDetailsArray($booking);

    if($booking->userData && $booking->userData->email){
        Mail::to($booking->userData->email)
            ->send(new TicketCancelledMail($details));
    }

    return back()->with('status','Booking cancelled successfully.');
}

// public function cancelBooking($id)
// {
//     $booking = BookingModel::with('showData')->findOrFail($id);

//     $showDateTime = Carbon::parse(
//         $booking->showData->show_date.' '.$booking->showData->show_time
//     );

//     $total = $booking->total_price;
//     $discount = $booking->discount_amount ?? 0;

//     $gstPercent = 18;

//         // Calculate GST properly
//     $taxableAmount = $total - $discount;
//     $gst = ($taxableAmount * $gstPercent) / 100;

//     $finalAmount = $taxableAmount + $gst;

//     $minutesLeft = now()->diffInMinutes($showDateTime, false);

//     if ($minutesLeft < 60) {
//         return back()->with('status','Cancellation not allowed within 1 hour of showtime.');
//     }

//     // Razorpay refund
//     if($booking->payment_id){

//         $api = new Api("rzp_test_etrvuxfEs88FRd", "EGRyDqlhbdWdGlVUWpLBcvma");

//         $api->payment->fetch($booking->payment_id)
//             ->refund([
//                 "amount" => $finalAmount * 100,
//             ]);
//     }

//     $booking->booking_status = 'cancelled';
//     $booking->payment_status = 'refunded';
//     $booking->save();

//       /* Prepare email data */
//     $details = $this->prepareDetailsArray($booking);

//     /* Send email */
//     if($booking->userData && $booking->userData->email){
//         Mail::to($booking->userData->email)
//             ->send(new TicketCancelledMail($details));
//     }

//     return back()->with('status','Booking cancelled and refund initiated.');
// }

// public function sendPaymentSuccessEmail($bookingId, $paymentId)
// {
//     $booking = BookingModel::find($bookingId);

//     if(!$booking){
//         return false;
//     }

//     $userEmail = UserModel::where('id', $booking->user_id)->value('email');

//     if($booking->payment_status === 'completed' && $booking->booking_status === 'confirmed') {

//         $details = [
//             // 'name' => $booking->user,
//             'movie' => $booking->movieData->movie_name,
//             'theater' => $booking->theaterData->theater_name,
//             'show_time' => $booking->showData->show_time,
//             'screen_no' => $booking->screen_no,
//             'seats' => implode(', ', json_decode($booking->seat_number)),
//             'amount' => $booking->final_amount ?? $booking->total_price,
//             'payment_id' => $paymentId,
//         ];

//         try{
//             Mail::to($userEmail)->send(new PaymentSuccessEmail($details));
//             return true;
//         } catch(\Exception $e){
//             \Log::error('Email sending failed: '.$e->getMessage());
//             return false;
//         }
//     }

//     return false;
// }


public function thankYou($id)
{
    $booking = BookingModel::with(['movieData','theaterData','showData'])
                ->findOrFail($id);

    if (
        $booking->payment_status === 'completed' &&
        $booking->booking_status === 'confirmed'
    ) {

        $details = [
            'name' => optional($booking->user)->name ?? 'Customer',
            'movie_image' => $booking->movieData->movie_image ?? '',
            'movie' => $booking->movieData->movie_name ?? '',
            'language' => $booking->language ?? '',
            'theater' => $booking->theaterData->theater_name ?? '',
            'show_time' => \Carbon\Carbon::parse(
                $booking->showData->show_date.' '.$booking->showData->show_time
            )->format('d M Y, h:i A'),
            'screen_no' => $booking->screen_no ?? '',
            'seats' => $booking->seat_number
                        ? implode(', ', json_decode($booking->seat_number))
                        : '',
            'total_price' => $booking->total_price,
            'discount' => $booking->discount_amount ?? 0,
            'payment_id' => $booking->payment_id,
            'booking_reference' => $booking->booking_reference,
        ];

        $movieImage = asset('image_upload/'.$details['movie_image']);

        $userEmail = UserModel::where('id', $booking->user_id)->value('email');

        if ($userEmail) {
            Mail::to($userEmail)->send(new PaymentSuccessMail($details));
        }

        // ✅ PASS $details TO VIEW
        return view('Mail.invoice', compact('details', 'movieImage'));
    }

    abort(404);
}

public function downloadTicket($reference)
{
    $booking = BookingModel::where('booking_reference', $reference)
                ->with(['movieData','theaterData','showData','userData'])
                ->firstOrFail();

    if (
        $booking->payment_status !== 'completed' ||
        $booking->booking_status !== 'confirmed'
    ) {
        abort(403);
    }

    $details = $this->prepareDetailsArray($booking);

    $pdf = Pdf::loadView('Mail.ticket', compact('details'));

    return $pdf->download(
        'Ticket-'.$booking->booking_reference.'.pdf'
    );
}

// private function prepareDetailsArray($booking)
// {
//     $total = $booking->total_price;
//     $discount = $booking->discount_amount ?? 0;
//     $gstPercent = 18;

//     $taxable = $total - $discount;
//     $gst = ($taxable * $gstPercent) / 100;
//     $final = $taxable + $gst;

//     return [
//         'name' => optional($booking->userData)->name ?? 'Customer',
//         'movie' => $booking->movieData->movie_name ?? '',
//         'movie_image' => $booking->movieData->movie_image ?? '',
//         'language' => $booking->language ?? '',
//         'theater' => $booking->theaterData->theater_name ?? '',
//         'screen_no' => $booking->screen_no ?? '',
//         'show_time' => Carbon::parse(
//             $booking->showData->show_date.' '.$booking->showData->show_time
//         )->format('d M Y, h:i A'),
//         'seats' => $booking->seat_number
//                     ? implode(', ', json_decode($booking->seat_number))
//                     : '',
//         'total_price' => $total,
//         'discount' => $discount,
//         'gst_amount' => $gst,
//         'final_amount' => $final,
//         'payment_id' => $booking->payment_id ?? '',
//         'booking_reference' => $booking->booking_reference ?? '',
//     ];
// }



private function prepareDetailsArray($booking)
{
    $total = $booking->total_price;
    $discount = $booking->discount_amount ?? 0;

    $gstPercent = 18;
    $taxable = $total - $discount;
    $gst = ($taxable * $gstPercent) / 100;
    $final = $taxable + $gst;

    $details = [
        'booking_reference' => $booking->booking_reference,
        'name' => optional($booking->userData)->name ?? 'Customer',
        'movie' => $booking->movieData->movie_name ?? '',
        'language' => $booking->language ?? '',
        'theater' => $booking->theaterData->theater_name ?? '',
        'screen' => $booking->screen_no ?? '',
        'show_time' => Carbon::parse(
            $booking->showData->show_date.' '.$booking->showData->show_time
        )->format('d M Y, h:i A'),
        'seats' => $booking->seat_number
                    ? implode(', ', json_decode($booking->seat_number))
                    : '',
        'amount' => $final,
        'payment_id' => $booking->payment_id
    ];

    /* Convert ticket details to JSON */
    $qrPayload = json_encode($details);

    /* Generate QR using SVG backend (no Imagick needed) */
    $renderer = new ImageRenderer(
        new RendererStyle(200),
        new SvgImageBackEnd()
    );

    $writer = new Writer($renderer);

    $qrCode = base64_encode($writer->writeString($qrPayload));

    /* Add QR to details */
    $details['qr'] = $qrCode;
    $details['movie_image'] = $booking->movieData->movie_image ?? '';
    $details['total_price'] = $total;
    $details['discount'] = $discount;
    $details['gst_amount'] = $gst;
    $details['final_amount'] = $final;

    return $details;
}

}