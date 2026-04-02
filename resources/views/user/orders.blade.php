<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pesanan - NOXÉS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif !important; }
        .status-tertunda { background: #fef3c7; color: #92400e; }
        .status-dikemas { background: #dcfce7; color: #166534; }
        .status-dikirim { background: #dbeafe; color: #1e40af; }
        .status-selesai { background: #f3f4f6; color: #374151; }
    </style>
</head>
<body class="bg-gray-50">

<!-- NAVBAR (Mirrored from Home) -->
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
            <img src="{{ asset('images/cart.png') }}" alt="Cart" class="w-8 h-8 object-contain">
        </a>
        <a href="{{ route('profile') }}">
            <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-9 h-9 rounded-full object-cover border border-gray-300">
        </a>
    </div>
</nav>

<!-- MAIN CONTENT -->
<main class="max-w-5xl mx-auto py-12 px-6">
    
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Riwayat Pesanan Saya</h2>
            <p class="text-gray-500 mt-2">Pantau semua pesanan Noxés Anda di sini.</p>
        </div>
        
        <!-- FILTER SECTION -->
        <form action="{{ route('orders.index') }}" method="GET" class="flex gap-4 items-end bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}" 
                       class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Bulan</label>
                <select name="month" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#1E5C4F]">
                    <option value="">Semua Bulan</option>
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-[#1E5C4F] text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-[#164239] transition">
                Filter
            </button>
            @if(request('date') || request('month'))
                <a href="{{ route('orders.index') }}" class="text-gray-400 text-sm py-2 hover:text-gray-600">Reset</a>
            @endif
        </form>
    </div>

    <!-- ORDER CARDS -->
    <div class="space-y-6">
        @forelse($orders as $order)
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center overflow-hidden border border-gray-100">
                             @if($order->items->count() > 0 && $order->items[0]->product)
                                <img src="{{ asset('products/'.$order->items[0]->product->image) }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <svg class="w-6 h-6 text-[#1E5C4F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-lg text-gray-800">{{ $order->order_code }}</h4>
                            <p class="text-sm text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    @php
                        $statusClass = 'status-' . strtolower(str_replace(' ', '', $order->status));
                        if($order->status == 'dikemas') $statusClass = 'status-dikemas';
                        if($order->status == 'dikirim') $statusClass = 'status-dikirim';
                        if($order->status == 'selesai') $statusClass = 'status-selesai';
                    @endphp
                    <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $statusClass }}">
                        {{ $order->status }}
                    </span>
                </div>
                
                <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-semibold mb-1">Total Pembayaran</p>
                        <p class="text-xl font-bold text-[#1E5C4F]">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('orders.show', $order->id) }}" 
                       class="border-2 border-[#1E5C4F] text-[#1E5C4F] px-8 py-2.5 rounded-xl font-bold hover:bg-[#1E5C4F] hover:text-white transition">
                        Detail Pesanan
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-gray-300">
                <img src="{{ asset('images/empty-cart.png') }}" class="w-32 mx-auto grayscale opacity-30 mb-4" alt="Empty">
                <h3 class="text-xl font-bold text-gray-400">Belum ada pesanan</h3>
                <p class="text-gray-400 mt-2">Segera temukan produk terbaik untuk gaya Anda!</p>
                <a href="{{ route('product.index') }}" class="inline-block mt-6 text-[#1E5C4F] font-bold underline">Mulai Belanja</a>
            </div>
        @endforelse
    </div>

</main>

<footer class="mt-20 px-16 py-16 bg-gray-100 italic text-center text-gray-400">
    © 2026 NOXES Apparel Corp. All rights reserved.
</footer>

</body>
</html>