<!DOCTYPE html>
<html>
<head>
    <title>Profil Pengguna - Admin</title>
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
        .menu { margin-top: 30px; }
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
        
        .profile-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            max-width: 600px;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .avatar {
            width: 80px;
            height: 80px;
            background: #0f5f54;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
        }
        
        .info-group { margin-bottom: 20px; }
        .info-label { font-size: 13px; color: #888; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 1px; }
        .info-value { font-size: 18px; font-weight: 500; color: #333; }
        
        .order-badge {
            background: #e6f0ee;
            color: #0f5f54;
            padding: 10px 20px;
            border-radius: 50px;
            display: inline-block;
            font-weight: 600;
            margin-top: 10px;
        }

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
        <div class="navbar">
            <h2>Profil Pengguna</h2>
            <span>Admin</span>
        </div>

        <div class="main">
            <a href="{{ route('admin.user.index') }}" class="back-link">← Kembali ke Daftar</a>

            <div class="profile-card">
                <div class="profile-header">
                    <div class="avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 style="margin:0; font-size:24px;">{{ $user->name }}</h3>
                        <p style="margin:0; color:#666;">@ {{ $user->username }}</p>
                    </div>
                </div>

                <div class="info-group">
                    <div class="info-label">Nama Lengkap</div>
                    <div class="info-value">{{ $user->name }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Username / Email</div>
                    <div class="info-value">{{ $user->username }}</div>
                </div>

                <div class="info-group">
                    <div class="info-label">Total Pesanan</div>
                    <div class="order-badge">
                        {{ $user->orders_count }} Pesanan Telah Dilakukan
                    </div>
                </div>

                <div class="info-group">
                    <div class="info-label">Status Akun</div>
                    <div style="color: #38a169; font-weight: 500;">Aktif</div>
                </div>
                
                <div style="margin-top: 30px; font-size: 12px; color: #999;">
                    Bergabung pada: {{ $user->created_at->format('d F Y') }}
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
