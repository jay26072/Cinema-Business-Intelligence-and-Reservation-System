@extends('userpanel.master')
@section('content')
<section class="movie-section padding-top padding-bottom">
        <div class="container">
            <div class="row flex-wrap-reverse justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-3">
                    <!-- <div class="widget-1 widget-banner">
                        <div class="widget-1-body">
                            <a href="#0">
                                <img src="images/banner01.jpg" alt="banner">
                            </a>
                        </div>
                    </div> -->
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
            <input type="checkbox" 
                   name="lang[]" 
                   id="lang_{{ $loop->index }}" 
                   value="{{ $lang }}"
>
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
                    <input type="checkbox"
                           class="exp-filter"
                           name="experience[]"
                           id="mode_{{ $exp->id }}"
                           value="{{ $exp->id }}">
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
                                    <input type="checkbox" name="genre[]" id="genre_{{ $type->id }}" value="{{ $type->id }}">
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
                                <div class="row mb-10 justify-content-center">
                                    @foreach($movies as $movie)
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="movie-grid">
                                            <div class="movie-thumb c-thumb">
                                                <a href="movie-details.html">
                                                    <img src="{{url('/image_upload/'.$movie->movie_image)}}" alt="movie">
                                                </a>
                                            </div>
                                            <div class="movie-content bg-one">
                                                <h5 class="title m-0">
                                                    <a href="movie-details.html">{{$movie->movie_name}}</a>
                                                    <h6 class="content m-0 movie-duration" data-minutes="{{ $movie->movie_duration }}" style="font-size: 15px;"></h6>
                                                </h5>
                                                
                                                <ul class="movie-rating-percent">
                                                    <li>
                                                        <div class="thumb">
                                                            <img src="./assets/images/tomato.png" alt="movie">
                                                        </div>
                                                        <span class="content">88%</span>
                                                    </li>
                                                    <li>
                                                        <div class="thumb">
                                                            <img src="./assets/images/cake.png" alt="movie">
                                                        </div>
                                                        <span class="content">88%</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                        <div class="pagination-area text-center">
                            <a href="#0"><i class="fas fa-angle-double-left"></i><span>Prev</span></a>
                            <a href="#0">1</a>
                            <a href="#0">2</a>
                            <a href="#0" class="active">3</a>
                            <a href="#0">4</a>
                            <a href="#0">5</a>
                            <a href="#0"><span>Next</span><i class="fas fa-angle-double-right"></i></a>
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

  document.querySelectorAll('.movie-duration').forEach(td => {
    const minutes = parseInt(td.dataset.minutes, 10);
    td.textContent = convertMinutesToHours(minutes);
  });
</script>

<script>
$(document).ready(function () {

    $('.exp-filter').on('change', function () {

        let experiences = [];

        $('.exp-filter:checked').each(function () {
            experiences.push($(this).val());
        });

        $.ajax({
            url: "{{ route('movies.filter') }}",
            method: "GET",
            data: {
                experience: experiences
            },
            beforeSend: function () {
                $('#movie-results').html('<p>Loading...</p>');
            },
            success: function (response) {
                $('#movie-results').html(response);
            }
        });
    });

});
</script>
@endsection