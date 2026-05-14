@extends('userpanel.master')
@section('content')

<section class="account-section bg_img" data-background="./assets/images/account/account-bg.jpg">

<div class="container">
<div class="padding-top padding-bottom">

<div class="account-area" style="max-width:1000px">

<div class="section-header-3">
<span class="cate">Your Activity</span>
<h2 class="title">Booking History</h2>
</div>

<div class="table-responsive">

<table class="table table-bordered table-striped text-center">

<thead style="background:#111;color:#fff">
<tr>
<th>#</th>
<th>Movie</th>
<th>Theater</th>
<th>Show Time</th>
<th>Seats</th>
<th>Total</th>
<th>Status</th>
<th>Ticket</th>
</tr>
</thead>

<tbody>

@forelse($bookings as $key => $booking)

<tr>

<td style="color:white">{{ $key+1 }}</td>

<td style="color:white">{{ $booking->movieData->movie_name ?? '' }}</td>

<td style="color:white">{{ $booking->theaterData->theater_name ?? '' }}</td>

<td style="color:white">
{{ \Carbon\Carbon::parse($booking->showData->show_date.' '.$booking->showData->show_time)->format('d M Y, h:i A') }}
</td>

<td style="color:white; text-transform:uppercase">
{{ implode(', ', json_decode($booking->seat_number)) }}
</td>

<td style="color:white">₹ {{ number_format($booking->total_price,2) }}</td>

<td style="color:white">

@if($booking->payment_status == 'completed')

<span style="color:green;font-weight:bold">Paid</span>

@elseif($booking->payment_status == 'refunded')

<span style="color:orange;font-weight:bold">Refunded</span>

@else

<span style="color:red">Cancelled</span>

@endif

</td>

<td>

@if($booking->payment_status == 'completed')

@php
$showDateTime = \Carbon\Carbon::parse($booking->showData->show_date.' '.$booking->showData->show_time);
$minutesLeft = now()->diffInMinutes($showDateTime, false);
@endphp

<div class="dropdown">

<button class="btn btn-primary btn-sm dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false">
Actions
</button>

<ul class="dropdown-menu">

    {{-- Download always allowed until showtime --}}
    @if($showDateTime->isFuture())
        <li>
            <a class="dropdown-item"
               href="{{ url('/ticket/download/'.$booking->booking_reference) }}">
               🎟 Download Ticket
            </a>
        </li>
    @endif

    {{-- Cancel only before 1 hour --}}
    @if($minutesLeft >= 60)
        <li>
            <a class="dropdown-item text-danger"
               href="{{ url('/cancel-booking/'.$booking->id) }}"
               onclick="return confirm('Cancel booking and process refund?')">
               ❌ Cancel Booking
            </a>
        </li>
    @else
        <li>
            <span class="dropdown-item text-muted">
                Cancellation Closed
            </span>
        </li>
    @endif

</ul>
</div>

@else

-

@endif

</td>

</tr>

@empty

<tr>
<td colspan="8">No Booking Found</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>
</div>

</section>

@endsection