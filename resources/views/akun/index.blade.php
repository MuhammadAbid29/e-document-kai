@extends('layouts.app-kai')

@section('content')

<!-- TITLE -->
<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-800">
        Manajemen Akun
    </h1>

    <p class="text-gray-500 text-sm">
        Kelola data pengguna sistem bank data
    </p>

</div>



<!-- TOOLBAR -->
<div class="flex items-center gap-3 mb-6">

    <!-- SEARCH -->
    <form method="GET" class="relative">

    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
        <path stroke-width="2"
              d="m21 21-4.3-4.3m0 0A7.7 7.7 0 1 0 5 5a7.7 7.7 0 0 0 11.7 11.7z"/>
    </svg>

    <input
        name="search"
        value="{{ $search ?? '' }}"
        placeholder="Cari akun..."
        class="h-10 w-72 bg-white-100 border-0 rounded-full
               pl-12 pr-4 text-sm
               focus:ring-2 focus:ring-blue-500">

</form>



    <!-- BUTTON TAMBAH -->
    <button onclick="openModal()"
        class="h-10 bg-[#243C7A] hover:bg-[#1b2f61]
               text-white px-6 rounded-full
               flex items-center gap-2 text-sm font-medium shadow-sm">

        <span class="text-lg leading-none">+</span>

        Tambah Akun

    </button>



    <!-- FILTER DIVISI -->
    <div class="relative">

    <select
        class="h-10 bg-gray-100 border-0 rounded-lg
               pl-4 pr-10 text-sm
               appearance-none
               focus:ring-2 focus:ring-blue-500">

        <option>PSDM</option>

        @foreach($divisi as $d)
        <option value="{{ $d->id }}">
            {{ $d->nama_divisi }}
        </option>
        @endforeach

    </select>

    <!-- ICON PANAH -->
    <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">

        <path stroke-width="2" d="m6 9 6 6 6-6"/>

    </svg>

</div>



    <!-- FILTER ROLE -->
<div class="relative">

    <select
        class="h-10 bg-gray-100 border-0 rounded-lg
               pl-4 pr-10 text-sm appearance-none
               focus:ring-2 focus:ring-blue-500">

        <option>Semua Role</option>
        <option>User</option>

    </select>

    <!-- ICON -->
    <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">

        <path stroke-width="2" d="m6 9 6 6 6-6"/>

    </svg>

</div>



<!-- FILTER STATUS -->
<div class="relative">

    <select
        class="h-10 bg-gray-100 border-0 rounded-lg
               pl-4 pr-10 text-sm appearance-none
               focus:ring-2 focus:ring-blue-500">

        <option>Semua</option>
        <option>Aktif</option>
        <option>Nonaktif</option>

    </select>

    <!-- ICON -->
    <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">

        <path stroke-width="2" d="m6 9 6 6 6-6"/>

    </svg>

</div>


</div>




<!-- CARD TABLE -->
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">


<table class="w-full">


<!-- HEADER -->
<thead class="bg-gray-100">

<tr class="text-gray-600 text-sm font-semibold">

<th class="px-6 py-4 text-left">
NIP
</th>

<th class="px-6 py-4 text-left">
Nama Pengguna
</th>

<th class="px-6 py-4 text-left">
Password
</th>

<th class="px-6 py-4 text-left">
Role
</th>

<th class="px-6 py-4 text-left">
Divisi
</th>

<th class="px-6 py-4 text-left">
Aksi
</th>

</tr>

</thead>



<tbody>

@forelse($users as $user)

<tr class="border-t hover:bg-gray-50 transition">


<td class="px-6 py-4 font-medium text-gray-800">

{{ $user->nip }}

</td>


<td class="px-6 py-4">

{{ $user->name }}

</td>


<td class="px-6 py-4 text-gray-400">

••••••••

</td>


<td class="px-6 py-4">

User

</td>


<td class="px-6 py-4">

{{ $user->divisi->nama_divisi ?? '-' }}

</td>


<td class="px-6 py-4">

<div class="flex items-center gap-2">


<button
onclick="editModal(
'{{ $user->id }}',
'{{ $user->nip }}',
'{{ $user->name }}',
'{{ $user->divisi_id }}'
)"
class="px-3 py-1.5 border border-gray-300 rounded-full text-sm
       hover:bg-gray-100 transition">

Edit

</button>



<button
onclick="openDeleteModal('{{ $user->id }}')"
class="px-3 py-1.5 border border-red-300 text-red-600
       rounded-full text-sm hover:bg-red-50 transition">

Hapus

</button>


</div>

</td>


</tr>


@empty


<tr>

<td colspan="6" class="py-24">

<div class="flex flex-col items-center justify-center text-center">


<svg class="w-14 h-14 text-gray-300 mb-3"
fill="none"
stroke="currentColor"
viewBox="0 0 24 24">

<path stroke-width="1.5"
d="M9 17v-6h13M9 17l-4-4m4 4l-4 4"/>

</svg>


<div class="text-gray-700 font-medium">

Belum ada data divisi

</div>


<div class="text-gray-400 text-sm">

Klik tombol "Tambah Akun"

</div>


</div>

</td>

</tr>


@endforelse


</tbody>


</table>


</div>



<!-- MODAL -->
<div id="modal"
class="fixed inset-0 bg-black/30 hidden items-center justify-center z-50">


<div class="bg-white rounded-2xl shadow-lg w-[520px] p-6">


<h2 id="modalTitle"
class="text-lg font-semibold mb-5 border-b pb-2">

Tambah Akun

</h2>



<form method="POST" id="form">

@csrf
<span id="method"></span>



<div class="grid grid-cols-2 gap-4 mb-4">


<div>

<label class="text-sm">
NIP
</label>

<input
id="nip"
name="nip"
class="w-full h-10 bg-gray-100 border-0 rounded-full px-4 mt-1">

</div>



<div>

<label class="text-sm">
Nama Pengguna
</label>

<input
id="name"
name="name"
class="w-full h-10 bg-gray-100 border-0 rounded-full px-4 mt-1">

</div>


</div>



<div class="mb-4">

<label class="text-sm">
Password
</label>

<input
name="password"
type="password"
class="w-full h-10 bg-gray-100 border-0 rounded-full px-4 mt-1">

</div>



<div class="grid grid-cols-2 gap-4 mb-6">


<div>

<label class="text-sm">
Role
</label>

<select
class="w-full h-10 bg-gray-100 border-0 rounded-full px-4 mt-1">

<option>User</option>

</select>

</div>



<div>

<label class="text-sm">
Divisi
</label>

<select
name="divisi_id"
id="divisi_id"
class="w-full h-10 bg-gray-100 border-0 rounded-full px-4 mt-1">

@foreach($divisi as $d)

<option value="{{ $d->id }}">
{{ $d->nama_divisi }}
</option>

@endforeach

</select>

</div>


</div>



<div class="flex justify-end gap-3">


<button type="button"
onclick="closeModal()"
class="px-6 py-2 rounded-full bg-gray-300 hover:bg-gray-400">

Batal

</button>


<button
class="px-6 py-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white">

Simpan

</button>


</div>


</form>


</div>
</div>




<!-- DELETE MODAL -->
<div id="deleteModal"
class="fixed inset-0 bg-black/30 hidden items-center justify-center z-50">


<div class="bg-white rounded-xl p-6 w-96">


<h2 class="font-semibold mb-2">

Konfirmasi Hapus

</h2>


<p class="text-gray-500 mb-6 text-sm">

Yakin ingin menghapus akun ini?

</p>


<form method="POST" id="deleteForm">

@csrf
@method('DELETE')


<div class="flex justify-end gap-3">


<button type="button"
onclick="closeDeleteModal()"
class="px-5 py-2 bg-gray-300 rounded-full">

Batal

</button>


<button
class="px-5 py-2 bg-red-600 text-white rounded-full">

Hapus

</button>


</div>


</form>


</div>


</div>




<script>

const modal = document.getElementById('modal')
const form = document.getElementById('form')
const method = document.getElementById('method')


function openModal()
{

modal.classList.remove('hidden')
modal.classList.add('flex')

form.action="/akun"

method.innerHTML=""

form.reset()

document.getElementById('modalTitle').innerText="Tambah Akun"

}


function editModal(id,nip,name,divisi)
{

modal.classList.remove('hidden')
modal.classList.add('flex')

form.action="/akun/"+id

method.innerHTML='<input type="hidden" name="_method" value="PUT">'

document.getElementById('nip').value=nip
document.getElementById('name').value=name
document.getElementById('divisi_id').value=divisi

document.getElementById('modalTitle').innerText="Edit Akun"

}


function closeModal()
{

modal.classList.add('hidden')

}



function openDeleteModal(id)
{

document.getElementById('deleteModal').classList.remove('hidden')
document.getElementById('deleteModal').classList.add('flex')

document.getElementById('deleteForm').action="/akun/"+id

}


function closeDeleteModal()
{

document.getElementById('deleteModal').classList.add('hidden')

}

</script>


@endsection