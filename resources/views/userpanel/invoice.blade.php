<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Movie Ticket Invoice</title>
</head>

<body style="margin:0; padding:0; background:#f3f4f6; font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">

<table width="680" cellpadding="0" cellspacing="0" style="background:#ffffff; margin:40px 0; border-radius:12px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">

    <!-- HEADER -->
    <tr>
        <td style="background:linear-gradient(90deg,#111827,#1f2937); padding:25px; color:#ffffff;">
            <h2 style="margin:0;">🎬 Cinema Reservation</h2>
            <p style="margin:6px 0 0; font-size:14px;">
                Booking Ref: <strong>{{ $details['booking_reference'] }}</strong>
            </p>
        </td>
    </tr>

    <!-- MOVIE POSTER + DETAILS -->
    <tr>
        <td style="padding:25px;">
            <table width="100%">
                <tr>
                    <!-- Movie Poster -->
                    <td width="180" valign="top">
                        <img src="{{ asset('image_upload/'.$details['movie_image']) }}"
                            style="width:160px; border-radius:10px; box-shadow:0 6px 15px rgba(0,0,0,0.15);">
                    </td>

                    <!-- Booking Info -->
                    <td valign="top" style="padding-left:20px;">
                        <h3 style="margin:0 0 10px 0;">{{ $details['movie'] }}</h3>
                        <p style="margin:5px 0;"><strong>Theater:</strong> {{ $details['theater'] }}</p>
                        <p style="margin:5px 0;"><strong>Date & Time:</strong> {{ $details['show_time'] }}</p>
                        <p style="margin:5px 0;"><strong>Screen:</strong> {{ $details['screen_no'] }}</p>
                        <p style="margin:5px 0; text-transform:capitalize;"><strong>Seats:</strong> {{ $details['seats'] }}</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- PAYMENT SUMMARY -->
    @php
    $total = $details['total_price'] ?? 0;
    $discount = $details['discount'] ?? 0;
    $gst = $details['gst_amount'] ?? 0;
    $final = $details['final_price'] ?? 0;
    $gstPercent = 18;
@endphp

    <tr>
        <td style="padding:0 25px 25px;">
            <h3 style="margin-bottom:15px;">Payment Summary</h3>

            <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;">

                <tr style="background:#f9fafb;">
    <td>Ticket Price</td>
    <td align="right">₹{{ number_format($total,2) }}</td>
</tr>

<tr>
    <td>Discount</td>
    <td align="right" style="color:#dc2626;">
        - ₹{{ number_format($discount,2) }}
    </td>
</tr>

<tr style="background:#f9fafb;">
    <td>GST ({{ $gstPercent }}%)</td>
    <td align="right">₹{{ number_format($gst,2) }}</td>
</tr>

<tr style="background:#111827; color:#ffffff; font-weight:bold;">
    <td>Total Paid</td>
    <td align="right">₹{{ number_format($final,2) }}</td>
</tr>

            </table>
        </td>
    </tr>

    <!-- PAYMENT INFO -->
    <tr>
        <td style="padding:0 25px 25px;">
            <p><strong>Transaction ID:</strong> {{ $details['payment_id'] }}</p>
            <p>Status: <strong style="color:#16a34a;">Paid</strong></p>
        </td>
    </tr>

    <!-- FOOTER -->
    <tr>
        <td style="background:#f3f4f6; padding:20px; text-align:center; font-size:13px; color:#6b7280;">
            Thank you for choosing our cinema 🎥<br>
            Please show this email at the theater entrance.
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>