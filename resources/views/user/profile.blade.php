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
    <a href="{{ route('product.index') }}">Product</a>

    
</div>
        <a href="{{ route('about') }}">About Us</a>
        <a href="{{ route('contact') }}">Contact Us</a>
    </div>

    <div class="flex items-center space-x-6">

    <!-- ICON CART -->
    <a href="{{ route('cart.index') }}" class="relative">
    <img src="{{ asset('images/cart.png') }}"
         alt="Cart"
         class="w-8 h-8 object-contain hover:scale-110 transition">

    @if(session('cart'))
        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
            {{ count(session('cart')) }}
        </span>
    @endif
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
