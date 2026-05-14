@extends('adminpanel.master')
@section('content')
    <div class="row">
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="statistics-details d-flex align-items-center justify-content-between">

@php
$revUp = $revenueGrowth >= 0;
$bookUp = $bookingGrowth >= 0;
@endphp

<!-- 🎭 Total Theaters -->
<div>
    <p class="statistics-title">Total Theaters</p>
    <h3 class="rate-percentage">{{ $totalTheaters }}</h3>

    <p class="text-info d-flex">
        <i class="mdi mdi-home"></i>
        <span>Active</span>
    </p>
</div>

<!-- 💰 Total Revenue -->
<div>
    <p class="statistics-title">Total Revenue</p>
    <h3 class="rate-percentage">₹ {{ number_format($totalRevenue) }}</h3>

    <p class="d-flex {{ $revUp ? 'text-success' : 'text-danger' }}">
        <i class="mdi {{ $revUp ? 'mdi-menu-up' : 'mdi-menu-down' }}"></i>
        <span>{{ $revUp ? 'Increasing' : 'Decreasing' }}</span>
    </p>
</div>

<!-- 🎟 Total Bookings -->
<div>
    <p class="statistics-title">Total Bookings</p>
    <h3 class="rate-percentage" id="totalBookings">{{ $totalBookings }}</h3>

    <p class="d-flex {{ $bookUp ? 'text-success' : 'text-danger' }}">
        <i class="mdi {{ $bookUp ? 'mdi-menu-up' : 'mdi-menu-down' }}"></i>
        <span>{{ $bookUp ? 'Increasing' : 'Decreasing' }}</span>
    </p>
</div>

<!-- 🏆 Top Theater -->
<div>
    <p class="statistics-title">Top Theater</p>
    <h3 class="rate-percentage">
        {{ $topTheater && $topTheater->theaterData 
    ? $topTheater->theaterData->theater_name 
    : 'N/A' 
}}
    </h3>

    <p class="text-success d-flex">
        <i class="mdi mdi-star"></i>
        <span>₹ {{ number_format($topTheater->revenue ?? 0) }}</span>
    </p>
</div>

</div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
            <div class="row">

    <!-- 📊 BAR CHART -->
    <div class="col-lg-8">
        <div class="card card-rounded">
            <div class="card-body">

                <!-- HEADER -->
                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title card-title-dash">Market Overview</h4>
                        <p class="card-subtitle card-subtitle-dash">
                            Movie performance based on bookings & revenue
                        </p>
                    </div>

                    <div>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle btn-lg" data-bs-toggle="dropdown">
                                {{ ucfirst($filter) }}
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="?filter=today">Today</a>
                                <a class="dropdown-item" href="?filter=week">This Week</a>
                                <a class="dropdown-item" href="?filter=month">This Month</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SUMMARY -->
                <div class="d-sm-flex align-items-center mt-3 justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div>
                            <h2 class="fw-bold">
                                ₹ {{ number_format($totalRevenue) }}
                            </h2>
                            <small>Total Revenue</small>
                        </div>

                        <div>
                            <h4>{{ $totalBookings }}</h4>
                            <small>Bookings</small>
                        </div>

                        <div>
                            <h5>{{ $topTheater->theaterData->theater_name ?? '-' }}</h5>
                            <small>Top Theater</small>
                        </div>
                    </div>
                </div>

                <!-- BAR CHART -->
                <div style="height:350px;">
                    <canvas id="marketingOverview"></canvas>
                </div>

            </div>
        </div>
    </div>

    <!-- 🥧 PIE CHART -->
    <div class="col-lg-4">
        <div class="card card-rounded">
            <div class="card-body">

                <h4 class="card-title">Revenue Share</h4>

                <div style="height:350px;">
                    <canvas id="revenuePieChart"></canvas>
                </div>

            </div>
        </div>
    </div>

</div>
        

<div class="card mt-4">
<div class="card-header">🎭 Theater-wise Revenue</div>
<div class="card-body">

<table class="table table-bordered">
<tr>
<th>Theater</th>
<th>Revenue</th>
<th>Bookings</th>
</tr>

@foreach($theaterStats as $t)
<tr>
<td>{{ $t->theaterData->theater_name }}</td>
<td>₹ {{ number_format($t->revenue) }}</td>
<td>{{ $t->bookings }}</td>
</tr>
@endforeach

</table>

</div>
</div>

<div class="card mt-4">
<div class="card-header">🎟 Seat Occupancy</div>
<div class="card-body">

@foreach($occupancy as $o)

@php
$movie = \App\Models\MovieModel::find($o->movie_id);
@endphp

<div class="mb-3">
    <strong>{{ $movie->movie_name }}</strong>

    <div class="progress">
        <div class="progress-bar 
            @if($o->percent > 70) bg-success
            @elseif($o->percent > 40) bg-warning
            @else bg-danger
            @endif"
            style="width: {{ $o->percent }}%">
            {{ $o->percent }}%
        </div>
    </div>
</div>

@endforeach

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
let chart;
let pieChart;

document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('marketingOverview').getContext('2d');

    chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [
                {
                    label: 'Bookings',
                    data: @json($bookingData),
                    borderWidth: 1,
                    borderRadius: 6,
                    backgroundColor: '#4B49AC'
                },
                {
                    label: 'Revenue (₹)',
                    data: @json($revenueData),
                    type: 'line',
                    tension: 0.4,
                    yAxisID: 'y1',
                    borderColor: '#FFC100',
                    backgroundColor: '#FFC100'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    const pieCtx = document.getElementById('revenuePieChart').getContext('2d');

    pieChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: @json($pieLabels),
            datasets: [{
                data: @json($pieData),
                backgroundColor: [
                    '#4B49AC',
                    '#FFC100',
                    '#FF4747',
                    '#28A745',
                    '#17A2B8',
                    '#6F42C1',
                    '#FD7E14'
                ]
            }]
        },
        options: {
            responsive: true,
            cutout: '60%'
        }
    });

    // 🚀 AUTO REFRESH EVERY 5 SEC
    setInterval(fetchDashboardData, 5000);
});


// 🔥 FETCH NEW DATA
function fetchDashboardData() {

    fetch("{{ url('/admin/dashboard-data') }}?filter={{ $filter }}")
        .then(response => response.json())
        .then(data => {

            // 🔄 UPDATE BAR CHART
            chart.data.labels = data.labels;
            chart.data.datasets[0].data = data.bookingData;
            chart.data.datasets[1].data = data.revenueData;
            chart.update();

            // 🔄 UPDATE PIE CHART
            pieChart.data.labels = data.pieLabels;
            pieChart.data.datasets[0].data = data.pieData;
            pieChart.update();

            // 🔄 UPDATE TOP VALUES (optional if IDs exist)
            if (document.getElementById('totalRevenue')) {
                document.getElementById('totalRevenue').innerText =
                    "₹ " + Number(data.totalRevenue).toLocaleString();
            }

            if (document.getElementById('totalBookings')) {
                document.getElementById('totalBookings').innerText =
                    data.totalBookings;
            }

        })
        .catch(err => console.log("Error:", err));
}
</script>
@endsection