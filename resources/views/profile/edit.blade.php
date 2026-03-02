@extends('layouts.app-kai')

@section('content')

<div class="mb-6">

    <h1 class="text-3xl font-bold text-gray-800">
        Profile {{ Auth::user()->name }}
    </h1>

    <p class="text-gray-500">
        Informasi akun pengguna
    </p>

</div>


<div class="bg-white rounded-2xl shadow overflow-hidden">

    <!-- HEADER AREA -->
    <div class="bg-slate-200 h-28"></div>


    <div class="p-6">

        <!-- avatar -->
        <div class="flex flex-col items-center -mt-16 mb-6">

    <img
        src="{{ Auth::user()->photo
            ? asset('storage/'.Auth::user()->photo)
            : 'https://ui-avatars.com/api/?name='.Auth::user()->name }}"
        class="w-24 h-24 rounded-full border-4 border-white shadow">


    <!-- upload -->
    <form method="POST"
          action="{{ route('profile.photo') }}"
          enctype="multipart/form-data"
          class="mt-3">

        @csrf

        <label
            class="bg-blue-600 text-white px-4 py-1 rounded-full cursor-pointer text-sm">

            Upload Foto

            <input type="file"
                   name="photo"
                   onchange="this.form.submit()"
                   class="hidden">

        </label>

    </form>


    <div class="text-xl font-semibold mt-2">
        {{ Auth::user()->name }}
    </div>

    <div class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm mt-1">
        {{ ucfirst(Auth::user()->role) }}
    </div>

</div>


        <!-- DATA -->
        <div class="grid grid-cols-2 gap-6">

            <div>
                <label class="text-sm text-gray-500">NIP</label>

                <div class="bg-gray-100 rounded-lg px-4 py-3 mt-1">
                    {{ Auth::user()->nip }}
                </div>
            </div>


            <div>
                <label class="text-sm text-gray-500">Role</label>

                <div class="bg-gray-100 rounded-lg px-4 py-3 mt-1">
                    {{ ucfirst(Auth::user()->role) }}
                </div>
            </div>


            <div>
                <label class="text-sm text-gray-500">Nama Lengkap</label>

                <div class="bg-gray-100 rounded-lg px-4 py-3 mt-1">
                    {{ Auth::user()->name }}
                </div>
            </div>


            <div>
                <label class="text-sm text-gray-500">Divisi</label>

                <div class="bg-gray-100 rounded-lg px-4 py-3 mt-1">
                    {{ Auth::user()->divisi->nama_divisi ?? '-' }}
                </div>
            </div>

        </div>


        <!-- LOGOUT -->
        <div class="flex justify-end mt-6">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="text-red-600 hover:underline">
                    Logout
                </button>

            </form>

        </div>


    </div>

</div>

@endsection