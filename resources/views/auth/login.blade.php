<!DOCTYPE html>
<html>
<head>
    <title>Login - NOXÉS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-white shadow px-12 py-4 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-green-800">NOXÉS</h1>

    <div class="space-x-8 text-green-800 font-medium">
        <a href="#">Home</a>
        <a href="#">Product</a>
        <a href="#">About Us</a>
        <a href="#">Contact Us</a>
    </div>

    <div class="space-x-4 text-xl">
        🛒 👤
    </div>
</nav>

<!-- CONTENT -->
<div class="grid grid-cols-2 min-h-[70vh]">

    <!-- LEFT SIDE -->
    <div class="flex flex-col justify-center px-24">
        <h1 class="text-5xl font-bold text-green-800 mb-6">NOXÉS</h1>
        <p class="text-3xl">Best Backpack <br> Style with you</p>
    </div>

    <!-- RIGHT SIDE -->
    <div class="flex items-center justify-center">
        <div class="bg-white w-[420px] p-10 shadow-lg">

            <h2 class="text-3xl text-center mb-6">Login</h2>

            {{-- ERROR MESSAGE --}}
            @if(session('error'))
                <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <input type="text" name="username"
                    placeholder="Username"
                    class="w-full border rounded-lg p-3 mb-4">

                <input type="password" name="password"
                    placeholder="Password"
                    class="w-full border rounded-lg p-3 mb-6">

                <button type="submit"
                    class="w-full bg-green-800 text-white py-3 rounded-lg shadow-md">
                    Login
                </button>
            </form>

            <p class="text-center mt-4">
                Belum punya akun?
                <a href="/register" class="text-blue-600">Register</a>
            </p>

        </div>
    </div>
</div>

</body>
</html>
