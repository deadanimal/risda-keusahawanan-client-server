<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TanamanController extends Controller
{
    
    public function index()
    {
        $tanaman = DB::table('jenis_tanamen')->get();

       
        return response()->json($tanaman);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $tanaman = DB::table('jenis_tanamen')->insert(
            [
                'tanahid' => $id,
                'jenis_tanaman_kebun' => $request->Jenis_Tanaman,
            ]
        );

        return response()->json($tanaman);
    }

    
    public function destroy($id)
    {
        $tanaman = DB::table('jenis_tanamen')->where('tanahid', $id)->delete();

        return response()->json($tanaman);
    }
}
