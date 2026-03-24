<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px transparent inset !important;
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>

<body>

<div class="min-h-screen flex items-center justify-center bg-cover bg-center"
    style="background-image:url('{{ asset('images/bskp.png') }}')">
    <div class="bg-white/20 backdrop-blur-xl
                rounded-3xl p-10 w-full max-w-sm
                shadow-2xl text-white">

        <!-- LOGO -->
        <img src="{{ asset('images/logobskp.svg') }}"
            class="w-48 mx-auto mb-4">

            <!-- TEXT UNDER LOGO -->
            <p class="text-[11px] font-bold text-center text-white/80 tracking-wide">
                PT. BRIDGESTONE KALIMANTAN PLANTATION
            </p>
            <p class="text-xs text-center text-white/80 tracking-wide">
                Performance Management System
            </p>

            <div class="h-8"></div>    

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
        @csrf


            <!-- EMAIL -->
            <div class="flex items-center border-b border-white/60 mb-6 pb-2">
                <input type="email" name="email"
                    class="w-full bg-transparent focus:outline-none placeholder-white"
                    placeholder="Email"
                    required>
            </div>

            <!-- PASSWORD -->
            <div class="flex items-center border-b border-white/60 mb-4 pb-2">
                <input type="password" name="password"
                    class="w-full bg-transparent focus:outline-none placeholder-white"
                    placeholder="Password"
                    required>
            </div>

            <!-- OPTIONS -->
            <div class="flex justify-between text-sm mb-6">
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-white">
                    Remember me
                </label>

                <a href="#" class="text-white/80 hover:underline">
                    Forgot Password?
                </a>
            </div>

            <!-- BUTTON -->
            <button
                class="w-full py-3 rounded-xl font-semibold text-white
                    bg-gradient-to-r from-red-600 to-yellow-500
                    hover:opacity-90 transition bg:hover shadow-md">
                Login
            </button>
        </form>

    </div>
</div>

</body>
</html>
