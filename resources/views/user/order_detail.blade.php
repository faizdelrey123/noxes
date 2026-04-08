<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>*{font-family:'Poppins',sans-serif}</style>
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto py-10">

    <!-- STATUS -->
    <h1 class="text-3xl font-bold text-[#1E5C4F] mb-6 capitalize">
        {{ $order->status }}
    </h1>

    <!-- HEADER -->
    <div class="bg-[#1E5C4F] text-white px-6 py-4 rounded-t-xl flex justify-between items-center">
    
    <div>
        <p class="font-semibold">Detail Pesanan</p>
        <p class="text-sm opacity-80">
            {{ $order->created_at->format('d M Y, H:i') }}
        </p>
    </div>

    <span>{{ $order->order_code }}</span>

</div>

    <!-- ALAMAT -->
    <div class="border bg-white p-6">
        <p class="font-semibold text-lg mb-2">Alamat Pengiriman</p>
        <p>{{ $order->address->name }} | {{ $order->address->phone }}</p>
        <p class="text-gray-600">{{ $order->address->address }}</p>
    </div>

    <!-- INFO Batal -->
    @if($order->status == 'dibatalkan')
    <div class="border bg-red-50 p-6 mt-6 rounded-xl border-red-100 text-red-700">
        <p class="font-semibold text-lg mb-2">⚠️ Pesanan Dibatalkan</p>
        <p>Alasan Pembatalan:</p>
        <p class="italic mt-1 font-medium">{{ $order->cancel_reason ?? 'Dibatalkan oleh sistem/admin.' }}</p>
    </div>
    @endif

    <!-- PRODUK -->
    <div class="border bg-white p-6 mt-6 rounded-xl">

        <p class="font-semibold text-lg mb-4">Jumlah Pesanan</p>

        @foreach($order->items as $item)
        <div class="flex justify-between items-center mb-4">

            <div class="flex gap-4">
                <img src="{{ asset('products/'.$item->product->image) }}"
                     class="w-20 h-20 object-cover">

                <div>
                    <p class="font-medium">{{ $item->product->name }}</p>
                    <p class="text-gray-500">x{{ $item->quantity }}</p>
                </div>
            </div>

            <div>
                Rp {{ number_format($item->price,0,',','.') }}
            </div>

        </div>
        @endforeach

        <hr class="my-4">

        <div class="flex justify-between">
            <span>Subtotal Produk :</span>
            <span class="text-[#1E5C4F]">
                Rp {{ number_format($subtotal,0,',','.') }}
            </span>
        </div>

        <div class="flex justify-between">
            <span>Ongkir :</span>
            <span class="text-[#1E5C4F]">
                Rp {{ number_format($ongkir,0,',','.') }}
            </span>
        </div>

        <div class="flex justify-between font-semibold">
            <span>Total :</span>
            <span class="text-[#1E5C4F]">
                Rp {{ number_format($order->total,0,',','.') }}
            </span>
        </div>

    </div>

    <!-- INFO -->
    <div class="border bg-white p-6 mt-6 rounded-xl">
        <p class="font-semibold text-lg mb-3">Info Pengiriman dan Pembayaran</p>

        <div class="flex justify-between">
            <span>Metode Pengiriman :</span>
            <span class="uppercase">{{ $order->shipping }}</span>
        </div>

        <div class="flex justify-between">
            <span>Metode Pembayaran :</span>
            <span class="capitalize">{{ $order->payment }}</span>
        </div>
    </div>

    <!-- BUKTI -->
    @if($order->proof)
    <div class="border bg-white p-6 mt-6 rounded-xl flex items-center gap-4">
        <img src="{{ asset($order->proof) }}" class="w-20">
        <a href="{{ asset($order->proof) }}" target="_blank"
           class="text-[#1E5C4F] font-medium">
           Lihat bukti pembayaran
        </a>
    </div>
    @endif

    <!-- BUTTON -->
    <div class="flex justify-end gap-3 mt-6">
        <a href="{{ route('orders.struk',$order->id) }}"
           class="border px-4 py-2 rounded-lg">
            Nota / Struk
        </a>

        <a href="{{ route('profile') }}"
           class="bg-[#1E5C4F] text-white px-6 py-2 rounded-lg">
            Kembali
        </a>
    </div>

</div>

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