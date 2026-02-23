<!DOCTYPE html>
<html>
<head>
    <title>Contact Us - NOXÉS</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- POPPINS -->
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
        <a href="#">Product ▾</a>
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

<!-- ================= HERO ================= -->
<section class="relative">
    <img src="{{ asset('images/bannerjans3.jpg') }}"
         class="w-full h-[420px] object-cover">

    <h2 class="absolute right-20 top-1/2 -translate-y-1/2 text-white text-6xl font-medium">
        Contact Us
    </h2>
</section>

<!-- ================= TITLE BOX ================= -->
<section class="flex justify-center -mt-20 relative z-10">

    <div class="bg-white w-[900px] text-center py-12 rounded-xl shadow-md">

        <h3 class="text-4xl font-bold mb-4">Contact Us</h3>
        <p class="text-2xl text-gray-700 mb-4">Questions, Comments, Concerns?</p>
        <p class="text-gray-500">
            Tell us what you think about our products. Your thoughts <br>
            help us to improve our service better
        </p>

    </div>

</section>

<!-- ================= INFO CARDS ================= -->
<section class="px-24 py-20 grid grid-cols-2 gap-12">

    <div class="bg-white p-10 rounded-xl shadow">
        <h4 class="text-3xl font-bold mb-4">Address</h4>
        <p class="text-gray-600 leading-relaxed">
            Pergudangan Ritz Park Blok BC-10 dan BC-11.<br>
            Desa Bohar, Kec. Taman, Kab. Sidoarjo –<br>
            Jawa Timur 61257
        </p>
    </div>

    <div class="bg-white p-10 rounded-xl shadow">
        <h4 class="text-3xl font-bold mb-4">Phone/WhatsApp</h4>
        <p class="text-gray-600 text-xl">
            +62-838-9635-0280
        </p>
    </div>

    <div class="bg-white p-10 rounded-xl shadow">
        <h4 class="text-3xl font-bold mb-4">Email</h4>
        <p class="text-gray-600 text-xl">
            noxesbackpack@gmail.com
        </p>
    </div>

    <div class="bg-white p-10 rounded-xl shadow">
        <h4 class="text-3xl font-bold mb-4">Outlet</h4>
        <p class="text-gray-600 leading-relaxed">
            Jakarta - Bandung - Bogor -<br>
            Yogyakarta - Bekasi - Surabaya -<br>
            Bali - Padang - Medan
        </p>
    </div>

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
