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
        <div class="logo">NOXÉS</div>
        <p>{{ Auth::check() ? ucfirst(Auth::user()->role) : '' }}</p>

        <div class="menu">
            <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('staff.dashboard') }}">Dashboard</a>
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
                <button type="submit">Logout</button>
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
                        </td>

                        <td>
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                @csrf

                                <select name="status" onchange="this.form.submit()">

                                    <option value="dikemas" {{ $order->status == 'dikemas' ? 'selected' : '' }}>
                                        Dikemas
                                    </option>

                                    <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>
                                        Dikirim
                                    </option>

                                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>

                                </select>

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