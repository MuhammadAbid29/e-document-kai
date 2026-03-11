<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Verifikasi Kode</title>
@vite(['resources/css/app.css'])
</head>

<body class="h-screen flex">

<!-- LEFT IMAGE -->
<div class="w-1/2 hidden lg:flex relative">

    <img src="{{ asset('images/kai-train.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-blue-900/50"></div>

    <div class="relative z-10 flex flex-col justify-center items-center w-full text-white">

        <img src="{{ asset('images/logo-kai.png') }}"
             class="w-52 mb-4">

        <h1 class="text-3xl font-bold">
            e-Document KAI Divre 3
        </h1>

    </div>

</div>


<!-- RIGHT -->
<div class="w-full lg:w-1/2 flex items-center justify-center">

<div class="w-full max-w-md px-8">

<p class="text-sm text-gray-500">
PT KAI DIVRE III PALEMBANG
</p>

<h2 class="text-3xl font-bold mb-2">
Verifikasi Kode
</h2>

<p class="text-gray-500 mb-6">
Kami telah mengirimkan kode verifikasi ke email Anda
</p>


<form method="POST" action="/verify-otp" onsubmit="combineOtp()">
@csrf

<input type="hidden" name="email" value="{{ $email }}">
<input type="hidden" name="otp" id="otp">


<!-- OTP BOX -->
<div class="flex gap-4 justify-center mb-6">

<input type="text" maxlength="1"
class="otp-box w-14 h-14 text-center text-xl rounded-xl bg-gray-200 focus:bg-white focus:ring-2 focus:ring-blue-400 outline-none">

<input type="text" maxlength="1"
class="otp-box w-14 h-14 text-center text-xl rounded-xl bg-gray-200 focus:bg-white focus:ring-2 focus:ring-blue-400 outline-none">

<input type="text" maxlength="1"
class="otp-box w-14 h-14 text-center text-xl rounded-xl bg-gray-200 focus:bg-white focus:ring-2 focus:ring-blue-400 outline-none">

<input type="text" maxlength="1"
class="otp-box w-14 h-14 text-center text-xl rounded-xl bg-gray-200 focus:bg-white focus:ring-2 focus:ring-blue-400 outline-none">

</div>


@error('otp')
<div class="text-red-500 text-sm text-center mb-2">
{{ $message }}
</div>
@enderror


<button
class="w-full bg-[#243C7A] hover:bg-[#1b2f61]
text-white py-3 rounded-xl font-semibold">

Verifikasi

</button>

</form>

</div>
</div>


<script>

const inputs = document.querySelectorAll(".otp-box");

inputs.forEach((input,index)=>{

input.addEventListener("input",function(){

if(this.value.length===1){

if(index < inputs.length-1){
inputs[index+1].focus();
}

}

});


input.addEventListener("keydown",function(e){

if(e.key==="Backspace" && this.value===""){

if(index>0){
inputs[index-1].focus();
}

}

});

});


function combineOtp(){

let otp="";

inputs.forEach(i=>{
otp+=i.value;
});

document.getElementById("otp").value=otp;

}

</script>


</body>
</html>