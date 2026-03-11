@extends('layouts.app-kai')

@section('content')

<div class="w-full">

<h1 class="text-3xl font-bold mb-1">Sampah</h1>
<p class="text-gray-500 text-sm mb-20">
Kelola file dan folder yang baru saja dihapus
</p>

<div class="bg-white rounded-2xl shadow-sm overflow-hidden">

<table class="w-full text-sm">

<thead class="bg-gray-50 text-gray-500 uppercase text-xs">
<tr>
<th class="px-6 py-4 text-left">Nama File/Folder</th>
<th class="px-6 py-4 text-left">Lokasi Awal</th>
<th class="px-6 py-4 text-left">Tanggal Hapus</th>
<th class="px-6 py-4 text-left">Aksi</th>
</tr>
</thead>

<tbody>

@forelse($files as $file)

<tr class="border-t">

<td class="px-6 py-5">
{{ $file->name }}
</td>

<td class="px-6 py-5">
/Folder Divisi/{{ $file->folder->name ?? '-' }}
</td>

<td class="px-6 py-5">
{{ $file->deleted_at->format('d F Y H:i') }}
</td>

<td class="px-6 py-5 flex gap-4">

<form method="POST" action="{{ route('trash.restore',$file->id) }}">
@csrf
<button class="text-blue-600">Pulihkan</button>
</form>

<form method="POST" action="{{ route('trash.delete',$file->id) }}">
@csrf
@method('DELETE')
<button class="text-red-600">Hapus Permanen</button>
</form>

</td>

</tr>

@empty

<tr>
<td colspan="4" class="text-center py-12 text-gray-400">
Tempat sampah kosong
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

@endsection