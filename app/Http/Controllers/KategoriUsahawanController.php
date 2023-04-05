<?php

namespace App\Http\Controllers;

use App\Models\Kategori_Usahawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriUsahawanController extends Controller
{
    public function index()
    {
        $kategori = DB::table('kategori_usahawans')->get();

        // dd($daerah);
        return response()->json($kategori);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
