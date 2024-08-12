<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fotos = foto::all();

        return view("foto.index", compact("fotos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $albums = album::all();

        return view("foto.tambah")->with("albums", $albums);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $album          = $request->album;
        $judul          = $request->judul;
        $deskripsi      = $request->deskripsi;

        $insertFoto                     = new Foto();
        $insertFoto->album_id           = $album;
        $insertFoto->judul              = $judul;
        $insertFoto->tanggal_unggah     = date("y-m-d");

        if (!empty($deskripsi)){
            $insertFoto->deskripsi = $deskripsi;
        }

        if($request->hasfile("foto")){
            $foto = $request->file("foto");
            $namaFotoBaru = date("y_m_d_H_i_s").".".$foto->getClientOriginalExtension();

            $foto->storeAs("/foto", $namaFotoBaru, "public");
            $insertFoto->lokasi_file = "foto/{$namaFotoBaru}";
        }
        $insertFoto->save();

        return redirect()->route("foto.index");
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
    public function edit(string $id)
    {
        $albums = album::all();

        $foto = foto::where("id", "=", $id)->first();

        $data = [
            "albums" => $albums,
            "foto" => $foto
        ];

        return view("foto.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $album          = $request->album;
        $judul          = $request->judul;
        $deskripsi      = $request->deskripsi;

        $updateFoto     =[
            "album_id"  => $album,
            "judul"     => $judul,
        ];
        // deskripsi opsional bisa diisi bisa tidak 
        // isi deskripsi apabila user input deskripsi
        if(!empty($deskripsi)){
            $updateFoto["deskripsi"] = $deskripsi;
        }
        // cek apakah terdapat file yang diupload oleh user
        if($request->hasfile("foto"))
        {
            // ambil input file yang bernama foto
            $foto = $request->FILE("foto");
            // cek apakah benar foto tersebut diisi dan bukan file corrupt
            if($foto->isValid()){
                // salah satu manfaat menggunakan OOP:
                // hanya membuat 1 method tetapi dapat dimanfaatkan berulang kali
                $this->deleteFileFoto($id);//delete file yang lama apabila terdapat file yang baru!
                // buat nama file yang benar-benar unik per detiknya
                // ambil nama extensi yang diupload
                $namaFotoBaru = date("Y_m_d_H_i_s") . "." . $foto->getClientOriginalExtension();
                // upload file ke dalam folder foto & rename file yang sudah diupload
                $foto->storeAs("/foto", $namaFotoBaru, "public");
                // masukkan nama file ke dalam field lokasi_file pada tabel foto
                $updateFoto["lokasi_file"]="foto/{$namaFotoBaru}";
            }
        }

        foto::where("id", "=", $id)->update($updateFoto);

        return redirect()->route("foto.index");
    }

    /**
     * Remove the specified resource from storage.
     */

    private function deleteFileFoto(string $id)
    {
        $foto = foto::where("id", $id)->first();
        // cek apakah ada file data folder storage
        if(storage::disk("public")->exists($foto->lokasi_file))
        {
            // apabila file ditemukan maka hapus foto sebelum hapus data pada tabel
            storage::disk("public")->delete($foto->lokasi_file);
        }
    }
    public function destroy(string $id)
    {
        $foto = foto::where("id", $id)->first();

        // panggil fungsi delete file foto
        $this->deleteFileFoto($id);

        $foto->delete();

        return redirect()->route("foto.index");
    }
}
