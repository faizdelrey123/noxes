<!DOCTYPE html>
<html>
<head>
    <title>Products - NOXÉS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

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
</nav>

<!-- TITLE -->
<section class="py-16 text-center">
    <h2 class="text-3xl text-green-800 mb-12 font-bold">Our Products</h2>

    <div class="grid grid-cols-4 gap-10 px-24">
        @forelse($products as $product)
            <div class="bg-white p-6 shadow rounded-xl hover:shadow-lg transition">

                <img src="{{ asset('storage/'.$product->image) }}"
                     class="mx-auto h-48 object-contain mb-4">

                <h3 class="text-lg font-semibold">
                    {{ $product->name }}
                </h3>

                <p class="text-green-700 font-bold mt-2">
                    Rp {{ number_format($product->price,0,',','.') }}
                </p>

                <a href="{{ route('product.detail', $product->id) }}"
                   class="mt-4 inline-block bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
                    Detail
                </a>

            </div>
        @empty
            <p class="col-span-4 text-gray-500">
                Belum ada produk tersedia.
            </p>
        @endforelse
    </div>
</section>

</body>
</html>