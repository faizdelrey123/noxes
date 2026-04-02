<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <meta charset="UTF-8">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold text-[#1E5C4F] mb-8">
        Checkout
    </h1>

    <!-- ADDRESS -->
    <div class="bg-white rounded-xl p-6 shadow-sm mb-6 flex justify-between items-center">
        <div>
            <p class="font-semibold text-lg text-[#1E5C4F] mb-1">Alamat Pengiriman</p>

            @if($address)
                <p class="font-medium">{{ $address->name }} | {{ $address->phone }}</p>
                <p class="text-gray-600">{{ $address->address }}</p>
            @else
                <p class="text-red-500">Belum pilih alamat</p>
            @endif
        </div>

        <a href="{{ route('alamat.index') }}"
           class="text-[#1E5C4F] font-medium">
            Ubah
        </a>
    </div>


    <!-- PRODUK -->
    <div class="bg-white rounded-xl p-6 shadow-sm mb-6">

        <p class="font-semibold text-lg text-[#1E5C4F] mb-4">Produk Dipesan</p>

        @foreach($cart as $item)
        <div class="flex items-center justify-between border-b py-4">

            <div class="flex items-center gap-4">
                <img src="{{ asset('products/'.$item['image']) }}"
                     class="w-20 h-20 object-cover rounded">

                <div>
                    <p class="font-medium">{{ $item['name'] }}</p>
                    <p class="text-gray-500 text-sm">
                        {{ $item['quantity'] }} x Rp {{ number_format($item['price'],0,',','.') }}
                    </p>
                </div>
            </div>

            <div class="font-semibold">
                Rp {{ number_format($item['price'] * $item['quantity'],0,',','.') }}
            </div>

        </div>
        @endforeach

    </div>


    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="col-span-2 space-y-6">

            <!-- SHIPPING -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <p class="font-semibold text-lg text-[#1E5C4F] mb-4">Opsi Pengiriman</p>

                <label class="flex justify-between border p-4 rounded-lg mb-3 cursor-pointer">
                    <span>JNE (Reguler)</span>
                    <input type="radio" name="shipping" value="jne">
                </label>

                <label class="flex justify-between border p-4 rounded-lg cursor-pointer">
                    <span>J&T (Express)</span>
                    <input type="radio" name="shipping" value="jnt">
                </label>
            </div>

            <!-- PAYMENT -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <p class="font-semibold text-lg text-[#1E5C4F] mb-4">Metode Pembayaran</p>

                <!-- QRIS -->
                <label class="border p-4 rounded-lg mb-3 cursor-pointer block">

    <!-- BARIS ATAS -->
    <div class="flex justify-between items-center">
        <span>QRIS</span>
        <input type="radio" name="payment" value="qris">
    </div>

    <!-- LIHAT QRIS -->
   <button type="button"
    onclick="event.stopPropagation(); showQR()"
    class="mt-2 text-sm text-[#1E5C4F] underline">
    Lihat QRIS
</button>

</label>

                <!-- BANK -->
                <label class="flex justify-between border p-4 rounded-lg cursor-pointer items-start">
                    
                    <div>
                        <p>Transfer Bank (BCA)</p>

                        <div class="flex items-center gap-3 mt-2">
                            <span id="rekening" class="font-medium text-gray-700">
                                6283178511238
                            </span>

                            <button type="button"
                                onclick="copyRekening()"
                                class="text-sm text-[#1E5C4F] underline">
                                Salin
                            </button>

                            <span id="copiedText" class="text-green-600 text-sm hidden">
                                Tersalin!
                            </span>
                        </div>
                    </div>

                    <input type="radio" name="payment" value="bank">
                </label>
            </div>

            <!-- UPLOAD -->
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <p class="font-semibold text-lg text-[#1E5C4F] mb-4">Upload Bukti</p>

                <input type="file" name="proof"
                       class="border p-3 rounded-lg w-full">
            </div>

        </div>


        <!-- RIGHT TOTAL -->
        <div class="bg-white rounded-xl p-6 shadow-sm h-fit sticky top-10">

            <p class="font-semibold text-lg text-[#1E5C4F] mb-4">Ringkasan</p>

            <div class="flex justify-between mb-2">
                <span>Total Produk</span>
                <span>Rp {{ number_format($total,0,',','.') }}</span>
            </div>

            <div class="flex justify-between mb-2">
                <span>Ongkir</span>
                <span>Rp {{ number_format($ongkir,0,',','.') }}</span>
            </div>

            <hr class="my-3">

            <div class="flex justify-between font-semibold text-lg">
                <span>Total</span>
                <span class="text-[#1E5C4F]">
                    Rp {{ number_format($grandTotal,0,',','.') }}
                </span>
            </div>

            <button
                class="mt-6 w-full bg-[#1E5C4F] text-white py-3 rounded-lg font-semibold hover:opacity-90">
                Buat Pesanan
            </button>

        </div>

    </div>

    </form>

</div>


<!-- QRIS MODAL -->
<div id="qrisModal"
     class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">

    <div class="bg-white p-6 rounded-xl text-center w-80 relative">

        <p class="font-semibold mb-4 text-[#1E5C4F]">Scan QRIS</p>

        <img src="{{ asset('images/qrisfigma.jpg') }}" class="w-64 mx-auto">

        <button onclick="closeQR()"
            class="mt-6 w-full bg-[#1E5C4F] text-white py-2 rounded-lg">
            Kembali
        </button>

    </div>

</div>


<script>
function showQR(){
    document.getElementById('qrisModal').classList.remove('hidden');
}

function closeQR(){
    document.getElementById('qrisModal').classList.add('hidden');
}

// klik luar modal = close
window.onclick = function(e){
    let modal = document.getElementById('qrisModal');
    if(e.target === modal){
        closeQR();
    }
}

// COPY REKENING
function copyRekening(){
    let text = document.getElementById("rekening").innerText;

    navigator.clipboard.writeText(text);

    let copied = document.getElementById("copiedText");
    copied.classList.remove("hidden");

    setTimeout(() => {
        copied.classList.add("hidden");
    }, 2000);
}
</script>

</body>
</html>