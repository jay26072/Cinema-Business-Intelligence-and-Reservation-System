@extends('theaterpanel.master')
@section('content')
    <div class="row">
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                         <div class="statistics-details d-flex align-items-center justify-content-between">

    <!-- 🎬 Total Movies -->
    @php
$movieUp = $movieGrowth >= 0;
@endphp

<div>
    <p class="statistics-title">Total Movies</p>

    <h3 class="rate-percentage">
        {{ $totalMovies }}
    </h3>

    <p class="d-flex {{ $movieUp ? 'text-success' : 'text-danger' }}">
        <i class="mdi {{ $movieUp ? 'mdi-menu-up' : 'mdi-menu-down' }}"></i>
        <span>{{ $movieUp ? 'Active' : 'Decreasing' }}</span>
    </p>
</div>

    <!-- 💰 Revenue -->
    <div>
        <p class="statistics-title">Total Revenue</p>
        <h3 class="rate-percentage">₹ {{ number_format($movieStats->sum('revenue')) }}</h3>
        @php
$revUp = $revenueGrowth >= 0;
@endphp

<p class="d-flex {{ $revUp ? 'text-success' : 'text-danger' }}">
    <i class="mdi {{ $revUp ? 'mdi-menu-up' : 'mdi-menu-down' }}"></i>
    <span>{{ $revUp ? '+ Revenue' : 'Revenue Down' }}</span>
</p>
    </div>

    <!-- 🎟 Bookings -->
    <div>
        <p class="statistics-title">Total Bookings</p>
        <h3 class="rate-percentage">{{ $movieStats->sum('bookings') }}</h3>
        @php
$bookUp = $bookingGrowth >= 0;
@endphp

<p class="d-flex {{ $bookUp ? 'text-success' : 'text-danger' }}">
    <i class="mdi {{ $bookUp ? 'mdi-menu-up' : 'mdi-menu-down' }}"></i>
    <span>{{ $bookUp ? 'Increasing' : 'Decreasing' }}</span>
</p>
    </div>

    

    <!-- 🏆 Top Movie -->
    <div class="d-none d-md-block">
        <p class="statistics-title">Top Movie</p>
        <h3 class="rate-percentage">
            {{ $topMovie->movieData->movie_name ?? '-' }}
        </h3>
        <p class="d-flex {{ $revUp ? 'text-success' : 'text-danger' }}">
    <i class="mdi {{ $revUp ? 'mdi-menu-up' : 'mdi-menu-down' }}"></i>
    <span>₹ {{ number_format($topMovie->revenue ?? 0) }}</span>
</p>
    </div>

    <!-- 🎟 Occupancy -->
    <div class="d-none d-md-block">
        <p class="statistics-title">Avg Occupancy</p>
        <h3 class="rate-percentage">
            {{ round($occupancy->avg('percent')) }}%
        </h3>
        @php
$occUp = $occupancyGrowth >= 0;
@endphp

<p class="d-flex {{ $occUp ? 'text-success' : 'text-danger' }}">
    <i class="mdi {{ $occUp ? 'mdi-menu-up' : 'mdi-menu-down' }}"></i>
    <span>Seats Filled</span>
</p>
    </div>

    <!-- Growth -->
    <div>
    <p class="statistics-title">Growth</p>
    <h3 class="rate-percentage">
        {{ $revenueGrowth }}%
    </h3>

    <p class="d-flex {{ $revenueGrowth >= 0 ? 'text-success' : 'text-danger' }}">
        <i class="mdi {{ $revenueGrowth >= 0 ? 'mdi-menu-up' : 'mdi-menu-down' }}"></i>
        <span>{{ $revenueGrowth >= 0 ? 'Increasing' : 'Decreasing' }}</span>
    </p>
</div>

    <!-- 📊 Extra Metric -->
    <div class="d-none d-md-block">
        <p class="statistics-title">Total Shows</p>
        <h3 class="rate-percentage">
            {{ \App\Models\ShowModel::where('theater_id', session('TheaterManagerLogginId')->id)->count() }}
        </h3>
        <p class="text-info d-flex">
            <i class="mdi mdi-movie"></i>
            <span>Running</span>
        </p>
    </div>

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
                                ₹ {{ number_format($movieStats->sum('revenue')) }}
                            </h2>
                            <small>Total Revenue</small>
                        </div>

                        <div>
                            <h4>{{ $movieStats->sum('bookings') }}</h4>
                            <small>Bookings</small>
                        </div>

                        <div>
                            <h5>{{ $topMovie->movieData->movie_name ?? '-' }}</h5>
                            <small>Top Movie</small>
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
<div class="card-header">🎬 Movie-wise Revenue</div>
<div class="card-body">

<table class="table table-bordered">
<tr>
<th>Movie</th>
<th>Revenue</th>
<th>Bookings</th>
</tr>

@foreach($movieStats as $m)
<tr>
<td>{{ $m->movieData->movie_name }}</td>
<td>₹ {{ number_format($m->revenue) }}</td>
<td>{{ $m->bookings }}</td>
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
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Bookings' }
                },
                y1: {
                    beginAtZero: true,
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    title: { display: true, text: 'Revenue ₹' }
                }
            }
        }
    });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const pieCtx = document.getElementById('revenuePieChart').getContext('2d');

    new Chart(pieCtx, {
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
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

});
</script>
@endsection