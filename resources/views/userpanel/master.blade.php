<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.animatedheadline.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/movie.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/seat.css')}}">
    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <title>Boleto  - Online Ticket Booking System</title>


</head>
<body>

     <!-- ==========Preloader========== -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ==========Preloader========== -->
    <!-- ==========Overlay========== -->
    <div class="overlay"></div>
    <a href="#0" class="scrollToTop">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- ==========Overlay========== -->

    <!-- ==========Header-Section========== -->
    <header class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="{{url('/')}}">
                        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="{{url('/')}}" class="active">Home</a>
                    </li>
                    <li>
                        <a href="{{url('/movies')}}">movies</a>
                    </li>
                    <li>
                        <a href="{{url('/about')}}">about</a>
                    </li>
                    <li>
                        <a href="{{url('/contact')}}">contact</a>
                    </li>
                    <li class="header-button pr-0">
                         @php
    $user = \App\Models\UserModel::find(session('UserLogginId'));
@endphp

<a href="{{ $user ? url('/userindex') : url('/signin') }}">
    {{ $user->name ?? 'Sign In' }}
</a>
                    </li>
                   
                </ul>
                <div class="header-bar d-lg-none">
					<span></span>
					<span></span>
					<span></span>
				</div>
            </div>
        </div>
    </header>
    <!-- ==========Header-Section========== -->

    @yield('content')

    <footer class="footer-section">
        <div class="newslater-section padding-bottom">
            <div class="container">
                <div class="newslater-container bg_img" data-background="{{ asset('./assets/images/newslater/newslater-bg01.jpg')}}">
                    <div class="newslater-wrapper">
                        <h5 class="cate">subscribe to Boleto </h5>
                        <h3 class="title">to get exclusive benifits</h3>
                        <!-- <form class="newslater-form">
                            <input type="text" placeholder="Your Email Address">
                            <button type="submit">subscribe</button>
                        </form> -->
                        <p>We respect your privacy, so we never share your info</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer-top">
                <div class="logo">
                    <a href="index-1.html">
                        <img src="{{ asset('./assets/images/footer/footer-logo.png')}}" alt="footer">
                    </a>
                </div>
                <ul class="social-icons">
                    <li>
                        <a href="#0">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0" class="active">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <i class="fab fa-google"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#0">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-bottom">
                <div class="footer-bottom-area">
                    <div class="left">
                        <p>Copyright © <?php echo date('Y'); ?>.All Rights Reserved By <a href="#0">Boleto </a></p>
                    </div>
                    <ul class="links">
                        <li>
                            <a href="#0">About</a>
                        </li>
                        <li>
                            <a href="#0">Terms Of Use</a>
                        </li>
                        <li>
                            <a href="#0">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#0">FAQ</a>
                        </li>
                        <li>
                            <a href="#0">Feedback</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/heandline.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/js/viewport.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/nice-select.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/payment_option.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/seatbook.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/js/seat_selection.js') }}"></script> -->



</body>
</html>