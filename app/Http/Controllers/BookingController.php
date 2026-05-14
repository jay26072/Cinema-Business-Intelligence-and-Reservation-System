<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingModel;
use App\Models\ShowModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class BookingController extends Controller
{
public function createBooking(Request $request)
{
    $request->validate([
        'show_id' => 'required',
        'seats' => 'required|array|min:1'
    ]);

    DB::beginTransaction();

    try {

        $show = ShowModel::find($request->show_id);

        // 🔒 Check seat availability
        foreach($request->seats as $seat){

            $exists = BookingModel::where('show_id', $request->show_id)
                ->whereJsonContains('seat_number', $seat)
                ->where(function($q){
                    $q->where('booking_status','confirmed')
                      ->orWhere(function($q2){
                          $q2->where('booking_status','locked')
                             ->where('expires_at','>', now());
                      });
                })
                ->exists();

            if($exists){
                return response()->json([
                    'status' => 'failed',
                    'message' => "Seat $seat already booked"
                ]);
            }
        }

        // $totalPrice = $request->total_price;

        $totalPrice = $request->total_price;
        $discount = $request->discount_amount ?? 0;

        $taxableAmount = $totalPrice - $discount;
        $gstPercent = $taxableAmount > 100 ? 18 : 12;

        $gstAmount = ($taxableAmount * $gstPercent) / 100;
        $finalPrice = $taxableAmount + $gstAmount;


        $booking = BookingModel::create([
            'user_id' => Session('UserLogginId') ?? NULL,
            'show_id' => $request->show_id,
            'movie_id' => $show->movie_id,
            'theater_id' => $show->theater_id,
            'booking_reference' => 'BK'.Str::upper(Str::random(8)),
            'seat_number' => json_encode($request->seats),
            'screen_type' => $show->screen_type,
            'screen_no' => $show->screen_no,
            'language' => $show->language,
            'total_price' => $totalPrice,
            'gst_amount' => $gstAmount,
            'final_price' => $finalPrice,
            'payment_method' => 'online',
            'payment_status' => 'pending',
            'booking_status' => 'locked',
            'expires_at' => now()->addMinutes(5)
        ]);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'booking_id' => $booking->id
        ]);

    } catch (\Exception $e) {

        DB::rollback();

        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}

public function seatSelection($showId)
{
    // 🔓 Auto release expired seats
    BookingModel::where('booking_status','locked')
        ->where('expires_at','<', now())
        ->update([
            'booking_status'=>'cancelled'
        ]);

    // Then load show data
    $show = ShowModel::findOrFail($showId);

    // Get booked seats (only valid ones)
    $bookedSeats = BookingModel::where('show_id', $showId)
        ->where(function($q){
            $q->where('booking_status','confirmed')
              ->orWhere(function($q2){
                  $q2->where('booking_status','locked')
                     ->where('expires_at','>', now());
              });
        })
        ->pluck('seat_number')
        ->toArray();

    return view('userpanel.seat-selection', compact('show','bookedSeats'));
}



public function confirmBooking($bookingId)
{
    $booking = BookingModel::where('id', $bookingId)
        ->where('booking_status','locked')
        ->where('expires_at','>', now())
        ->firstOrFail();

    $booking->update([
        'payment_status' => 'completed',
        'booking_status' => 'confirmed',
        'expires_at' => null
    ]);

    return redirect()->route('booking.success');
}


}
