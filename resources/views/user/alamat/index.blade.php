<!DOCTYPE html>
<html>
<head>
    <title>Daftar Alamat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto py-16 px-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">
            📍 Daftar Alamat
        </h2>

        <a href="{{ route('alamat.create') }}"
           class="bg-[#0f5f54] text-white px-5 py-2 rounded-lg hover:opacity-90 transition shadow">
            + Tambah Alamat
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @forelse($addresses as $address)
    <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition mb-6 border">

        <!-- TOP INFO -->
        <div class="flex justify-between items-start">

            <div>
                <p class="font-semibold text-lg text-gray-800">
                    {{ $address->name }}
                </p>

                <p class="text-gray-600">
                    {{ $address->phone }}
                </p>

                <p class="text-gray-500 mt-2">
                    {{ $address->address }}
                </p>
            </div>

           

        </div>

        <!-- BUTTONS -->
        <div class="flex gap-3 mt-6">

            <!-- PILIH -->
            <form action="{{ route('alamat.select',$address->id) }}" method="POST">
                @csrf
                <button type="submit"
                        class="bg-[#0f5f54] text-white px-6 py-2 rounded-lg hover:opacity-90 transition">
                    Pilih
                </button>
            </form>

            <!-- HAPUS -->
            <form action="{{ route('alamat.destroy',$address->id) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus alamat ini?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="border border-red-500 text-red-500 px-6 py-2 rounded-lg hover:bg-red-50 transition">
                    Hapus
                </button>
            </form>

        </div>

    </div>

    @empty
        <div class="bg-white p-10 text-center rounded-2xl shadow-sm">
            <p class="text-gray-500 text-lg">
                Belum ada alamat tersimpan.
            </p>
        </div>
    @endforelse

</div>

</body>
</html>