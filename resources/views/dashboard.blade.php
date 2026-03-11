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


<!-- CARD STATISTIC -->
<div class="grid grid-cols-4 gap-6 mb-6">

    <div class="bg-white p-5 rounded-xl shadow">
        <div class="text-gray-500 text-sm">
            Total Divisi
        </div>

        <div class="text-3xl font-bold mt-2">
            {{ $totalDivisi }}
        </div>
    </div>


    <div class="bg-white p-5 rounded-xl shadow">
        <div class="text-gray-500 text-sm">
            Total Akun
        </div>

        <div class="text-3xl font-bold mt-2">
            {{ $totalAkun }}
        </div>
    </div>


    <div class="bg-white p-5 rounded-xl shadow">
        <div class="text-gray-500 text-sm">
            Total Folder
        </div>

        <div class="text-3xl font-bold mt-2">
            {{ $totalFolder }}
        </div>
    </div>


    <div class="bg-white p-5 rounded-xl shadow">
        <div class="text-gray-500 text-sm">
            Total Dokumen
        </div>

        <div class="text-3xl font-bold mt-2">
            {{ $totalDokumen }}
        </div>
    </div>

</div>


<!-- PANEL -->
<div class="grid grid-cols-2 gap-6">


<!-- AKTIVITAS TERBARU -->
<div class="bg-white p-5 rounded-xl shadow h-72 overflow-y-auto">

    <h2 class="font-semibold text-gray-700 mb-4">
        Aktivitas Terbaru
    </h2>

@forelse($aktivitas as $log)

<div class="flex justify-between border-b py-2 text-sm">

    <div>

        <span class="font-semibold">
            {{ $log->user->name ?? '-' }}
        </span>

        {{ $log->action }}

        <span class="text-gray-500">
            {{ $log->target }}
        </span>

    </div>

    <div class="text-gray-400 text-xs">
        {{ $log->created_at->format('d M Y H:i') }}
    </div>

</div>

@empty

<p class="text-gray-400 text-sm">
Belum ada aktivitas
</p>

@endforelse

</div>


<!-- DOKUMEN TERBARU -->
<div class="bg-white p-5 rounded-xl shadow h-72 overflow-y-auto">

    <h2 class="font-semibold text-gray-700 mb-4">
        Dokumen Terbaru
    </h2>

@forelse($dokumenTerbaru as $doc)

<div class="flex justify-between border-b py-2 text-sm">

    <div>
        {{ $doc->name }}
    </div>

    <div class="text-gray-400 text-xs">
        {{ $doc->created_at->format('d M Y') }}
    </div>

</div>

@empty

<p class="text-gray-400 text-sm">
Belum ada dokumen
</p>

@endforelse

</div>

</div>

@endsection