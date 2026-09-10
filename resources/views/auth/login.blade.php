
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login | ZanzOutdoor</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap"
        rel="stylesheet"
    >

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: '#163A2A',
                        deepforest: '#0D291D',
                        moss: '#476B52',
                        cream: '#F5F3ED',
                        charcoal: '#202522',
                    },

                    fontFamily: {
                        sans: ['DM Sans', 'sans-serif'],
                        heading: ['Manrope', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>

        body {
            font-family: 'DM Sans', sans-serif;
        }

        .heading {
            font-family: 'Manrope', sans-serif;
        }

        /* =========================
           BACKGROUND FOTO
           ========================= */

        .outdoor-image {
            background-image:
                linear-gradient(
                    90deg,
                    rgba(13, 41, 29, 0.35),
                    rgba(13, 41, 29, 0.05)
                ),
                url('images/gunung-home.png');

            background-size: cover;
            background-position: center;
        }

        /* Input */

        .input-field {
            transition: 0.2s ease;
        }

        .input-field:focus {
            border-color: #476B52;
            box-shadow: 0 0 0 3px rgba(71, 107, 82, 0.10);
        }

        /* Button */

        .login-button {
            transition: 0.2s ease;
        }

        .login-button:hover {
            background: #0D291D;
            transform: translateY(-1px);
        }

    </style>

</head>


<body class="bg-cream min-h-screen">

    <!-- PAGE -->
    <main class="min-h-screen flex items-center justify-center p-4">

        <!-- LOGIN CONTAINER -->
        <div class="w-full max-w-4xl bg-white rounded-2xl
                   overflow-hidden shadow-[0_20px_60px_rgba(13,41,29,0.14)]
                   grid grid-cols-1 md:grid-cols-2">


            <!-- ======================================
                 LEFT SIDE
                 ====================================== -->

            <section class="outdoor-image relative min-h-[260px] md:min-h-[520px]">

                <div class="absolute top-6 left-6 flex items-center gap-2.5 z-10">
                    {{-- Logo  --}}
                    <div></div>

                    <div>
                        <h1 class="heading text-white font-bold text-sm">ZanzOutdoor</h1>
                        <p class="text-white/75 text-[8px]
                                   tracking-[0.2em] uppercase">Equipment Rental</p>
                    </div>
                </div>

                <!-- Bottom Text -->

                <div class="absolute bottom-7 left-6 right-6 z-10">
                    <p class="text-white/75 text-[10px] uppercase
                               tracking-[0.2em] mb-2">Explore Without Limits</p>
                    <h2 class="heading text-white text-2xl
                               md:text-3xl font-bold leading-tight">
                               Gear Up.<br> Go Further.</h2>

                    <p class="text-white/75 text-xs mt-3 max-w-xs
                               leading-relaxed"> 
                               Perlengkapan outdoor untuk setiap perjalanan dan petualanganmu.
                    </p>
                </div>

            </section>



            <!-- ======================================
                 RIGHT SIDE - LOGIN
                 ====================================== -->

            <section
                class="flex items-center
                       bg-white">


                <div
                    class="w-full
                           px-7 py-8
                           sm:px-10 sm:py-10">


                    <!-- Header -->

                    <div class="mb-7">

                        <p
                            class="text-forest
                                   text-[10px]
                                   font-bold
                                   uppercase
                                   tracking-[0.2em]
                                   mb-2">

                            Welcome Back

                        </p>


                        <h2
                            class="heading
                                   text-charcoal
                                   text-2xl
                                   font-bold">

                            Masuk ke akun

                        </h2>


                        <p
                            class="text-gray-400
                                   text-xs
                                   mt-2">

                            Masuk untuk melanjutkan ke ZanzOutdoor.

                        </p>

                    </div>



                    <!-- SUCCESS -->

                    @if (session('success'))

                        <div
                            class="mb-5
                                   rounded-lg
                                   bg-green-50
                                   border border-green-100
                                   px-3 py-2.5
                                   text-xs
                                   text-green-700">

                            {{ session('success') }}

                        </div>

                    @endif



                    <!-- ERROR -->

                    @if ($errors->any())

                        <div
                            class="mb-5
                                   rounded-lg
                                   bg-red-50
                                   border border-red-100
                                   px-3 py-2.5
                                   text-xs
                                   text-red-600">

                            {{ $errors->first() }}

                        </div>

                    @endif



                    <!-- FORM -->

                    <form
                        method="POST"
                        action="{{ route('login.post') }}"
                        class="space-y-4">

                        @csrf


                        <!-- EMAIL -->

                        <div>

                            <label
                                for="email"
                                class="block
                                       text-xs
                                       font-semibold
                                       text-charcoal
                                       mb-1.5">

                                Email

                            </label>


                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                required
                                autofocus

                                class="input-field
                                       w-full
                                       h-11
                                       px-3.5
                                       rounded-lg
                                       border
                                       border-gray-200
                                       bg-gray-50
                                       text-sm
                                       text-charcoal
                                       outline-none
                                       placeholder:text-gray-400">

                        </div>



                        <!-- PASSWORD -->

                        <div>

                            <label
                                for="password"
                                class="block
                                       text-xs
                                       font-semibold
                                       text-charcoal
                                       mb-1.5">

                                Password

                            </label>


                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan password"
                                required

                                class="input-field
                                       w-full
                                       h-11
                                       px-3.5
                                       rounded-lg
                                       border
                                       border-gray-200
                                       bg-gray-50
                                       text-sm
                                       text-charcoal
                                       outline-none
                                       placeholder:text-gray-400">

                        </div>



                        <!-- REMEMBER -->

                        <div
                            class="flex
                                   items-center
                                   justify-between
                                   pt-1">


                            <label
                                class="flex
                                       items-center
                                       gap-2
                                       cursor-pointer">


                                <input
                                    type="checkbox"
                                    name="remember"

                                    class="w-3.5
                                           h-3.5
                                           rounded
                                           border-gray-300
                                           text-forest
                                           focus:ring-forest">


                                <span
                                    class="text-xs
                                           text-gray-500">

                                    Ingat saya

                                </span>

                            </label>

                        </div>



                        <!-- LOGIN BUTTON -->

                        <button
                            type="submit"

                            class="login-button
                                   w-full
                                   h-11
                                   rounded-lg
                                   bg-forest
                                   text-white
                                   text-xs
                                   font-semibold
                                   tracking-wide
                                   shadow-sm">

                            Masuk ke Akun

                        </button>


                    </form>



                    <!-- REGISTER -->

                    <div
                        class="mt-6
                               pt-5
                               border-t
                               border-gray-100
                               text-center">


                        <p
                            class="text-xs
                                   text-gray-400">

                            Belum punya akun?

                            <a
                                href="{{ route('register') }}"

                                class="font-semibold
                                       text-forest
                                       hover:text-moss
                                       transition">

                                Daftar sekarang

                            </a>

                        </p>

                    </div>



                    <!-- FOOTER -->

                    <p
                        class="text-center
                               text-[10px]
                               text-gray-300
                               mt-5">

                        © {{ date('Y') }} ZanzOutdoor

                    </p>

                </div>

            </section>

        </div>

    </main>

</body>
</html>