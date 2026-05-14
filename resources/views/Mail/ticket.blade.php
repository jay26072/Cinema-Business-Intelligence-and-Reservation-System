<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cinema Ticket</title>

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    margin:0;
    padding:0;
}

.ticket{
    width:100%;
    border:2px solid #000;
}

/* MAIN ROW */
.row{
    display:table;
    width:100%;
}

/* LEFT STUB */
.stub{
    display:table-cell;
    width:22%;
    background:#111;
    color:#fff;
    text-align:center;
    vertical-align:middle;
    padding:15px;
}

/* PERFORATION */
.perforation{
    display:table-cell;
    width:2%;
    border-left:3px dashed #000;
}

/* RIGHT SIDE */
.main{
    display:table-cell;
    width:76%;
    padding:15px;
}

/* TITLE */
.title{
    font-size:22px;
    font-weight:bold;
    margin-bottom:10px;
}

/* MOVIE POSTER */
.poster{
    width:120px;
    border-radius:6px;
}

/* INFO TABLE */
.info{
    font-size:14px;
    margin-bottom:5px;
}

.label{
    color:#666;
    font-size:11px;
}

/* SEAT */
.seat{
    background:#000;
    color:#fff;
    padding:8px;
    font-weight:bold;
    text-align:center;
    border-radius:5px;
    margin-top:10px;
}

/* QR */
.qr{
    text-align:center;
    border:1px solid #000;
    padding:10px;
    font-size:12px;
    margin-top:10px;
}

/* FOOTER */
.footer{
    font-size:11px;
    text-align:center;
    padding:8px;
    background:#f2f2f2;
}

</style>
</head>

<body>

<div class="ticket">

<div class="row">

<!-- LEFT STUB -->
<div class="stub">

    <h3>CINEMA</h3>

    <p style="font-size:12px;">Booking Ref</p>

    <strong>{{ $details['booking_reference'] }}</strong>

    <br><br>

    <p style="font-size:12px;">Seats</p>

    <strong style="text-transform:uppercase;">{{ $details['seats'] }}</strong>

</div>

<!-- CUT LINE -->
<div class="perforation"></div>

<!-- MAIN CONTENT -->
<div class="main">

<div class="row">

<!-- POSTER -->
<div style="display:table-cell;width:140px;">
@php
$imagePath = public_path('image_upload/'.$details['movie_image']);
@endphp

@if(isset($details['movie_image']) && file_exists($imagePath))
<img src="{{ $imagePath }}" class="poster">
@endif
</div>

<!-- DETAILS -->
<div style="display:table-cell;padding-left:15px;vertical-align:top;">

<div class="title">
{{ $details['movie'] }}
</div>

<div class="info">
<span class="label">Language:</span>
{{ $details['language'] }}
</div>

<div class="info">
<span class="label">Theater:</span>
{{ $details['theater'] }}
</div>

<div class="info">
<span class="label">Show Time:</span>
{{ $details['show_time'] }}
</div>

<div class="info">
<span class="label">Screen:</span>
{{ $details['screen'] }}
</div>

<div class="seat" style="text-transform:uppercase;">
SEATS: {{ $details['seats'] }}
</div>

</div>

</div>

@php
$total = $details['total_price'];
$discount = $details['discount'];
$gst = (($total - $discount) * 18) / 100;
$final = ($total - $discount) + $gst;
@endphp

<br>

<strong>Total Paid: ₹{{ number_format($final,2) }}</strong>

<br>

Transaction ID: {{ $details['payment_id'] }}

<div class="qr">

Scan QR at Entry Gate

<br><br>

<img src="data:image/svg+xml;base64,{{ $details['qr'] }}" width="120">
</div>

</div>

</div>

<div class="footer">
Please arrive 15 minutes before showtime • No outside food allowed
</div>

</div>

</body>
</html>