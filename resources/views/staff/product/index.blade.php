<!DOCTYPE html>
<html>
<head>
    <title>Kelola Produk</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { margin:0; font-family:'Poppins',sans-serif; background:#f5f5f5; }
        .container { display:flex; }

        .sidebar {
            width:240px; background:white; min-height:100vh;
            padding:20px; border-right:1px solid #ddd;
        }

        .logo { font-size:26px; font-weight:bold; color:#0f5f54; }

        .menu { margin-top:30px; }

        .menu a {
            display:block; padding:10px; margin-bottom:10px;
            color:#0f5f54; text-decoration:none; border-radius:6px;
        }

        .menu a:hover { background:#e6f0ee; }

        .content { flex:1; }

        .navbar {
            background:white; padding:20px;
            border-bottom:1px solid #ddd;
            font-size:22px; font-weight:bold; color:#0f5f54;
        }

        .main { padding:40px; }

        table { width:100%; border-collapse:collapse; }
        th, td { padding:10px; }
        thead { background:#f3f3f3; }
        tr { border-bottom:1px solid #eee; }
    </style>
</head>

<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">NOXÉS</div>
        <p>{{ ucfirst(Auth::user()->role) }}</p>

        <div class="menu">
            <a href="{{ route('staff.dashboard') }}">Dashboard</a>
            <a href="{{ route('staff.product.index') }}">Kelola Produk</a>
            <a href="{{ route('staff.status') }}">Status Pemesanan</a>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button style="margin-top:20px;background:#0f5f54;color:white;padding:10px;border:none;border-radius:8px;">
                Logout
            </button>
        </form>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="navbar">Kelola Produk</div>

        <div class="main">

            <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
                <h2>Produk</h2>

                <a href="{{ route('staff.product.create') }}"
                   style="background:#0f5f54;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;">
                    + Tambah
                </a>
            </div>

            @if(session('success'))
                <div style="background:#d4edda;color:#155724;padding:10px;border-radius:6px;margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background:white;padding:20px;border-radius:12px;">

                <table>
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Series</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <img src="{{ asset('products/'.$product->image) }}"
                                     width="70">
                            </td>

                            <td>{{ $product->name }}</td>
                            <td>{{ $product->series }}</td>
                            <td>Rp {{ number_format($product->price,0,',','.') }}</td>
                            <td>{{ $product->stock }}</td>

                            <td style="display:flex; gap:5px;">
                                <a href="{{ route('staff.product.edit',$product->id) }}"
                                   style="background:#ffc107;padding:5px 10px;border-radius:6px;text-decoration:none;">
                                    Edit
                                </a>

                                <form action="{{ route('staff.product.destroy',$product->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button style="background:red;color:white;padding:5px 10px;border:none;border-radius:6px;">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>