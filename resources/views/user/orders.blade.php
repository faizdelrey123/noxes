<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Saya</title>
    <meta charset="UTF-8">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-[#F5F5F5]">

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
        <a href="{{ route('cart.index') }}">
            <img src="{{ asset('images/cart.png') }}" class="w-8">
        </a>

        <a href="{{ route('profile') }}">
            <img src="{{ asset('images/profile.png') }}" class="w-9">
        </a>
    </div>
</nav>


<!-- PROFILE -->
<div class="border-b bg-white px-16 py-10 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-bold text-[#1E5C4F]">
            Hi, {{ auth()->user()->name }}
        </h2>
        <p class="mt-2 text-lg">{{ auth()->user()->email }}</p>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="bg-[#1E5C4F] text-white px-8 py-3 rounded-lg">
            Logout
        </button>
    </form>
</div>


<!-- CONTENT -->
<section class="px-24 py-12">

    <!-- TITLE -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-[#1E5C4F]">
            Pesanan Saya
        </h2>

        <a href="#" class="bg-[#1E5C4F] text-white px-6 py-2 rounded-lg">
            Riwayat Pesanan
        </a>
    </div>


    <!-- TAB -->
    <div class="border rounded-xl flex overflow-hidden mb-10 bg-white">
        <a href="?status=pending"
           class="flex-1 text-center py-4 font-medium
           {{ request('status') == 'pending' ? 'bg-[#1E5C4F] text-white' : '' }}">
            Tertunda
        </a>

        <a href="?status=packed"
           class="flex-1 text-center py-4 font-medium">
            Dikemas
        </a>

        <a href="?status=shipped"
           class="flex-1 text-center py-4 font-medium">
            Dikirim
        </a>

        <a href="?status=done"
           class="flex-1 text-center py-4 font-medium">
            Selesai
        </a>
    </div>


    <!-- LIST ORDER -->
    @foreach($orders as $order)
    <div class="bg-white rounded-xl p-6 mb-10 shadow-sm">

        @foreach($order->items as $item)
        <div class="flex justify-between items-center mb-6">

            <div class="flex gap-6 items-center">

                <img src="{{ asset('products/'.$item->product->image) }}"
                     class="w-24 h-24 object-cover rounded">

                <div>
                    <p class="font-semibold">
                        {{ $item->product->name }}
                    </p>
                    <p class="text-gray-500">x{{ $item->quantity }}</p>
                </div>
            </div>

            <div class="font-semibold">
                Rp {{ number_format($item->price,0,',','.') }}
            </div>

        </div>
        @endforeach


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
    @endforeach

</section>

</body>
</html>