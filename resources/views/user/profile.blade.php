<!DOCTYPE html>
<html>
<head>
    <title>Profile - NOXÉS</title>
    <meta charset="UTF-8">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-[#F5F5F5]">
@if(session('success'))
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-xl text-center w-96">
        <h2 class="text-2xl font-bold text-[#1E5C4F] mb-3">
            Pesanan Berhasil!
        </h2>
        <p class="mb-6 text-gray-600">
            Pesanan kamu sudah dibuat
        </p>

        <button onclick="closePopup()"
            class="bg-[#1E5C4F] text-white px-6 py-2 rounded-lg">
            Lihat Pesanan
        </button>
    </div>
</div>

<script>
function closePopup(){
    document.querySelector('.fixed').style.display = 'none';
}
</script>
@endif
<!-- NAVBAR -->
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

        <!-- CART -->
        <a href="{{ route('cart.index') }}" class="relative">
            <img src="{{ asset('images/cart.png') }}" class="w-8">

            @if(session('cart'))
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">
                    {{ count(session('cart')) }}
                </span>
            @endif
        </a>

        <!-- PROFILE -->
        <a href="{{ route('profile') }}">
            <img src="{{ asset('images/profile.png') }}" class="w-9">
        </a>

    </div>
</nav>


<!-- PROFILE BOX -->
<div class="px-24 py-12">

    <div class="bg-white p-10 rounded-xl flex justify-between items-center border">

        <div>
            <h2 class="text-3xl font-bold text-[#1E5C4F]">
                Hi, {{ Auth::user()->name }}
            </h2>

            <p class="mt-2 text-lg font-medium">
                {{ Auth::user()->username }}
</p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="bg-[#1E5C4F] text-white px-8 py-3 rounded-lg">
                Logout
            </button>
        </form>

    </div>


    <!-- TITLE -->
    <div class="mt-16 flex justify-between items-center">

        <h3 class="text-4xl font-bold text-[#1E5C4F]">
            Pesanan Saya
        </h3>

        <a href="{{ route('orders.index') }}" class="bg-[#1E5C4F] text-white px-6 py-2 rounded-lg">
            Riwayat Pesanan
        </a>

    </div>


    <!-- TAB -->
    <div class="mt-10 grid grid-cols-4 rounded-xl overflow-hidden bg-white border">

    <!-- TERTUNDA -->
    <a href="?status=tertunda"
       class="flex flex-col items-center justify-center py-4 transition
       {{ $status=='tertunda' ? 'bg-[#1E5C4F] text-white' : 'hover:bg-gray-100' }}">

        <span class="font-semibold">Tertunda</span>

        <span class="mt-1 text-xs px-2 py-0.5 rounded-full
        {{ $status=='tertunda' ? 'bg-white text-[#1E5C4F]' : 'bg-gray-200' }}">
            {{ $counts['tertunda'] }}
        </span>
    </a>

    <!-- DIKEMAS -->
    <a href="?status=packed"
       class="flex flex-col items-center justify-center py-4 transition
       {{ $status=='packed' ? 'bg-[#1E5C4F] text-white' : 'hover:bg-gray-100' }}">

        <span class="font-semibold">Dikemas</span>

        <span class="mt-1 text-xs px-2 py-0.5 rounded-full
        {{ $status=='packed' ? 'bg-white text-[#1E5C4F]' : 'bg-gray-200' }}">
            {{ $counts['packed'] }}
        </span>
    </a>

    <!-- DIKIRIM -->
    <a href="?status=shipped"
       class="flex flex-col items-center justify-center py-4 transition
       {{ $status=='shipped' ? 'bg-[#1E5C4F] text-white' : 'hover:bg-gray-100' }}">

        <span class="font-semibold">Dikirim</span>

        <span class="mt-1 text-xs px-2 py-0.5 rounded-full
        {{ $status=='shipped' ? 'bg-white text-[#1E5C4F]' : 'bg-gray-200' }}">
            {{ $counts['shipped'] }}
        </span>
    </a>

    <!-- SELESAI -->
    <a href="?status=done"
       class="flex flex-col items-center justify-center py-4 transition
       {{ $status=='done' ? 'bg-[#1E5C4F] text-white' : 'hover:bg-gray-100' }}">

        <span class="font-semibold">Selesai</span>

        <span class="mt-1 text-xs px-2 py-0.5 rounded-full
        {{ $status=='done' ? 'bg-white text-[#1E5C4F]' : 'bg-gray-200' }}">
            {{ $counts['done'] }}
        </span>
    </a>

</div>


    <!-- ORDER LIST -->
    <div class="mt-10 space-y-10">

        @forelse($orders as $order)

        <div class="bg-white p-8 rounded-xl shadow-sm">

            @foreach($order->items as $item)
            <div class="flex justify-between items-center mb-6">

                <div class="flex items-center gap-6">

                    <img src="{{ asset('products/'.$item->product->image) }}"
                         class="w-24 h-24 object-cover rounded">

                    <div>
                        <p class="font-semibold">
                            {{ $item->product->name }}
                        </p>

                        <p class="text-gray-500">
                            x{{ $item->quantity }}
                        </p>
                    </div>

                </div>

                <div class="font-semibold">
                    Rp {{ number_format($item->price,0,',','.') }}
                </div>

            </div>
            @endforeach
<!-- STATUS -->
<div class="flex justify-between items-center mb-4">

    <p class="font-medium">Status Pesanan :</p>

    <span class="px-4 py-1 rounded-full text-white text-sm
        @if($order->status == 'tertunda') bg-gray-500
        @elseif($order->status == 'dikemas') bg-yellow-500
        @elseif($order->status == 'dikirim') bg-blue-500
        @else bg-green-600
        @endif
    ">
        @if($order->status == 'tertunda')
            Menunggu Konfirmasi
        @elseif($order->status == 'dikemas')
            Dikemas
        @elseif($order->status == 'dikirim')
            Dikirim
        @else
            Selesai
        @endif
    </span>

</div>

            <!-- SUBTOTAL -->
            <div class="flex justify-between mt-4">
                <p class="font-medium">Subtotal order :</p>

                <p class="text-[#1E5C4F] font-semibold">
                    Rp {{ number_format($order->total,0,',','.') }}
                </p>
            </div>


            <!-- BUTTON -->
            <div class="text-right mt-6">
                <a href="{{ route('orders.show', $order->id) }}"
                   class="border px-6 py-2 rounded-lg">
                    Detail
                </a>
            </div>

        </div>

        @empty
        <div class="text-center text-gray-500 mt-10">
            Belum ada pesanan
        </div>
        @endforelse

    </div>

</div>

</body>
</html>