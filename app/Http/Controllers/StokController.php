<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    
    public function index()
    {
        $stok = Stok::all();
        return response()->json($stok);
    }

    
    public function store(Request $request)
    {
        $stok = new Stok();

        $stok->id_katalog = $request->id_katalog;
        $stok->id_pelanggan = $request->id_pelanggan;
        $stok->stok_dijual = $request->stok_dijual;
        $stok->modified_by = $request->modified_by;

        $stok->save();

        return response()->json($stok);
    }

   
    public function show($id)
    {
        $stok = Stok::where('id_pelanggan',$id)->get();
        return response()->json($stok);
    }

    public function update(Request $request, Stok $stok)
    {
        $stok->id_katalog = $request->id_katalog;
        $stok->id_pelanggan = $request->id_pelanggan;
        $stok->stok_dijual = $request->stok_dijual;
        $stok->modified_by = $request->modified_by;

        $stok->save();

        return response()->json($stok);
    }

   
    public function destroy(Stok $stok)
    {
        $stok->delete();

        return response()->json($stok);
    }

    public function deleteMany($id_pelanggan)
    {
        $stok = Stok::where('id_pelanggan',$id_pelanggan)->delete();

        return response()->json($stok);
    }
}
