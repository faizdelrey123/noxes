<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan - Petugas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
        body { margin: 0; background: #f5f5f5; color: #333; }
        .container-wrapper { display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: white;
            min-height: 100vh;
            padding: 20px;
            border-right: 1px solid #ddd;
            position: relative;
        }
        .logo { font-size: 26px; font-weight: bold; color: #0f5f54; margin-bottom: 5px; }
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

        /* FILTER BOX */
        .filter-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .filter-form { display: flex; gap: 20px; align-items: flex-end; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 13px; font-weight: 500; margin-bottom: 5px; color: #666; }
        input[type="date"] { padding: 10px; border: 1px solid #ddd; border-radius: 8px; }
        .btn-filter { background: #0f5f54; color: white; padding: 11px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; }
        .btn-export { background: #38a169; color: white; padding: 11px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; text-decoration: none; display: inline-block; }
        .btn-print { background: #3490dc; color: white; padding: 11px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; }

        /* STATS */
        .stats-grid { display: flex; gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px; border-radius: 12px; flex: 1; border: 1px solid #eee; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .stat-label { font-size: 14px; color: #888; }
        .stat-value { font-size: 24px; font-weight: bold; color: #0f5f54; margin-top: 5px; }

        /* TABLE */
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; color: #0f5f54; font-weight: 600; }

        /* PRINT STYLES */
        @media print {
            .sidebar, .navbar, .filter-card, .btn-print, .btn-export { display: none !important; }
            .content { margin-left: 0 !important; width: 100% !important; }
            .main { padding: 0; }
            body { background: white; }
            .stat-card { border: 1px solid #ddd; }
            table { box-shadow: none; border: 1px solid #ddd; }
            .report-header { display: block !important; text-align: center; margin-bottom: 30px; }
        }
        .report-header { display: none; }
    </style>
</head>
<body>

<div class="container-wrapper">
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">LA PRIMERA</div>
        <p>{{ Auth::check() ? ucfirst(Auth::user()->role) : '' }}</p>

        <div class="menu">
            <a href="{{ route('staff.dashboard') }}">Dasbor</a>
            <a href="{{ route('staff.product.index') }}">Kelola Produk</a>
            <a href="{{ route('staff.status') }}">Status Pemesanan</a>
            <a href="{{ route('staff.riwayat') }}">Riwayat Pesanan</a>
            @if(Auth::user()->role == 'petugas')
                <a href="{{ route('staff.laporan') }}" class="active">Laporan</a>
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
            <h2>Laporan Penjualan</h2>
            <div style="display: flex; gap: 10px;">
                <button onclick="window.print()" class="btn-print">Print PDF</button>
                <a href="{{ route('staff.laporan.export', request()->all()) }}" class="btn-export">Export Excel</a>
            </div>
        </div>

        <div class="main">
            <!-- PRINT HEADER -->
            <div class="report-header">
                <h1 style="color:#0f5f54; margin:0;">LA PRIMERA</h1>
                <p style="margin:5px 0;">Laporan Penjualan Resmi</p>
                <p style="font-size:12px; color:#666;">Periode: {{ request('start_date') ?? 'Semua' }} s/d {{ request('end_date') ?? 'Sekarang' }}</p>
                <hr style="border:1px solid #eee; margin:20px 0;">
            </div>

            <div class="filter-card">
                <form action="{{ route('staff.laporan') }}" method="GET" class="filter-form">
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    <button type="submit" class="btn-filter">Filter Data</button>
                    <a href="{{ route('staff.laporan') }}" style="text-decoration:none; color:#666; font-size:14px; margin-bottom:12px;">Reset</a>
                </form>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Pendapatan</div>
                    <div class="stat-value">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Jumlah Order Selesai</div>
                    <div class="stat-value">{{ $total_order }}</div>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID Order</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Items</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td><strong>{{ $order->order_code }}</strong></td>
                            <td>{{ $order->user ? $order->user->name : 'N/A' }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td>{{ $order->items->count() }} Item</td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:30px; color:#999;">Tidak ada data pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
