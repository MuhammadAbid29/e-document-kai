<div class="bg-white shadow px-6 py-4 flex justify-between items-center">

    <div>

        <h1 class="text-2xl font-bold text-gray-800">
            Dashboard
        </h1>

        <p class="text-gray-500">
            Selamat datang kembali, {{ Auth::user()->name }}!
        </p>

    </div>


    <div class="flex items-center gap-4">

        <!-- avatar -->
        <div class="w-10 h-10 bg-blue-900 text-white rounded-full flex items-center justify-center font-bold">
            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
        </div>


        <div>

            <div class="font-semibold">
                {{ Auth::user()->name }}
            </div>

            <div class="text-sm text-gray-500">
                Super Admin
            </div>

        </div>


        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="text-red-500 hover:text-red-700">
                Logout
            </button>

        </form>

    </div>

</div>