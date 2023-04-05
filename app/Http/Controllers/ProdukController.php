<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return response()->json($produk);
    }

    public function store(Request $request)
    {
        $produk = new Produk();

        $produk->perniagaanid= $request->perniagaanid;
        $produk->jenamaproduk= $request->jenamaproduk;
        $produk->unitmatrik= $request->unitmatrik;
        $produk->kapasitimaksimum= $request->kapasitimaksimum;
        $produk->kapasitisemasa= $request->kapasitisemasa;
        $produk->hargaperunit= $request->hargaperunit;
        $produk->modified_by= $request->modified_by;

        $produk->save();

        return response()->json($produk);
    }

    public function show( $id)
    {
        $produk = Produk::where('perniagaanid', $id)->get();

        return response()->json($produk);
    }

    
    public function edit(Produk $produk)
    {
        return view('produk.edit', [
            'produk' => $produk
        ]);
    }

    
    public function update(Request $request, Produk $produk)
    {
        // $produk->perniagaanid= $request->perniagaanid;
        // $produk->perniagaanid= $request->perniagaanid;
        $produk->jenamaproduk= $request->jenamaproduk;
        $produk->unitmatrik= $request->unitmatrik;
        $produk->kapasitimaksimum= $request->kapasitimaksimum;
        $produk->kapasitisemasa= $request->kapasitisemasa;
        $produk->hargaperunit= $request->hargaperunit;
        $produk->modified_by= $request->modified_by;

        $produk->save();

        return response()->json($produk);
    }

    
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return response()->json($produk);
    }
}
