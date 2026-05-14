@extends('userpanel.master')
@section('content')
<!-- ==========Banner-Section========== -->
    <section class="details-banner bg_img" data-background="assets/images/banner/banner03.jpg">
        <div class="container">
            <div class="details-banner-wrapper">
                <div class="details-banner-thumb">
                    <img src="{{url('/image_upload/'.$movie->movie_image)}}" alt="movie">
                    @php
                        $videoUrl = $movie->movie_trailer ?? '';
                        $videoId = '';

                        if ($videoUrl && preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/|shorts/|live/))([^\?&"/]+)~', $videoUrl, $matches)) {
                            $videoId = $matches[1];
                        }

                        $embedUrl = $videoId 
                            ? "https://www.youtube.com/embed/{$videoId}?autoplay=1&rel=0"
                            : null;
                    @endphp

                    <a href="{{ $embedUrl }}" class="video-popup">
                        <img src="{{ asset('assets/images/movie/video-button.png') }}" alt="movie">
                    </a>
                </div>
                <div class="details-banner-content offset-lg-3">
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
                    @php
                        $types = $matchedTypes->pluck('movie_type')->toArray();
                    @endphp
                    @foreach($types as $type)
                    <a href="#0" class="button">{{ $type }}</a>
                    @endforeach
                    
                    <div class="social-and-duration">
                        <div class="duration-area">
                            <div class="item">
                                <i class="fas fa-calendar-alt"></i><span>{{ $movie->release_date }}</span>
                            </div>
                            <div class="item">
                                <i class="far fa-clock"></i><span>{{ $movie->movie_duration }}</span>
                            </div>
                        </div>
                        <ul class="social-share">
                            <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#0"><i class="fab fa-pinterest-p"></i></a></li>
                            <li><a href="#0"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Book-Section========== -->
    <section class="book-section bg-one">
        <div class="container">
            <div class="book-wrapper offset-lg-3">
                <div class="left-side">
                    <div class="item">
                        <div class="item-header">
                            <div class="thumb">
                                <img src="{{ asset('assets/images/movie/tomato2.png')}}" alt="movie">
                            </div>
                            <div class="counter-area">
                                <span class="counter-item odometer" data-odometer-final="88">0</span>
                            </div>
                        </div>
                        <p>tomatometer</p>
                    </div>
                    <div class="item">
                        <div class="item-header">
                            <div class="thumb">
                                <img src="{{ asset('assets/images/movie/cake2.png')}}" alt="movie">
                            </div>
                            <div class="counter-area">
                                <span class="counter-item odometer" data-odometer-final="88">0</span>
                            </div>
                        </div>
                        <p>audience Score</p>
                    </div>
                    <div class="item">
                        <div class="item-header">
                            <h5 class="title">4.5</h5>
                            <div class="rated">
                                <i class="fas fa-heart"></i>
                                <i class="fas fa-heart"></i>
                                <i class="fas fa-heart"></i>
                                <i class="fas fa-heart"></i>
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                        <p>Users Rating</p>
                    </div>
                    <div class="item">
                        <div class="item-header">
                            <div class="rated rate-it">
                                <i class="fas fa-heart"></i>
                                <i class="fas fa-heart"></i>
                                <i class="fas fa-heart"></i>
                                <i class="fas fa-heart"></i>
                                <i class="fas fa-heart"></i>
                            </div>
                            <h5 class="title">0.0</h5>
                        </div>
                        <p><a href="#0">Rate It</a></p>
                    </div>
                </div>
                <a href="{{url('showtime/'.$movie->id)}}" class="custom-button">book tickets</a>
            </div>
        </div>
    </section>
    <!-- ==========Book-Section========== -->

    <!-- ==========Movie-Section========== -->
    <section class="movie-details-section padding-top padding-bottom">
        <div class="container">
            <div class="row justify-content-center flex-wrap-reverse mb--50">
                <div class="col-lg-3 col-sm-10 col-md-6 mb-50">
                    <div class="widget-1 widget-tags">
                        <ul>
                           @php
                        $types = $matcheScreenExp->pluck('screen_type')->toArray();
                        @endphp
                        @foreach($types as $type)
                        <li><a href="#0">{{ $type }}</a></li>
                        @endforeach

                        </ul>
                    </div>
                    <div class="widget-1 widget-offer">
                        <h3 class="title">Applicable offer</h3>
                        <div class="offer-body">
                            <div class="offer-item">
                                <div class="thumb">
                                    <img src="{{ asset('assets/images/sidebar/offer01.png')}}" alt="sidebar">
                                </div>
                                <div class="content">
                                    <h6>
                                        <a href="#0">Amazon Pay Cashback Offer</a>
                                    </h6>
                                    <p>Win Cashback Upto Rs 300*</p>
                                </div>
                            </div>
                            <div class="offer-item">
                                <div class="thumb">
                                    <img src="{{ asset('assets/images/sidebar/offer02.png')}}" alt="sidebar">
                                </div>
                                <div class="content">
                                    <h6>
                                        <a href="#0">PayPal Offer</a>
                                    </h6>
                                    <p>Transact first time with Paypal and
                                        get 100% cashback up to Rs. 500</p>
                                </div>
                            </div>
                            <div class="offer-item">
                                <div class="thumb">
                                    <img src="{{ asset('assets/images/sidebar/offer03.png')}}" alt="sidebar">
                                </div>
                                <div class="content">
                                    <h6>
                                        <a href="#0">HDFC Bank Offer</a>
                                    </h6>
                                    <p>Get 15% discount up to INR 100* 
                                        and INR 50* off on F&B T&C apply</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 mb-35">
                    <div class="movie-details">
                        <!-- <h3 class="title">photos</h3>
                        <div class="details-photos owl-carousel">
                            <div class="thumb">
                                <a href="assets/images/movie/movie-details01.jpg" class="img-pop">
                                    <img src="assets/images/movie/movie-details01.jpg" alt="movie">
                                </a>
                            </div>
                            <div class="thumb">
                                <a href="assets/images/movie/movie-details02.jpg" class="img-pop">
                                    <img src="assets/images/movie/movie-details02.jpg" alt="movie">
                                </a>
                            </div>
                            <div class="thumb">
                                <a href="assets/images/movie/movie-details03.jpg" class="img-pop">
                                    <img src="assets/images/movie/movie-details03.jpg" alt="movie">
                                </a>
                            </div>
                            <div class="thumb">
                                <a href="assets/images/movie/movie-details01.jpg" class="img-pop">
                                    <img src="assets/images/movie/movie-details01.jpg" alt="movie">
                                </a>
                            </div>
                            <div class="thumb">
                                <a href="assets/images/movie/movie-details02.jpg" class="img-pop">
                                    <img src="assets/images/movie/movie-details02.jpg" alt="movie">
                                </a>
                            </div>
                            <div class="thumb">
                                <a href="assets/images/movie/movie-details03.jpg" class="img-pop">
                                    <img src="assets/images/movie/movie-details03.jpg" alt="movie">
                                </a>
                            </div>
                        </div> -->
                        <div class="tab summery-review">
                            <ul class="tab-menu">
                                <li class="active">
                                    summery
                                </li>
                            </ul>
                            <div class="tab-area">
                                <div class="tab-item active">
                                    <div class="item">
                                        <h5 class="sub-title">Description</h5>
                                        <p>{{ $movie->movie_description }}</p>
                                    </div>
                                    <div class="item">
                                        <div class="header">
                                            <h5 class="sub-title">cast</h5>
                                            <div class="navigation">
                                                <div class="cast-prev"><i class="flaticon-double-right-arrows-angles"></i></div>
                                                <div class="cast-next"><i class="flaticon-double-right-arrows-angles"></i></div>
                                            </div>
                                        </div>
                                        <div class="casting-slider owl-carousel">
                                            @foreach($matchedActors as $item)
                                                <div class="cast-item">
                                                    <div class="cast-thumb">
                                                        <a href="#0">
                                                            <img src="{{ url('/image_upload/' . $item->image) }}" alt="cast">
                                                        </a>
                                                    </div>
                                                    <div class="cast-content">
                                                        <h6 class="cast-title">
                                                            <a href="#0">{{ $item->castname }}</a>
                                                        </h6>
                                                        <span class="cate">actor</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="header">
                                            <h5 class="sub-title">crew</h5>
                                            <div class="navigation">
                                                <div class="cast-prev-2"><i class="flaticon-double-right-arrows-angles"></i></div>
                                                <div class="cast-next-2"><i class="flaticon-double-right-arrows-angles"></i></div>
                                            </div>
                                        </div>
                                        <div class="casting-slider-two owl-carousel">
                                            @foreach ($matchedCrew as $crew)
                                            <div class="cast-item">
                                                <div class="cast-thumb">
                                                    <a href="#0">
                                                        <img src="{{url('/image_upload/'.$crew->image)}}" alt="cast">
                                                    </a>
                                                </div>
                                                <div class="cast-content">
                                                    <h6 class="cast-title"><a href="#0">{{ $crew->crewname }}</a></h6>
                                                    <span class="cate">{{ $crew->type }}</span>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Movie-Section========== -->

@endsection