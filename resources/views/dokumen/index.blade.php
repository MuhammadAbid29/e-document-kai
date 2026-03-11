@extends('layouts.app-kai')

@section('content')

<div class="w-full">

    <!-- TITLE -->
    <div class="mb-1">
        <h1 class="text-3xl font-bold text-gray-800">
            Manajemen Dokumen
        </h1>
        <p class="text-gray-500 text-sm">
            Kelola Dokumen dan Folder Divisi
        </p>
    </div>

    <!-- SEARCH -->
    <div class="flex justify-end mb-3">

    <form method="GET"
          action="{{ route('dokumen.index') }}"
          class="relative w-72">

        <input type="hidden"
               name="divisi_id"
               value="{{ request('divisi_id') }}">

        <input type="hidden"
               name="folder_id"
               value="{{ request('folder_id') }}">

        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari file..."
               class="w-full bg-gray-50 border border-gray-200
                      rounded-full pl-10 pr-4 py-2 text-sm
                      focus:ring-2 focus:ring-blue-400 outline-none">

        <!-- ICON DI DALAM RELATIVE -->
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4 absolute left-3 top-2.5 text-gray-400 pointer-events-none"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>

    </form>

</div>


    <div class="flex gap-6">

        <!-- LEFT PANEL -->
        <div class="w-72 shrink-0">

            <div class="bg-white rounded-2xl shadow-sm p-5">

                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">
                    Folder - {{ $currentDivisi?->nama_divisi ?? 'Pilih Divisi' }}
                </div>

                @include('dokumen.partials.folder-tree', [
    'folders' => $folders,
    'currentDivisi' => $currentDivisi,
    'currentFolder' => $currentFolder
])

            </div>

        </div>



        <!-- RIGHT CONTENT -->
        <div class="flex-1">
@if($currentDivisi)

<div class="mb-4 text-sm text-gray-500">

    <a href="{{ route('dokumen.index', [
        'divisi_id'=>$currentDivisi->id
    ]) }}" class="hover:underline">
        {{ $currentDivisi->nama_divisi }}
    </a>

    @if($currentFolder)
        > {{ $currentFolder->name }}
    @endif

</div>

@endif
            
          <!-- ACTION AREA -->
<div class="mb-4">

    

    <!-- BUTTON -->
    <div class="flex justify-end gap-3">

        @if($currentFolder)
        <button onclick="openUploadModal()"
            class="bg-[#243C7A] text-white px-5 py-2 rounded-xl
                   shadow-sm hover:shadow-md transition">
            Upload
        </button>
        @endif

        @if($currentDivisi)
        <button onclick="openFolderModal()"
            class="bg-[#243C7A] text-white px-5 py-2 rounded-xl
                   shadow-sm hover:shadow-md transition">
            Tambah Folder
        </button>
        @endif

    </div>

</div>

@if($currentFolder)

<!-- SUBFOLDER GRID -->
<div class="flex gap-4 mb-4 flex-wrap">

@forelse($subfolders as $folder)

<div class="relative bg-white border border-gray-100 p-5 rounded-2xl w-44
           shadow-sm hover:shadow-lg transition group">

    <a href="{{ route('dokumen.index', [
        'divisi_id'=>$currentDivisi?->id,
        'folder_id'=>$folder->id
    ]) }}" class="absolute inset-0 z-0"></a>

    <!-- 3 DOT -->
    <div x-data="{ menu:false }"
     class="absolute top-3 right-3 z-10">
         
        <button @click.stop="menu = !menu"
            class="opacity-0 group-hover:opacity-100 transition text-gray-500 hover:text-black">
            ⋮
        </button>

        <div x-show="menu"
             @click.away="menu=false"
             class="absolute right-0 mt-2 w-40 bg-white border rounded-xl shadow-lg z-50">

            <!-- Tambah Subfolder -->
            <button type="button"
                onclick="event.stopPropagation(); openSubfolderModal({{ $folder->id }})"
                class="block w-full text-left px-3 py-2 hover:bg-gray-100">
                Tambah Subfolder
            </button>

            <!-- Rename -->
            <button type="button"
                onclick="event.stopPropagation(); openRenameModal({{ $folder->id }}, '{{ $folder->name }}')"
                class="block w-full text-left px-3 py-2 hover:bg-gray-100">
                Rename
            </button>

            <!-- Hapus -->
            <button type="button"
                onclick="event.stopPropagation(); openDeleteModal('{{ route('folder.delete',$folder->id) }}')"
                class="block w-full text-left px-3 py-2 text-red-500 hover:bg-red-50">
                Hapus
            </button>

        </div>

    </div>

    <!-- ICON -->
    <div class="w-12 h-12 bg-yellow-100 rounded-xl
                flex items-center justify-center mb-3">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 text-yellow-500"
             fill="currentColor"
             viewBox="0 0 24 24">
            <path d="M3 6a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v2H3V6z"/>
            <path d="M3 10h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/>
        </svg>

    </div>

    <!-- NAME -->
    <div class="font-medium text-gray-800">
        {{ $folder->name }}
    </div>

    <!-- FILE COUNT -->
    <div class="text-xs text-gray-400 mt-1">
        {{ $folder->documents->count() }} File
    </div>

</div>

@empty
<p class="text-gray-400 text-sm">Tidak ada subfolder</p>
@endforelse

</div>

@endif


            <!-- TABLE -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="text-left px-6 py-4">Nama File</th>
                            <th class="text-left px-6 py-4">Jenis</th>
                            <th class="text-left px-6 py-4">Tanggal</th>
                            <th class="text-left px-6 py-4">Ukuran</th>
                            <th class="text-left px-6 py-4">Diupload Oleh</th>
                            <th class="text-left px-6 py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($documents as $doc)

                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-6 py-5">{{ $doc->name }}</td>
                            <td class="px-6 py-5">
                                {{ strtoupper(pathinfo($doc->name, PATHINFO_EXTENSION)) }}
                            </td>
                            <td class="px-6 py-5">
                                {{ $doc->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-5">{{ $doc->file_size }}</td>
                            <td class="px-6 py-5">{{ $doc->uploader->name }}</td>
                            <td class="px-6 py-5 flex gap-4">

                                <a href="{{ asset('storage/'.$doc->file_path) }}"
                                   class="text-blue-600 hover:underline">
                                    Download
                                </a>

                               <button type="button"
    onclick="openDeleteModal('{{ route('dokumen.delete',$doc->id) }}')"
    class="text-red-500 hover:underline">
    Hapus
</button>

                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-400">
                                Belum ada dokumen
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- SUBFOLDER MODAL -->
<div id="subfolderModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-96 p-6 shadow-xl">

        <h2 class="text-lg font-semibold mb-4">
            Tambah Subfolder
        </h2>

        <form method="POST" action="{{ route('folder.store') }}">
            @csrf

            <input type="hidden" name="divisi_id"
                   value="{{ $currentDivisi?->id }}">

            <input type="hidden" name="parent_id"
                   id="subfolder_parent_id">

            <input type="text"
                   name="name"
                   placeholder="Nama Folder"
                   required
                   class="w-full border rounded-xl px-4 py-2 mb-4 focus:ring-2 focus:ring-blue-400">

            <div class="flex justify-end gap-2">
                <button type="button"
                        onclick="closeSubfolderModal()"
                        class="px-4 py-2 bg-gray-200 rounded-xl">
                    Batal
                </button>

                <button
                        class="px-4 py-2 bg-[#243C7A] text-white rounded-xl">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>

<!-- RENAME MODAL -->
<div id="renameModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-96 p-6 shadow-xl">

        <h2 class="text-lg font-semibold mb-4">
            Rename Folder
        </h2>

        <form method="POST" id="renameForm">
            @csrf

            <input type="text"
                   name="name"
                   id="rename_name"
                   required
                   class="w-full border rounded-xl px-4 py-2 mb-4 focus:ring-2 focus:ring-blue-400">

            <div class="flex justify-end gap-2">
                <button type="button"
                        onclick="closeRenameModal()"
                        class="px-4 py-2 bg-gray-200 rounded-xl">
                    Batal
                </button>

                <button
                        class="px-4 py-2 bg-[#243C7A] text-white rounded-xl">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>

<!-- UPLOAD MODAL -->
<div id="uploadModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-96 p-6 shadow-xl">

        <h2 class="text-lg font-semibold mb-4">
            Upload File
        </h2>

        <form method="POST"
              action="{{ route('dokumen.upload') }}"
              enctype="multipart/form-data">
            @csrf

            <input type="hidden"
                   name="folder_id"
                   value="{{ $currentFolder?->id }}">

            <input type="file"
                   name="file"
                   required
                   class="w-full border rounded-xl px-4 py-2 mb-4">

            <div class="flex justify-end gap-2">
                <button type="button"
                        onclick="closeUploadModal()"
                        class="px-4 py-2 bg-gray-200 rounded-xl">
                    Batal
                </button>

                <button
                        class="px-4 py-2 bg-[#243C7A] text-white rounded-xl">
                    Upload
                </button>
            </div>

        </form>

    </div>
</div>

<!-- FOLDER MODAL -->
<div id="folderModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-96 p-6 shadow-xl">

        <h2 class="text-lg font-semibold mb-4">
            Tambah Folder
        </h2>

        <form method="POST" action="{{ route('folder.store') }}">
            @csrf

            <input type="hidden"
                   name="divisi_id"
                   value="{{ $currentDivisi?->id }}">

            <input type="hidden"
                   name="parent_id"
                   value="{{ $currentFolder?->id }}">

            <input type="text"
                   name="name"
                   placeholder="Nama Folder"
                   required
                   class="w-full border rounded-xl px-4 py-2 mb-4">

            <div class="flex justify-end gap-2">
                <button type="button"
                        onclick="closeFolderModal()"
                        class="px-4 py-2 bg-gray-200 rounded-xl">
                    Batal
                </button>

                <button
                        class="px-4 py-2 bg-[#243C7A] text-white rounded-xl">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>

<!-- DELETE CONFIRM MODAL -->
<div id="deleteModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-96 p-6 shadow-xl">

        <h2 class="text-lg font-semibold mb-2">
            Konfirmasi Hapus
        </h2>

        <p class="text-sm text-gray-500 mb-6">
            Data yang dihapus tidak dapat dikembalikan.
            Apakah Anda yakin?
        </p>

        <form method="POST" id="deleteForm">
            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-200 rounded-xl">
                    Batal
                </button>

                <button
                        class="px-4 py-2 bg-red-600 text-white rounded-xl">
                    Ya, Hapus
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function openDeleteModal(actionUrl)
{
    const modal = document.getElementById('deleteModal');
    const form  = document.getElementById('deleteForm');

    form.action = actionUrl;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteModal()
{
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>

<script>
function openFolderModal()
{
    document.getElementById('folderModal').classList.remove('hidden');
    document.getElementById('folderModal').classList.add('flex');
}

function closeFolderModal()
{
    document.getElementById('folderModal').classList.add('hidden');
}
</script>

<script>
function openUploadModal()
{
    document.getElementById('uploadModal').classList.remove('hidden');
    document.getElementById('uploadModal').classList.add('flex');
}

function closeUploadModal()
{
    document.getElementById('uploadModal').classList.add('hidden');
}
</script>

<script>
function openSubfolderModal(parentId)
{
    document.getElementById('subfolder_parent_id').value = parentId;
    document.getElementById('subfolderModal').classList.remove('hidden');
    document.getElementById('subfolderModal').classList.add('flex');
}

function closeSubfolderModal()
{
    document.getElementById('subfolderModal').classList.add('hidden');
}

function openRenameModal(id, name)
{
    document.getElementById('rename_name').value = name;
    document.getElementById('renameForm').action = '/folder/rename/' + id;

    document.getElementById('renameModal').classList.remove('hidden');
    document.getElementById('renameModal').classList.add('flex');
}

function closeRenameModal()
{
    document.getElementById('renameModal').classList.add('hidden');
}
</script>
@endsection