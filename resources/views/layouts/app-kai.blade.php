<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KAI Document System</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100">

<!-- HEADER PUTIH ATAS -->
<div class="bg-white shadow-sm border-b">

    <div class="flex items-center justify-between px-6 py-3">

        <!-- Logo kiri -->
        <div class="flex items-center gap-4">

            <img src="{{ asset('images/logo-kai.png') }}"
                 class="h-10">

            <div class="font-semibold text-gray-700">
                PT KAI DIVRE III PALEMBANG
            </div>

        </div>


        <!-- PROFILE -->
        <div class="relative">

            <button onclick="toggleProfile()"
                class="flex items-center gap-3">

                <div class="text-right">

                    <div class="font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-sm text-gray-500 capitalize">
                        {{ Auth::user()->role }}
                    </div>

                </div>

                <img
src="{{ Auth::user()->photo
    ? asset('storage/'.Auth::user()->photo)
    : 'https://ui-avatars.com/api/?name='.Auth::user()->name }}"
class="w-10 h-10 rounded-full object-cover">

                <svg class="w-5 h-5 text-gray-600"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-width="2"
                          d="M19 9l-7 7-7-7"/>
                </svg>

            </button>


            <!-- DROPDOWN -->
            <div id="profileMenu"
                class="hidden absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-lg border p-3 z-50">

                <div class="pb-2 border-b">

                    <div class="font-semibold">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-sm text-orange-500 capitalize">
                        {{ Auth::user()->role }}
                    </div>

                </div>


                <a href="{{ route('profile.show') }}"
                   class="flex items-center gap-2 px-3 py-2 mt-2 hover:bg-gray-100 rounded-lg">

                    👤 Profil

                </a>


                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="flex items-center gap-2 px-3 py-2 w-full text-left text-red-600 hover:bg-red-50 rounded-lg">

                        ⎋ Logout

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
<!-- END HEADER -->


<!-- BODY -->
<div class="flex">

    <!-- SIDEBAR -->
    @include('components.sidebar')


    <!-- CONTENT -->
    <main class="flex-1 p-6">

        @yield('content')

    </main>

</div>


<script>
function toggleProfile()
{
    document
        .getElementById("profileMenu")
        .classList
        .toggle("hidden")
}
</script>


</body>
</html>