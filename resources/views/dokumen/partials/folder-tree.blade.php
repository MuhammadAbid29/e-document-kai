@foreach($folders as $folder)

<div x-data="{ open: false }" class="mb-1">

    <!-- ROW FOLDER -->
    <div class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-100 group">

        <!-- LEFT SIDE -->
        <div class="flex items-center gap-2 cursor-pointer"
             @click="open = !open">

            @if($folder->children->count() > 0)
                <span class="text-xs w-4 text-gray-500"
                      x-text="open ? '▼' : '▶'"></span>
            @else
                <span class="w-4"></span>
            @endif

            <a href="{{ route('dokumen.index', [
                    'divisi_id' => request('divisi_id'),
                    'folder_id' => $folder->id
                ]) }}"
               class="text-sm font-medium text-gray-700 hover:text-blue-600">

                📁 {{ $folder->name }}

            </a>

        </div>


        <!-- 3 DOT MENU -->
        <div x-data="{ menu: false }"
             class="relative opacity-0 group-hover:opacity-100">

            <button @click.stop="menu = !menu"
                class="px-2 text-gray-500 hover:text-black">
                ⋮
            </button>

            <div x-show="menu"
                 @click.away="menu = false"
                 class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-lg z-50">

                <button onclick="openSubfolderModal({{ $folder->id }})"
                    class="block w-full text-left px-3 py-2 hover:bg-gray-100">
                    Tambah Subfolder
                </button>

                <button onclick="openRenameModal({{ $folder->id }}, '{{ $folder->name }}')"
                    class="block w-full text-left px-3 py-2 hover:bg-gray-100">
                    Rename
                </button>

                <form method="POST"
                      action="{{ route('folder.delete',$folder->id) }}">
                    @csrf
                    @method('DELETE')

                    <button
                        class="block w-full text-left px-3 py-2 text-red-500 hover:bg-red-50">
                        Hapus
                    </button>
                </form>

            </div>

        </div>

    </div>


    <!-- CHILDREN -->
    @if($folder->children->count() > 0)
        <div x-show="open" class="ml-6 mt-1 border-l pl-3">
            @include('dokumen.partials.folder-tree', [
                'folders' => $folder->children
            ])
        </div>
    @endif

</div>

@endforeach