<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Ticket Cancelled</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:40px 0;">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.08);">

<!-- Header -->
<tr>
<td style="background:#e74c3c;color:#ffffff;padding:20px;text-align:center;font-size:22px;font-weight:bold;">
🎬 Booking Cancelled
</td>
</tr>

<!-- Body -->
<tr>
<td style="padding:30px;color:#333333;font-size:15px;line-height:1.6;">

<p>Hello <strong>{{ $details['name'] }}</strong>,</p>

<p>Your movie booking has been <strong style="color:#e74c3c;">successfully cancelled</strong>. Below are the details of your cancelled ticket.</p>

<table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;margin-top:20px;font-size:14px;">

<tr style="background:#f7f7f7;">
<td style="font-weight:bold;border:1px solid #eeeeee;">Movie</td>
<td style="border:1px solid #eeeeee;">{{ $details['movie'] }}</td>
</tr>

<tr>
<td style="font-weight:bold;border:1px solid #eeeeee;">Theater</td>
<td style="border:1px solid #eeeeee;">{{ $details['theater'] }}</td>
</tr>

<tr style="background:#f7f7f7;">
<td style="font-weight:bold;border:1px solid #eeeeee;">Show Time</td>
<td style="border:1px solid #eeeeee;">{{ $details['show_time'] }}</td>
</tr>

<tr>
<td style="font-weight:bold;border:1px solid #eeeeee;">Seats</td>
<td style="border:1px solid #eeeeee; text-transform:uppercase">{{ $details['seats'] }}</td>
</tr>

<tr style="background:#f7f7f7;">
<td style="font-weight:bold;border:1px solid #eeeeee;">Booking Reference</td>
<td style="border:1px solid #eeeeee;">{{ $details['booking_reference'] }}</td>
</tr>

<tr>
<td style="font-weight:bold;border:1px solid #eeeeee;">Refund Amount</td>
<td style="border:1px solid #eeeeee;color:#27ae60;font-weight:bold;">
₹ {{ number_format($details['final_amount'],2) }}
</td>
</tr>

</table>

<p style="margin-top:20px;">
The refund will be processed to your <strong>original payment method</strong>. Please allow a few business days for the amount to reflect in your account.
</p>

<p style="margin-top:25px;">Thank you for using our booking service.</p>

</td>
</tr>

<!-- Footer -->
<tr>
<td style="background:#f4f6f9;text-align:center;padding:20px;font-size:13px;color:#777;">
© {{ date('Y') }} Movie Booking System <br>
This is an automated email. Please do not reply.
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>