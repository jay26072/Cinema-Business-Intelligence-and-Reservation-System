<!DOCTYPE html>
<html>
<head>
    <title>Booking Report</title>
    <style>
        body { font-family: DejaVu Sans; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:6px; font-size:12px; }
    </style>
</head>
<body>

<h2>🎟 Booking Report</h2>

<table>
<thead>
<tr>
<th>ID</th>
<th>User</th>
<th>Movie</th>
<th>Theater</th>
<th>Show</th>
<th>Seats</th>
<th>Total</th>
</tr>
</thead>

<tbody>
@foreach($bookings as $b)
<tr>
<td>{{ $b->id }}</td>
<td>{{ $b->userData->name ?? '' }}</td>
<td>{{ $b->movieData->movie_name ?? '' }}</td>
<td>{{ $b->theaterData->theater_name ?? '' }}</td>
<td>{{ $b->showData->show_date }} {{ $b->showData->show_time }}</td>
<td>{{ implode(',', json_decode($b->seat_number)) }}</td>
<td>₹ {{ $b->total_price }}</td>
</tr>
@endforeach
</tbody>
</table>

</body>
</html>