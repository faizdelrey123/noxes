<!DOCTYPE html>
<html>
<head>
    <title>Status Pemesanan</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
        }

        .container {
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #fff;
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

        .role {
            margin-top: 5px;
            color: #0f5f54;
        }

        .menu {
            margin-top: 30px;
        }

        .menu a {
            display: block;
            padding: 10px;
            margin-bottom: 8px;
            color: #0f5f54;
            text-decoration: none;
            border-radius: 6px;
        }

        .menu a.active,
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
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }

        /* CONTENT */
        .content {
            flex: 1;
        }

        .navbar {
            background: white;
            padding: 20px;
            border-bottom: 1px solid #ddd;
            font-size: 20px;
            font-weight: 600;
            color: #0f5f54;
        }

        .main {
            padding: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f2f2f2;
        }

        select {
            padding: 5px 10px;
            border-radius: 6px;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            color: white;
            font-size: 13px;
        }

        .dikemas { background: orange; }
        .dikirim { background: #3490dc; }
        .selesai { background: #38a169; }

    </style>
</head>

<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">LA PRIMERA</div>
        <p>{{ Auth::check() ? ucfirst(Auth::user()->role) : '' }}</p>

        <div class="menu">
            <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('staff.dashboard') }}">Dasbor</a>
            <a href="{{ Auth::user()->role == 'admin' ? route('admin.product.index') : route('staff.product.index') }}">Kelola Produk</a>
            <a href="{{ route('staff.status') }}" class="active">Status Pemesanan</a>
            <a href="{{ route('staff.riwayat') }}">Riwayat Pesanan</a>
            
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.petugas.index') }}">Kelola Petugas</a>
                <a href="{{ route('admin.user.index') }}">Kelola Pengguna</a>
            @endif

            @if(Auth::user()->role == 'petugas')
                <a href="{{ route('staff.laporan') }}">Laporan</a>
            @endif
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

        <div class="navbar">
            Status Pemesanan
        </div>

        <div class="main">

            <h2>Daftar Pesanan</h2>

            <!-- FILTER & SEARCH -->
            <form action="{{ route('staff.status') }}" method="GET" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: flex-start; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); flex-wrap: wrap;">
                <div>
                    <label style="font-size: 13px; color: #666; display: block; margin-bottom: 4px;">Pencarian (ID / Nama)</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pesanan..." style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; width: 220px; font-family: 'Poppins', sans-serif;">
                </div>
                <div>
                    <label style="font-size: 13px; color: #666; display: block; margin-bottom: 4px;">Mulai Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Poppins', sans-serif;">
                </div>
                <div>
                    <label style="font-size: 13px; color: #666; display: block; margin-bottom: 4px;">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-family: 'Poppins', sans-serif;">
                </div>
                <div style="margin-top: 23px;">
                    <button type="submit" style="background: #0f5f54; color: white; border: none; padding: 9px 15px; border-radius: 6px; cursor: pointer; font-family: 'Poppins', sans-serif;">Terapkan</button>
                    <a href="{{ route('staff.status') }}" style="text-decoration: none; color: #666; margin-left: 10px; font-size: 14px;">Reset</a>
                </div>
            </form>

            @if(session('success'))
                <p style="color:green">{{ session('success') }}</p>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama User</th>
                        <th>Jumlah Item</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Ubah Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                    <tr>

                        <td>{{ $order->order_code }}</td>

                        <td>{{ $order->user->name }}</td>

                        <td>{{ $order->items->sum('quantity') }}</td>

                        <td>
                            Rp {{ number_format($order->total,0,',','.') }}
                        </td>

                        <td>
                            <span class="badge {{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>
                            @if($order->is_received)
                                <div style="margin-top: 8px; font-size: 11px; color: #38a169; font-weight: bold;">
                                    ✔ Telah Diterima User
                                </div>
                            @endif
                        </td>

                        <td>
                            @if($order->is_received)
                                <div style="font-size: 13px; color: #38a169; font-weight: bold; background: #e6ffed; padding: 10px; border-radius: 6px; text-align: center; border: 1px solid #38a169;">
                                    Terkunci<br><span style="font-size: 11px; font-weight: normal;">(Sudah Diterima)</span>
                                </div>
                            @else
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 8px; text-align: left;">
                                    @csrf

                                    <select name="status" style="width: 100%; border: 1px solid #ccc; font-size: 13px;">
                                        <option value="tertunda" {{ $order->status == 'tertunda' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="dikemas" {{ $order->status == 'dikemas' ? 'selected' : '' }}>Dikemas</option>
                                        <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>

                                    <select name="tracking_level" style="width: 100%; border: 1px solid #ccc; font-size: 12px; background: #fdfdfd;">
                                        <option value="0" {{ $order->tracking_level == 0 ? 'selected' : '' }}>- Info Lacak -</option>
                                        <option value="1" {{ $order->tracking_level == 1 ? 'selected' : '' }}>Menyiapkan pengiriman</option>
                                        <option value="2" {{ $order->tracking_level == 2 ? 'selected' : '' }}>Paket di-pickup</option>
                                        <option value="3" {{ $order->tracking_level == 3 ? 'selected' : '' }}>Sedang transit</option>
                                        <option value="4" {{ $order->tracking_level == 4 ? 'selected' : '' }}>Dalam pengiriman</option>
                                        <option value="5" {{ $order->tracking_level == 5 ? 'selected' : '' }}>Diterima</option>
                                    </select>

                                    <button type="submit" style="background:#0f5f54; color:white; border:none; padding:6px; border-radius:4px; font-size:12px; cursor:pointer; font-weight: 500; font-family:'Poppins', sans-serif;">Simpan Update</button>
                                </form>
                            @endif
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