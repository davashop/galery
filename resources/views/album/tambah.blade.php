@extends('layout')
@section('content')
    <h1>Tambah Album</h1>

    <form action="{{ route('album.store') }}" method="post">
        @csrf
        <div>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Album..." required>
        </div>
        <div>
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" placeholder="Masukkan Deskripsi Album..." required>
        </div>
        <div>
            <label for="tgl_buat">Tanggal</label>
            <input type="date" name="tgl_buat" id="tgl_buat" placeholder="Masukkan Tanggal Dibuat..." required>
        </div>
        <br>
        <button type="submit">Simpan</button>
    </form>
@endsection