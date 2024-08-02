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
    <h1>Album</h1>
    <a href="{{ route('album.create') }}">+ Tambah +</a>
        <br>
        <br>
    </div>
    <div class="container">
    <table border="1">
        <thead>
        <tr>
            <td>No</td>
            <td>Nama Album</td>
            <td>Deskripsi</td>
            <td>Tanggal Dibuat</td>
            <td>Opsi</td>
        </tr>
        </thead>
        <tbody>
            @php
                $no = 1
            @endphp
            @foreach($albums as $album)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $album->nama_album }}</td>
                    <td>{{ $album->deskripsi }}</td>
                    <td>{{ $album->tanggal_dibuat }}</td>
                    <td>
                    <a href="{{ url("/album/{$album->id}") }}">Edit</a>
                        ||
                    <form action="{{ url("/album/{$album->id}") }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
    </div>