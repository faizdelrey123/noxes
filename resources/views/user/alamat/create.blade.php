<!DOCTYPE html>
<html>
<head>
    <title>Tambah Alamat</title>
    <meta charset="UTF-8">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F5F5F5]">

<!-- ================= NAVBAR ================= -->
<nav class="bg-white px-16 py-6 flex justify-between items-center shadow-sm">

    <h1 class="text-4xl font-bold text-[#1E5C4F]">
        <a href="{{ route('home') }}">NOXÉS</a>
    </h1>

    <div class="space-x-10 text-[#1E5C4F] font-medium text-lg">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('product.index') }}">Product</a>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('contact') }}">Contact Us</a>
    </div>

    <div class="flex items-center space-x-6">

        <!-- CART -->
        <a href="{{ route('cart.index') }}" class="relative">
            <img src="{{ asset('images/cart.png') }}"
                 class="w-8 hover:scale-110 transition">

            @if(session('cart'))
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                {{ count(session('cart')) }}
            </span>
            @endif
        </a>

        <!-- PROFILE -->
        @auth
        <a href="{{ route('profile') }}">
            <img src="{{ asset('images/profile.png') }}"
                 class="w-9 h-9 rounded-full border hover:scale-110 transition">
        </a>
        @else
        <a href="{{ route('login') }}">
            <img src="{{ asset('images/profile.png') }}"
                 class="w-9 h-9 rounded-full border hover:scale-110 transition">
        </a>
        @endauth

    </div>
</nav>


<!-- ================= CONTENT ================= -->
<div class="flex justify-center mt-20">

    <div class="bg-white w-[500px] p-10 rounded-2xl shadow-sm">

        <h2 class="text-2xl font-semibold text-[#1E5C4F] mb-8 text-center">
            Tambah Alamat
        </h2>

        <form action="{{ route('alamat.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- NAMA -->
            <div>
                <label class="text-sm text-gray-600">Nama Penerima</label>
                <input type="text" name="name" required
                    class="w-full mt-1 border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]">
            </div>

            <!-- HP -->
            <div>
                <label class="text-sm text-gray-600">No HP</label>
                <input type="text" name="phone" required
                    class="w-full mt-1 border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]">
            </div>

            <!-- ALAMAT -->
            <div>
                <label class="text-sm text-gray-600">Alamat Lengkap</label>
                <textarea name="address" rows="4" required
                    class="w-full mt-1 border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]"></textarea>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-[#1E5C4F] text-white py-3 rounded-xl font-semibold hover:opacity-90 transition">
                Simpan Alamat
            </button>

        </form>

    </div>

</div>

</body>
</html>