@extends('layouts.dashboard')

@section('content')
@if ($errors->any())
    <div style="background:#ffe0e0;padding:15px;border-radius:8px;margin-bottom:20px;color:#b00020;">
        <ul style="margin:0;padding-left:20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div style="max-width:600px; margin:auto;">

    <h2 style="
        font-size:26px;
        font-weight:600;
        margin-bottom:30px;
        color:#0f5f54;
    ">
        Tambah Petugas
    </h2>

    <div style="
        background:#ffffff;
        padding:40px;
        border-radius:12px;
        box-shadow:0 4px 15px rgba(0,0,0,0.05);
        border:1px solid #e5e5e5;
    ">

        <form action="{{ route('petugas.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px; font-weight:500;">
                    Nama Lengkap
                </label>
                <input type="text" name="name" required
                    style="
                        width:100%;
                        padding:12px;
                        border-radius:8px;
                        border:1px solid #ccc;
                        outline:none;
                        font-size:14px;
                    ">
            </div>

            <!-- Username -->
            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px; font-weight:500;">
                    Username
                </label>
                <input type="text" name="username" required
                    style="
                        width:100%;
                        padding:12px;
                        border-radius:8px;
                        border:1px solid #ccc;
                        outline:none;
                        font-size:14px;
                    ">
            </div>

            <!-- Password -->
            <div style="margin-bottom:30px;">
                <label style="display:block; margin-bottom:8px; font-weight:500;">
                    Password
                </label>
                <input type="password" name="password" required
                    style="
                        width:100%;
                        padding:12px;
                        border-radius:8px;
                        border:1px solid #ccc;
                        outline:none;
                        font-size:14px;
                    ">
            </div>

            <!-- Button -->
            <div style="display:flex; justify-content:space-between;">

                <a href="{{ route('petugas.index') }}"
                    style="
                        padding:10px 20px;
                        border-radius:8px;
                        text-decoration:none;
                        background:#e5e5e5;
                        color:#333;
                    ">
                    Kembali
                </a>

                <button type="submit"
                    style="
                        background:#0f5f54;
                        color:white;
                        padding:10px 25px;
                        border:none;
                        border-radius:8px;
                        cursor:pointer;
                        font-weight:500;
                        font-family: 'Poppins', sans-serif;
                    ">
                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
