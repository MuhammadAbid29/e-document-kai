@extends('layouts.app-kai')

@section('content')

<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-800">
        Dashboard
    </h1>

    <p class="text-gray-500">
        Selamat datang {{ Auth::user()->name }}!
    </p>

</div>

<div class="grid grid-cols-4 gap-6 mb-6">

    <div class="bg-white p-5 rounded-xl shadow">

        <div class="text-gray-500 text-sm">
            Total Divisi
        </div>

        <div class="text-3xl font-bold mt-2">
            0
        </div>

    </div>


    <div class="bg-white p-5 rounded-xl shadow">

        <div class="text-gray-500 text-sm">
            Total Akun
        </div>

        <div class="text-3xl font-bold mt-2">
            1
        </div>

    </div>


    <div class="bg-white p-5 rounded-xl shadow">

        <div class="text-gray-500 text-sm">
            Total Folder
        </div>

        <div class="text-3xl font-bold mt-2">
            0
        </div>

    </div>


    <div class="bg-white p-5 rounded-xl shadow">

        <div class="text-gray-500 text-sm">
            Total Dokumen
        </div>

        <div class="text-3xl font-bold mt-2">
            0
        </div>

    </div>

</div>


<div class="grid grid-cols-2 gap-4">

    <div class="bg-white p-4 rounded shadow h-64">
        <h2 class="font-bold mb-2">
            Aktivitas Terbaru
        </h2>
    </div>

    <div class="bg-white p-4 rounded shadow h-64">
        <h2 class="font-bold mb-2">
            Dokumen Terbaru
        </h2>
    </div>

</div>

@endsection