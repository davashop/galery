@extends('layout')
@section('content')
<style type="text/css">
        .head{
            margin-left: 35%;
        }

        .container{
            background-color:white;
            width: 25%;
            margin-left: 35%;
        }
    </style>
    <div class="head">
    <h1>Foto</h1>
    <a href="{{ route('foto.create') }}">+ Tambah +</a>
        <br>
        <br>
    </div>
    <div class="container">
        <table border="1">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Album</td>
                    <td>Judul</td>
                    <td>Deskripsi</td>
                    <td>Tanggal</td>
                    <td>Foto</td>
                    <td>Opsi</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1
                @endphp
                @forelse($fotos as $foto)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $foto->album->nama_album }}</td>
                        <td>{{ $foto->judul }}</td>
                        <td>{{ date("d-m-y"), strtotime($foto->tanggal_unggah) }}</td>
                        <td><img src="{{ asset("storage/{$foto->lokasi_file}") }}" alt="{{ $foto->judul }}" width="40%"></td>
                        <td>
                            <a href="{{ route('foto.edit', $album->id) }}">Edit</a>
                                ||
                            <form action="{{ route('foto.destroy', $album->id) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6">Tidak terdapat data foto!</td>
                        </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection