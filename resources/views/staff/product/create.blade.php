<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <style>
        body { font-family:Poppins; background:#f5f5f5; }
        .box { max-width:600px; margin:auto; margin-top:50px; background:white; padding:30px; border-radius:12px; }
    </style>
</head>

<body>

<div class="box">

    <h2>Tambah Produk</h2>

    <form action="{{ route('staff.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="name" placeholder="Nama" required><br><br>
        <input type="text" name="series" placeholder="Series" required><br><br>
        <input type="number" name="price" placeholder="Harga" required><br><br>
        <input type="number" name="stock" placeholder="Stok" required><br><br>

        <textarea name="description" placeholder="Deskripsi"></textarea><br><br>

        <input type="file" name="image" required><br><br>

        <button type="submit">Simpan</button>

    </form>

</div>

</body>
</html>