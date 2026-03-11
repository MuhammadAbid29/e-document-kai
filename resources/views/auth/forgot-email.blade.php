<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Lupa Password - KAI</title>
@vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="h-screen flex bg-gray-100">

<!-- LEFT IMAGE -->
<div class="hidden lg:flex w-1/2 relative">

    <img src="{{ asset('images/kai-train.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-blue-900/50"></div>

    <div class="relative z-10 flex flex-col items-center justify-center w-full text-white">

        <img src="{{ asset('images/logo-kai.png') }}"
             class="w-52 mb-6">

        <h1 class="text-3xl font-bold">
            e-Document KAI Divre III
        </h1>

    </div>

</div>



<!-- RIGHT FORM -->
<div class="w-full lg:w-1/2 flex items-center justify-center">

<div class="w-full max-w-md px-10">

<p class="text-sm text-gray-500">
PT KAI DIVRE III PALEMBANG
</p>

<h2 class="text-3xl font-bold text-gray-800">
Lupa Password?
</h2>

<p class="text-gray-500 text-sm mb-6">
Masukkan email untuk menerima kode verifikasi
</p>


@if(session('otp'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
OTP: {{ session('otp') }}
</div>
@endif


<form method="POST" action="/forgot-password">
@csrf


<label class="text-sm text-gray-600">
Email
</label>

<input
type="email"
name="email"
required
placeholder="Masukkan Email Anda"
class="w-full bg-white border border-gray-300
rounded-xl px-4 py-3 mt-1
focus:ring-2 focus:ring-blue-500">


@error('email')
<div class="text-red-500 text-sm mt-1">
{{ $message }}
</div>
@enderror



<button
class="w-full bg-[#243C7A] hover:bg-[#1b2f61]
text-white py-3 rounded-lg mt-6 font-semibold">

Minta Kode Verifikasi

</button>


<a href="/login"
class="block text-center mt-3 bg-gray-300
hover:bg-gray-400 text-gray-700
py-3 rounded-lg">

Kembali

</a>


</form>

</div>
</div>

</body>
</html>