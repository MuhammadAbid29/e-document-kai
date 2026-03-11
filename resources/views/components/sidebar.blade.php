@php
    use App\Models\Divisi;
    $divisiList = Divisi::all();
@endphp

<div class="w-64 min-h-screen bg-[#243C7A] text-white pt-6">

    <nav class="space-y-2 px-4">

        <!-- DASHBOARD -->
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-3 rounded-lg
           {{ request()->is('dashboard') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
            Dashboard
        </a>


        <!-- SUPERADMIN ONLY -->
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


       
        <!-- MANAJEMEN DOKUMEN DROPDOWN -->
        <div x-data="{ open: {{ request()->is('dokumen*') ? 'true' : 'false' }} }">

            <button @click="open = !open"
                class="flex items-center justify-between w-full px-4 py-3 rounded-lg
                {{ request()->is('dokumen*') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">

                <span>Manajemen Dokumen</span>

                <svg class="w-4 h-4 transition-transform"
                     :class="open ? 'rotate-180' : ''"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M19 9l-7 7-7-7" />
                </svg>
            </button>


            <!-- DROPDOWN DIVISI -->
            <div x-show="open" class="mt-2 space-y-1 pl-4">

                @foreach($divisiList as $d)

                    <a href="{{ route('dokumen.index',['divisi_id'=>$d->id]) }}"
                       class="block px-4 py-2 rounded-lg text-sm
                       {{ request('divisi_id') == $d->id
                            ? 'bg-blue-500'
                            : 'hover:bg-blue-500' }}">

                        {{ $d->nama_divisi }}

                    </a>

                @endforeach

            </div>

        </div>


        <!-- AUDIT LOG -->
       <a href="{{ route('audit.index') }}"
   class="block px-4 py-3 rounded-lg
   {{ request()->is('audit-log') ? 'bg-blue-600 text-white' : 'hover:bg-blue-600 hover:text-white' }}">
   Audit Log
</a>


        <!-- SAMPAH -->
        <a href="{{ route('trash.index') }}"
   class="block px-4 py-3 rounded-lg
   {{ request()->is('sampah') ? 'bg-blue-600 text-white' : 'hover:bg-blue-600 hover:text-white' }}">
   Sampah
</a>

    </nav>

</div>