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
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f5f5f5;
        }

        .btn-approve {
            background:#0f5f54;
            color:white;
            padding:6px 12px;
            border:none;
            border-radius:6px;
            cursor:pointer;
        }

        .btn-approve:hover {
            background:#0c4b42;
        }

        .btn-detail {
            background:#2563eb;
            color:white;
            padding:6px 12px;
            border:none;
            border-radius:6px;
            cursor:pointer;
            margin-left:5px;
            text-decoration:none;
            font-size:14px;
            display:inline-block;
        }

        .btn-detail:hover {
            background:#1d4ed8;
        }

        .btn-cancel {
            background:#ef4444;
            color:white;
            padding:6px 12px;
            border:none;
            border-radius:6px;
            cursor:pointer;
            margin-left:5px;
            text-decoration:none;
            font-size:14px;
            display:inline-block;
        }

        .btn-cancel:hover {
            background:#dc2626;
        }

        /* Modal Styles */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
        .modal-content { background-color: #fefefe; margin: 10% auto; padding: 20px; border: 1px solid #888; width: 400px; border-radius: 10px; }
        .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
        .close:hover, .close:focus { color: black; text-decoration: none; }

        .proof-img {
            width: 60px;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="container">

<div class="sidebar">
    <div class="logo">LA PRIMERA</div>
    <p>{{ Auth::check() ? ucfirst(Auth::user()->role) : '' }}</p>

    <div class="menu">
        <a href="{{ route('admin.dashboard') }}" class="active">Dasbor</a>
        <a href="{{ route('admin.product.index') }}">Kelola Produk</a>

        <a href="{{ route('staff.riwayat') }}">Riwayat Pesanan</a>
        <a href="{{ route('admin.petugas.index') }}">Kelola Petugas</a>
        <a href="{{ route('admin.user.index') }}">Kelola Pengguna</a>
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

            @if(session('success'))
                <p style="color:green">{{ session('success') }}</p>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama User</th>
                        <th>Total</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pendingOrders as $order)
                    <tr>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>Rp {{ number_format($order->total,0,',','.') }}</td>

                        <td>
                            @if($order->proof)
                                <a href="{{ asset('storage/'.$order->proof) }}" target="_blank">
                                    <img src="{{ asset('products/'.$order->proof) }}" class="proof-img">
                                </a>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            <div style="display:flex; justify-content:center; align-items:center;">
                                <form action="{{ route('staff.approve', $order->id) }}" method="POST" style="margin:0;">
                                    @csrf
                                    <button class="btn-approve" onclick="return confirm('Approve pesanan ini?')">Approve</button>
                                </form>
                                <a href="{{ route('staff.orders.show', $order->id) }}" class="btn-detail">Detail</a>
                                <button type="button" class="btn-cancel" onclick="openCancelModal({{ $order->id }})">Batalkan</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" align="center">Belum ada pesanan</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

            <!-- TABEL PENGGUNA BARU -->
            <h2 style="margin-top:40px;">Pengguna Baru (User)</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($newUsers as $user)
                    <tr>
                        <td>USR-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" align="center">Belum ada pengguna baru</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

</div>

    <!-- Modal Cancel -->
    <div id="cancelModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCancelModal()">&times;</span>
            <form id="cancelForm" method="POST" action="">
                @csrf
                <h3 style="margin-top:0;">Batalkan Pesanan</h3>
                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:5px;">Alasan Pembatalan:</label>
                    <textarea name="cancel_reason" rows="4" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;" required placeholder="Masukkan alasan kenapa pesanan dibatalkan..."></textarea>
                </div>
                <button type="submit" class="btn-cancel" style="width:100%; padding:10px; margin-left:0;">Konfirmasi Batal</button>
            </form>
        </div>
    </div>

    <script>
        function openCancelModal(orderId) {
            document.getElementById('cancelModal').style.display = "block";
            // Asumsi prefix URL /staff/cancel/ di auth admin & staff (karena route staff.cancel)
            document.getElementById('cancelForm').action = "/staff/cancel/" + orderId;
        }
        function closeCancelModal() {
            document.getElementById('cancelModal').style.display = "none";
        }
        window.onclick = function(event) {
            var modal = document.getElementById('cancelModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>