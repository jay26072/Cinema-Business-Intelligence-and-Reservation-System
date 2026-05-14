@extends('theaterpanel.master')
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
.filter-box select,
.filter-box input {
    height: 40px;
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
<form method="GET">
<div class="row filter-box">

    <!-- 📅 Date -->
    <div class="col-md-2">
        <input type="date" name="date" value="{{ request('date') }}" class="form-control">
    </div>

    <!-- ⏰ Show Time -->
    <div class="col-md-2">
        <select name="show_time" class="form-control">
            <option value="">All Times</option>
            @foreach($showTimes as $time)
                <option value="{{ $time }}" {{ request('show_time') == $time ? 'selected' : '' }}>
                    {{ date('h:i A', strtotime($time)) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- 🎬 Movie -->
    <div class="col-md-3">
        <select name="movie_id" class="form-control">
            <option value="">All Movies</option>
            @foreach($movies as $movie)
                <option value="{{ $movie->id }}" {{ request('movie_id') == $movie->id ? 'selected' : '' }}>
                    {{ $movie->movie_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- 💳 Payment -->
    <div class="col-md-2">
        <select name="payment_status" class="form-control">
            <option value="">Payment</option>
            <option value="completed" {{ request('payment_status')=='completed'?'selected':'' }}>Paid</option>
            <option value="pending" {{ request('payment_status')=='pending'?'selected':'' }}>Pending</option>
            <option value="refunded" {{ request('payment_status')=='refunded'?'selected':'' }}>Refunded</option>
        </select>
    </div>

    <!-- 🔘 Buttons -->
    <div class="col-md-3 d-flex gap-2">
        <button class="btn btn-primary w-50">Filter</button>
        <a href="{{ url()->current() }}" class="btn btn-secondary w-50">Reset</a>
    </div>

</div>
</form>

<!-- ================= TABLE ================= -->

<h5>Total Bookings: {{ $bookings->count() }}</h5>

<table id="example1" class="table table-bordered table-striped">

<thead>
<tr>
<th>ID</th>
<th>User</th>
<th>Movie</th>
<th>Show Time</th>
<th>Seats</th>
<th>Total</th>
<th>Reference</th>
<th>Status</th>
</tr>
</thead>

<tbody style="text-transform: capitalize;">

@forelse($bookings as $booking)

<tr>
<td>{{ $booking->id }}</td>

<td>{{ $booking->userData->name ?? 'Guest' }}</td>

<td>{{ $booking->movieData->movie_name ?? '-' }}</td>

<td>
{{ \Carbon\Carbon::parse($booking->showData->show_date.' '.$booking->showData->show_time)->format('d M Y h:i A') }}
</td>

<td>
{{ implode(', ', json_decode($booking->seat_number)) }}
</td>

<td>₹ {{ number_format($booking->total_price,2) }}</td>

<td>{{ $booking->booking_reference }}</td>

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
<td colspan="8">No booking found</td>
</tr>

@endforelse

</tbody>

</table>

</div>
</div>

</div>
</section>

@endsection