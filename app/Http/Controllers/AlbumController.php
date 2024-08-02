<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = album::all();

        $data =[
            "albums" => $albums
        ];

        return view("album.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("album.tambah");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nama = $request->nama;
        $deskripsi = $request->deskripsi;
        $tgl_buat = $request->tgl_buat;

        $dataalbum = new album();
        $dataalbum->nama_album = $nama;
        $dataalbum->deskripsi = $deskripsi;
        $dataalbum->tanggal_dibuat = $tgl_buat;
        $dataalbum->save();

        return redirect("/album");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $album = album::where("id", $id)->first();

        $data = [
            "album" => $album
        ];

        return view("album.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nama = $request->nama;
        $deskripsi = $request->deskripsi;
        $tgl_buat = $request->tgl_buat;

        album::where("id", $id)->update([
            "nama_album" => $nama,
            "deskripsi" => $deskripsi,
            "tanggal_dibuat" => $tgl_buat,
        ]);

        return redirect("/album");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $album = album::where("id",$id)->first();
        $album->delete();

        return redirect("/album");
    }
}
