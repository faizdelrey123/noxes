<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
        body { margin: 0; background: #f5f5f5; color: #333; }
        .container { display: flex; }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: white;
            min-height: 100vh;
            padding: 20px;
            border-right: 1px solid #ddd;
            position: relative;
        }
        .logo { font-size: 26px; font-weight: bold; color: #0f5f54; }
        .role-badge { font-size: 14px; color: #666; margin-bottom: 30px; }
        .menu a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 8px;
            color: #0f5f54;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }
        .menu a:hover, .menu a.active { background: #e6f0ee; font-weight: 500; }
        .logout { position: absolute; bottom: 30px; left: 20px; right: 20px; }
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

        /* CONTENT */
        .content { flex: 1; }
        .navbar {
            background: white;
            padding: 20px 40px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h2 { margin: 0; font-size: 20px; color: #0f5f54; }
        
        .main { padding: 40px; }
        .form-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            max-width: 800px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: #444; }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: #0f5f54;
            outline: none;
            box-shadow: 0 0 0 3px rgba(15, 95, 84, 0.1);
        }
        textarea.form-control { height: 120px; resize: vertical; }
        
        .btn-submit {
            background: #0f5f54;
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
        }
        .btn-submit:hover { background: #0c4d44; transform: translateY(-1px); }
        
        .row { display: flex; gap: 20px; }
        .col { flex: 1; }

        .back-link {
            text-decoration: none;
            color: #666;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 20px;
        }
        .back-link:hover { color: #0f5f54; }

        .current-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid #eee;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="sidebar">
        <div class="logo">NOXÉS</div>
        <p>{{ Auth::check() ? ucfirst(Auth::user()->role) : '' }}</p>
        <div class="menu">
            <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('staff.dashboard') }}">Dashboard</a>
            <a href="{{ Auth::user()->role == 'admin' ? route('admin.product.index') : route('staff.product.index') }}" class="active">Kelola Produk</a>
            <a href="{{ route('staff.status') }}">Status Pemesanan</a>
            <a href="{{ route('staff.riwayat') }}">Riwayat Pesanan</a>

            @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.petugas.index') }}">Kelola Petugas</a>
                <a href="{{ route('admin.user.index') }}">Kelola Pengguna</a>
            @endif

            @if(Auth::user()->role == 'petugas')
                <a href="#">Laporan</a>
            @endif
        </div>
        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <div class="content">
        <div class="navbar">
            <h2>Edit Produk</h2>
            <span>{{ Auth::user()->name }} (Admin)</span>
        </div>

        <div class="main">
            <a href="{{ route('admin.product.index') }}" class="back-link">← Kembali ke Daftar</a>

            <div class="form-card">
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Series / Kategori</label>
                                <input type="text" name="series" class="form-control" value="{{ $product->series }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Harga (Rp)</label>
                                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar Produk</label>
                        @if($product->image)
                            <img src="{{ asset('products/'.$product->image) }}" class="current-img">
                        @endif
                        <input type="file" name="image" class="form-control" style="padding: 10px;">
                        <small style="color: #888; display: block; margin-top: 5px;">Biarkan kosong jika tidak ingin mengubah gambar. Format: JPG, PNG. Maks: 2MB.</small>
                    </div>

                    <button type="submit" class="btn-submit">Update Produk</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
