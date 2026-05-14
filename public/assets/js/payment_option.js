
document.querySelectorAll(".payment-option li").forEach(option => {

    option.addEventListener("click", function(e) {
        e.preventDefault();

        // Remove active class
        document.querySelectorAll(".payment-option li")
            .forEach(li => li.classList.remove("active"));

        this.classList.add("active");

        let type = this.getAttribute("data-type");

        // Hide all forms
        document.querySelectorAll(".payment-form")
            .forEach(form => form.classList.add("d-none"));

        // Show selected form
        document.getElementById(type + "-form")
            .classList.remove("d-none");
    });

});



function makePayment(method){

    fetch("/process-payment/{{ $booking->id }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            payment_method: method
        })
    })
    .then(res => res.json())
    .then(data => {

        if(data.status === "success"){
            alert("Payment Successful 🎉");
            window.location.href = "/ticket/" + data.booking_id;
        } else {
            alert("Payment Failed");
        }

    });

}

function applyPromo1(){

    let code = document.getElementById("promoInput").value.trim();

    if(code === ""){
        document.getElementById("promoMessage").innerHTML =
            "<span style='color:red'>Please enter promo code</span>";
        return;
    }

    fetch(applyPromoUrl,{
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body:JSON.stringify({
            code: code,
            booking_id: bookingId
        })
    })
    .then(res=>{
        if(!res.ok){
            throw new Error("Server error");
        }
        return res.json();
    })
    .then(data=>{

        if(data.status === "success"){

            document.getElementById("promoMessage").innerHTML =
                "<span style='color:green'>Discount Applied: ₹ "+data.discount+"</span>";

            setTimeout(()=>{
                location.reload();
            },800);

        }else{

            document.getElementById("promoMessage").innerHTML =
                "<span style='color:red'>"+data.message+"</span>";
        }

    })
    .catch(err=>{
        console.error("Promo Error:", err);
        document.getElementById("promoMessage").innerHTML =
            "<span style='color:red'>Something went wrong</span>";
    });
}


function applyPromo(){

    let code = document.getElementById("promoInput").value.trim();

    if(code === ""){
        showToast("Please enter promo code","error");
        return;
    }

    fetch(applyPromoUrl,{
        method:"POST",
        headers:{
            "Content-Type":"application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body:JSON.stringify({
            code: code,
            booking_id: bookingId
        })
    })
    .then(res=>{
        if(!res.ok){
            throw new Error("Server error");
        }
        return res.json();
    })
    .then(data=>{

        if(data.status === "success"){

            showToast("Discount Applied: ₹ "+data.discount,"success");

            setTimeout(()=>{
                location.reload();
            },1500);

        }else{
            showToast(data.message,"error");
        }

    })
    .catch(err=>{
        console.error("Promo Error:", err);
        showToast("Something went wrong","error");
    });
}

function showToast(message,type){

    const toast = document.getElementById("promoToast");

    toast.innerText = message;

    toast.classList.remove("promo-success","promo-error");
    toast.classList.add(type === "success" ? "promo-success" : "promo-error");

    toast.classList.add("show");

    setTimeout(()=>{
        toast.classList.remove("show");
    },3000);
}