<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk - NOXÉS</title>
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
        <a href="{{ route('profile') }}">
            <img src="{{ asset('images/profile.png') }}" class="w-9">
        </a>
    </div>
</nav>


<!-- CONTENT -->
<section class="py-20 px-24 grid grid-cols-2 gap-20">

    <!-- IMAGE -->
    <div>
         <img src="{{ asset('products/' . $product->image) }}" width="200"
             class="w-full rounded-xl shadow">
    </div>

    <!-- DETAIL -->
    <div>

        <h1 class="text-4xl font-bold text-[#1E5C4F] mb-6">
            {{ strtoupper($product->name) }}
        </h1>

        <p class="text-3xl font-semibold text-gray-500 mb-4">
            IDR {{ number_format($product->price,0,',','.') }}
        </p>

        <p class="text-gray-700 mb-6">
            250 terjual
        </p>

        <p class="text-gray-600 leading-relaxed mb-10">
            {{ $product->description }}
        </p>

        <!-- QTY -->
        <form action="{{ route('cart.add',$product->id) }}" method="POST">
            @csrf

            <div class="flex items-center border w-36 justify-between px-4 py-2 mb-8">
                <button type="button" onclick="minus()">−</button>
                <input type="number" id="qty" name="quantity"
                       value="1" min="1"
                       class="w-12 text-center outline-none">
                <button type="button" onclick="plus()">+</button>
            </div>

            <button class="bg-[#1E5C4F] text-white w-80 py-4 rounded-xl text-xl font-semibold hover:opacity-90 transition">
                ADD TO CART
            </button>

        </form>
    </div>
</section>

<script>
function plus(){
    let qty = document.getElementById('qty');
    qty.value = parseInt(qty.value) + 1;
}
function minus(){
    let qty = document.getElementById('qty');
    if(qty.value > 1){
        qty.value = parseInt(qty.value) - 1;
    }
}
</script>

</body>
</html>