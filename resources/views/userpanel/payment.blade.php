@extends('userpanel.master')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.promo-toast{
    position: fixed;
    top: -100px;
    right: 20px;
    min-width: 260px;
    padding: 14px 20px;
    border-radius: 8px;
    color: #fff;
    font-weight: 600;
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    opacity: 0;
    transition: all 0.4s ease;
    z-index: 9999;
}

.promo-toast.show{
    top: 25px;
    opacity: 1;
}

.promo-success{
    background: linear-gradient(45deg,#28a745,#2ecc71);
}

.promo-error{
    background: linear-gradient(45deg,#dc3545,#ff6b6b);
}
</style>

<!-- ==========Banner-Section========== -->
    <section class="details-banner hero-area bg_img seat-plan-banner" data-background="./assets/images/banner/banner04.jpg">
        <div class="container">
            <div class="details-banner-wrapper">
                <div class="details-banner-content style-two">
                    <h3 class="title">{{$booking->movieData->movie_name}}</h3>
                    <div class="tags">
                        <a href="#0">{{$booking->theaterData->theater_name}}</a>
                        <a href="#0">{{$booking->language}}</a>
                        <a href="#0">{{$booking->screen_no}}</a>
                        <a href="#0">{{$booking->screenData->screen_type}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Page-Title========== -->
    <section class="page-title bg-one">
        <div class="container">
            <div class="page-title-area">
                <div class="item md-order-1">
                    <a href="movie-ticket-plan.html" class="custom-button back-button">
                        <i class="flaticon-double-right-arrows-angles"></i>back
                    </a>
                </div>
                <div class="item date-item">
                    <span class="date">{{ \Carbon\Carbon::parse($booking->showData->show_date)->format('D, M d Y') }}</span>
                    <select class="select-bar">
                        @if($booking->showData->show_time)
                            <option value="{{ $booking->showData->show_time }}">{{ \Carbon\Carbon::parse($booking->showData->show_time)->format('h:i A') }}</option>
                        @endif
                    </select>
                </div>
                <div class="item" id="countdownBox" style="display:none;">
                    <h5 class="title" id="countdownTimer"></h5>
                    <p>Mins Left</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Page-Title========== -->

    <!-- ==========Movie-Section========== -->
    <div class="movie-facility padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-widget checkout-contact">
                        <h5 class="title">Your Contact  Details </h5>
                        <form class="checkout-contact-form">
                            
                            <div class="form-group">
                                <input type="text" placeholder="Full Name" name="name" id="name" disabled value="{{ $booking->userData->name ?? '' }}">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Enter your Mail" name="email" id="email" disabled value="{{ $booking->userData->email ?? '' }}">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Enter your Phone Number " name="phone" id="phone" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" disabled maxlength="10" value="{{ $booking->userData->mobile_no ?? '' }}">
                            </div>
                        </form>
                    </div>
                    <div class="checkout-widget checkout-contact">
                        <h5 class="title">Promo Code </h5>
                        <form class="checkout-contact-form">
                            <div class="form-group">
                                <input type="text" id="promoInput" placeholder="Enter promo code">
                            </div>
                            <div class="form-group">
                                <button type="button" onclick="applyPromo()" class="custom-button" style="width:auto">Apply</button>
                                
                            </div>
                        </form>
                    </div>
                    <!-- Payment Pay.html file -->
                </div>
                <div class="col-lg-4">
                    <div class="booking-summery bg-one">
                        <h4 class="title">booking summery</h4>
                        <ul>
                            <li>
                                    @php
                                        $seats = json_decode($booking->seat_number, true);
                                    @endphp

                                    <p>Seats: {{ collect($seats)->map(fn($seat) => strtoupper($seat))->implode(', ') }}</p>
                                
                                <h6 class="subtitle">{{ $booking->movieData->movie_name }}</h6>
                                <span class="info">{{ $booking->language }}</span>
                            </li>
                            <li>
                                <h6 class="subtitle"><span>{{$booking->theaterData->theater_name}}</span></h6>
                                <div class="info"><span>{{ strtoupper(\Carbon\Carbon::parse($booking->showData->show_date . ' ' . $booking->showData->show_time)->format('d M D, h:i A')) }}</span> <span>Tickets</span></div>
                            </li>
                            <li>
                                <h6 class="subtitle mb-0"><span>Tickets  Price</span><span>₹ {{ $booking->total_price }}</span></h6>
                            </li>
                        </ul>
                        <!-- <ul class="side-shape">
                            <li>
                                <h6 class="subtitle"><span>combos</span><span>$57</span></h6>
                                <span class="info"><span>2 Nachos Combo</span></span>
                            </li>
                            <li>
                                <h6 class="subtitle"><span>food & bevarage</span></h6>
                            </li>
                        </ul> -->
                        <ul>
                            <li>
                                <span class="info">
                                    <span>Ticket Price</span>
                                    <span>₹ {{ number_format($booking->total_price, 2) }}</span>
                                </span>

                                <span class="info">
                                    <span>Discount</span>
                                    <span>- ₹ {{ number_format($discount,2) }}</span>
                                </span>

                                <span class="info">
                                    <span>GST ({{ $gstPercent }}%)</span>
                                    <span>₹ {{ number_format($taxAmount, 2) }}</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="proceed-area  text-center">
                       <h6 class="subtitle">
                            <span>Amount Payable</span>
                            <span name="finalAmount">₹ {{ number_format($finalAmount, 2) }}</span>
                        </h6>

                        <a href="javascript:void(0)" id="rzp-button" class="custom-button back-button">proceed</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========Movie-Section========== -->

<div id="promoToast" class="promo-toast"></div>

<script>
    const applyPromoUrl = "{{ route('apply.promo') }}";
    const bookingId = "{{ $booking->id }}";
</script>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$(document).ready(function(){

    $('#rzp-button').on('click', function(e){
        e.preventDefault();

        let button = $(this);
        button.text("Processing...");
        button.css("pointer-events","none");

        $.ajax({
            url: "/razorpay/order",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                booking_id: "{{ $booking->id }}",
            },
            success: function(data){

                var options = {
                    key: data.key,
                    currency: "INR",
                    name: "Movie Ticket Booking",
                    description: "Ticket Payment",
                    order_id: data.order_id,

                    handler: function (response) {

                        $.ajax({
                            url: "/razorpay/verify",
                            type: "POST",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                booking_id: "{{ $booking->id }}",
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_signature: response.razorpay_signature
                            },
                            success: function(result){

                                if(result.success){
                                    alert("Payment Successful!");
                                    // window.location.href = "/thank-you";
                                    window.location.href = "/thank-you/" + "{{ $booking->id }}";
                                } else {
                                    alert("Payment Verification Failed!");
                                    location.reload();
                                }
                            }
                        });
                    },
                    modal: {
                        ondismiss: function () {
                            location.reload();
                        }
                    },
                    theme: {
                        color: "#31D7A9"
                    }
                };
                var rzp = new Razorpay(options);
                rzp.open();

            },
            error: function(xhr){
                alert("Order Creation Failed!");
                console.log(xhr.responseText);
                location.reload();
            }
        });

    });

});
</script>

<script>
    success: function(res) {
    if(res.status === 'success') {
        $('.discount').text('₹ ' + res.discount);
        $('.gst').text('₹ ' + res.gst);
        $('.final').text('₹ ' + res.final);
    }
}
</script>
@endsection