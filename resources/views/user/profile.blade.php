<!DOCTYPE html>
<html>
<head>
    <title>Profile - NOXÉS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Poppins]">

<!-- NAVBAR -->
<nav class="bg-white px-16 py-6 flex justify-between items-center shadow-sm">

    <h1 class="text-4xl font-bold text-[#1E5C4F]">
        <a href="{{ route('home') }}">NOXÉS</a>
    </h1>

    <div class="space-x-10 text-[#1E5C4F] font-medium text-lg">
        <a href="{{ route('home') }}">Home</a>
        <div class="relative group inline-block">
    <a href="#">Product ▾</a>

    <div class="absolute hidden group-hover:block bg-white shadow rounded mt-2">
        <a href="{{ route('user.products') }}" class="block px-4 py-2">All</a>
        <a href="{{ route('product.series', 'Classic') }}" class="block px-4 py-2">Classic Series</a>
        <a href="{{ route('product.series', 'V1') }}" class="block px-4 py-2">V1 Series</a>
        <a href="{{ route('product.series', 'V2') }}" class="block px-4 py-2">V2 Series</a>
    </div>
</div>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('contact') }}">Contact Us</a>
    </div>

    <div class="flex items-center space-x-6">

    <!-- ICON CART -->
    <a href="#">
        <img src="{{ asset('images/cart.png') }}"
             alt="Cart"
             class="w-8 h-8 object-contain hover:scale-110 transition">
    </a>

    <!-- ICON PROFILE -->
    @auth
        <a href="{{ route('profile') }}">
            <img src="{{ asset('images/profile.png') }}"
                 alt="Profile"
                 class="w-9 h-9 rounded-full object-cover border border-gray-300 hover:scale-110 transition">
        </a>
    @else
        <a href="{{ route('login') }}">
            <img src="{{ asset('images/profile.png') }}"
                 alt="Login"
                 class="w-9 h-9 rounded-full object-cover border border-gray-300 hover:scale-110 transition">
        </a>
    @endauth

</div>
</nav>

<!-- PROFILE CONTENT -->
<div class="px-24 py-16">

    <div class="bg-white p-10 shadow rounded-xl flex justify-between items-center">

        <div>
            <h2 class="text-3xl font-bold text-green-800">
                Hi, {{ Auth::user()->name }}
            </h2>

            <p class="mt-2 text-lg">
                {{ Auth::user()->username }}
            </p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-green-800 text-white px-6 py-3 rounded-lg">
                Logout
            </button>
        </form>

    </div>

    <div class="mt-20 flex justify-between items-center">

        <h3 class="text-4xl font-bold text-green-800">
            Status Pesanan
        </h3>

        <button class="bg-green-800 text-white px-6 py-3 rounded-lg">
            Riwayat Pesanan
        </button>

    </div>

</div>

</body>
</html>
