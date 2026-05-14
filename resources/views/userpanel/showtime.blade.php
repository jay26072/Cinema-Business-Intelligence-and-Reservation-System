@extends('userpanel.master')
@section('content')

<style>
    .showtime-wrapper {
    position: relative;
}

.blur-overlay {
    position: absolute;
    inset: 0;

    backdrop-filter: blur(6px);
    background: rgba(0,0,0,0.35);

    display: flex;              /*  always flex */
    align-items: center;        /* vertical center */
    justify-content: center;    /* horizontal center */

    opacity: 0;                 /* hide using opacity */
    visibility: hidden;
    transition: all 0.3s ease;

    z-index: 10;
    border-radius: 10px;
}

/* 🔥 When Active */
.blur-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* Smooth blur transition */
.blur-active #showtime-content {
    filter: blur(5px);
    transition: all 0.3s ease;
}

/* Spinner */
.loader-spinner {
    width: 45px;
    height: 45px;
    border: 4px solid rgba(255,255,255,0.3);
    border-top: 4px solid #ff4c4c;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    100% { transform: rotate(360deg); }
}
</style>
 <!-- ==========Banner-Section========== -->
    <section class="details-banner hero-area bg_img" data-background="./assets/images/banner/banner04.jpg">
        <div class="container">
            <div class="details-banner-wrapper">
                <div class="details-banner-content">
                    <h3 class="title">{{ $movie->movie_name }}</h3>
                    <div class="tags">
                        @php
                            $languages = ["English","Hindi","Gujarati","Tamil","Kannada"];
                            $selectedLanguages = array_intersect($languages, $movie->language ?? []);
                        @endphp

                        @if(count($selectedLanguages))
                            <label>{{ implode(', ', $selectedLanguages) }}</label>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Book-Section========== -->
    <section class="book-section bg-one">
        <div class="container">
            <form class="ticket-search-form two">
                <!-- <div class="form-group">
                    <div class="thumb">
                        <img src="{{asset('assets/images/city.png')}}" alt="ticket">
                    </div>
                    <span class="type">city</span>
                    <select class="select-bar">
                        <option value="london">London</option>
                        <option value="dhaka">dhaka</option>
                        <option value="rosario">rosario</option>
                        <option value="madrid">madrid</option>
                        <option value="koltaka">kolkata</option>
                        <option value="rome">rome</option>
                        <option value="khoksa">khoksa</option>
                    </select>
                </div> -->

                <div class="form-group">
                    <div class="thumb">
                        <img src="{{asset('assets/images/date.png')}}" alt="ticket">
                    </div>
                    <span class="type">date</span>
                    <select class="select-bar" id="date-select">
                        @php
                            $startDate = \Carbon\Carbon::today();
                        @endphp

                        @for ($i = 0; $i < 7; $i++)
                            @php
                                $date = $startDate->copy()->addDays($i);
                            @endphp

                            <option value="{{ $date->format('Y-m-d') }}">{{ $date->format('d M Y') }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <div class="thumb">
                        <img src="{{asset('assets/images/exp.png')}}" alt="ticket">
                    </div>
                    <span class="type">Experience</span>
                    <select class="select-bar" id="experience-select">
                       @foreach($screxps as $screxp)
                       <option value="{{$screxp->id}}">{{$screxp->screen_type}}</option>
                       @endforeach
                    </select>
                </div>
            </form>
        </div>
    </section>
    <!-- ==========Book-Section========== -->

    <!-- ==========Movie-Section========== -->
    <div class="ticket-plan-section padding-bottom padding-top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 mb-5 mb-lg-0">
                    <div id="showtime-wrapper" class="showtime-wrapper">
                        <div id="blur-overlay" class="blur-overlay">
                            <div class="loader-spinner"></div>
                        </div>

                        <div id="showtime-content">
                            @include('userpanel.partials.showtime')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========Movie-Section========== -->
<script>
function convertTo12Hour(time24) {
    let [hours, minutes] = time24.split(':');

    hours = parseInt(hours);

    let ampm = hours >= 12 ? 'PM' : 'AM';

    hours = hours % 12;
    hours = hours ? hours : 12;

    return hours.toString().padStart(2, '0') + ':' + minutes + ' ' + ampm;
}

document.addEventListener("DOMContentLoaded", function () {

    let now = new Date();

    document.querySelectorAll('.time').forEach(function (el) {

        let showDate = el.dataset.date;   // YYYY-MM-DD
        let showTime = el.dataset.time;   // HH:MM:SS

        if (!showDate || !showTime) return;

        let showDateTime = new Date(showDate + "T" + showTime);

        // Hide past shows
        if (showDateTime < now) {
            el.parentElement.style.display = "none";
        } else {
            // Convert to 12-hour format
            el.textContent = convertTo12Hour(showTime);
        }

    });

});
</script>



<script>
    $(document).ready(function(){

    function hidePastShows(){

        let now = new Date();

        $(".time").each(function(){

            let showDate = $(this).data("date");
            let showTime = $(this).data("time");

            if(!showDate || !showTime) return;

            let showDateTime = new Date(showDate + "T" + showTime);

            if(showDateTime < now){
                $(this).closest(".item").hide();
            }

        });
    }

    function loadShowtimes(){

        let date = $("#date-select").val();
        let exp  = $("#experience-select").val();

        // 🔥 Activate blur
        $("#blur-overlay").addClass("active");
        $("#showtime-wrapper").addClass("blur-active");

        $.ajax({
            url: "{{ route('showtime', $movie->id) }}",
            type: "GET",
            data: {
                date: date,
                experience: exp
            },
            success: function(response){

                setTimeout(function(){

                    $("#showtime-content").html(response);

                    hidePastShows();

                    $("#blur-overlay").removeClass("active");
                    $("#showtime-wrapper").removeClass("blur-active");

                }, 400);

            }
        });
    }

    $(document).on("change", "#date-select", loadShowtimes);
    $(document).on("change", "#experience-select", loadShowtimes);

    hidePastShows();

});
</script>
@endsection