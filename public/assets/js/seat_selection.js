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

        if(seatDisplay) seatDisplay.innerText = selectedSeats.join(', ');
        if(priceDisplay) priceDisplay.innerText = '₹' + totalPrice;
    }
});

function proceedBooking() {

    let selectedSeats = [];
    let totalPrice = 0;

    document.querySelectorAll('.single-seat.selected').forEach(seat => {
        selectedSeats.push(seat.dataset.seat);
        totalPrice += parseInt(seat.dataset.price);
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
