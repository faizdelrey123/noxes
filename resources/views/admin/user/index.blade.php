<!DOCTYPE html>
<html>
<head>
    <title>Kelola Pengguna - Admin</title>
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
        
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; text-align: left; }
        th, td { padding: 14px; border-bottom: 1px solid #eee; }
        th { background: #f3f3f3; }
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
            <a href="{{ route('admin.petugas.index') }}">Kelola Petugas</a>
            <a href="{{ route('admin.user.index') }}" class="active">Kelola Pengguna</a>
        </div>
        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
    <div class="content">
        <div class="navbar">Kelola Pengguna</div>
        <div class="main">

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Kelola Pengguna</h2>
</div>

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
            <th>Tanggal Terdaftar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->format('d M Y') }}</td>
            <td>
                <div style="display: flex; gap: 5px;">
                    <a href="{{ route('admin.user.show', $user->id) }}"
                       style="background:#0f5f54; color:white; padding:5px 10px; border-radius:5px; text-decoration:none; font-size: 13px;">
                        Detail
                    </a>
                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                        @csrf
                        @method('DELETE')
                        <button style="background:red; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer; font-size: 13px;">
                            Hapus
                        </button>
                    </form>
                </div>
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
