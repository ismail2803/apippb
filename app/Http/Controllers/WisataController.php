<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;

class WisataController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('foto');
        $filename = $image->getClientOriginalName();
        $path = 'public/fotowisata/';
        $data = Wisata::create([
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'deskripsi' => $request->input('deskripsi'),
            'kategori' => $request->input('kategori'),
            'path' => 'storage/fotowisata/' . $filename,
        ]);

        $image->storeAs($path, $filename);
        return response()->json($data, 201);
    }

    public function datakategori($kategori)
    {
        $data = Wisata::where('kategori', $kategori)->get();
        return response()->json($data, 200);
    }

}
