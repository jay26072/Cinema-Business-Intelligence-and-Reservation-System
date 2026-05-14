@extends('userpanel.master')
@section('content')


    <!-- ==========Banner-Section========== -->
    <section class="banner-section">
        <div class="banner-bg bg_img bg-fixed" data-background="./assets/images/banner/banner01.jpg"></div>
        <div class="container">
            <div class="banner-content">
                <h1 class="title  cd-headline clip"><span class="d-block">book your</span> tickets for 
                    <span class="color-theme cd-words-wrapper p-0 m-0">
                        <b class="is-visible">Movie</b>
                    </span>
                </h1>
                <p>Safe, secure, reliable ticketing.Your ticket to live entertainment!</p>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Ticket-Search========== -->
    <section class="search-ticket-section padding-top pt-lg-0">
        <div class="container">
            <div class="search-tab bg_img" data-background="./assets/images/ticket/ticket-bg01.jpg">
                <div class="row align-items-center mb--20">
                    <div class="col-lg-6 mb-20">
                        <div class="search-ticket-header">
                            <h6 class="category">welcome to Boleto </h6>
                            <h3 class="title">what are you looking for</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-20">
                        <ul class="tab-menu ticket-tab-menu">
                            <li class="active">
                                <div class="tab-thumb">
                                    <img src="./assets/images/ticket/ticket-tab01.png" alt="ticket">
                                </div>
                                <span>movie</span>
                            </li>
                            <!-- <li>
                                <div class="tab-thumb">
                                    <img src="./assets/images/ticket/ticket-tab02.png" alt="ticket">
                                </div>
                                <span>events</span>
                            </li>
                            <li>
                                <div class="tab-thumb">
                                    <img src="./assets/images/ticket/ticket-tab03.png" alt="ticket">
                                </div>
                                <span>sports</span>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="tab-area">
                    <div class="tab-item active">
                        <form class="ticket-search-form">
                            <div class="form-group large">
                                <input type="text" id="searchMovie" placeholder="Search fo Movies">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="./assets/images/ticket/city.png" alt="ticket">
                                </div>
                                <span class="type">city</span>
                                <select id="city" class="select-bar">
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="./assets/images/ticket/date.png" alt="ticket">
                                </div>
                                <span class="type">date</span>
                                <select id="date" class="select-bar">
                                    <option value="">Select Date</option>
                                    @for($i=0;$i<7;$i++)
                                        <option value="{{ \Carbon\Carbon::today()->addDays($i)->toDateString() }}">
                                            {{ \Carbon\Carbon::today()->addDays($i)->format('d M') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                    <img src="./assets/images/ticket/cinema.png" alt="ticket">
                                </div>
                                <span class="type">cinema</span>
                                <select class="select-bar">
                                    <option value="">Select Cinema</option>
                                    @foreach($cinemas as $cinema)
                                        <option value="{{ $cinema->id }}">{{ $cinema->theater_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>    
    <!-- ==========Ticket-Search========== -->

    <!-- ==========Movie-Section========== -->
    <section class="movie-section padding-top padding-bottom">
        <div class="container">
            <div class="tab">
                <div class="section-header-2">
                    <div class="left">
                        <h2 class="title">movies</h2>
                        <p>Be sure not to miss these Movies today.</p>
                    </div>
                    <ul class="tab-menu">
                        <li class="active">
                            now showing 
                        </li>
                        <!-- <li>
                            coming soon
                        </li>
                        <li>
                            exclusive
                        </li> -->
                    </ul>
                </div>
                <div class="tab-area mb-30-none">
                    <div class="tab-item active">
                    <div id="movie-container" class="row">
                        <div class="owl-carousel tab-slider">

@foreach($movies as $movie)
    <div class="item">
        <div class="movie-grid">

            <div class="movie-thumb c-thumb">
                <a href="{{ url('movie-details/'.$movie->id) }}">
                    <img src="{{ url('/image_upload/'.$movie->movie_image) }}">
                </a>
            </div>

            <div class="movie-content bg-one">
                <h5 class="title m-0">
                    <a href="{{ url('movie-details/'.$movie->id) }}">
                        {{ $movie->movie_name }}
                    </a>
                </h5>

                <ul class="movie-rating-percent">
                    <li>
                        <div class="thumb">
                            <img src="./assets/images/movie/tomato.png">
                        </div>
                        <span class="content">88%</span>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="./assets/images/movie/cake.png">
                        </div>
                        <span class="content">88%</span>
                    </li>
                </ul>

                <!-- default -->
                <p class="text-success mt-2">Now Showing</p>

            </div>
        </div>
    </div>
@endforeach
</div>

</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Movie-Section========== -->


<script>
let defaultMovies = '';

$(document).ready(function () {

    // ✅ store default slider HTML
    defaultMovies = $('#movie-container').html();

    let timer;

    // 🔥 DESTROY SLIDER
    function destroySlider() {
        if ($('.tab-slider').hasClass('owl-loaded')) {
            $('.tab-slider').trigger('destroy.owl.carousel');
            $('.tab-slider').removeClass('owl-loaded');
            $('.tab-slider').find('.owl-stage-outer').children().unwrap();
        }
    }

    // 🔥 INIT SLIDER
    function initSlider() {
        $('.tab-slider').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 4 }
            }
        });
    }

    function loadMovies() {

        let date = $('#date').val();
        let city = $('#city').val();
        let search = $('#searchMovie').val().trim();

        // ✅ RESET → SHOW DEFAULT SLIDER
        if (!date && !city && search === '') {

            destroySlider();

            $('#movie-container').fadeOut(100, function () {
                $(this).html(defaultMovies).fadeIn(200, function () {
                    initSlider(); // 🔥 restore slider
                });
            });

            return;
        }

        $('#loader').show();

        $.ajax({
            url: '/get-movies-live',
            type: 'GET',
            data: { date, city, search },

            success: function (response) {

                let html = '';

                if (!response || Object.keys(response).length === 0) {

                    destroySlider();

                    html = `
                        <div class="col-12 text-center">
                            <h4>No movies found</h4>
                        </div>
                    `;

                    $('#movie-container').fadeOut(100, function () {
                        $(this).html(html).fadeIn(200);
                    });

                    $('#loader').hide();
                    return;
                }

                // 🔥 REMOVE SLIDER BEFORE GRID
                destroySlider();

                $.each(response, function (movieId, shows) {

                    if (!shows || shows.length === 0) return;

                    let movie = shows[0].movie_data;

                    if (!movie) return;

                    html += `
<div class="col-sm-6 col-lg-4">
    <div class="movie-grid">

        <div class="movie-thumb c-thumb">
            <a href="/movie-details/${movie.id}">
                <img src="/image_upload/${movie.movie_image}">
            </a>
        </div>

        <div class="movie-content bg-one">
            <h5>${movie.movie_name}</h5>

            <div class="mt-2">
                ${
                    shows.map(show =>
                        `<span class="badge bg-success m-1">${formatTime(show.show_time)}</span>`
                    ).join('')
                }
            </div>

        </div>
    </div>
</div>
`;
                });

                $('#movie-container').fadeOut(100, function () {
                    $(this).html(html).fadeIn(200);
                });

                $('#loader').hide();
            },

            error: function (err) {
                console.log(err);
                $('#loader').hide();
            }
        });
    }

    // 🎯 FILTERS
    $('#date, #city').on('change', loadMovies);

    // 🔍 SEARCH
    $('#searchMovie').on('keyup', function () {

        let value = $(this).val().trim();

        // ✅ CLEAR SEARCH → BACK TO DEFAULT SLIDER
        if (value === '') {

            destroySlider();

            $('#movie-container').fadeOut(100, function () {
                $(this).html(defaultMovies).fadeIn(200, function () {
                    initSlider();
                });
            });

            return;
        }

        clearTimeout(timer);
        timer = setTimeout(loadMovies, 300);
    });

});
</script>
<script>

function formatTime(time) {
    let [hour, min] = time.split(':');
    hour = parseInt(hour);

    let ampm = hour >= 12 ? 'PM' : 'AM';
    hour = hour % 12 || 12;

    return `${hour}:${min} ${ampm}`;
}
</script>
@endsection
