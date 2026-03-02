<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login — e-Document KAI</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>


<body class="h-screen flex bg-gray-100">


<!-- LEFT SIDE IMAGE -->
<div class="hidden lg:flex w-1/2 relative">

    <img src="{{ asset('images/kai-train.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover">


    <!-- overlay -->
    <div class="absolute inset-0 bg-[#243C7A]/60"></div>


    <!-- content -->
    <div class="relative z-10 flex flex-col items-center justify-center w-full text-white">

        <img src="{{ asset('images/logo-kai.png') }}"
             class="w-56 mb-6">

        <h1 class="text-3xl font-semibold tracking-wide">
            e-Document KAI Divre III
        </h1>

    </div>

</div>



<!-- RIGHT SIDE FORM -->
<div class="w-full lg:w-1/2 flex items-center justify-center px-10">


    <div class="w-full max-w-md">


        <!-- TITLE -->
        <div class="mb-8">

            <p class="text-sm text-gray-500">
                PT KAI DIVRE III PALEMBANG
            </p>

            <h2 class="text-3xl font-bold text-gray-800">
                Selamat Datang
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                Silakan masuk ke akun Anda untuk melanjutkan.
            </p>

        </div>



        <!-- STATUS -->
        @if(session('status'))
            <div class="mb-4 text-green-600 text-sm">
                {{ session('status') }}
            </div>
        @endif



        <form method="POST" action="{{ route('login') }}">

            @csrf


            <!-- NIPP -->
            <div>

                <label class="text-sm text-gray-600 font-medium">
                    NIPP
                </label>

                <input
                    type="text"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="Masukkan NIPP Anda"

                    class="w-full mt-2 px-5 py-3
                           bg-gray-200
                           rounded-2xl
                           border border-transparent
                           focus:bg-white
                           focus:border-[#243C7A]
                           focus:ring-2 focus:ring-blue-200
                           outline-none
                           transition">

                @error('email')
                    <div class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror

            </div>



            <!-- PASSWORD -->
            <div class="mt-5">

                <label class="text-sm text-gray-600 font-medium">
                    Password
                </label>


                <div class="relative">

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        placeholder="Masukkan Password Anda"

                        class="w-full mt-2 px-5 py-3
                               bg-gray-200
                               rounded-2xl
                               border border-transparent
                               focus:bg-white
                               focus:border-[#243C7A]
                               focus:ring-2 focus:ring-blue-200
                               outline-none
                               transition">


                    <button
                        type="button"
                        onclick="togglePassword()"

                        class="absolute right-4 top-1/2
                               -translate-y-1/2
                               text-gray-400 hover:text-gray-700">

                        👁

                    </button>

                </div>


                @error('password')
                    <div class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror


            </div>



            <!-- LUPA PASSWORD -->
            <div class="text-right mt-3">

                <a href="{{ route('password.request') }}"
                   class="text-sm text-[#243C7A] hover:underline">

                    Lupa Password?

                </a>

            </div>



            <!-- LOGIN BUTTON -->
            <button
                type="submit"

                class="w-full mt-6
                       bg-[#243C7A]
                       hover:bg-[#1b2f61]
                       text-white
                       font-semibold
                       py-3
                       rounded-xl
                       shadow-md
                       transition">

                LOGIN

            </button>



        </form>


    </div>


</div>



<script>

function togglePassword()
{
    const input = document.getElementById("password");

    input.type =
        input.type === "password"
        ? "text"
        : "password";
}

</script>



</body>
</html>