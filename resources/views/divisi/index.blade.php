@extends('layouts.app-kai')

@section('content')

<!-- JUDUL -->
<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-800">
        Manajemen Divisi
    </h1>

    <p class="text-gray-500">
        Kelola informasi perdivisi
    </p>

</div>


<!-- SEARCH + BUTTON (DI BAWAH JUDUL) -->
<div class="flex justify-end items-center gap-3 mb-6">

    <form method="GET">
        <input type="text"
               name="search"
               value="{{ $search }}"
               placeholder="Cari divisi..."
               class="bg-white-100 border-0 rounded-full px-5 py-2 w-72
                      focus:outline-none focus:ring-2 focus:ring-blue-500">
    </form>


    <button onclick="openModal()"
            class="bg-[#243C7A] hover:bg-[#1d3266]
                   text-white px-6 py-2 rounded-full shadow-sm">

        + Tambah Divisi

    </button>

</div>



<!-- CARD TABLE -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">


    <table class="w-full">

        <!-- HEADER -->
        <thead class="bg-slate-100">

            <tr class="text-gray-600 text-sm font-semibold">

                <th class="text-left py-4 px-6">
                    Kode Divisi
                </th>

                <th class="text-left py-4 px-6">
                    Nama Divisi
                </th>

                <th class="text-left py-4 px-6">
                    Jumlah Akun
                </th>

                <th class="text-left py-4 px-6">
                    Deskripsi
                </th>

                <th class="text-left py-4 px-6">
                    Status
                </th>

                <th class="text-left py-4 px-6">
                    Aksi
                </th>

            </tr>

        </thead>



        <!-- BODY -->
        <tbody>

        @forelse($divisi as $d)

        <tr class="border-t hover:bg-gray-50 transition">

            <td class="py-4 px-6 font-medium text-gray-700">
                {{ $d->kode_divisi }}
            </td>


            <td class="px-6">
                {{ $d->nama_divisi }}
            </td>


            <td class="px-6">
                0
            </td>


            <td class="px-6 text-gray-600">
                {{ $d->deskripsi }}
            </td>


            <td class="px-6">

                <span class="px-3 py-1 text-xs font-semibold
                    {{ $d->status=='Aktif'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-gray-200 text-gray-600' }}
                    rounded-full">

                    {{ $d->status }}

                </span>

            </td>


            <td class="px-6">

    <div class="flex items-center gap-2">

        <!-- EDIT -->
        <button
            onclick="editModal(
                '{{ $d->id }}',
                '{{ $d->nama_divisi }}',
                '{{ $d->deskripsi }}',
                '{{ $d->status }}'
            )"
            class="flex items-center gap-1 border border-gray-300
                   px-3 py-1.5 rounded-full text-sm
                   hover:bg-gray-100 transition">

            Edit

        </button>


        <!-- DELETE BUTTON -->
        <button
            onclick="openDeleteModal('{{ $d->id }}')"
            class="flex items-center gap-1 border border-red-300
                   text-red-600 px-3 py-1.5 rounded-full text-sm
                   hover:bg-red-50 transition">

            Hapus

        </button>

    </div>

</td>

<!-- DELETE MODAL -->
<div id="deleteModal"
class="fixed inset-0 bg-black/30 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl shadow-lg w-[400px] p-6">

        <h2 class="text-lg font-semibold mb-2 text-gray-800">
            Konfirmasi Hapus
        </h2>

        <p class="text-gray-500 mb-6">
            Yakin ingin menghapus divisi ini?
        </p>

        <form method="POST" id="deleteForm">

            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-3">

                <button type="button"
                        onclick="closeDeleteModal()"
                        class="bg-gray-300 hover:bg-gray-400
                               text-gray-700 px-5 py-2 rounded-full">

                    Batal

                </button>

                <button
                    class="bg-red-600 hover:bg-red-700
                           text-white px-5 py-2 rounded-full">

                    Hapus

                </button>

            </div>

        </form>

    </div>

</div>

        @empty


        <!-- EMPTY STATE -->
        <tr>

            <td colspan="6" class="py-24 text-center">

                <div class="flex flex-col items-center text-gray-400">

                    <svg class="w-14 h-14 mb-3"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-width="1.5"
                        d="M9 17v-6h13M9 17l-4-4m4 4l-4 4"/>

                    </svg>

                    <div class="font-medium text-black">
                        Belum ada data divisi
                    </div>

                    <div class="text-sm">
                        Klik tombol "Tambah Divisi" untuk membuat data baru.
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

    <!-- TITLE -->
    <h2 class="text-xl font-semibold mb-4 border-b pb-2">
        Tambah Divisi
    </h2>


    <form method="POST" id="form">

        @csrf
        <span id="method"></span>


        <!-- ROW 2 KOLOM -->
        <div class="grid grid-cols-2 gap-4 mb-4">

            <!-- Nama Divisi -->
            <div>

                <label class="text-sm text-black">
                    Nama Divisi
                </label>

                <input type="text"
                       name="nama_divisi"
                       id="nama"
                       class="w-full bg-gray-100 border-0 rounded-full px-4 py-2 mt-1
                              focus:ring-2 focus:ring-blue-500">

            </div>


            <!-- Status -->
            <div>

                <label class="text-sm text-black">
                    Status
                </label>

                <select name="status"
                        id="status"
                        class="w-full bg-gray-100 border-0 rounded-full px-4 py-2 mt-1
                               focus:ring-2 focus:ring-blue-500">

                    <option value="">
                        Pilih role
                    </option>

                    <option value="Aktif">
                        Aktif
                    </option>

                    <option value="Nonaktif">
                        Nonaktif
                    </option>

                </select>

            </div>

        </div>



        <!-- DESKRIPSI -->
        <div class="mb-6">

            <label class="text-sm text-black">
                Deskripsi
            </label>

            <textarea name="deskripsi"
                      id="deskripsi"
                      rows="3"
                      class="w-full bg-gray-100 border-0 rounded-2xl px-4 py-3 mt-1
                             focus:ring-2 focus:ring-blue-500"></textarea>

        </div>



        <!-- BUTTON -->
        <div class="flex justify-end gap-3">

            <button type="button"
                    onclick="closeModal()"
                    class="bg-gray-300 hover:bg-gray-400
                           text-gray-700 px-6 py-2 rounded-full">

                Batal

            </button>


            <button
                class="bg-blue-600 hover:bg-blue-700
                       text-white px-6 py-2 rounded-full">

                Simpan

            </button>

        </div>


    </form>


</div>
</div>



<script>

const modal = document.getElementById('modal');
const form = document.getElementById('form');
const method = document.getElementById('method');
const deleteModal = document.getElementById('deleteModal');
const deleteForm = document.getElementById('deleteForm');

function openDeleteModal(id)
{
    deleteModal.classList.remove('hidden')
    deleteModal.classList.add('flex')

    deleteForm.action = "/divisi/" + id
}

function closeDeleteModal()
{
    deleteModal.classList.add('hidden')
}

function openModal()
{
    modal.classList.remove('hidden')
    modal.classList.add('flex')

    form.action = "/divisi"

    method.innerHTML = ""

    form.reset()

    document.getElementById('status').value = ""

    document.querySelector("#modal h2").innerText = "Tambah Divisi"
}


function editModal(id,nama,desk,statusVal)
{
    modal.classList.remove('hidden')
    modal.classList.add('flex')

    form.action = "/divisi/" + id

    method.innerHTML =
        '<input type="hidden" name="_method" value="PUT">'

    document.getElementById('nama').value = nama
    document.getElementById('deskripsi').value = desk
    document.getElementById('status').value = statusVal

    document.querySelector("#modal h2").innerText = "Edit Divisi"
}


function closeModal()
{
    modal.classList.add('hidden')
}

</script>

@endsection