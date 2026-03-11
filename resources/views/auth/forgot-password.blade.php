<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password — e-Document KAI</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="h-screen flex bg-gray-100">


<!-- LEFT -->
<div class="hidden lg:flex w-1/2 relative">

    <img src="{{ asset('images/kai-train.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-[#243C7A]/60"></div>

    <div class="relative z-10 flex flex-col items-center justify-center w-full text-white">

        <img src="{{ asset('images/logo-kai.png') }}"
             class="w-56 mb-6">

        <h1 class="text-3xl font-semibold">
            e-Document KAI Divre III
        </h1>

    </div>

</div>



<!-- RIGHT -->
<div class="w-full lg:w-1/2 flex items-center justify-center px-10">

<div class="w-full max-w-md">


<h2 class="text-3xl font-bold text-gray-800 mb-2">
Lupa Password
</h2>

<p class="text-gray-500 text-sm mb-6">
Masukkan email Anda untuk menerima link reset password
</p>


@if (session('status'))
<div class="mb-4 text-green-600">
{{ session('status') }}
</div>
@endif



<form method="POST" action="{{ route('password.email') }}">

@csrf


<label class="text-sm text-gray-600">
Email
</label>

<input
type="email"
name="email"
required
placeholder="Masukkan Email"
class="w-full mt-2 px-5 py-3
bg-gray-200
rounded-2xl
focus:bg-white
focus:ring-2 focus:ring-blue-200
outline-none">


@error('email')
<div class="text-red-500 text-sm mt-1">
{{ $message }}
</div>
@enderror



<button
class="w-full mt-6
bg-[#243C7A]
hover:bg-[#1b2f61]
text-white
py-3
rounded-xl">

KIRIM LINK RESET

</button>


</form>


<a href="/login"
class="block text-center mt-4 text-sm text-blue-700">

Kembali ke login

</a>


</div>
</div>


</body>
</html>