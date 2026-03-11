@extends('layouts.app-kai')

@section('content')

<div class="w-full">

<!-- TITLE -->
<div class="mb-12">
    <h1 class="text-3xl font-bold text-gray-800">
        Audit Log
    </h1>
    <p class="text-gray-500 text-sm">
        Catatan riwayat aktivitas
    </p>
</div>


<!-- SEARCH -->
<div class="mb-6">

<form method="GET" class="relative w-full">

<input type="text"
       name="search"
       value="{{ request('search') }}"
       placeholder="Cari berdasarkan divisi"
       class="w-full bg-white-100 border border-gray-200
              rounded-xl pl-10 pr-4 py-3 text-sm
              focus:ring-2 focus:ring-blue-400 outline-none">

<svg xmlns="http://www.w3.org/2000/svg"
     class="w-4 h-4 absolute left-3 top-3.5 text-gray-400"
     fill="none"
     stroke="currentColor"
     stroke-width="2"
     viewBox="0 0 24 24">

<circle cx="11" cy="11" r="8"/>
<line x1="21" y1="21" x2="16.65" y2="16.65"/>

</svg>

</form>

</div>



<!-- TABLE -->
<div class="bg-white rounded-2xl shadow-sm overflow-hidden">

<table class="w-full text-sm">

<thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">

<tr>

<th class="text-left px-6 py-4">Waktu</th>
<th class="text-left px-6 py-4">Aktor</th>
<th class="text-left px-6 py-4">Aktivitas</th>
<th class="text-left px-6 py-4">Target</th>
<th class="text-left px-6 py-4">Divisi</th>

</tr>

</thead>


<tbody>

@forelse($logs as $log)

<tr class="border-t hover:bg-gray-50">

<td class="px-6 py-5">

{{ $log->created_at->format('d F Y') }}<br>

<span class="text-xs text-gray-400">
{{ $log->created_at->format('H:i') }}
</span>

</td>

<td class="px-6 py-5">
{{ $log->user->name }}
</td>

<td class="px-6 py-5">
{{ $log->action }}
</td>

<td class="px-6 py-5">
{{ $log->target }}
</td>

<td class="px-6 py-5">
{{ $log->divisi->nama_divisi ?? '-' }}
</td>

</tr>

@empty

<tr>
<td colspan="5" class="text-center py-12 text-gray-400">
Tidak ada aktivitas
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

@endsection