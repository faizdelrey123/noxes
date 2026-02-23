@extends('layouts.dashboard')

@section('content')

<h2>Selamat Datang {{ Auth::user()->name }} !!</h2>

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
        <p>34</p>
    </div>
    
</div>

@endsection
