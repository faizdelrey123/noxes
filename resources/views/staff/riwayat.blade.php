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
        <div class="logo">NOXÉS</div>

        <div class="menu">
            <a href="{{ route('staff.dashboard') }}">Dashboard</a>
            <a href="{{ route('staff.product.index') }}">Kelola Produk</a>
            <a href="{{ route('staff.status') }}">Status Pemesanan</a>
            <a href="{{ route('staff.riwayat') }}" class="active">Riwayat Pesanan</a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="navbar">Riwayat Pesanan</div>

        <div class="main">

            <h2>Riwayat Pesanan</h2>

            <!-- FILTER -->
            <div class="filter">
                <a href="?filter=harian"
                   class="{{ $filter == 'harian' ? 'active' : '' }}">
                    Harian
                </a>

                <a href="?filter=bulanan"
                   class="{{ $filter == 'bulanan' ? 'active' : '' }}">
                    Bulanan
                </a>

                <a href="{{ route('staff.riwayat') }}">
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
                        </td>

                        <td>
                            {{ $order->created_at->format('d M Y') }}
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