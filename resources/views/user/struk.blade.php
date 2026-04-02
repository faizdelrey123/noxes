<!DOCTYPE html>
<html>
<head>
    <title>Struk Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>*{font-family:'Poppins',sans-serif}</style>
    <style>
        @media print {
            button { display: none; }
        }
    </style>
</head>

<body class="bg-white">

<div class="max-w-md mx-auto p-6 border mt-10">

    <h2 class="text-center text-xl font-bold mb-4">
        NOXÉS STORE
    </h2>

    <p class="text-center text-sm mb-4">
        {{ $order->order_code }}
    </p>
<p class="text-center text-xs mb-2">
    {{ $order->created_at->format('d M Y H:i') }}
</p>
    <hr class="mb-4">

    <!-- CUSTOMER -->
    <p><b>Nama:</b> {{ $order->address->name }}</p>
    <p><b>No HP:</b> {{ $order->address->phone }}</p>
    <p class="mb-4"><b>Alamat:</b> {{ $order->address->address }}</p>

    <hr class="mb-4">

    <!-- ITEMS -->
    @php $total = 0; @endphp

    @foreach($order->items as $item)
    <div class="flex justify-between text-sm mb-2">
        <span>
            {{ $item->product->name }} (x{{ $item->quantity }})
        </span>
        <span>
            Rp {{ number_format($item->price * $item->quantity,0,',','.') }}
        </span>
    </div>

    @php $total += $item->price * $item->quantity; @endphp
    @endforeach

    <hr class="my-3">

    <div class="flex justify-between text-sm">
        <span>Subtotal</span>
        <span>Rp {{ number_format($total,0,',','.') }}</span>
    </div>

    <div class="flex justify-between text-sm">
        <span>Ongkir</span>
        <span>Rp 10.000</span>
    </div>

    <div class="flex justify-between font-bold mt-2">
        <span>Total</span>
        <span>Rp {{ number_format($order->total,0,',','.') }}</span>
    </div>

    <hr class="my-4">

    <p class="text-sm">Pembayaran: {{ strtoupper($order->payment) }}</p>
    <p class="text-sm">Pengiriman: {{ strtoupper($order->shipping) }}</p>

    <p class="text-center text-xs mt-6">
        Terima kasih telah berbelanja 🙏
    </p>

    <div class="text-center mt-4">
        <button onclick="window.print()"
            class="bg-black text-white px-4 py-2 rounded">
            Print
        </button>
    </div>

</div>

</body>
</html>