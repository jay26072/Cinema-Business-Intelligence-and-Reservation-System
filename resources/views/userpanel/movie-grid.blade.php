@extends('userpanel.master')
@section('content')
<style>
.pagination-area a.disabled {
    opacity: 0.5;
    pointer-events: none;
}
/* Card */
.movie-card {
    background: #0d2a52;
    border-radius: 12px;
    overflow: hidden;
    transition: 0.3s;
    height: 100%;
}

/* Image container */
.movie-thumb {
    width: 100%;
    height: 380px; /* 🔥 SAME SIZE */
    overflow: hidden;
}

/* Image */
.movie-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Info section */
.movie-info {
    padding: 15px;
}

/* Title */
.movie-title {
    color: #fff;
    font-size: 20px;
    margin-bottom: 5px;
}

/* Duration */
.movie-duration {
    color: #cbd5e1;
    font-size: 14px;
    margin-bottom: 10px;
}

/* Rating */
.movie-rating {
    display: flex;
    gap: 15px;
    align-items: center;
}

.movie-rating span {
    color: #fff;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.movie-rating img {
    width: 16px;
}

/* Hover */
.movie-card:hover {
    transform: translateY(-5px);
}
</style>
<section class="movie-section padding-top padding-bottom">
        <div class="container">
            <div class="row flex-wrap-reverse justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-3">
                    <div class="widget-1 widget-check">
                        <div class="widget-header">
                            <h5 class="m-title">Filter By</h5> <a href="#0" class="clear-check">Clear All</a>
                        </div>
                        <div class="widget-1-body">
                            <h6 class="subtitle">Language</h6>
                            <div class="check-area">
                                @php
                                    $languages = ["English", "Hindi", "Gujarati", "Tamil", "Kannada"];
                                    // Assume $movie->language is an array of languages for this movie (e.g. ['Hindi', 'Tamil'])
                                    $movieLanguages = $movie->language ?? [];
                                @endphp

                            <div class="check-area">
                                @foreach($languages as $lang)
                                    <div class="form-group">
                                        <input type="checkbox" name="lang[]" id="lang_{{ $loop->index }}" class="lang-filter" value="{{ $lang }}">
                                        <label for="lang_{{ $loop->index }}">{{ $lang }}</label>
                                    </div>
                                @endforeach
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-1 widget-check">
                        <div class="widget-1-body">
                            <h6 class="subtitle">Experience</h6>
                            <div class="check-area">
                                @foreach($screenexp as $exp)
                                    <div class="form-group">
                                        <input type="checkbox" class="exp-filter" name="experience[]" id="mode_{{ $exp->id }}" value="{{ $exp->id }}">
                                        <label for="mode_{{ $exp->id }}">
                                            {{ $exp->screen_type }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                     <div class="widget-1 widget-check">
                        <div class="widget-1-body">
                            <h6 class="subtitle">genre</h6>
                            <div class="check-area">
                                @foreach($movietypes as $type)
                                <div class="form-group">
                                    <input type="checkbox" name="genre[]" class="genre-filter" id="genre_{{ $type->id }}" value="{{ $type->id }}">
                                    <label for="genre_{{ $type->id }}">{{ $type->movie_type }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
      
                    <!-- <div class="widget-1 widget-banner">
                        <div class="widget-1-body">
                            <a href="#0">
                                <img src="./assets/images/banner02.jpg" alt="banner">
                            </a>
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-9 mb-50 mb-lg-0">
                    <div class="filter-tab tab">
                        <div class="filter-area">
                            <div class="filter-main">
                                <div class="left">
                                    <div class="item">
                                        <span class="show">Sort By :</span>
                                        <select class="select-bar">
                                            <option value="showing">now showing</option>
                                            <option value="exclusive">exclusive</option>
                                            <option value="trending">trending</option>
                                            <option value="most-view">most view</option>
                                        </select>
                                    </div>
                                </div>
                                <ul class="grid-button tab-menu">
                                    <li class="active">
                                        <i class="fas fa-th"></i>
                                    </li>                            
                                    <li>
                                        <i class="fas fa-bars"></i>
                                    </li>                            
                                </ul>
                            </div>
                        </div>
                        <div class="tab-area">
                            <div class="tab-item active">
                                <div id="movie-loader" class="movie-loader d-none">
                                    <div class="spinner"></div>
                                    <p>Loading movies...</p>
                                </div>
                                <div class="row mb-10 justify-content-center" id="movie-list">
                                    @include('userpanel.partials.movie-list', ['movies' => $movies])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
  function convertMinutesToHours(minutes) {
    const h = Math.floor(minutes / 60);
    const m = minutes % 60;

    return (h ? h + "h " : "") + m + " m";
  }

  function formatDurations() {
    $('.movie-duration').each(function () {
        const minutes = parseInt($(this).data('minutes'), 10);

        if (!isNaN(minutes)) {
            const h = Math.floor(minutes / 60);
            const m = minutes % 60;
            $(this).text((h ? h + "h " : "") + m + " m");
        }
    });
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    fetchMovies($(this).attr('href'));
});

$(document).on('change', '.lang-filter, .exp-filter, .genre-filter', function () {
    fetchMovies();
});

$(document).on('click', '.clear-check', function(e){
    e.preventDefault();
    $('input[type="checkbox"]').prop('checked', false);
    fetchMovies();
});


let isLoading = false;

function fetchMovies(url = "{{ route('movies.filter') }}") {

    if (isLoading) return;
    isLoading = true;

    let data = {};

    let languages = $('.lang-filter:checked').map(function () {
        return $(this).val();
    }).get();

    let experiences = $('.exp-filter:checked').map(function () {
        return $(this).val();
    }).get();

    let genres = $('.genre-filter:checked').map(function () {
        return $(this).val();
    }).get();

    if (languages.length > 0) data.language = languages;
    if (experiences.length > 0) data.experience = experiences;
    if (genres.length > 0) data.genre = genres;

    $.ajax({
        url: url,
        type: "GET",
        data: data,
        beforeSend: function () {
            $('#movie-loader').removeClass('d-none');
            $('#movie-list').hide();
        },
        success: function (response) {
            $('#movie-list').html(response);

            // ✅ RE-RUN AFTER AJAX
            formatDurations();
        },
        complete: function () {
            isLoading = false;
            $('#movie-loader').addClass('d-none');
            $('#movie-list').show();
        }
    });
}

// Filter change
$(document).on('change', '.lang-filter, .exp-filter, .genre-filter', function () {
    fetchMovies();
});

// Pagination
$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    fetchMovies($(this).attr('href'));
});

// Clear all
$(document).on('click', '.clear-check', function(e){
    e.preventDefault();
    $('input[type="checkbox"]').prop('checked', false);
    fetchMovies();
});
</script>

@endsection