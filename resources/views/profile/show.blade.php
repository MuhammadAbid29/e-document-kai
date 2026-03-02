@extends('layouts.app-kai')

@section('content')

<!-- TITLE -->
<div class="mb-6">

    <h1 class="text-3xl font-bold text-gray-800">
        Profile {{ Auth::user()->name }}
    </h1>

</div>


<!-- CARD -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

    <!-- HEADER BIRU -->
    <div class="h-32 bg-slate-300"></div>


    <!-- CONTENT -->
    <div class="px-8 pb-8">

        <!-- FOTO -->
        <div class="-mt-16 flex flex-col items-center">

            <img
src="{{ Auth::user()->photo
    ? asset('storage/'.Auth::user()->photo)
    : 'https://ui-avatars.com/api/?name='.Auth::user()->name }}"
class="w-24 h-24 rounded-full border-4 border-white shadow object-cover">

            <div class="text-xl font-semibold mt-3">
                {{ Auth::user()->name }}
            </div>

            <div class="bg-orange-500 text-white text-sm px-4 py-1 rounded-full mt-1">
                {{ Auth::user()->role }}
            </div>

        </div>


        <!-- FORM GRID -->
        <div class="grid grid-cols-2 gap-6 mt-8">

            <!-- NIP -->
            <div>

                <label class="text-sm text-gray-600">
                    NIP
                </label>

                <div class="bg-gray-100 rounded-lg px-4 py-3 mt-1">

                    {{ Auth::user()->nip }}

                </div>

            </div>


            <!-- ROLE -->
            <div>

                <label class="text-sm text-gray-600">
                    Role
                </label>

                <div class="bg-gray-100 rounded-lg px-4 py-3 mt-1">

                    {{ Auth::user()->role }}

                </div>

            </div>


            <!-- NAMA -->
            <div>

                <label class="text-sm text-gray-600">
                    Nama Lengkap
                </label>

                <div class="bg-gray-100 rounded-lg px-4 py-3 mt-1">

                    {{ Auth::user()->name }}

                </div>

            </div>


            <!-- DIVISI -->
            <div>

                <label class="text-sm text-gray-600">
                    Divisi
                </label>

                <div class="bg-gray-100 rounded-lg px-4 py-3 mt-1">

                    {{ Auth::user()->divisi->nama_divisi ?? '-' }}

                </div>

            </div>

        </div>


        <!-- LOGOUT -->
        <div class="flex justify-end mt-6">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    class="text-red-600 hover:underline">

                    Logout

                </button>

            </form>

        </div>


    </div>

</div>

@endsection