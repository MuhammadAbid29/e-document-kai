<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Password Baru</title>
@vite(['resources/css/app.css'])
</head>

<body class="h-screen flex">

<div class="w-1/2 hidden lg:flex relative">
<img src="{{ asset('images/kai-train.jpg') }}"
class="absolute inset-0 w-full h-full object-cover">

<div class="absolute inset-0 bg-blue-900/50"></div>

<div class="relative z-10 flex flex-col justify-center items-center w-full text-white">
<img src="{{ asset('images/logo-kai.png') }}" class="w-52 mb-4">
<h1 class="text-3xl font-bold">
e-Document KAI Divre 3
</h1>
</div>
</div>


<div class="w-full lg:w-1/2 flex items-center justify-center">

<div class="w-full max-w-md">

<p class="text-sm text-gray-500">
PT KAI DIVRE III PALEMBANG
</p>

<h2 class="text-3xl font-bold mb-2">
Buat Password Baru
</h2>


<form method="POST" action="/reset-password">
@csrf

<input type="hidden" name="email" value="{{ $email }}">


<input type="password"
name="password"
placeholder="Password baru"
class="w-full bg-gray-100 px-4 py-3 rounded-xl mb-3">


<input type="password"
name="password_confirmation"
placeholder="Konfirmasi password"
class="w-full bg-gray-100 px-4 py-3 rounded-xl">


<button
class="w-full mt-5 bg-[#243C7A] text-white py-3 rounded-xl">

Simpan

</button>

</form>

</div>
</div>

</body>
</html>