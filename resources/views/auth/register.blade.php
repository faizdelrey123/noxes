<!DOCTYPE html>
<html>
<head>
    <title>Register - LA PRIMERA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>

</head>
<body class="bg-gray-50 selection:bg-[#4ade80] selection:text-[#0f342b]">

    <!-- Sloped Background -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <!-- Full Image Background -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/bannerjans4.jpg') }}');">
            <div class="absolute inset-0 bg-[#000000]/60"></div>
        </div>
        <!-- Diagonal White Shape -->
        <div class="absolute inset-0 bg-white" style="clip-path: polygon(75% 0, 100% 0, 100% 100%, 55% 100%);"></div>
    </div>

    <!-- Main Content Wrapper -->
    <div class="relative z-10 flex flex-col min-h-screen">

<!-- NAVBAR -->
<nav class="bg-white/95 backdrop-blur-md px-16 py-6 flex justify-between items-center shadow-sm relative z-30 border-b border-gray-200">
    <h1 class="text-4xl font-black tracking-tighter italic">
        <a href="{{ route('home') }}" class="flex items-center gap-1 group">
            <span class="text-transparent bg-clip-text bg-gradient-to-br from-[#1E5C4F] to-[#4ade80] group-hover:from-[#15463b] group-hover:to-[#22c55e] transition-all duration-500 drop-shadow-md">LA PRIMERA</span>
            <div class="w-2 h-2 rounded-full bg-[#4ade80] self-end mb-1.5 group-hover:animate-bounce"></div>
        </a>
    </h1>

    <div class="space-x-10 text-[#1E5C4F] font-medium text-lg">
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('product.index') }}">Produk</a>
        <a href="{{ route('about') }}">Tentang Kami</a>
        <a href="{{ route('contact') }}">Hubungi Kami</a>
    </div>

    <div class="flex items-center space-x-6">
        @auth
            <a href="{{ route('cart.index') }}" class="relative">
                <img src="{{ asset('images/cart.png') }}" alt="Cart" class="w-8 h-8 object-contain hover:scale-110 transition">
                @if(session('cart'))
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </a>
            
            <a href="{{ route('profile') }}" class="relative">
                <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-9 h-9 rounded-full object-cover border border-gray-300 hover:scale-110 transition">
                @php
                    $unreadOrders = \App\Models\Order::where('user_id', auth()->id())->where('is_notified', false)->count();
                @endphp
                @if($unreadOrders > 0)
                    <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
                @endif
            </a>
        @else
            <a href="javascript:void(0)" onclick="alert('Harap masuk terlebih dahulu!'); window.location.href='{{ route('login') }}';" class="relative">
                <img src="{{ asset('images/cart.png') }}" alt="Cart" class="w-8 h-8 object-contain hover:scale-110 transition">
            </a>
            
            <a href="javascript:void(0)" onclick="alert('Harap masuk terlebih dahulu!'); window.location.href='{{ route('login') }}';">
                <img src="{{ asset('images/profile.png') }}" alt="Login" class="w-9 h-9 rounded-full object-cover border border-gray-300 hover:scale-110 transition">
            </a>
        @endauth
    </div>
</nav>

<!-- CONTENT -->
<div class="grid grid-cols-2 flex-grow relative z-10">

    <!-- LEFT SIDE -->
    <div class="flex flex-col justify-center px-24">
        <h1 class="text-6xl font-black tracking-tighter italic mb-8 flex items-center gap-1 drop-shadow-sm cursor-default hover:scale-105 transition-transform duration-500">
            <span class="text-transparent bg-clip-text bg-gradient-to-br from-[#1E5C4F] to-[#4ade80]">LA PRIMERA</span>
            <div class="w-3 h-3 rounded-full bg-[#4ade80] self-end mb-2animate-pulse"></div>
        </h1>
        <p class="text-3xl text-white font-light drop-shadow-lg tracking-wide leading-relaxed">Tas Ransel Terbaik <br> <span class="font-extrabold text-[#4ade80]">Gaya Bersamamu</span></p>
    </div>

    <!-- RIGHT SIDE -->
    <div class="flex items-center justify-center">
        <div class="bg-white border border-gray-100 w-[420px] p-10 shadow-[0_20px_50px_rgba(0,0,0,0.15)] rounded-2xl transform transition-all duration-300 hover:-translate-y-1">

            <h2 class="text-4xl font-extrabold text-center mb-8 text-transparent bg-clip-text bg-gradient-to-r from-[#1E5C4F] to-[#4ade80]">Daftar</h2>

            {{-- VALIDATION ERROR --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ url('/register') }}">
                @csrf

                <input type="text" name="name"
                    placeholder="Nama Lengkap"
                    class="w-full border border-gray-300 focus:border-[#4ade80] focus:ring-1 focus:ring-[#4ade80] outline-none rounded-xl p-3 mb-4 transition-all">

                <input type="text" name="username"
                    placeholder="Nama Pengguna"
                    class="w-full border border-gray-300 focus:border-[#4ade80] focus:ring-1 focus:ring-[#4ade80] outline-none rounded-xl p-3 mb-4 transition-all">

                <input type="password" name="password"
                    placeholder="Kata Sandi"
                    class="w-full border border-gray-300 focus:border-[#4ade80] focus:ring-1 focus:ring-[#4ade80] outline-none rounded-xl p-3 mb-6 transition-all">

                <button type="submit"
                    class="w-full bg-gradient-to-r from-[#1E5C4F] to-[#22c55e] hover:from-[#15463b] hover:to-[#16a34a] text-white font-semibold py-3 rounded-xl shadow-lg transform transition hover:scale-[1.02]">
                    Daftar
                </button>
            </form>

            <p class="text-center mt-6 text-gray-600">
                Sudah punya akun?
                <a href="/login" class="text-[#1E5C4F] font-semibold hover:text-[#4ade80] transition-colors">Masuk</a>
            </p>

        </div>
    </div>
</div>
    </div>
</div>

</body>
</html>
