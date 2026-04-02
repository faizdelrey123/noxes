<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>

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

        /* CONTENT */
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

        .cards {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #ddd;
            width: 220px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }

        .card h4 {
            margin: 0;
            font-weight: 500;
            color: #555;
        }

        .card p {
            font-size: 22px;
            font-weight: bold;
            margin-top: 10px;
            color: #0f5f54;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #f3f3f3;
        }

        .btn-detail {
            background: #0f5f54;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

<div class="sidebar">
    <div class="logo">NOXÉS</div>
    <p>{{ Auth::check() ? ucfirst(Auth::user()->role) : '' }}</p>

    <div class="menu">
        <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
        <a href="{{ route('admin.product.index') }}">Kelola Produk</a>
        <a href="{{ route('staff.status') }}">Status Pemesanan</a>
        <a href="{{ route('staff.riwayat') }}">Riwayat Pesanan</a>
        <a href="{{ route('admin.petugas.index') }}">Kelola Petugas</a>
        <a href="{{ route('admin.user.index') }}">Kelola Pengguna</a>
    </div>

    <div class="logout">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

    <!-- CONTENT -->
    <div class="content">

        <div class="navbar">
            Dashboard Admin
        </div>

        <div class="main">

            <h2>Selamat Datang {{ Auth::user()->name }} 👋</h2>

            <!-- CARDS -->
            <div class="cards">

                <div class="card">
                    <h4>Total Pendapatan</h4>
                    <p>Rp {{ number_format($totalPendapatan,0,',','.') }}</p>
                </div>

                <div class="card">
                    <h4>Total Order</h4>
                    <p>{{ $totalOrder }}</p>
                </div>

                <div class="card">
                    <h4>Total Produk</h4>
                    <p>{{ $totalProduk }}</p>
                </div>

                <div class="card">
                    <h4>Total User</h4>
                    <p>{{ $totalUser }}</p>
                </div>

            </div>

            <!-- TABLE -->
            <h2 style="margin-top:40px;">Pesanan Terbaru</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>Rp {{ number_format($order->total,0,',','.') }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('orders.show',$order->id) }}" class="btn-detail">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" align="center">Belum ada pesanan</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>