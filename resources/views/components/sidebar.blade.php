<div class="w-64 min-h-screen bg-[#243C7A] text-white pt-6">

    <nav class="space-y-2 px-4">

        <!-- DASHBOARD -->
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-3 rounded-lg
           {{ request()->is('dashboard') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
            Dashboard
        </a>


        <!-- hanya superadmin -->
        @if(auth()->user()->role == 'superadmin')

        <a href="{{ url('/divisi') }}"
           class="block px-4 py-3 rounded-lg
           {{ request()->is('divisi*') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
            Manajemen Divisi
        </a>


        <a href="{{ url('/akun') }}"
           class="block px-4 py-3 rounded-lg
           {{ request()->is('akun*') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
            Manajemen Akun
        </a>

        @endif


        <!-- semua user bisa lihat nanti -->
        <a href="#"
           class="block px-4 py-3 hover:bg-blue-600 rounded-lg">
            Manajemen Dokumen
        </a>


        <a href="#"
           class="block px-4 py-3 hover:bg-blue-600 rounded-lg">
            Audit Log
        </a>


        <a href="#"
           class="block px-4 py-3 hover:bg-blue-600 rounded-lg">
            Sampah
        </a>

    </nav>

</div>