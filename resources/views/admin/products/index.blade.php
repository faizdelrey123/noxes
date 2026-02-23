@extends('layouts.dashboard')

@section('content')

<div style="padding:40px;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
        <h2 style="font-size:24px; font-weight:600; color:#0f5f54;">
            Kelola Produk
        </h2>

        <a href="{{ route('products.create') }}"
           style="background:#0f5f54;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;">
            + Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div style="background:#d4edda;color:#155724;padding:10px;border-radius:6px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background:white;padding:30px;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,0.05);">

        <table width="100%" cellpadding="10" style="border-collapse:collapse;">
            <thead style="background:#f3f3f3;">
                <tr>
                    <th align="left">Gambar</th>
                    <th align="left">Nama</th>
                    <th align="left">Series</th>
                    <th align="left">Harga</th>
                    <th align="left">Stok</th>
                    <th align="left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr style="border-bottom:1px solid #eee;">
                    <td>
                        <img src="{{ asset('products/'.$product->image) }}"
                             width="60">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->series }}</td>
                    <td>Rp {{ number_format($product->price) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td style="display:flex; gap:10px;">

                        <a href="{{ route('products.edit', $product->id) }}"
                           style="background:#ffc107;color:black;padding:5px 12px;border-radius:6px;text-decoration:none;">
                            Edit
                        </a>

                        <form action="{{ route('admin.product.destroy', $product->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus produk?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="background:#dc3545;color:white;padding:5px 12px;border:none;border-radius:6px;cursor:pointer;">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" align="center" style="padding:20px;">
                        Belum ada produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection