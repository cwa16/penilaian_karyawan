<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

<div class="min-h-screen flex items-center justify-center bg-cover bg-center"
     style="background-image:url('{{ asset('images/bskp.jpg') }}')">

    <div class="bg-white/20 backdrop-blur-md border border-white/40 
                rounded-xl p-8 w-full max-w-md shadow-2xl text-center">

        <!-- LOGO -->
        <img src="{{ asset('images/logobskp.jpg') }}"
             class="w-48 mx-auto mb-6">

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
         @csrf


            <input type="email" name="email"
                   class="w-full p-3 rounded-lg mb-3 focus:outline-none"
                   placeholder="Email" required>

            <input type="password" name="password"
                   class="w-full p-3 rounded-lg mb-4 focus:outline-none"
                   placeholder="Password" required>

            <button
                class="w-full py-3 rounded-lg text-white font-semibold
                       bg-gradient-to-r from-red-600 to-yellow-500
                       hover:opacity-90 transition">
                LOGIN
            </button>
        </form>

    </div>
</div>

</body>
</html>
