<!DOCTYPE html>
<html>
<head>
    <title>Tambah Petugas - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
        body { margin: 0; background: #f5f5f5; }
        .container { display: flex; }
        .sidebar {
            width: 240px;
            background: white;
            min-height: 100vh;
            padding: 20px;
            border-right: 1px solid #ddd;
            position: relative;
        }
        .logo { font-size: 26px; font-weight: bold; color: #0f5f54; }
        .menu { margin-top: 30px; }
        .menu a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            color: #0f5f54;
            text-decoration: none;
            border-radius: 6px;
        }
        .menu a:hover, .menu a.active { background: #e6f0ee; }
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
        .content { flex: 1; }
        .navbar { background: white; padding: 20px; border-bottom: 1px solid #ddd; font-size: 22px; font-weight: bold; color: #0f5f54; }
        .main { padding: 40px; }
        
        .form-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            max-width: 600px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; }
        .form-control { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; }
        .btn-submit {
            background: #0f5f54;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <div class="logo">NOXÉS</div>
        <p>{{ Auth::check() ? ucfirst(Auth::user()->role) : '' }}</p>
        <div class="menu">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.product.index') }}">Kelola Produk</a>
            <a href="{{ route('staff.status') }}">Status Pemesanan</a>
            <a href="{{ route('staff.riwayat') }}">Riwayat Pesanan</a>
            <a href="{{ route('admin.petugas.index') }}" class="active">Kelola Petugas</a>
            <a href="{{ route('admin.user.index') }}">Kelola Pengguna</a>
        </div>
        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
    <div class="content">
        <div class="navbar">Tambah Petugas</div>
        <div class="main">

<div class="form-card">
    <h2 style="margin-top:0; margin-bottom:30px;">Tambah Petugas</h2>

    @if ($errors->any())
        <div style="background:#ffe0e0; padding:15px; border-radius:8px; margin-bottom:20px; color:#b00020;">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.petugas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="form-control" placeholder="Nama petugas" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Min. 8 karakter" required>
        </div>

        <button type="submit" class="btn-submit">Simpan Petugas</button>
    </form>
</div>

        </div>
    </div>
</div>
</body>
</html>
