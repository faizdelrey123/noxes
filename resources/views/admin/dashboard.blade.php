@extends('layouts.dashboard')

@section('content')

<h2>Selamat Datang Admin</h2>

<div class="cards">
    <div class="card">
        <h4>Total Pendapatan</h4>
        <p>Rp. 500.000.000</p>
    </div>

    <div class="card">
        <h4>Total Order</h4>
        <p>1500</p>
    </div>

    <div class="card">
        <h4>Total Produk</h4>
        <p>44</p>
    </div>
    <div class="card">
        <h4>Total Pengguna</h4>
        <p>1000</p>
    </div>
</div>

<h2 style="margin-top:40px;">Pesanan Terbaru</h2>

<table>
    <thead>
        <tr>
            <th>ID Pesanan</th>
            <th>Username</th>
            <th>Jumlah Pesanan</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>NXS-000123456</td>
            <td>Faiz Syawaluddin</td>
            <td>3</td>
            <td>Rp. 750.000</td>
            <td><button class="btn-detail">Detail</button></td>
        </tr>
    </tbody>
</table>

@endsection
