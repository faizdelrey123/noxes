<!DOCTYPE html>
<html>
<head>
    <title>Kelola Petugas - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
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
        
        table { width: 100%; margin-top: 30px; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; text-align: left; }
        th, td { padding: 14px; border-bottom: 1px solid #eee; }
        th { background: #f3f3f3; }
        
        .btn-add {
            background:#0f5f54;
            color:white;
            padding:10px 20px;
            border-radius:8px;
            text-decoration:none;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <div class="logo">LA PRIMERA</div>
        <p>{{ Auth::check() ? ucfirst(Auth::user()->role) : '' }}</p>
        <div class="menu">
            <a href="{{ route('admin.dashboard') }}">Dasbor</a>
            <a href="{{ route('admin.product.index') }}">Kelola Produk</a>

            <a href="{{ route('staff.riwayat') }}">Riwayat Pesanan</a>
            <a href="{{ route('admin.petugas.index') }}" class="active">Kelola Petugas</a>
            <a href="{{ route('admin.user.index') }}">Kelola Pengguna</a>
        </div>
        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Keluar</button>
            </form>
        </div>
    </div>
    <div class="content">
        <div class="navbar">Kelola Petugas</div>
        <div class="main">

<h2>Kelola Petugas</h2>

<a href="{{ route('admin.petugas.create') }}" class="btn-add">
    + Tambah Petugas
</a>

@if(session('success'))
    <div style="background:#d4edda; color:#155724; padding:10px; border-radius:8px; margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($petugas as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>{{ $p->email }}</td>
            <td>
                <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus petugas ini?')">
                    @csrf
                    @method('DELETE')
                    <button style="background:red; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">
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
</body>
</html>
