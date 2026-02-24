<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - NOXÉS</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- GOOGLE FONT POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
</head>

<body class="bg-gray-100">

<!-- ================= NAVBAR ================= -->
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



<!-- ================= HERO SECTION ================= -->
<section>
    <img src="{{ asset('images/bannerjans4.jpg') }}"
         class="w-full h-[500px] object-cover">

    <div class="absolute top-[500px] left-10 text-white text-6xl font-bold">
        SuperBreak Convention.
    </div>
</section>

<!-- ================= NEW ARRIVAL ================= -->
<section class="py-16 text-center">

    <h2 class="text-3xl text-green-800 mb-12">New Arrival</h2>

    <div class="grid grid-cols-4 gap-10 px-24">

        <div class="bg-white p-6 shadow rounded-xl">
            <img src="{{ asset('images/jansmtf6.jpg') }}"
                 class="mx-auto h-48 object-contain">
        </div>

        <div class="bg-white p-6 shadow rounded-xl">
            <img src="{{ asset('images/jansmtf8.jpg') }}"
                 class="mx-auto h-48 object-contain">
        </div>

        <div class="bg-white p-6 shadow rounded-xl">
            <img src="{{ asset('images/jansmtf10.jpg') }}"
                 class="mx-auto h-48 object-contain">
        </div>

        <div class="bg-white p-6 shadow rounded-xl">
            <img src="{{ asset('images/jansmtf8.jpg') }}"
                 class="mx-auto h-48 object-contain">
        </div>

    </div>
</section>

<!-- ================= BEST SELLER ================= -->
<section class="py-16 text-center bg-gray-50">

    <h2 class="text-3xl text-green-800 mb-12">Best Seller</h2>

    <div class="grid grid-cols-4 gap-10 px-24">

        <div>
            <img src="{{ asset('images/jansmtf11.jpg') }}"
                 class="mx-auto h-60 object-contain">
        </div>

        <div>
            <img src="{{ asset('images/jansmtf12.jpg') }}"
                 class="mx-auto h-60 object-contain">
        </div>

        <div>
            <img src="{{ asset('images/jansmtf13.jpg') }}"
                 class="mx-auto h-60 object-contain">
        </div>

        <div>
            <img src="{{ asset('images/jansmtf14.jpg') }}"
                 class="mx-auto h-60 object-contain">
        </div>

    </div>
</section>

<!-- ================= FULL BANNER ================= -->
<section>
    <img src="{{ asset('images/bannerjans6.jpg') }}"
         class="w-full h-[450px] object-cover">
</section>

<!-- ================= STYLE SECTION ================= -->
<section class="py-20 px-24 grid grid-cols-2 items-center gap-20">

    <div>
        <img src="{{ asset('images/bannerjans2.jpg') }}"
             class="w-full rounded-xl shadow">
    </div>

    <div>
        <h1 class="text-5xl text-green-800 leading-snug">
            “Where <br>
            Style <br>
            Meets <br>
            Daily <br>
            Life”
        </h1>
    </div>

</section>

<!-- ================= FOOTER ================= -->
<footer class="px-24 py-16 bg-gray-100">

    <div class="flex justify-between">

        <div>
            <h2 class="text-3xl font-bold text-green-800 mb-4">NOXÉS</h2>

            <p>
                Jl. Tanah Baru Jl. Kemiri Jaya <br>
                No.99, Beji, Kecamatan Beji,<br>
                Kota Depok, Jawa Barat 16421
            </p>

            <p class="mt-6 text-sm">
                © 2026 NOXES Apparel Corp. All rights reserved.
            </p>
        </div>

        <div>
            <h2 class="text-3xl font-bold mb-6">Follow Us</h2>

            <div class="text-3xl space-x-6">
                📸 ▶️ 🎵 👍 ✖️ 📌
            </div>
        </div>

    </div>

</footer>

</body>
</html>
