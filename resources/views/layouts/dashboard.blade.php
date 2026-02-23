<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #ffffff;
            min-height: 100vh;
            padding: 20px;
            border-right: 1px solid #ddd;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #0f5f54;
        }

        .role {
            margin-top: 5px;
            color: #0f5f54;
            font-size: 18px;
        }

        .menu {
            margin-top: 30px;
        }

        .menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #0f5f54;
            margin-bottom: 10px;
            border-radius: 6px;
        }

        .menu a.active,
        .menu a:hover {
            background-color: #e5e5e5;
        }

        .logout-btn {
            position: absolute;
            bottom: 30px;
        }

        .logout-btn button {
            background-color: #0f5f54;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        /* CONTENT */
        .content {
            flex: 1;
        }

        .navbar {
            background: #ffffff;
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
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            border: 1px solid #ccc;
            text-align: center;
            min-width: 180px;
        }

        .card h4 {
            margin: 0;
            font-weight: normal;
        }

        .card p {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #f1f1f1;
        }

        .btn-detail {
            padding: 6px 15px;
            border-radius: 6px;
            border: 1px solid #333;
            background: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
    <div class="logo">NOXÉS</div>
    <div class="role">{{ ucfirst(Auth::user()->role) }}</div>

    <div class="menu">

    <a href="#">Dashboard</a>

    <a href="{{ route('admin.product.index') }}">Kelola Produk</a>

    <a href="#">Status Pemesanan</a>
    <a href="#">Riwayat Pesanan</a>

    @if(Auth::user()->role == 'petugas')
        <a href="#">Laporan</a>
    @endif

    @if(Auth::user()->role == 'admin')
        <a href="{{ route('petugas.index') }}">Kelola Petugas</a>
        <a href="#">Kelola Pengguna</a>
    @endif

</div>

    <div class="logout-btn">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

    <!-- CONTENT -->
    <div class="content">

        <div class="navbar">
            Dashboard
        </div>

        <div class="main">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>
