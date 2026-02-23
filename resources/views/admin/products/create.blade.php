@extends('layouts.dashboard')

@section('content')

<div style="max-width:700px; margin:auto; padding:40px;">

    <h2 style="font-size:24px; font-weight:600; margin-bottom:30px; color:#0f5f54;">
        Tambah Produk
    </h2>

    <div style="background:white;padding:40px;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,0.05);">

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama -->
            <div style="margin-bottom:20px;">
                <label>Nama Produk</label>
                <input type="text" name="name" required
                    style="width:100%;padding:10px;border-radius:8px;border:1px solid #ccc;">
            </div>

            <!-- Series -->
            <div style="margin-bottom:20px;">
                <label>Series</label>
                <select name="series" required
                    style="width:100%;padding:10px;border-radius:8px;border:1px solid #ccc;">
                    <option value="">-- Pilih Series --</option>
                    <option value="Classic">Classic</option>
                    <option value="V1">V1</option>
                    <option value="V2">V2</option>
                </select>
            </div>

            <!-- Harga -->
            <div style="margin-bottom:20px;">
                <label>Harga</label>
                <input type="number" name="price" required
                    style="width:100%;padding:10px;border-radius:8px;border:1px solid #ccc;">
            </div>

            <!-- Stok -->
            <div style="margin-bottom:20px;">
                <label>Stok</label>
                <input type="number" name="stock" required
                    style="width:100%;padding:10px;border-radius:8px;border:1px solid #ccc;">
            </div>

            <!-- Deskripsi -->
            <div style="margin-bottom:20px;">
                <label>Deskripsi</label>
                <textarea name="description" rows="4"
                    style="width:100%;padding:10px;border-radius:8px;border:1px solid #ccc;"></textarea>
            </div>

            <!-- Gambar -->
            <div style="margin-bottom:30px;">
                <label>Gambar Produk</label>
                <input type="file" name="image" required
                    style="width:100%;">
            </div>

            <!-- Button -->
            <div style="display:flex; justify-content:space-between;">

                <a href="{{ route('products.index') }}"
                   style="background:#e5e5e5;padding:10px 20px;border-radius:8px;text-decoration:none;color:black;">
                    Kembali
                </a>

                <button type="submit"
                        style="background:#0f5f54;color:white;padding:10px 25px;border:none;border-radius:8px;cursor:pointer;">
                    Simpan Produk
                </button>

            </div>

        </form>

    </div>

</div>

@endsection