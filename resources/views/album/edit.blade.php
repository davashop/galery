@extends('layout')
@section('content')
    <h1>Tambah Album</h1>

    <form action="{{ route('album.update', $album->id) }}" method="post">
        @method('put')
        @csrf
        <div>
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Album..." value="{{ $album->nama_album }}" required>
        </div>
        <div>
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" placeholder="Masukkan Deskripsi Album..." value="{{ $album->deskripsi }}" required>
        </div>
        <div>
            <label for="tgl_buat">Tanggal</label>
            <input type="date" name="tgl_buat" id="tgl_buat" placeholder="Masukkan Tanggal Dibuat..." value="{{ $album->tanggal_dibuat }}" required>
        </div>
        <br>
        <button type="submit">Simpan</button>
    </form>
@endsection