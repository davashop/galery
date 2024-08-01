@extends('layout')
@section('content')
    <style type="text/css">
        .back{
            width: 30%;
            padding: 10%;
            margin-left: 25%;
        }
    </style>
    <div class="back">
    <h1>Album</h1>
        <br>
        <br>
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