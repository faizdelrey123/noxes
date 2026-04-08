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
            left: 20px;
            right: 20px;
        }
        .logout button {
            width: 100%;
            background: #0f5f54;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
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

        /* PREMIUM TABLE STYLES */
        .styled-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
            font-size: 14px;
            text-align: left;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .styled-table thead tr {
            background-color: #0f5f54;
            color: #ffffff;
            text-align: left;
        }
        .styled-table th,
        .styled-table td {
            padding: 16px 20px;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #eeeeee;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }
        .styled-table tbody tr:hover {
            background-color: #f4fbf9;
        }
        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #0f5f54;
        }

        /* PREMIUM IMAGE STYLES */
        .product-img {
            width: 65px;
            height: 65px;
            object-fit: contain;
            background: #fff;
            border-radius: 10px;
            padding: 4px;
            border: 1px solid #eaeaea;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        /* PREMIUM BUTTON STYLES */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            outline: none;
        }
        .btn-add {
            background-color: #0f5f54;
            color: #ffffff;
            font-size: 14px;
            padding: 12px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(15, 95, 84, 0.25);
        }
        .btn-add:hover {
            background-color: #0b4a41;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(15, 95, 84, 0.35);
        }
        .btn-edit {
            background-color: #f59e0b;
            color: white;
        }
        .btn-edit:hover {
            background-color: #d97706;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(245, 158, 11, 0.25);
        }
        .btn-delete {
            background-color: #ef4444;
            color: white;
        }
        .btn-delete:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.25);
        }
        .action-flex {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .price-badge {
            font-weight: 700;
            color: #0f5f54;
            background: #e6f0ee;
            padding: 6px 12px;
            border-radius: 6px;
            display: inline-block;
        }

        /* SEARCH STYLES */
        .search-container {
            display: flex;
        }
        .search-input {
            width: 250px;
            padding: 10px 16px;
            border: 1px solid #ddd;
            border-radius: 8px 0 0 8px;
            font-size: 14px;
            outline: none;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
        }
        .search-input:focus {
            border-color: #0f5f54;
        }
        .btn-search {
            background-color: #0f5f54;
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            transition: 0.2s;
        }
        .btn-search:hover {
            background-color: #0b4a41;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">LA PRIMERA</div>
        <p>{{ Auth::check() ? ucfirst(Auth::user()->role) : '' }}</p>

        <div class="menu">
            <a href="{{ route('admin.dashboard') }}">Dasbor</a>
            <a href="{{ route('admin.product.index') }}" class="active">Kelola Produk</a>

            <a href="{{ route('staff.riwayat') }}">Riwayat Pesanan</a>
            <a href="{{ route('admin.petugas.index') }}">Kelola Petugas</a>
            <a href="{{ route('admin.user.index') }}">Kelola Pengguna</a>
        </div>

        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Keluar</button>
            </form>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="navbar">Kelola Produk</div>

        <div class="main">

            
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
                <h2 style="margin: 0; color: #333 text-2xl font-bold">Daftar Produk</h2>

                <div style="display: flex; gap: 15px;">
                    <form action="{{ route('admin.product.index') }}" method="GET" class="search-container">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="search-input">
                        <button type="submit" class="btn-search">Cari</button>
                    </form>

                    <a href="{{ route('admin.product.create') }}" class="btn btn-add">
                        + Tambah Produk
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div style="background:#d1fae5;color:#065f46;padding:15px;border-radius:8px;margin-bottom:20px;border-left:4px solid #10b981;font-weight:500;">
                    {{ session('success') }}
                </div>
            @endif

            <table class="styled-table">
                <thead>
                    <tr>
                        <th width="10%">Gambar</th>
                        <th width="20%">Nama Produk</th>
                        <th width="20%">Series</th>
                        <th width="20%">Harga</th>
                        <th width="10%">Stok</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <img src="{{ asset('products/'.$product->image) }}" class="product-img">
                    </td>
                    <td style="font-weight: 600; color: #333;">{{ $product->name }}</td>
                    <td style="color: #666;">{{ $product->series }}</td>
                    <td><span class="price-badge">Rp {{ number_format($product->price,0,',','.') }}</span></td>
                    <td>
                        <span style="font-weight: 600; {{ $product->stock < 10 ? 'color: #ef4444;' : 'color: #10b981;' }}">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td>
                        <div class="action-flex">
                            <a href="{{ route('admin.product.edit',$product->id) }}" class="btn btn-edit">Ubah</a>

                            <form action="{{ route('admin.product.destroy',$product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: #888; font-style: italic;">Belum ada produk tersedia.</td>
                </tr>
                @endforelse
                </tbody>
            </table>

        </div>

    </div>

</div>

</body>
</html>