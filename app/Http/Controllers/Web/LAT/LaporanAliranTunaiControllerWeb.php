<?php

namespace App\Http\Controllers\Web\LAT;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Usahawan;
use App\Models\Pegawai;
use App\Models\Negeri;
use App\Models\PusatTanggungjawab;
use App\Models\Mukim;

class LaporanAliranTunaiControllerWeb extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        if(isset($authuser)){
            $authpegawai = Pegawai::where('id', $authuser->idpegawai)->first();
        }else{
            return redirect('/landing');
        }

        $authmukim = Mukim::where('U_Mukim_ID', $authpegawai->mukim)->first();
        if($authuser->role == 1 || $authuser->role == 2){
            $users = Usahawan::select('id','namausahawan','U_Negeri_ID','Kod_PT')->with(['PT','negeri'])->without(['user','pekebun','daerah','dun','parlimen','perniagaan','kateusah','syarikat','insentif','etnik','mukim','kampung','seksyen'])->get();
        }else if($authuser->role == 3 || $authuser->role == 5){
            $users = Usahawan::where('U_Negeri_ID', $authmukim->U_Negeri_ID)->get();
        }else if($authuser->role == 4 || $authuser->role == 6){
            $users = Usahawan::where('U_Daerah_ID', $authmukim->U_Daerah_ID)->get();
        }else if($authuser->role == 7){
            $users = Usahawan::where('Kod_PT', $authpegawai->NamaPT)->get();
        }else{
            return redirect('/landing');
        }

        // foreach ($users as $usahawan) {
        //     $negeri = Negeri::where('U_Negeri_ID', $usahawan->U_Negeri_ID)->first();
        //     if(isset($negeri)){
        //         $usahawan->negeri = $negeri->Negeri;
        //     }
        //     $PT = PusatTanggungjawab::where('Kod_PT', $usahawan->Kod_PT)->first();
        //     if(isset($PT)){
        //         $usahawan->PusatTang = $PT->keterangan;
        //     }
        // }

        return view('laporanalirantunai.index'
        ,[
            'users'=>$users
        ]
        );
    }

}
