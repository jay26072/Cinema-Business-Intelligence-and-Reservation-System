<ul class="seat-plan-wrapper bg-five">
@foreach($theaters as $theater)
<li>
    <div class="movie-name">
        <a href="#" class="name">{{ $theater->theater_name }}</a>
    </div>

    <div class="movie-schedule">

        @if($showtime->has($theater->id))

            @foreach($showtime[$theater->id] as $time)
                <div class="item">
                    <a href="{{ url('seat-selection/'.$time->id) }}" 
                       class="time"
                       style="color:white;"
                       data-date="{{ $time->show_date }}"
                       data-time="{{ $time->show_time }}">
                        {{ \Carbon\Carbon::parse($time->show_time)->format('h:i A') }}
                    </a>
                </div>
            @endforeach

        @else
            <p>No Show Available</p>
        @endif

    </div>
</li>
@endforeach
</ul>

