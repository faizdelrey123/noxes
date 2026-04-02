<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan - Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { margin: 0; background: #f5f5f5; color: #333; }
        .container-wrapper { display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: white;
            min-height: 100vh;
            padding: 20px;
            border-right: 1px solid #ddd;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 50;
        }
        .logo { font-size: 26px; font-weight: bold; color: #0f5f54; margin-bottom: 5px; }
        .role-badge { font-size: 14px; color: #666; margin-bottom: 30px; }
        .menu a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 8px;
            color: #0f5f54;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }
        .menu a:hover, .menu a.active { background: #e6f0ee; font-weight: 500; }
        .logout { position: absolute; bottom: 30px; left: 20px; right: 20px; }
        .logout button {
            width: 100%;
            background: #0f5f54;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }

        /* CONTENT */
        .content { flex: 1; margin-left: 240px; }
        .navbar {
            background: white;
            padding: 20px 40px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h2 { margin: 0; font-size: 20px; color: #0f5f54; }
        
        .main { padding: 40px; }
    </style>
</head>
<body class="bg-gray-100">

<div class="container-wrapper">
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">NOXÉS</div>
        <p>{{ Auth::check() ? ucfirst(Auth::user()->role) : '' }}</p>
        <div class="menu">
            <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('staff.dashboard') }}">Dashboard</a>
            <a href="{{ Auth::user()->role == 'admin' ? route('admin.product.index') : route('staff.product.index') }}">Kelola Produk</a>
            <a href="{{ route('staff.status') }}">Status Pemesanan</a>
            <a href="{{ route('staff.riwayat') }}" class="active">Riwayat Pesanan</a>
            
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.petugas.index') }}">Kelola Petugas</a>
                <a href="{{ route('admin.user.index') }}">Kelola Pengguna</a>
            @endif

            @if(Auth::user()->role == 'petugas')
                <a href="{{ route('staff.laporan') }}">Laporan</a>
            @endif
        </div>
        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <div class="navbar">
            <h2>Detail Pesanan</h2>
            <span>{{ Auth::user()->name }}</span>
        </div>

        <div class="main">
            <div class="max-w-4xl mx-auto">
                <a href="{{ route('staff.riwayat') }}" class="inline-flex items-center text-gray-600 hover:text-[#0f5f54] mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Riwayat
                </a>

                <!-- STATUS -->
                <h1 class="text-3xl font-bold text-[#1E5C4F] mb-6 capitalize px-2">
                    {{ $order->status }}
                </h1>

                <!-- HEADER -->
                <div class="bg-[#1E5C4F] text-white px-6 py-4 rounded-t-xl flex justify-between items-center shadow-lg">
                    <div>
                        <p class="font-semibold">Detail Pesanan</p>
                        <p class="text-sm opacity-80">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <span>{{ $order->order_code }}</span>
                </div>

                <!-- INFO USER & ALAMAT -->
                <div class="bg-white border-x border-b p-6 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="font-semibold text-lg mb-2 text-[#1E5C4F]">Customer</p>
                            <p class="font-medium">{{ $order->user->name }}</p>
                            <p class="text-gray-600">{{ $order->user->email }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-lg mb-2 text-[#1E5C4F]">Alamat Pengiriman</p>
                            <p class="font-medium">{{ $order->address->name }} | {{ $order->address->phone }}</p>
                            <p class="text-gray-600 leading-relaxed">{{ $order->address->address }}</p>
                        </div>
                    </div>
                </div>

                <!-- PRODUK -->
                <div class="bg-white border-x border-b p-6 mt-6 rounded-xl shadow-sm">
                    <p class="font-semibold text-lg mb-4 text-[#1E5C4F]">Daftar Item</p>

                    @foreach($order->items as $item)
                    <div class="flex justify-between items-center mb-6 last:mb-0 pb-4 last:pb-0 last:border-0 border-b border-gray-100">
                        <div class="flex gap-4">
                            <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden border border-gray-100">
                                <img src="{{ asset('products/'.$item->product->image) }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex flex-col justify-center">
                                <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                                <p class="text-gray-500 font-medium">x{{ $item->quantity }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-[#1E5C4F]">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-400">Total: Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Subtotal Produk :</span>
                            <span class="text-[#1E5C4F] font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-600">Ongkir :</span>
                            <span class="text-[#1E5C4F] font-medium">Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-xl border-t border-gray-100 pt-4">
                            <span class="text-gray-800">Total :</span>
                            <span class="text-[#1E5C4F]">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- INFO PENGIRIMAN & PEMBAYARAN -->
                <div class="bg-white border p-6 mt-6 rounded-xl shadow-sm">
                    <p class="font-semibold text-lg mb-4 text-[#1E5C4F]">Info Pengiriman dan Pembayaran</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex justify-between md:block">
                            <span class="text-gray-500 text-sm block">Metode Pengiriman :</span>
                            <span class="font-semibold uppercase text-gray-700">{{ $order->shipping }}</span>
                        </div>
                        <div class="flex justify-between md:block">
                            <span class="text-gray-500 text-sm block">Metode Pembayaran :</span>
                            <span class="font-semibold capitalize text-gray-700">{{ $order->payment }}</span>
                        </div>
                    </div>
                </div>

                <!-- BUKTI -->
                @if($order->proof)
                <div class="bg-white border p-6 mt-6 rounded-xl shadow-sm">
                    <p class="font-semibold text-lg mb-4 text-[#1E5C4F]">Bukti Pembayaran</p>
                    <div class="flex items-center gap-6">
                        <div class="w-24 h-24 rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ asset($order->proof) }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm mb-2">Pastikan bukti pembayaran sudah sesuai dengan nominal total pesanan.</p>
                            <a href="{{ asset($order->proof) }}" target="_blank"
                               class="inline-block bg-[#1E5C4F] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#0c4d44] transition">
                               Lihat Bukti Fullscreen
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

</body>
</html>
