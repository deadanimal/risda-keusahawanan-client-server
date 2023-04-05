<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PusatTanggungjawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PTController extends Controller
{
    public function index()
    {
        $pt = DB::table('pusat_tanggungjawabs')->get();

        // dd($daerah);
        return response()->json($pt);
    }


    public function senaraiPTPunPud($id_pegawai)
    {
        $negeri_pegawai = DB::table('pegawais')->where('pegawais.id', $id_pegawai)
            ->join('pusat_tanggungjawabs', 'pusat_tanggungjawabs.Kod_PT', 'pegawais.NamaPT')
            ->join('negeris', 'negeris.Negeri_Rkod', 'pusat_tanggungjawabs.Negeri_Rkod')
            ->select('pusat_tanggungjawabs.*')
            ->get()->first();

        if (!$negeri_pegawai) {
            return [
                'code'=>404,
                'message'=>'Pegawai ID '.$id_pegawai.' not found',
            ];
        }
        $pt = DB::table('pusat_tanggungjawabs')->where('pusat_tanggungjawabs.Negeri_Rkod', $negeri_pegawai->Negeri_Rkod)
            ->get();

        return response()->json($pt);
    }

}
