<!DOCTYPE html>
<html>
<head>
    <title>Tambah Alamat</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
    <meta charset="UTF-8">
    <style>
        
        .container{
            max-width:600px;
            margin:auto;
            background:white;
            padding:30px;
            border-radius:10px;
        }
        input, textarea{
            width:100%;
            padding:10px;
            margin-bottom:15px;
            border-radius:6px;
            border:1px solid #ccc;
        }
        button{
            background:#0f5f54;
            color:white;
            padding:10px 20px;
            border:none;
            border-radius:6px;
        }
    </style>
</head>
<body>
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


<div class="container">
    <h2>Tambah Alamat</h2>

    <form action="{{ route('alamat.store') }}" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Nama Penerima" required>

        <input type="text" name="phone" placeholder="No HP" required>

        <textarea name="address" placeholder="Alamat Lengkap" required></textarea>

        <button type="submit">Simpan Alamat</button>
    </form>

</div>

</body>
</html>