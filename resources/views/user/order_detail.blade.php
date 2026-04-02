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

</body>
</html>