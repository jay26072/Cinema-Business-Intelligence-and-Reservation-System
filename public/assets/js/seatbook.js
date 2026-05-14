// document.addEventListener("DOMContentLoaded", function(){

// let selectedSeats = [];
// let holdDuration = 300;
// let timerInterval = null;
// const countdownEl = document.getElementById("countdown");

// document.querySelectorAll(".seat-free").forEach(seat=>{

//     seat.addEventListener("click",function(){

//         let seatNo = this.dataset.seat;

//         if(this.classList.contains("selected")){
//             return;
//         }

//         fetch("/lock-seat",{
//             method:"POST",
//             headers:{
//                 "Content-Type":"application/json",
//                 "X-CSRF-TOKEN":"{{ csrf_token() }}"
//             },
//             body:JSON.stringify({
//                 show_id:"{{ $show->id }}",
//                 seat:seatNo
//             })
//         })
//         .then(res=>res.json())
//         .then(data=>{

//             if(data.status==="locked"){

//                 this.classList.add("selected");
//                 selectedSeats.push(seatNo);

//                 startTimer();

//             }else{
//                 alert("Seat already booked or locked.");
//                 this.classList.remove("seat-free");
//                 this.classList.add("seat-booked");
//             }

//         });

//     });

// });


// function startTimer(){

//     if(timerInterval) return;

//     timerInterval = setInterval(()=>{

//         holdDuration--;

//         let minutes = Math.floor(holdDuration/60);
//         let seconds = holdDuration%60;

//         countdownEl.innerText =
//             String(minutes).padStart(2,"0")+":"+
//             String(seconds).padStart(2,"0");

//         if(holdDuration<=0){
//             clearInterval(timerInterval);
//             releaseSeats();
//         }

//     },1000);
// }


// function releaseSeats(){

//     alert("Time expired. Seats released.");

//     selectedSeats=[];
//     holdDuration=300;

//     document.querySelectorAll(".selected").forEach(seat=>{
//         seat.classList.remove("selected");
//     });

//     countdownEl.innerText="05:00";
// }


// window.confirmBooking=function(){

//     if(selectedSeats.length===0){
//         alert("Select seats first");
//         return;
//     }

//     fetch("/confirm-seat",{
//         method:"POST",
//         headers:{
//             "Content-Type":"application/json",
//             "X-CSRF-TOKEN":"{{ csrf_token() }}"
//         },
//         body:JSON.stringify({
//             show_id:"{{ $show->id }}",
//             seats:selectedSeats
//         })
//     })
//     .then(res=>res.json())
//     .then(data=>{
//         if(data.status==="success"){
//             alert("Booking Confirmed");
//             location.reload();
//         }
//     });

// };


// // Real-time update
// setInterval(()=>{

//     fetch("/get-seats/{{ $show->id }}")
//     .then(res=>res.json())
//     .then(data=>{

//         data.forEach(seatNo=>{

//             let el=document.querySelector('[data-seat="'+seatNo+'"]');

//             if(el){
//                 el.classList.remove("seat-free","selected");
//                 el.classList.add("seat-booked");
//             }

//         });

//     });

// },3000);

// });

// $(document).ready(function(){

//     // 🔥 Show start datetime from Laravel
//     let showStartTime = new Date("{{ \Carbon\Carbon::parse($show->show_date.' '.$show->show_time)->format('Y-m-d H:i:s') }}");

//     function updateCountdown(){

//         let now = new Date();
//         let diff = Math.floor((showStartTime - now) / 1000); // seconds

//         if(diff > 0 && diff <= 300){   // ✅ Only if 5 minutes remaining

//             $("#countdownBox").show();

//             let minutes = Math.floor(diff / 60);
//             let seconds = diff % 60;

//             $("#countdownTimer").text(
//                 String(minutes).padStart(2,'0') + ":" +
//                 String(seconds).padStart(2,'0')
//             );

//         } else {

//             $("#countdownBox").hide();

//         }
//     }

//     // Run immediately
//     updateCountdown();

//     // Update every second
//     setInterval(updateCountdown, 1000);

// });

document.addEventListener("DOMContentLoaded", function(){

let selectedSeats = [];
let holdDuration = 300;
let timerInterval = null;
const countdownEl = document.getElementById("countdown");

// ================= CLICK SEAT =================
document.querySelectorAll(".seat-free").forEach(seat=>{

    seat.addEventListener("click",function(){

        let seatNo = this.dataset.seat;

        if(this.classList.contains("selected")){
            return;
        }

        fetch("/lock-seat",{
            method:"POST",
            headers:{
                "Content-Type":"application/json",
                "X-CSRF-TOKEN": window.csrfToken
            },
            body:JSON.stringify({
                show_id: window.showId,
                seat: seatNo
            })
        })
        .then(res=>res.json())
        .then(data=>{

            if(data.status==="locked"){
                this.classList.add("selected");
                selectedSeats.push(seatNo);
                startTimer();
            }else{
                alert("Seat already booked or locked.");
                this.classList.remove("seat-free");
                this.classList.add("seat-booked");
            }

        });

    });

});


// ================= TIMER =================
function startTimer(){

    if(timerInterval) return;

    timerInterval = setInterval(()=>{

        holdDuration--;

        let minutes = Math.floor(holdDuration/60);
        let seconds = holdDuration%60;

        countdownEl.innerText =
            String(minutes).padStart(2,"0")+":"+
            String(seconds).padStart(2,"0");

        if(holdDuration<=0){
            clearInterval(timerInterval);
            releaseSeats();
        }

    },1000);
}


// ================= RELEASE =================
function releaseSeats(){

    alert("Time expired. Seats released.");

    selectedSeats=[];
    holdDuration=300;

    document.querySelectorAll(".selected").forEach(seat=>{
        seat.classList.remove("selected");
    });

    countdownEl.innerText="05:00";
}


// ================= CONFIRM =================
window.confirmBooking=function(){

    if(selectedSeats.length===0){
        alert("Select seats first");
        return;
    }

    fetch("/confirm-seat",{
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            "X-CSRF-TOKEN": window.csrfToken
        },
        body:JSON.stringify({
            show_id: window.showId,
            seats: selectedSeats
        })
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.status==="success"){
            alert("Booking Confirmed");
            location.reload();
        }
    });

};


/// ================= REALTIME SEAT UPDATE =================
setInterval(()=>{

    fetch("/get-seats/"+window.showId)
    .then(res => {
        if(!res.ok){
            throw new Error("Server response not OK");
        }
        return res.json();
    })
    .then(data => {

        data.forEach(seatNo => {

            let el = document.querySelector('[data-seat="'+seatNo+'"]');

            if(el){
                el.classList.remove("seat-free","selected");
                el.classList.add("seat-booked");

                const img = el.querySelector("img");
                if(img){
                    img.src = "/assets/images/seat01-free.png";
                }
            }

        });

    })
    .catch(err => console.log("Seat update error:",err));

},3000);

});