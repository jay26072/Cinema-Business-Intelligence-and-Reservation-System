@extends('theaterpanel.master')

@section('content')

<style>

body{
background:#0f172a;
font-family: "Segoe UI", Arial;
color:white;
}

/* Layout */

.scanner-wrapper{
max-width:900px;
margin:auto;
padding-top:30px;
}

/* Header */

.scanner-header{
text-align:center;
margin-bottom:20px;
}

.scanner-header h2{
font-size:28px;
font-weight:700;
}

.scanner-header p{
color:#94a3b8;
}


/* Scanner box */

.scanner-box{
background:#1e293b;
padding:20px;
border-radius:12px;
box-shadow:0 5px 20px rgba(0,0,0,0.5);
}

#reader{
border-radius:10px;
overflow:hidden;
}

/* Result popup */

.result-screen{
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
display:none;
align-items:center;
justify-content:center;
flex-direction:column;
font-size:40px;
font-weight:bold;
z-index:999;
}

.success-screen{
background:#22c55e;
color:white;
}

.error-screen{
background:#ef4444;
color:white;
}

.result-details{
font-size:22px;
margin-top:20px;
text-align:center;
}

.title{
    color:#fbbf24;
}

</style>

<div class="scanner-wrapper">

<div class="scanner-header">
<h2 class="title">🎟 Cinema Ticket Scanner</h2>
<p>Scan customer QR ticket for entry verification</p>
</div>


<!-- Scanner -->

<div class="scanner-box">
<div id="reader"></div>
</div>

</div>

<!-- Result Screen -->

<div id="resultScreen" class="result-screen">
<div id="resultMessage"></div>
<div id="resultDetails" style="text-transform:uppercase" class="result-details"></div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>

let scanner;
let scanning=false;

/* Sound */

function playSound(type){

let audio;

if(type==="success"){
    audio=new Audio("https://actions.google.com/sounds/v1/alarms/beep_short.ogg");
}else{
    audio=new Audio("https://actions.google.com/sounds/v1/cartoon/clang_and_wobble.ogg");
}

audio.play();
}

/* Result screen */

function showResult(type,message,details=""){

let screen=document.getElementById("resultScreen");
let msg=document.getElementById("resultMessage");
let det=document.getElementById("resultDetails");

screen.style.display="flex";
msg.innerHTML=message;
det.innerHTML=details;

/* COLORS */

if(type==="success"){
    screen.style.background="#22c55e"; // green
}
else if(type==="late"){
    screen.style.background="#f59e0b"; // orange
}
else{
    screen.style.background="#ef4444"; // red
}

setTimeout(()=>{

screen.style.display="none";
scanning=false;
scanner.resume();

},3000);

}

/* Scan success */

function onScanSuccess(decodedText)
{

    if(scanning) return;

    scanning=true;
    scanner.pause();

    let reference;

    try
    {
        let ticket=JSON.parse(decodedText);
        reference=ticket.booking_reference;
    }
    catch(e)
    {
        reference=decodedText;
    }

    fetch("/verify-ticket",{
    method:"POST",
    headers:{
        "X-CSRF-TOKEN":"{{ csrf_token() }}",
        "Content-Type":"application/x-www-form-urlencoded"
    },
    body:new URLSearchParams({
    booking_reference:reference
    })
    })
    .then(res=>res.json())
    .then(data=>{

if(data.status==="success"){

    playSound("success");

    showResult(
        "success",
        "ENTRY ALLOWED",
        "👤 "+data.name+"<br>🎬 "+data.movie+"<br>💺 Seats: "+data.seats
    );

}
else if(data.status==="late"){

    playSound("success");

    showResult(
        "late",
        "⚠ LATE ENTRY",
        "👤 "+data.name+"<br>🎬 "+data.movie+"<br>💺 Seats: "+data.seats
    );

}
else{

    playSound("error");

    showResult(
        "error",
        "ENTRY DENIED",
        data.message
    );

}

})
.catch(err=>{

console.error(err);

playSound("error");

showResult(
"error",
"SERVER ERROR",
"Please try again"
);

});

}

/* Start scanner */

document.addEventListener("DOMContentLoaded",function(){

scanner=new Html5QrcodeScanner(
"reader",
{
fps:10,
qrbox:250
}
);
scanner.render(onScanSuccess);

});

</script>

@endsection