<!DOCTYPE html>
<html>
<head>
    <title>About Us - LA PRIMERA</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-[#f5f5f5]">

<!-- ================= NAVBAR ================= -->
<nav class="bg-white px-16 py-6 flex justify-between items-center shadow-sm">

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

<!-- ================= HERO ================= -->
<section class="relative h-[500px] overflow-hidden">
    <div class="absolute inset-0 bg-black/40 z-10 w-full h-full"></div>
    <img src="{{ asset('images/bannerabout2.jpg') }}" alt="About LA PRIMERA" class="absolute inset-0 w-full h-full object-cover transform hover:scale-105 transition-transform duration-1000">
    <div class="relative z-20 h-full flex flex-col justify-center items-center text-center px-4">
        <h2 class="text-white text-6xl md:text-7xl font-extrabold tracking-tight mb-4 drop-shadow-xl animate-[fadeIn_1s_ease-out]">
            Cerita <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#4ade80] to-[#22c55e]">LA PRIMERA</span>
        </h2>
        <p class="text-gray-100 text-lg md:text-2xl max-w-2xl font-light mb-8 drop-shadow-md animate-[fadeIn_1.5s_ease-out]">
            Mendefinisikan ulang gaya hidup urban dengan inovasi dan kualitas tanpa kompromi.
        </p>
    </div>
</section>

<!-- ================= SECTION 1 ================= -->
<section class="px-8 md:px-24 py-24 bg-white relative">
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#4ade80]/10 rounded-full blur-3xl -z-10"></div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center max-w-7xl mx-auto">
        <div class="relative group">
            <div class="absolute -inset-4 bg-gradient-to-r from-[#1E5C4F] to-[#4ade80] rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
            <img src="{{ asset('images/bannerjans7.jpg') }}" class="relative w-full rounded-2xl shadow-2xl object-cover h-[450px] transform group-hover:scale-[1.02] transition duration-500">
        </div>
        <div>
            <div class="inline-block px-4 py-1 rounded-full bg-[#1E5C4F]/10 text-[#1E5C4F] font-semibold text-sm mb-4 tracking-wide uppercase">Kualitas Terjamin</div>
            <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900 leading-tight">Produk <span class="relative z-10">Eksklusif<span class="absolute bottom-1 left-0 w-full h-3 bg-[#4ade80]/30 -z-10"></span></span> Kami</h1>
            <p class="text-gray-600 leading-relaxed text-lg mb-6">
                Kepercayaan sulit didapat, itulah mengapa LA PRIMERA selalu merancang setiap tas dan aksesori dengan material premium yang tahan lama. Siap menemani setiap langkah Anda, melihat apa yang Anda lihat, dan membawa apa yang Anda butuhkan.
            </p>
            <p class="text-gray-600 leading-relaxed text-lg border-l-4 border-[#1E5C4F] pl-5 py-2 bg-gray-50 italic rounded-r-lg">
                "Kami berdiri di atas kualitas dan durabilitas. Ini bukan sekadar janji, melainkan komitmen kami untuk gaya hidup Anda sejak awal."
            </p>
        </div>
    </div>
</section>

<!-- ================= SECTION 2 ================= -->
<section class="px-8 md:px-24 py-24 bg-[#f9fafb] relative overflow-hidden">
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-[#1E5C4F]/5 rounded-full blur-3xl -z-10"></div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center max-w-7xl mx-auto">
        <div class="order-2 lg:order-1">
            <div class="inline-block px-4 py-1 rounded-full bg-[#4ade80]/20 text-[#15463b] font-semibold text-sm mb-4 tracking-wide uppercase">Nilai Kami</div>
            <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900 leading-tight">Hal Yang Kami <span class="text-[#1E5C4F]">Pedulikan</span></h1>
            <p class="text-gray-600 leading-relaxed text-lg mb-8">
                Sebagai bagian dari komunitas global, kami menyadari dampak positif yang dapat diberikan oleh LA PRIMERA. Kami percaya bahwa Komunitas, Keberlanjutan Lingkungan, dan Kesadaran Mental adalah fondasi utama dari brand kami.
            </p>
            <ul class="space-y-5 mb-8">
                <li class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:shadow-md transition-all duration-300">
                    <div class="w-12 h-12 rounded-full bg-[#1E5C4F]/10 flex justify-center items-center text-[#1E5C4F] shrink-0">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <span class="block text-gray-800 font-bold text-lg">Material Ramah Lingkungan</span>
                        <span class="text-sm text-gray-500">Mendukung keberlanjutan melalui pilihan bahan yang cermat.</span>
                    </div>
                </li>
                <li class="flex items-center gap-4 p-3 rounded-lg hover:bg-white hover:shadow-md transition-all duration-300">
                    <div class="w-12 h-12 rounded-full bg-[#1E5C4F]/10 flex justify-center items-center text-[#1E5C4F] shrink-0">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <span class="block text-gray-800 font-bold text-lg">Pemberdayaan Pengrajin Lokal</span>
                        <span class="text-sm text-gray-500">Berkolaborasi untuk menghasilkan produk berkualitas tinggi.</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="order-1 lg:order-2 relative group">
            <div class="absolute top-4 -right-4 w-full h-full bg-gradient-to-br from-[#1E5C4F] to-[#4ade80] rounded-2xl -z-10 group-hover:translate-x-3 group-hover:-translate-y-3 transition-transform duration-500 opacity-80"></div>
            <img src="{{ asset('images/aboutjans.jpg') }}" class="w-full rounded-2xl shadow-xl h-[450px] object-cover border-4 border-white relative z-10 transition-transform duration-500 group-hover:-rotate-1">
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<!-- ================= FOOTER ================= -->
<footer class="bg-white border-t border-gray-200 mt-20">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            
            <!-- BRAND -->
            <div class="md:col-span-2">
                <h2 class="text-3xl font-bold text-[#1E5C4F] mb-4">LA PRIMERA</h2>
                <p class="text-gray-600 leading-relaxed mb-6 max-w-sm">
                    Di mana Gaya Bertemu Kehidupan Sehari-hari. Menyediakan koleksi backpack eksklusif dan kebutuhan fashion harian terbaik untuk gaya aktifmu.
                </p>
                <div class="text-gray-500 font-medium">
                    <p>Jl. Tanah Baru Jl. Kemiri Jaya No.99,</p>
                    <p>Beji, Kecamatan Beji, Kota Depok,</p>
                    <p>Jawa Barat 16421</p>
                </div>
            </div>

            

            <!-- SOCIAL MEDIA -->
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-6 uppercase tracking-wider">Ikuti Kami</h3>
                <div class="flex items-center gap-4">
                    <!-- TikTok -->
                    <a href="URL_TIKTOK_DISINI" target="_blank" class="w-10 h-10 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 448 512"><path d="M448 209.91a210.06 210.06 0 01-122.77-39.25v178.72A162.55 162.55 0 11185 188.31v89.89a74.62 74.62 0 1052.23 71.18V0l88 0a121.18 121.18 0 001.86 22.17h0A122.18 122.18 0 00381 102.39a121.43 121.43 0 0067 20.14z"/></svg>
                    </a>
                    
                    <!-- Instagram -->
                    <a href="URL_INSTAGRAM_DISINI" target="_blank" class="w-10 h-10 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center hover:bg-gradient-to-tr hover:from-yellow-400 hover:via-pink-500 hover:to-purple-600 hover:text-white shadow hover:shadow-md transition">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                    </a>

                    <!-- YouTube -->
                    <a href="URL_YOUTUBE_DISINI" target="_blank" class="w-10 h-10 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center hover:bg-[#FF0000] hover:text-white shadow hover:shadow-md transition">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 576 512"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>
                    </a>

                    <!-- Twitter (X) -->
                    <a href="URL_TWITTER_DISINI" target="_blank" class="w-10 h-10 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center hover:bg-black hover:text-white shadow hover:shadow-md transition">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.6 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                    </a>

                    <!-- Facebook -->
                    <a href="URL_FACEBOOK_DISINI" target="_blank" class="w-10 h-10 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center hover:bg-[#1877F2] hover:text-white shadow hover:shadow-md transition">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
                    </a>
                </div>
            </div>

        </div>

        <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-500">
                © {{ date('Y') }} LA PRIMERA Apparel Corp. Hak cipta dilindungi.
            </p>
            <div class="flex gap-4 mt-4 md:mt-0 text-sm text-gray-500">
                <a href="#" class="hover:text-[#1E5C4F]">Kebijakan Privasi</a>
                <span>&bull;</span>
                <a href="#" class="hover:text-[#1E5C4F]">Syarat Ketentuan</a>
            </div>
        </div>
    </div>
</footer>


</body>
</html>
