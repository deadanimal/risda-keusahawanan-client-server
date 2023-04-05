<?php

namespace App\Http\Controllers;

use App\Models\KategoriAliran;
use Illuminate\Http\Request;

class KategoriAliranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori_Aliran = KategoriAliran::all();
        
        return response()->json($kategori_Aliran);
    }

   
    public function store(Request $request)
    {
        $kategori_Aliran = new KategoriAliran();

        $kategori_Aliran->jenis_aliran = $request->jenis_aliran;
        $kategori_Aliran->nama_kategori_aliran = $request->nama_kategori_aliran;
        $kategori_Aliran->status_kategori_aliran = $request->status_kategori_aliran;

        $kategori_Aliran->save();

        return response()->json($kategori_Aliran);
    }

    
    public function show(KategoriAliran $kategoriAliran)
    {
        return response()->json($kategoriAliran);
    }


    public function update(Request $request, KategoriAliran $kategoriAliran)
    {
        $kategoriAliran->jenis_aliran = $request->jenis_aliran;
        $kategoriAliran->nama_kategori_aliran = $request->nama_kategori_aliran;
        $kategoriAliran->status_kategori_aliran = $request->status_kategori_aliran;

        $kategoriAliran->save();

        return response()->json($kategoriAliran);

    }

    public function destroy(KategoriAliran $kategoriAliran)
    {
        //
    }
}
