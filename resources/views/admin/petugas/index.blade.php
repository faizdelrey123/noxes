@extends('layouts.dashboard')

@section('content')

<h2>Kelola Petugas</h2>

<a href="{{ route('petugas.create') }}"
   style="background:#0f5f54;color:white;padding:8px 15px;border-radius:6px;text-decoration:none;">
    Tambah Petugas
</a>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($petugas as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>{{ $p->username }}</td>
            <td>
                <form action="{{ route('petugas.destroy', $p->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        style="padding:5px 12px;border-radius:6px;">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
