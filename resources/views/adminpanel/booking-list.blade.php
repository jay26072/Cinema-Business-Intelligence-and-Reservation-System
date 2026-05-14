@extends('adminpanel.master')
@section('content')

<style>
.table td, .table th {
    text-align: center;
}
.filter-box{
    background:#f4f6f9;
    padding:15px;
    border-radius:8px;
    margin-bottom:15px;
}
</style>

<section class="content">
<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">🎟 Theater Booking History</h3>
</div>

<div class="card-body">

<!-- ================= FILTER ================= -->
<form method="GET" action="">
<div class="row filter-box">

<div class="col-md-3">
<select name="theater_id" class="form-control">
<option value="">All Theaters</option>
@foreach($theaters as $theater)
<option value="{{ $theater->id }}" {{ request('theater_id') == $theater->id ? 'selected' : '' }}>
{{ $theater->theater_name }}
</option>
@endforeach
</select>
</div>

<div class="col-md-2">
<select name="payment_status" class="form-control">
<option value="">Payment</option>
<option value="completed" {{ request('payment_status')=='completed'?'selected':'' }}>Paid</option>
<option value="pending" {{ request('payment_status')=='pending'?'selected':'' }}>Pending</option>
<option value="refunded" {{ request('payment_status')=='refunded'?'selected':'' }}>Refunded</option>
</select>
</div>

<div class="col-md-2">
<select name="show_time" class="form-control">
<option value="">All Show Times</option>

@foreach($showTimes as $time)
<option value="{{ $time }}" {{ request('show_time') == $time ? 'selected' : '' }}>
{{ \Carbon\Carbon::parse($time)->format('h:i A') }}
</option>
@endforeach

</select>
</div>

<div class="col-md-2">
<input type="date" name="date" value="{{ request('date') }}" class="form-control">
</div>

<div class="col-md-3">
<button class="btn btn-primary">Filter</button>
<a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
<div class="col-md-3 mt-2">
    <a href="{{ route('admin.bookings.pdf', request()->all()) }}" 
       class="btn btn-danger">
       Export PDF
    </a>
</div>
</div>


</div>
</form>

<!-- ================= TABLE ================= -->

<table id="example1" class="table table-bordered table-striped">

<thead>
<tr>
<th>ID</th>
<th>User</th>
<th>Theater</th>
<th>Movie</th>
<th>Show Time</th>
<th>Seats</th>
<th>Total</th>
<th>Booking Ref</th>
<th>Booked At</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@forelse($bookings as $booking)

<tr>

<td>{{ $booking->id }}</td>

<td style="text-transform:capitalize">
{{ $booking->userData->name ?? 'Guest' }}
</td>

<td>
{{ $booking->theaterData->theater_name ?? '-' }}
</td>

<td>
{{ $booking->movieData->movie_name ?? '-' }}
</td>

<td>
@php
$showTime = \Carbon\Carbon::parse($booking->showData->show_date.' '.$booking->showData->show_time);
@endphp

{{ $showTime->format('d M Y h:i A') }}

<br>

<span class="badge badge-dark">
@if($showTime->hour < 12)
Morning
@elseif($showTime->hour < 17)
Afternoon
@elseif($showTime->hour < 21)
Evening
@else
Night
@endif
</span>
</td>

<td style="text-transform:uppercase">
{{ implode(', ', json_decode($booking->seat_number)) }}
</td>

<td>₹ {{ number_format($booking->total_price,2) }}</td>

<td>{{ $booking->booking_reference }}</td>

<td>
{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y h:i A') }}
</td>

<td>

@if($booking->payment_status == 'completed')
<span class="badge badge-success">Paid</span>

@elseif($booking->payment_status == 'refunded')
<span class="badge badge-info">Refunded</span>

@else
<span class="badge badge-warning">Pending</span>
@endif

</td>

</tr>

@empty

<tr>
<td colspan="10">No booking found</td>
</tr>

@endforelse

</tbody>

</table>

</div>
</div>

</div>
</section>

<!-- ================= DATATABLE ================= -->
<script>
$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
        "order": [[0, "desc"]]
    });
});
</script>

@endsection