<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk - NOXÉS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white px-16 py-6 flex justify-between items-center shadow-sm">
    <h1 class="text-4xl font-bold text-[#1E5C4F]">
        <a href="{{ route('home') }}">NOXÉS</a>
    </h1>

    <div class="space-x-10 text-[#1E5C4F] font-medium text-lg">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('product.index') }}">Product</a>
    </div>
</nav>

<section class="py-20 px-24 grid grid-cols-2 gap-16">

    <div>
        <img src="{{ asset('storage/'.$product->image) }}"
             class="w-full rounded-xl shadow">
    </div>

    <div>
        <h1 class="text-4xl font-bold text-green-800 mb-6">
            {{ $product->name }}
        </h1>

        <p class="text-2xl text-green-700 font-bold mb-6">
            Rp {{ number_format($product->price,0,',','.') }}
        </p>

        <p class="text-gray-700 mb-8">
            {{ $product->description }}
        </p>

        <a href="{{ route('product.index') }}"
           class="bg-gray-700 text-white px-6 py-3 rounded hover:bg-gray-800">
            Kembali
        </a>
    </div>

</section>

</body>
</html>