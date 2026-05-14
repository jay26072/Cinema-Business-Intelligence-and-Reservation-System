@extends('userpanel.master')
@section('content')   
<style>
    .single-seat { position: relative; z-index: 1; }
.sit-num { pointer-events: none; } /* This makes the click "pass through" the text to the seat */
</style>
 <!-- ==========Banner-Section========== -->
    <section class="details-banner hero-area bg_img seat-plan-banner" data-background="{{asset('assets/images/banner/banner04.jpg')}}">
        <div class="container">
            <div class="details-banner-wrapper">
                <div class="details-banner-content style-two">
                    <h3 class="title">{{ $movie->movie_name }}</h3>
                    <div class="tags">
                        <a>{{ $theater->theater_name }}</a>
                        <a>{{$show->language}}</a>
                        <a>{{$show->screen_no}}</a>
                        <a>{{$show->screenData->screen_type}}</a>
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
                    <span class="date">{{ \Carbon\Carbon::parse($show->show_date)->format('D, M d Y') }}</span>
                    <select class="select-bar">
                        @if($show->show_time)
                            <option value="{{ $show->show_time }}">{{ \Carbon\Carbon::parse($show->show_time)->format('h:i A') }}</option>
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
    <div class="seat-plan-section padding-bottom padding-top">
        <div class="container">
            <div class="screen-area">
                <h4 class="screen">screen</h4>
                <div class="screen-thumb">
                    <img src="{{ asset('assets/images/screen-thumb.png') }}" alt="movie">
                </div>
                


 

                {{-- 🔥 Pricing Badge --}}
                @if(isset($flashSale) && $flashSale)
<div id="flashBanner"
     style="background: linear-gradient(90deg,#ff416c,#ff4b2b);
            padding:12px;
            border-radius:8px;
            color:#fff;
            margin-bottom:15px;
            font-weight:600;
            text-align:center;">

    ⚡ Flash Sale {{ $flashDiscountPercent }}% OFF  
    <div style="margin-top:5px; font-size:18px;">
        Ends In: <span id="flashTimer">00:00:00</span>
    </div>
</div>
@endif

                @foreach($sections as $sectionName => $section)
                <h5 class="subtitle" data-original="{{ $section['original_price'] }}">
    {{ $sectionName }} -

    @if($flashSale)
        <span class="old-price" style="text-decoration:line-through;opacity:0.6;">
            <!-- ₹{{ $section['original_price'] }} -->
        </span>

        <span class="current-price" style="color:#ff4c4c;font-weight:600;">
            <!-- ₹{{ $section['price'] }} -->
        </span>
    @else
        <span class="current-price">
            <!-- ₹{{ $section['price'] }} -->
        </span>
    @endif
</h5>
                <div class="screen-wrapper">
                    <ul class="seat-area">
                        @foreach($section['rows'] as $row)
                        <li class="seat-line">
                            <span>{{ $row }}</span>

                            <ul class="seat--area">
                                @for($i=1; $i <= $section['seats']; $i++)

                                @php
                                $seatNumber = strtolower($row).$i;
                                $isBooked = in_array($seatNumber, $confirmedSeats ?? []);
                                $isLocked = in_array($seatNumber, $lockedSeats ?? []);
                                @endphp
                            

                                <li class="single-seat
    {{ $isBooked ? 'seat-booked' : ($isLocked ? 'seat-locked' : 'seat-free') }}"
    data-seat="{{ $seatNumber }}"
    @php
$seatPositionFactor = 1;

// Middle seats (4,5,6,7) premium
if($i >= 4 && $i <= 7){
    $seatPositionFactor = 1.10;
}

// Corner seats discount
if($i == 1 || $i == 10){
    $seatPositionFactor = 0.95;
}

$finalSeatPrice = round($section['price'] * $seatPositionFactor);
@endphp

data-price="{{ $finalSeatPrice }}">

    @if($isBooked)
        <img src="{{ asset('assets/images/seat01-free.png') }}" alt="booked">
    @elseif($isLocked)
        <img src="{{ asset('assets/images/seat01-free.png') }}" alt="locked">
    @else
        <img src="{{ asset('assets/images/seat01.png') }}" alt="free">
    @endif

    <span class="sit-num">{{ strtoupper($seatNumber) }}</span>

{{-- ✅ ONLY CONFIRMED USER --}}
@if(isset($seatUserMap[$seatNumber]))
    <p style="
        display:block;
        font-size:9px;
        color:#FFFAF0;
        opacity:1;
        text-align:center;
        justify-content:center;
        margin-top:2px;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
        max-width:40px;
    ">
        {{ explode(' ', $seatUserMap[$seatNumber])[0] }}
    </p>
@endif
</li>

                                @endfor
                            </ul>

                            <span>{{ $row }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                @endforeach

            </div>
            <div class="proceed-book bg_img" data-background="{{ asset('assets/images/movie/movie-bg-proceed.jpg') }}">
                <div class="proceed-to-book">
                    <div class="book-item">
                        <span>You have Choosed Seat</span>
                        <h3 class="title"></h3>
                    </div>
                    <div class="book-item">
                        <span>total price</span>
                        <h3 class="title"></h3>
                    </div>
                    <div class="book-item">
                        @if(session('UserLogginId'))
                            <button onclick="proceedBooking()" class="custom-button">
                                Proceed
                            </button>
                        @else
                            <a href="{{ url('/signin') }}" class="custom-button">
                            Proceed
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========Movie-Section========== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Define your image paths clearly
    const seatFreeImage = "{{ asset('assets/images/seat01.png') }}";
    const seatSelectedImage = "{{ asset('assets/images/booked.png') }}";

    // 2. Select all free seats
    const allSeats = document.querySelectorAll('.single-seat.seat-free');

    allSeats.forEach(seat => {
        seat.addEventListener('click', function(e) {
            // Prevent default behavior
            e.preventDefault();

            const img = this.querySelector('img');
            
            // Toggle the 'selected' class
            this.classList.toggle('selected');

            // 3. Logic to swap images
            if (this.classList.contains('selected')) {
                img.src = seatSelectedImage;
                console.log("Seat Selected: " + this.getAttribute('data-seat'));
            } else {
                img.src = seatFreeImage;
                console.log("Seat Deselected: " + this.getAttribute('data-seat'));
            }

            // Update the UI totals
            updateBookingSummary();
        });
    });

    function updateBookingSummary() {
        let selectedSeats = [];
        let totalPrice = 0;

        document.querySelectorAll('.single-seat.selected').forEach(seat => {
            selectedSeats.push(seat.getAttribute('data-seat').toUpperCase());
            totalPrice += parseInt(seat.getAttribute('data-price'));
        });

        // Update the HTML display
        const seatDisplay = document.querySelector('.proceed-to-book .book-item:nth-child(1) .title');
        const priceDisplay = document.querySelector('.proceed-to-book .book-item:nth-child(2) .title');

        // if(seatDisplay) seatDisplay.innerText = selectedSeats.join(', ');
        if(seatDisplay) 
        {
            seatDisplay.innerText = selectedSeats.length 
            ? selectedSeats.join(', ') 
            : "No Seat Selected";
        }
        if(priceDisplay) priceDisplay.innerText = '₹' + totalPrice;
    }
});

function proceedBooking() {

    let selectedSeats = [];
    let totalPrice = 0;

    document.querySelectorAll('.single-seat.selected').forEach(seat => {
        selectedSeats.push(seat.dataset.seat);
        // totalPrice += parseInt(seat.dataset.price);
        totalPrice += Number(seat.dataset.price);
    });

    if (selectedSeats.length === 0) {
        alert("Please select at least 1 seat");
        return;
    }

    fetch("{{ route('create.booking') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        },
        body: JSON.stringify({
            show_id: "{{ $show->id }}",
            movie_id: "{{ $movie->id }}",
            seats: selectedSeats,
            total_price: totalPrice
        })
    })
    .then(res => res.json())
    .then(data => {

        if (data.status === "success") {

            // 🔥 Redirect to payment page
            window.location.href = "/payment/" + data.booking_id;

        } else {
            alert(data.message);
        }

    });
}

</script>
<script>
    window.showId = {{ $show->id }};
    window.csrfToken = "{{ csrf_token() }}";
</script>
<script src="{{ asset('assets/js/seatbook.js') }}"></script>

@if($flashSale && $flashEndsAt)
<script>
document.addEventListener("DOMContentLoaded", function(){

    let flashEndTime = {{ $flashEndsAt->timestamp }} * 1000;

    let timerInterval = setInterval(function(){

        let now = new Date().getTime();
        let distance = flashEndTime - now;

        if(distance <= 0){
            clearInterval(timerInterval);
            // 🔥 1️⃣ Remove banner completely
            let banner = document.getElementById("flashBanner");
            if(banner){
                banner.remove();
            }
            // 🔥 2️⃣ Fix prices (remove double price)
            document.querySelectorAll(".subtitle").forEach(function(block){

                let originalPrice = block.getAttribute("data-original");
                // Remove old-price span
                let oldPrice = block.querySelector(".old-price");
                if(oldPrice){
                    oldPrice.remove();
                }
                // Update current price to original
                let current = block.querySelector(".current-price");
                if(current){
                    //current.innerText = "₹" + originalPrice;
                     current.innerText = "";
                    current.style.color = "#31D7A9";
                    current.style.fontWeight = "600";
                }
            });
            return;
        }
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("flashTimer").innerText =
            String(minutes).padStart(2,'0') + ":" +
            String(seconds).padStart(2,'0');

    }, 1000);

});
</script>
@endif

<script>
    setInterval(() => {

    fetch("/get-seats/{{ $show->id }}")
    .then(res => res.json())
    .then(data => {

        if(data.status !== "success") return;

        let confirmed = data.confirmed || [];
        let locked = data.locked || [];

        document.querySelectorAll(".single-seat").forEach(seat => {

            let seatNo = seat.dataset.seat;

            // ✅ Skip current user selected seats
            if(seat.classList.contains("selected")) return;

            // 🔥 RESET STATE
            seat.classList.remove("seat-booked", "seat-locked", "seat-free");

            let img = seat.querySelector("img");

            // ✅ BOOKED
            if(confirmed.includes(seatNo)) {

                seat.classList.add("seat-booked");
                if(img) img.src = "/assets/images/seat01-free.png";

            }

            // 🔒 LOCKED
            else if(locked.includes(seatNo)) {

                seat.classList.add("seat-locked");
                if(img) img.src = "/assets/images/seat01-free.png";

            }

            // 🟢 FREE
            else {

                seat.classList.add("seat-free");
                if(img) img.src = "/assets/images/seat01.png";

            }

        });

    })
    .catch(err => console.log("Live seat error:", err));

}, 1500); // 🔥 faster refresh
</script>

@endsection