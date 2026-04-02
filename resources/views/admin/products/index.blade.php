<!DOCTYPE html>
<html>
<head>
    <title>Kelola Produk - Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }

        body {
            margin: 0;
            background: #f5f5f5;
        }

        .container {
            display: flex;
        }

        .sidebar {
            width: 240px;
            background: white;
            min-height: 100vh;
            padding: 20px;
            border-right: 1px solid #ddd;
            position: relative;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            color: #0f5f54;
        }

        .menu {
            margin-top: 30px;
        }

        .menu a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            color: #0f5f54;
            text-decoration: none;
            border-radius: 6px;
        }

        .menu a:hover {
            background: #e6f0ee;
        }

        .logout {
            position: absolute;
            bottom: 30px;
        }

        .logout button {
            background: #0f5f54;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .content {
            flex: 1;
        }

        .navbar {
            background: white;
            padding: 20px;
            border-bottom: 1px solid #ddd;
            font-size: 22px;
            font-weight: bold;
            color: #0f5f54;
        }

        .main {
            padding: 40px;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">NOXÉS</div>
        <p>Admin</p>

        <div class="menu">
            <a href="/admin/dashboard">Dashboard</a>
            <a href="{{ route('admin.product.index') }}">Kelola Produk</a>
            <a href="{{ route('staff.status') }}">Status Pemesanan</a>
            <a href="{{ route('staff.riwayat') }}">Riwayat Pesanan</a>
            <a href="{{ route('petugas.index') }}">Kelola Petugas</a>
        </div>

        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button>Logout</button>
            </form>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="navbar">Kelola Produk</div>

        <div class="main">

            <div style="display:flex; justify-content:space-between; margin-bottom:30px;">
                <h2>Daftar Produk</h2>

                <a href="{{ route('admin.product.create') }}"
                   style="background:#0f5f54;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;">
                    + Tambah Produk
                </a>
            </div>

            @if(session('success'))
                <div style="background:#d4edda;color:#155724;padding:10px;border-radius:6px;margin-bottom:20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background:white;padding:30px;border-radius:12px;">

                <table width="100%" cellpadding="10">
                    <thead style="background:#f3f3f3;">
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
                    @forelse($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset('products/'.$product->image) }}" width="70">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->series }}</td>
                        <td>Rp {{ number_format($product->price,0,',','.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('admin.product.edit',$product->id) }}">Edit</a>

                            <form action="{{ route('admin.product.destroy',$product->id) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button>Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Belum ada produk</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>