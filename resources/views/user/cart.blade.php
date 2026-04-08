<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Saya - LA PRIMERA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#F5F5F5] min-h-screen flex flex-col">

<!-- NAVBAR -->
<nav class="bg-white px-16 py-6 flex justify-between items-center shadow-sm relative z-40">
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
<section class="max-w-7xl mx-auto py-12 px-6 flex-grow w-full">

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-10 gap-4">
        <h2 class="text-3xl lg:text-4xl font-bold text-[#1E5C4F]">
            Keranjang Belanja
        </h2>
        <a href="{{ route('product.index') }}" class="inline-flex justify-center bg-[#1E5C4F] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[#15463b] shadow-md transition transform hover:-translate-y-0.5 items-center gap-2 whitespace-nowrap w-full sm:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Produk
        </a>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">

        <!-- KIRI: PRODUK & ALAMAT -->
        <div class="lg:w-2/3 flex flex-col gap-6">

            <!-- ADDRESS -->
            @if(!$selectedAddress)
                <div class="border border-gray-200 p-8 rounded-2xl flex items-center justify-between bg-white shadow-sm hover:shadow-md transition">
                    <div>
                        <p class="text-lg font-medium text-gray-500 mb-1">Alamat pengiriman kosong,</p>
                        <p class="text-xl lg:text-2xl font-bold text-[#1E5C4F]">Tambah alamat dulu yuk!</p>
                    </div>
                    <a href="{{ route('alamat.index') }}"
                       class="bg-[#1E5C4F] text-white px-6 lg:px-8 py-3 rounded-xl font-medium hover:bg-[#15463b] shadow-md transition transform hover:-translate-y-0.5 whitespace-nowrap">
                       + Tambah Alamat
                    </a>
                </div>
            @else
                <div class="border border-gray-200 p-8 rounded-2xl flex items-center justify-between bg-white shadow-sm hover:shadow-md transition">
                    <div>
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat Pengiriman</h3>
                        <p class="text-xl font-semibold text-[#1E5C4F] mb-1">
                            {{ $selectedAddress->name }} 
                            <span class="text-sm font-normal text-gray-500 ml-3 pl-3 border-l">{{ $selectedAddress->phone }}</span>
                        </p>
                        <p class="text-gray-600 text-sm leading-relaxed mt-2">{{ $selectedAddress->address }}</p>
                    </div>
                    <a href="{{ route('alamat.index') }}" 
                       class="border-2 border-[#1E5C4F] text-[#1E5C4F] px-6 lg:px-8 py-3 rounded-xl font-semibold hover:bg-[#1E5C4F] hover:text-white transition whitespace-nowrap">
                        Ganti Alamat
                    </a>
                </div>
            @endif

            <!-- ITEMS LIST -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden flex flex-col">
                <div class="bg-gray-50 border-b border-gray-100 px-8 py-4 grid grid-cols-12 text-xs font-bold text-gray-500 uppercase tracking-wider items-center">
                    <div class="col-span-6">Produk</div>
                    <div class="col-span-2 text-center">Jumlah</div>
                    <div class="col-span-3 text-right">Total Harga</div>
                    <div class="col-span-1"></div>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($cart as $id => $item)
                    <div class="px-8 py-6 grid grid-cols-12 items-center hover:bg-gray-50 transition group">
                        <!-- Product Info -->
                        <div class="col-span-6 flex items-center gap-6">
                            <div class="w-24 h-24 bg-white border rounded-xl overflow-hidden shadow-sm flex-shrink-0 flex items-center justify-center p-2">
                                <img src="{{ asset('products/' . $item['image']) }}" alt="{{ $item['name'] }}" class="max-w-full max-h-full object-contain mix-blend-multiply">
                            </div>
                            <div class="flex flex-col">
                                <h3 class="text-lg font-bold text-gray-800 leading-snug">{{ $item['name'] }}</h3>
                                <p class="text-gray-500 font-medium mt-1">Rp {{ number_format($item['price'],0,',','.') }}</p>
                            </div>
                        </div>

                        <!-- Quantity Settings -->
                        <div class="col-span-2 flex justify-center">
                            <form action="{{ route('cart.update',$id) }}" method="POST" class="flex items-center border border-gray-300 rounded-lg overflow-hidden bg-white shadow-sm">
                                @csrf
                                <button name="quantity" value="{{ $item['quantity'] - 1 }}" class="w-8 h-8 lg:w-10 lg:h-10 text-gray-600 hover:bg-gray-100 font-medium focus:outline-none transition">−</button>
                                <span class="w-8 lg:w-10 text-center font-semibold text-gray-800 text-sm lg:text-base">{{ $item['quantity'] }}</span>
                                <button name="quantity" value="{{ $item['quantity'] + 1 }}" class="w-8 h-8 lg:w-10 lg:h-10 text-gray-600 hover:bg-gray-100 font-medium focus:outline-none transition">+</button>
                            </form>
                        </div>

                        <!-- Total Price -->
                        <div class="col-span-3 text-right">
                            <span class="text-[#1E5C4F] font-bold text-lg">Rp {{ number_format($item['price'] * $item['quantity'],0,',','.') }}</span>
                        </div>

                        <!-- Delete button -->
                        <div class="col-span-1 flex justify-end">
                            <form action="{{ route('cart.remove',$id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 rounded-full flex items-center justify-center text-gray-400 group-hover:text-red-500 hover:bg-red-50 hover:shadow-inner transition" title="Hapus item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="px-8 py-20 text-center">
                        <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                            <img src="{{ asset('images/cart.png') }}" alt="Empty Cart" class="w-12 opacity-40 grayscale">
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Keranjang belanjamu masih kosong</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">Yuk, isi keranjangmu dengan koleksi backpack terbaik dari LA PRIMERA sekarang juga!</p>
                        <a href="{{ route('product.index') }}" class="inline-block bg-[#1E5C4F] text-white px-10 py-3.5 rounded-xl font-bold hover:bg-[#15463b] shadow-md transition transform hover:-translate-y-0.5">Mulai Belanja</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- KANAN: RINGKASAN BELANJA -->
        <div class="lg:w-1/3">
            <div class="bg-white border border-gray-200 p-8 rounded-2xl shadow-sm sticky top-10">
                <h3 class="text-xl font-bold text-gray-800 mb-6 border-b border-gray-100 pb-4">Ringkasan Belanja</h3>
                
                @php
                    $totalHarga = 0;
                    $totalItem = 0;
                    if(isset($cart) && is_array($cart)){
                        foreach($cart as $item) {
                            $totalHarga += $item['price'] * $item['quantity'];
                            $totalItem += $item['quantity'];
                        }
                    }
                    $totalBelanja = $totalHarga;
                @endphp

                <div class="space-y-4 text-gray-600 mb-6 text-sm lg:text-base">
                    <div class="flex justify-between items-center">
                        <span>Total Harga ({{ $totalItem }} barang)</span>
                        <span class="font-semibold text-gray-800">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="border-t border-dashed border-gray-300 pt-6 mb-8 flex justify-between items-center">
                    <span class="text-lg font-bold text-gray-800">Total Belanja</span>
                    <span class="text-2xl font-black text-[#1E5C4F]">Rp {{ number_format($totalBelanja, 0, ',', '.') }}</span>
                </div>

                <button onclick="checkout()"
                    class="w-full bg-[#1E5C4F] text-white py-4 text-lg rounded-xl font-bold hover:bg-[#15463b] shadow-lg transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    Beli Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <p class="text-xs text-center text-gray-400 mt-5 leading-relaxed flex items-center justify-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                    Aman & Terenkripsi
                </p>
            </div>
        </div>

    </div>
</section>

<!-- POPUP ALAMAT KOSONG -->
<div id="popup" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 transition-opacity">
    <div class="bg-white p-8 rounded-3xl text-center w-[400px] shadow-2xl transform scale-100">
        <div class="w-20 h-20 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Alamat Kosong</h3>
        <p class="mb-8 text-gray-500 leading-relaxed">
            Kamu belum menambahkan alamat pengiriman. Tentukan alamat dulu yuk!
        </p>
        <div class="flex gap-3">
            <button onclick="document.getElementById('popup').classList.replace('flex', 'hidden')" class="flex-1 border-2 border-gray-200 text-gray-600 px-4 py-3 rounded-xl font-bold hover:bg-gray-50 transition">
                Batal
            </button>
            <a href="{{ route('alamat.index') }}" class="flex-1 bg-[#1E5C4F] text-white px-4 py-3 rounded-xl font-bold hover:bg-[#15463b] shadow-md transition">
                Pilih Alamat
            </a>
        </div>
    </div>
</div>

<!-- POPUP PRODUK KOSONG -->
<div id="popupProduk" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 transition-opacity">
    <div class="bg-white p-8 rounded-3xl text-center w-[400px] shadow-2xl">
        <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#1E5C4F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Keranjang Kosong</h3>
        <p class="mb-8 text-gray-500 leading-relaxed">
            Ups, sepertinya kamu belum memilih produk apapun. Belanja dulu yuk!
        </p>
        <div class="flex gap-3">
            <button onclick="document.getElementById('popupProduk').classList.replace('flex', 'hidden')" class="flex-1 border-2 border-gray-200 text-gray-600 px-4 py-3 rounded-xl font-bold hover:bg-gray-50 transition">
                Tutup
            </button>
            <a href="{{ route('product.index') }}" class="flex-1 bg-[#1E5C4F] text-white px-4 py-3 rounded-xl font-bold hover:bg-[#15463b] shadow-md transition">
                Belanja Yuk
            </a>
        </div>
    </div>
</div>

<script>
function checkout(){
    let cartEmpty = {{ count($cart ?? []) == 0 ? 'true' : 'false' }};

    if(cartEmpty){
        document.getElementById('popupProduk').classList.remove('hidden');
        document.getElementById('popupProduk').classList.add('flex');
        return;
    }

    @if(!$selectedAddress)
        document.getElementById('popup').classList.remove('hidden');
        document.getElementById('popup').classList.add('flex');
    @else
        window.location.href = "{{ route('checkout.index') }}";
    @endif
}
</script>

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