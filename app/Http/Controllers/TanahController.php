<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TanahController extends Controller
{

    public function index()
    {
        $tanah = DB::table('tanahs')->get();


        return response()->json($tanah);
    }


    public function update(Request $request, $id)
    {

        $tanah = DB::table('tanahs')->insertGetId(
            [
                'pekebunid' => $id,
                'No_Geran' => $request->No_Geran,
                'No_Lot' => $request->No_Lot,
                'U_Negeri_ID' => $request->U_Negeri_ID,
                'U_Daerah_ID' => $request->U_Daerah_ID,
                'U_Mukim_ID' => $request->U_Mukim_ID,
                'U_Parlimen_ID' => $request->U_Parlimen_ID,
                'U_Dun_ID' => $request->U_Dun_ID,
                'U_Kampung_ID' => $request->U_Kampung_ID,
                'U_Seksyen_ID' => $request->U_Seksyen_ID,
                'keluasan_hektar' => $request->Luas_Lot,
            ]
        );

        return response()->json($tanah);
    }


    public function destroy($id)
    {
        $tanahs = DB::table('tanahs')->where('pekebunid', $id)
            ->get();

        foreach ($tanahs as $tanah) {
            DB::table('jenis_tanamen')->where('tanahid', $tanah->id)
                ->delete();
        }

        DB::table('tanahs')->where('pekebunid', $id)
            ->delete();

        return response()->json($tanahs);
    }
}
