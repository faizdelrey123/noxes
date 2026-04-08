<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pesanan</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
        }

        .container { display: flex; }

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

        .menu { margin-top: 30px; }

        .menu a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            color: #0f5f54;
            text-decoration: none;
            border-radius: 6px;
        }

        .menu a.active,
        .menu a:hover {
            background: #e6f0ee;
        }

        .content { flex: 1; }

        .navbar {
            background: white;
            padding: 20px;
            border-bottom: 1px solid #ddd;
            font-size: 22px;
            font-weight: bold;
            color: #0f5f54;
        }

        .main { padding: 40px; }

        /* FILTER */
        .filter {
            margin-bottom: 20px;
        }

        .filter a {
            padding: 8px 15px;
            margin-right: 10px;
            border-radius: 6px;
            text-decoration: none;
            border: 1px solid #0f5f54;
            color: #0f5f54;
        }

        .filter a.active {
            background: #0f5f54;
            color: white;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th { background: #f5f5f5; }

        /* STATUS BADGE */
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
            <a href="{{ route('staff.status') }}">Status Pemesanan</a>
            <a href="{{ route('staff.riwayat') }}" class="active">Riwayat Pesanan</a>
            
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.petugas.index') }}">Kelola Petugas</a>
                <a href="{{ route('admin.user.index') }}">Kelola Pengguna</a>
            @endif

            @if(Auth::user()->role == 'petugas')
                <a href="{{ route('staff.laporan') }}">Laporan</a>
            @endif
        </div>

        <div class="logout" style="position:absolute; bottom:30px; left:20px; right:20px;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="width:100%; background:#0f5f54; color:white; padding:12px; border:none; border-radius:8px; cursor:pointer; font-weight:500; font-family:'Poppins',sans-serif;">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="navbar">Riwayat Pesanan</div>

        <div class="main">

            <h2>Riwayat Pesanan</h2>

            <!-- FILTER & SEARCH FORM -->
            <form action="{{ route('staff.riwayat') }}" method="GET" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: flex-start; background: white; padding: 15px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); flex-wrap: wrap;">
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
                    <a href="{{ route('staff.riwayat') }}" style="text-decoration: none; color: #666; margin-left: 10px; font-size: 14px;">Reset</a>
                </div>
            </form>

            <!-- FILTER -->
            <div class="filter">
                <a href="{{ route('staff.riwayat', ['filter' => 'harian', 'search' => request('search'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                   class="{{ request('filter') == 'harian' ? 'active' : '' }}">
                    Harian
                </a>

                <a href="{{ route('staff.riwayat', ['filter' => 'bulanan', 'search' => request('search'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                   class="{{ request('filter') == 'bulanan' ? 'active' : '' }}">
                    Bulanan
                </a>

                <a href="{{ route('staff.riwayat', ['search' => request('search'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                   class="{{ !request('filter') ? 'active' : '' }}">
                    Semua
                </a>
            </div>

            <!-- TABLE -->
            <table>
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama User</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>Rp {{ number_format($order->total,0,',','.') }}</td>

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
                            {{ $order->created_at->format('d M Y') }}
                        </td>
                        <td>
                            <a href="{{ route('staff.orders.show', $order->id) }}" 
                               style="background:#0f5f54; color:white; padding:6px 12px; border-radius:6px; text-decoration:none; font-size:13px;">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Belum ada riwayat</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

</div>

</body>
</html>