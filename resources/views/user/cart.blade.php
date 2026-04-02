<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Saya</title>
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
<section class="px-24 py-20">

    <h2 class="text-4xl font-bold text-[#1E5C4F] text-center mb-16">
        Keranjang Saya
    </h2>

    <!-- ADDRESS -->
    @if(!$selectedAddress)
        <div class="border p-10 rounded-xl flex justify-between items-center mb-14 bg-white">
            <div>
                <p class="text-xl font-medium">Alamat kamu kosong,</p>
                <p class="text-2xl font-semibold">tambah alamat dulu yuk</p>
            </div>
            <a href="{{ route('alamat.index') }}"
               class="text-lg font-medium">
               + Tambah alamat
            </a>
        </div>
    @else
        <div class="border p-10 rounded-xl flex justify-between items-center mb-14 bg-white">
            <div>
            <p class="text-2xl font-semibold">{{ $selectedAddress->name }}</p>
            <p class="text-xl font-medium">{{ $selectedAddress->phone }}</p>
            <p class="text-xl font-medium">{{ $selectedAddress->address }}</p>
            </div>
            <a href="{{ route('alamat.index') }}" class="text-lg font-medium">
                Ganti alamat
            </a>
        </div>
    @endif


    <!-- TABLE HEADER -->
    <div class="border p-5 grid grid-cols-5 font-medium bg-white mb-6">
        <div>Gambar</div>
        <div>Series</div>
        <div>Jumlah</div>
        <div>Harga</div>
        <div>Aksi</div>
    </div>

    <!-- ITEMS -->
    @foreach($cart as $id => $item)
    <div class="grid grid-cols-5 items-center py-6 border-b">

        <div>
             <img src="{{ asset('products/' . $item['image']) }}" width="100" class="w-24">
        </div>

        <div>
            {{ $item['name'] }}
        </div>

        <div>
            <form action="{{ route('cart.update',$id) }}" method="POST" class="flex border w-28 justify-between px-3 py-1">
                @csrf
                <button name="quantity" value="{{ $item['quantity'] - 1 }}">−</button>
                <span>{{ $item['quantity'] }}</span>
                <button name="quantity" value="{{ $item['quantity'] + 1 }}">+</button>
            </form>
        </div>

        <div>
            Rp {{ number_format($item['price'],0,',','.') }}
        </div>

        <div>
            <form action="{{ route('cart.remove',$id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 text-white px-4 py-1 rounded">
                    Hapus
                </button>
            </form>
        </div>
    </div>
    @endforeach


    <!-- CHECKOUT -->
    <div class="text-center mt-16">
        <button onclick="checkout()"
            class="bg-[#1E5C4F] text-white px-20 py-4 text-2xl rounded-xl font-semibold hover:opacity-90">
            Checkout
        </button>
    </div>

</section>


<!-- POPUP -->
<div id="popup" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-10 rounded-2xl text-center w-96">
        <p class="mb-6 text-lg">
            Ups, Kamu belum menambahkan alamat <br>
            pilih alamat dulu yuk !!
        </p>
        <a href="{{ route('alamat.index') }}"
           class="bg-[#1E5C4F] text-white px-6 py-3 rounded-lg">
            Tambah alamat kamu
        </a>
    </div>
</div>
<!-- POPUP PRODUK KOSONG -->
<div id="popupProduk" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-10 rounded-2xl text-center w-96">
        <p class="mb-6 text-lg">
            Ups, keranjang kamu kosong 😢 <br>
            yuk pilih produk dulu !!
        </p>
        <a href="{{ route('product.index') }}"
           class="bg-[#1E5C4F] text-white px-6 py-3 rounded-lg">
            Belanja sekarang
        </a>
    </div>
</div>

<script>
function checkout(){

    let cartEmpty = {{ count($cart) == 0 ? 'true' : 'false' }};

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

</body>
</html>