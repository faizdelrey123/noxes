<!DOCTYPE html>
<html>
<head>
    <title>About Us - NOXÉS</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-[#f5f5f5]">

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

<!-- ================= HERO ================= -->
<section class="relative">
    <img src="{{ asset('images/bannerabout2.jpg') }}"
         class="w-full h-[420px] object-cover">

    <h2 class="absolute right-20 top-1/2 -translate-y-1/2 text-white text-6xl font-medium">
        About Us
    </h2>
</section>

<!-- ================= SECTION 1 ================= -->
<section class="px-24 py-24 grid grid-cols-2 gap-20 items-center">

    <img src="{{ asset('images/bannerjans7.jpg') }}"
         class="w-full rounded">

    <div>
        <h1 class="text-3xl font-semibold mb-6">OUR PRODUCT</h1>

        <p class="text-gray-700 leading-relaxed text-lg">
            Trust is hard earned, so for over 50 years JanSport has designed
            packs that last, to go everywhere you go, see what you see, and
            carry what you need. We stand by the quality and durability of
            every pack we make. And since we've been doing that since 1967,
            it's a promise you can trust.
        </p>
    </div>

</section>

<!-- ================= SECTION 2 ================= -->
<section class="px-24 pb-24 grid grid-cols-2 gap-20 items-center">

    <div>
        <h1 class="text-3xl font-semibold mb-6">STUFF WE CARE ABOUT</h1>

        <p class="text-gray-700 leading-relaxed text-lg">
            As global citizens, we're aware of the small but significantly
            positive impact a company like JanSport can have. We believe
            Community, Sustainability, and Mental Health are key components
            to the JanSport brand and we are committed to provide support
            through everything we do.
        </p>
    </div>

    <img src="{{ asset('images/aboutjans.jpg') }}"
         class="w-full rounded">

</section>

<!-- ================= FOOTER ================= -->
<footer class="px-24 py-20 flex justify-between">

    <div>
        <h2 class="text-4xl font-bold text-[#1E5C4F] mb-6">NOXÉS</h2>

        <p class="text-gray-600 leading-relaxed mb-6">
            Jl. Tanah Baru Jl. Kemiri Jaya No.99, Beji, Kecamatan Beji,<br>
            Kota Depok, Jawa Barat 16421
        </p>

        <p class="text-gray-600">
            © 2026 NOXES Apparel Corp. All rights reserved.
        </p>
    </div>

    <div class="text-right">
        <h3 class="text-4xl font-bold mb-8">Follow Us</h3>
        <div class="flex space-x-6 text-3xl justify-end">
            📷 ▶️ 🎵 📘 ✖️ 📌
        </div>
    </div>

</footer>

</body>
</html>
