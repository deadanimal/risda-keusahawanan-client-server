<?php

namespace App\Http\Controllers\Web\LAT;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
// error_reporting( error_reporting() & ~E_NOTICE );
use App\Models\Usahawan;
use App\Models\Pegawai;
use App\Models\Negeri;
use App\Models\PusatTanggungjawab;
use App\Models\Mukim;
use App\Models\Report;

class PenyataUntungRugiControllerWeb extends Controller
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


        $getYear = date("Y");
        $reports = Report::where('type', 13)
        ->where('tab20', $authuser->id)
        ->where('tab1', $getYear)
        ->orderBy('tab1', 'ASC')
        ->orderBy('tab2', 'ASC')
        ->orderBy('tab3', 'ASC')
        ->get();

        $Hasil = new \stdClass();
        $Hasil->bul1 = 0;
        $Hasil->bul2 = 0;
        $Hasil->bul3 = 0;
        $Hasil->bul4 = 0;
        $Hasil->bul5 = 0;
        $Hasil->bul6 = 0;
        $Hasil->bul7 = 0;
        $Hasil->bul8 = 0;
        $Hasil->bul9 = 0;
        $Hasil->bul10 = 0;
        $Hasil->bul11 = 0;
        $Hasil->bul12 = 0;
        $Hasil->jumlah = 0;

        $Kos = new \stdClass();
        $Kos->bul1 = 0;
        $Kos->bul2 = 0;
        $Kos->bul3 = 0;
        $Kos->bul4 = 0;
        $Kos->bul5 = 0;
        $Kos->bul6 = 0;
        $Kos->bul7 = 0;
        $Kos->bul8 = 0;
        $Kos->bul9 = 0;
        $Kos->bul10 = 0;
        $Kos->bul11 = 0;
        $Kos->bul12 = 0;
        $Kos->jumlah = 0;

        $Kasar = new \stdClass();
        $Kasar->bul1 = 0;
        $Kasar->bul2 = 0;
        $Kasar->bul3 = 0;
        $Kasar->bul4 = 0;
        $Kasar->bul5 = 0;
        $Kasar->bul6 = 0;
        $Kasar->bul7 = 0;
        $Kasar->bul8 = 0;
        $Kasar->bul9 = 0;
        $Kasar->bul10 = 0;
        $Kasar->bul11 = 0;
        $Kasar->bul12 = 0;
        $Kasar->jumlah = 0;

        $Perbelanjaan = new \stdClass();
        $Perbelanjaan->bul1 = 0;
        $Perbelanjaan->bul2 = 0;
        $Perbelanjaan->bul3 = 0;
        $Perbelanjaan->bul4 = 0;
        $Perbelanjaan->bul5 = 0;
        $Perbelanjaan->bul6 = 0;
        $Perbelanjaan->bul7 = 0;
        $Perbelanjaan->bul8 = 0;
        $Perbelanjaan->bul9 = 0;
        $Perbelanjaan->bul10 = 0;
        $Perbelanjaan->bul11 = 0;
        $Perbelanjaan->bul12 = 0;
        $Perbelanjaan->jumlah = 0;

        $Lain = new \stdClass();
        $Lain->bul1 = 0;
        $Lain->bul2 = 0;
        $Lain->bul3 = 0;
        $Lain->bul4 = 0;
        $Lain->bul5 = 0;
        $Lain->bul6 = 0;
        $Lain->bul7 = 0;
        $Lain->bul8 = 0;
        $Lain->bul9 = 0;
        $Lain->bul10 = 0;
        $Lain->bul11 = 0;
        $Lain->bul12 = 0;
        $Lain->jumlah = 0;

        $Bersih = new \stdClass();
        $Bersih->bul1 = 0;
        $Bersih->bul2 = 0;
        $Bersih->bul3 = 0;
        $Bersih->bul4 = 0;
        $Bersih->bul5 = 0;
        $Bersih->bul6 = 0;
        $Bersih->bul7 = 0;
        $Bersih->bul8 = 0;
        $Bersih->bul9 = 0;
        $Bersih->bul10 = 0;
        $Bersih->bul11 = 0;
        $Bersih->bul12 = 0;
        $Bersih->jumlah = 0;

        foreach ($reports as $report) {
            if($report->tab3 == 1){
                if($report->tab2 == 1){
                    $Hasil->bul1 = $Hasil->bul1 + $report->tab4;
                }else if($report->tab2 == 2){
                    $Hasil->bul2 = $Hasil->bul2 + $report->tab4;
                }else if($report->tab2 == 3){
                    $Hasil->bul3 = $Hasil->bul3 + $report->tab4;
                }else if($report->tab2 == 4){
                    $Hasil->bul4 = $Hasil->bul4 + $report->tab4;
                }else if($report->tab2 == 5){
                    $Hasil->bul5 = $Hasil->bul5 + $report->tab4;
                }else if($report->tab2 == 6){
                    $Hasil->bul6 = $Hasil->bul6 + $report->tab4;
                }else if($report->tab2 == 7){
                    $Hasil->bul7 = $Hasil->bul7 + $report->tab4;
                }else if($report->tab2 == 8){
                    $Hasil->bul8 = $Hasil->bul8 + $report->tab4;
                }else if($report->tab2 == 9){
                    $Hasil->bul9 = $Hasil->bul9 + $report->tab4;
                }else if($report->tab2 == 10){
                    $Hasil->bul10 = $Hasil->bul10 + $report->tab4;
                }else if($report->tab2 == 11){
                    $Hasil->bul11 = $Hasil->bul11 + $report->tab4;
                }else if($report->tab2 == 12){
                    $Hasil->bul12 = $Hasil->bul12 + $report->tab4;
                }
                
            }else if($report->tab3 == 2){
                if($report->tab2 == 1){
                    $Kos->bul1 = $Kos->bul1 + $report->tab4;
                }else if($report->tab2 == 2){
                    $Kos->bul2 = $Kos->bul2 + $report->tab4;
                }else if($report->tab2 == 3){
                    $Kos->bul3 = $Kos->bul3 + $report->tab4;
                }else if($report->tab2 == 4){
                    $Kos->bul4 = $Kos->bul4 + $report->tab4;
                }else if($report->tab2 == 5){
                    $Kos->bul5 = $Kos->bul5 + $report->tab4;
                }else if($report->tab2 == 6){
                    $Kos->bul6 = $Kos->bul6 + $report->tab4;
                }else if($report->tab2 == 7){
                    $Kos->bul7 = $Kos->bul7 + $report->tab4;
                }else if($report->tab2 == 8){
                    $Kos->bul8 = $Kos->bul8 + $report->tab4;
                }else if($report->tab2 == 9){
                    $Kos->bul9 = $Kos->bul9 + $report->tab4;
                }else if($report->tab2 == 10){
                    $Kos->bul10 = $Kos->bul10 + $report->tab4;
                }else if($report->tab2 == 11){
                    $Kos->bul11 = $Kos->bul11 + $report->tab4;
                }else if($report->tab2 == 12){
                    $Kos->bul12 = $Kos->bul12 + $report->tab4;
                }

            }else if($report->tab3 == 3){
                if($report->tab2 == 1){
                    $Perbelanjaan->bul1 = $Perbelanjaan->bul1 + $report->tab4;
                }else if($report->tab2 == 2){
                    $Perbelanjaan->bul2 = $Perbelanjaan->bul2 + $report->tab4;
                }else if($report->tab2 == 3){
                    $Perbelanjaan->bul3 = $Perbelanjaan->bul3 + $report->tab4;
                }else if($report->tab2 == 4){
                    $Perbelanjaan->bul4 = $Perbelanjaan->bul4 + $report->tab4;
                }else if($report->tab2 == 5){
                    $Perbelanjaan->bul5 = $Perbelanjaan->bul5 + $report->tab4;
                }else if($report->tab2 == 6){
                    $Perbelanjaan->bul6 = $Perbelanjaan->bul6 + $report->tab4;
                }else if($report->tab2 == 7){
                    $Perbelanjaan->bul7 = $Perbelanjaan->bul7 + $report->tab4;
                }else if($report->tab2 == 8){
                    $Perbelanjaan->bul8 = $Perbelanjaan->bul8 + $report->tab4;
                }else if($report->tab2 == 9){
                    $Perbelanjaan->bul9 = $Perbelanjaan->bul9 + $report->tab4;
                }else if($report->tab2 == 10){
                    $Perbelanjaan->bul10 = $Perbelanjaan->bul10 + $report->tab4;
                }else if($report->tab2 == 11){
                    $Perbelanjaan->bul11 = $Perbelanjaan->bul11 + $report->tab4;
                }else if($report->tab2 == 12){
                    $Perbelanjaan->bul12 = $Perbelanjaan->bul12 + $report->tab4;
                }

            }else if($report->tab3 == 4){
                if($report->tab2 == 1){
                    $Lain->bul1 = $Lain->bul1 + $report->tab4;
                }else if($report->tab2 == 2){
                    $Lain->bul2 = $Lain->bul2 + $report->tab4;
                }else if($report->tab2 == 3){
                    $Lain->bul3 = $Lain->bul3 + $report->tab4;
                }else if($report->tab2 == 4){
                    $Lain->bul4 = $Lain->bul4 + $report->tab4;
                }else if($report->tab2 == 5){
                    $Lain->bul5 = $Lain->bul5 + $report->tab4;
                }else if($report->tab2 == 6){
                    $Lain->bul6 = $Lain->bul6 + $report->tab4;
                }else if($report->tab2 == 7){
                    $Lain->bul7 = $Lain->bul7 + $report->tab4;
                }else if($report->tab2 == 8){
                    $Lain->bul8 = $Lain->bul8 + $report->tab4;
                }else if($report->tab2 == 9){
                    $Lain->bul9 = $Lain->bul9 + $report->tab4;
                }else if($report->tab2 == 10){
                    $Lain->bul10 = $Lain->bul10 + $report->tab4;
                }else if($report->tab2 == 11){
                    $Lain->bul11 = $Lain->bul11 + $report->tab4;
                }else if($report->tab2 == 12){
                    $Lain->bul12 = $Lain->bul12 + $report->tab4;
                }
                
            }
            
            
        }
        $Hasil->jumlah = $Hasil->bul1 + $Hasil->bul2 + $Hasil->bul3 + $Hasil->bul4 + $Hasil->bul5 + $Hasil->bul6 + $Hasil->bul7 + $Hasil->bul8 + $Hasil->bul9 + $Hasil->bul10 + $Hasil->bul11 + $Hasil->bul12;
        $Kos->jumlah = $Kos->bul1 + $Kos->bul2 + $Kos->bul3 + $Kos->bul4 + $Kos->bul5 + $Kos->bul6 + $Kos->bul7 + $Kos->bul8 + $Kos->bul9 + $Kos->bul10 + $Kos->bul11 + $Kos->bul12;
        
        $Kasar->bul1 = $Hasil->bul1 - $Kos->bul1;
        $Kasar->bul2 = $Hasil->bul2 - $Kos->bul2;
        $Kasar->bul3 = $Hasil->bul3 - $Kos->bul3;
        $Kasar->bul4 = $Hasil->bul4 - $Kos->bul4;
        $Kasar->bul5 = $Hasil->bul5 - $Kos->bul5;
        $Kasar->bul6 = $Hasil->bul6 - $Kos->bul6;
        $Kasar->bul7 = $Hasil->bul7 - $Kos->bul7;
        $Kasar->bul8 = $Hasil->bul8 - $Kos->bul8;
        $Kasar->bul9 = $Hasil->bul9 - $Kos->bul9;
        $Kasar->bul10 = $Hasil->bul10 - $Kos->bul10;
        $Kasar->bul11 = $Hasil->bul11 - $Kos->bul11;
        $Kasar->bul12 = $Hasil->bul12 - $Kos->bul12;
        $Kasar->jumlah = $Hasil->jumlah - $Kos->jumlah;

        $Perbelanjaan->jumlah = $Perbelanjaan->bul1 + $Perbelanjaan->bul2 + $Perbelanjaan->bul3 + $Perbelanjaan->bul4 + $Perbelanjaan->bul5 + $Perbelanjaan->bul6 + $Perbelanjaan->bul7 + $Perbelanjaan->bul8 + $Perbelanjaan->bul9 + $Perbelanjaan->bul10 + $Perbelanjaan->bul11 + $Perbelanjaan->bul12;
        $Lain->jumlah = $Lain->bul1 + $Lain->bul2 + $Lain->bul3 + $Lain->bul4 + $Lain->bul5 + $Lain->bul6 + $Lain->bul7 + $Lain->bul8 + $Lain->bul9 + $Lain->bul10 + $Lain->bul11 + $Lain->bul12;
        
        $Bersih->bul1 = $Bersih->bul1 + $Kasar->bul1 + $Lain->bul1 - $Perbelanjaan->bul1;
        $Bersih->bul2 = $Bersih->bul2 + $Kasar->bul2 + $Lain->bul2 - $Perbelanjaan->bul2;
        $Bersih->bul3 = $Bersih->bul3 + $Kasar->bul3 + $Lain->bul3 - $Perbelanjaan->bul3;
        $Bersih->bul4 = $Bersih->bul4 + $Kasar->bul4 + $Lain->bul4 - $Perbelanjaan->bul4;
        $Bersih->bul5 = $Bersih->bul5 + $Kasar->bul5 + $Lain->bul5 - $Perbelanjaan->bul5;
        $Bersih->bul6 = $Bersih->bul6 + $Kasar->bul6 + $Lain->bul6 - $Perbelanjaan->bul6;
        $Bersih->bul7 = $Bersih->bul7 + $Kasar->bul7 + $Lain->bul7 - $Perbelanjaan->bul7;
        $Bersih->bul8 = $Bersih->bul8 + $Kasar->bul8 + $Lain->bul8 - $Perbelanjaan->bul8;
        $Bersih->bul9 = $Bersih->bul9 + $Kasar->bul9 + $Lain->bul9 - $Perbelanjaan->bul9;
        $Bersih->bul10 = $Bersih->bul10 + $Kasar->bul10 + $Lain->bul10 - $Perbelanjaan->bul10;
        $Bersih->bul11 = $Bersih->bul11 + $Kasar->bul11 + $Lain->bul11 - $Perbelanjaan->bul11;
        $Bersih->bul12 = $Bersih->bul12 + $Kasar->bul12 + $Lain->bul12 - $Perbelanjaan->bul12;
        $Bersih->jumlah = $Bersih->jumlah + $Kasar->jumlah + $Lain->jumlah - $Perbelanjaan->jumlah;

        return view('laporanalirantunai.penyatauntungrugi'
        ,[
            'users'=>$users,
            'Hasil'=>$Hasil,
            'Kos'=>$Kos,
            'Kasar'=>$Kasar,
            'Perbelanjaan'=>$Perbelanjaan,
            'Lain'=>$Lain,
            'Bersih'=>$Bersih
        ]
        );
    }

    public function show(Request $request)
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }

        if ($request->tahun != null){
            $getYear = $request->tahun;
        }else{
            $getYear = date("Y");
        }

        $reports = Report::where('type', 13)
        ->where('tab20', $authuser->id)
        ->where('tab1', $getYear)
        ->orderBy('tab1', 'ASC')
        ->orderBy('tab2', 'ASC')
        ->orderBy('tab3', 'ASC')
        ->get();

        $Hasil = new \stdClass();
        $Hasil->bul1 = 0;
        $Hasil->bul2 = 0;
        $Hasil->bul3 = 0;
        $Hasil->bul4 = 0;
        $Hasil->bul5 = 0;
        $Hasil->bul6 = 0;
        $Hasil->bul7 = 0;
        $Hasil->bul8 = 0;
        $Hasil->bul9 = 0;
        $Hasil->bul10 = 0;
        $Hasil->bul11 = 0;
        $Hasil->bul12 = 0;
        $Hasil->jumlah = 0;

        $Kos = new \stdClass();
        $Kos->bul1 = 0;
        $Kos->bul2 = 0;
        $Kos->bul3 = 0;
        $Kos->bul4 = 0;
        $Kos->bul5 = 0;
        $Kos->bul6 = 0;
        $Kos->bul7 = 0;
        $Kos->bul8 = 0;
        $Kos->bul9 = 0;
        $Kos->bul10 = 0;
        $Kos->bul11 = 0;
        $Kos->bul12 = 0;
        $Kos->jumlah = 0;

        $Kasar = new \stdClass();
        $Kasar->bul1 = 0;
        $Kasar->bul2 = 0;
        $Kasar->bul3 = 0;
        $Kasar->bul4 = 0;
        $Kasar->bul5 = 0;
        $Kasar->bul6 = 0;
        $Kasar->bul7 = 0;
        $Kasar->bul8 = 0;
        $Kasar->bul9 = 0;
        $Kasar->bul10 = 0;
        $Kasar->bul11 = 0;
        $Kasar->bul12 = 0;
        $Kasar->jumlah = 0;

        $Perbelanjaan = new \stdClass();
        $Perbelanjaan->bul1 = 0;
        $Perbelanjaan->bul2 = 0;
        $Perbelanjaan->bul3 = 0;
        $Perbelanjaan->bul4 = 0;
        $Perbelanjaan->bul5 = 0;
        $Perbelanjaan->bul6 = 0;
        $Perbelanjaan->bul7 = 0;
        $Perbelanjaan->bul8 = 0;
        $Perbelanjaan->bul9 = 0;
        $Perbelanjaan->bul10 = 0;
        $Perbelanjaan->bul11 = 0;
        $Perbelanjaan->bul12 = 0;
        $Perbelanjaan->jumlah = 0;

        $Lain = new \stdClass();
        $Lain->bul1 = 0;
        $Lain->bul2 = 0;
        $Lain->bul3 = 0;
        $Lain->bul4 = 0;
        $Lain->bul5 = 0;
        $Lain->bul6 = 0;
        $Lain->bul7 = 0;
        $Lain->bul8 = 0;
        $Lain->bul9 = 0;
        $Lain->bul10 = 0;
        $Lain->bul11 = 0;
        $Lain->bul12 = 0;
        $Lain->jumlah = 0;

        $Bersih = new \stdClass();
        $Bersih->bul1 = 0;
        $Bersih->bul2 = 0;
        $Bersih->bul3 = 0;
        $Bersih->bul4 = 0;
        $Bersih->bul5 = 0;
        $Bersih->bul6 = 0;
        $Bersih->bul7 = 0;
        $Bersih->bul8 = 0;
        $Bersih->bul9 = 0;
        $Bersih->bul10 = 0;
        $Bersih->bul11 = 0;
        $Bersih->bul12 = 0;
        $Bersih->jumlah = 0;

        foreach ($reports as $report) {
            if($report->tab3 == 1){
                if($report->tab2 == 1){
                    $Hasil->bul1 = $Hasil->bul1 + $report->tab4;
                }else if($report->tab2 == 2){
                    $Hasil->bul2 = $Hasil->bul2 + $report->tab4;
                }else if($report->tab2 == 3){
                    $Hasil->bul3 = $Hasil->bul3 + $report->tab4;
                }else if($report->tab2 == 4){
                    $Hasil->bul4 = $Hasil->bul4 + $report->tab4;
                }else if($report->tab2 == 5){
                    $Hasil->bul5 = $Hasil->bul5 + $report->tab4;
                }else if($report->tab2 == 6){
                    $Hasil->bul6 = $Hasil->bul6 + $report->tab4;
                }else if($report->tab2 == 7){
                    $Hasil->bul7 = $Hasil->bul7 + $report->tab4;
                }else if($report->tab2 == 8){
                    $Hasil->bul8 = $Hasil->bul8 + $report->tab4;
                }else if($report->tab2 == 9){
                    $Hasil->bul9 = $Hasil->bul9 + $report->tab4;
                }else if($report->tab2 == 10){
                    $Hasil->bul10 = $Hasil->bul10 + $report->tab4;
                }else if($report->tab2 == 11){
                    $Hasil->bul11 = $Hasil->bul11 + $report->tab4;
                }else if($report->tab2 == 12){
                    $Hasil->bul12 = $Hasil->bul12 + $report->tab4;
                }
                
            }else if($report->tab3 == 2){
                if($report->tab2 == 1){
                    $Kos->bul1 = $Kos->bul1 + $report->tab4;
                }else if($report->tab2 == 2){
                    $Kos->bul2 = $Kos->bul2 + $report->tab4;
                }else if($report->tab2 == 3){
                    $Kos->bul3 = $Kos->bul3 + $report->tab4;
                }else if($report->tab2 == 4){
                    $Kos->bul4 = $Kos->bul4 + $report->tab4;
                }else if($report->tab2 == 5){
                    $Kos->bul5 = $Kos->bul5 + $report->tab4;
                }else if($report->tab2 == 6){
                    $Kos->bul6 = $Kos->bul6 + $report->tab4;
                }else if($report->tab2 == 7){
                    $Kos->bul7 = $Kos->bul7 + $report->tab4;
                }else if($report->tab2 == 8){
                    $Kos->bul8 = $Kos->bul8 + $report->tab4;
                }else if($report->tab2 == 9){
                    $Kos->bul9 = $Kos->bul9 + $report->tab4;
                }else if($report->tab2 == 10){
                    $Kos->bul10 = $Kos->bul10 + $report->tab4;
                }else if($report->tab2 == 11){
                    $Kos->bul11 = $Kos->bul11 + $report->tab4;
                }else if($report->tab2 == 12){
                    $Kos->bul12 = $Kos->bul12 + $report->tab4;
                }

            }else if($report->tab3 == 3){
                if($report->tab2 == 1){
                    $Perbelanjaan->bul1 = $Perbelanjaan->bul1 + $report->tab4;
                }else if($report->tab2 == 2){
                    $Perbelanjaan->bul2 = $Perbelanjaan->bul2 + $report->tab4;
                }else if($report->tab2 == 3){
                    $Perbelanjaan->bul3 = $Perbelanjaan->bul3 + $report->tab4;
                }else if($report->tab2 == 4){
                    $Perbelanjaan->bul4 = $Perbelanjaan->bul4 + $report->tab4;
                }else if($report->tab2 == 5){
                    $Perbelanjaan->bul5 = $Perbelanjaan->bul5 + $report->tab4;
                }else if($report->tab2 == 6){
                    $Perbelanjaan->bul6 = $Perbelanjaan->bul6 + $report->tab4;
                }else if($report->tab2 == 7){
                    $Perbelanjaan->bul7 = $Perbelanjaan->bul7 + $report->tab4;
                }else if($report->tab2 == 8){
                    $Perbelanjaan->bul8 = $Perbelanjaan->bul8 + $report->tab4;
                }else if($report->tab2 == 9){
                    $Perbelanjaan->bul9 = $Perbelanjaan->bul9 + $report->tab4;
                }else if($report->tab2 == 10){
                    $Perbelanjaan->bul10 = $Perbelanjaan->bul10 + $report->tab4;
                }else if($report->tab2 == 11){
                    $Perbelanjaan->bul11 = $Perbelanjaan->bul11 + $report->tab4;
                }else if($report->tab2 == 12){
                    $Perbelanjaan->bul12 = $Perbelanjaan->bul12 + $report->tab4;
                }

            }else if($report->tab3 == 4){
                if($report->tab2 == 1){
                    $Lain->bul1 = $Lain->bul1 + $report->tab4;
                }else if($report->tab2 == 2){
                    $Lain->bul2 = $Lain->bul2 + $report->tab4;
                }else if($report->tab2 == 3){
                    $Lain->bul3 = $Lain->bul3 + $report->tab4;
                }else if($report->tab2 == 4){
                    $Lain->bul4 = $Lain->bul4 + $report->tab4;
                }else if($report->tab2 == 5){
                    $Lain->bul5 = $Lain->bul5 + $report->tab4;
                }else if($report->tab2 == 6){
                    $Lain->bul6 = $Lain->bul6 + $report->tab4;
                }else if($report->tab2 == 7){
                    $Lain->bul7 = $Lain->bul7 + $report->tab4;
                }else if($report->tab2 == 8){
                    $Lain->bul8 = $Lain->bul8 + $report->tab4;
                }else if($report->tab2 == 9){
                    $Lain->bul9 = $Lain->bul9 + $report->tab4;
                }else if($report->tab2 == 10){
                    $Lain->bul10 = $Lain->bul10 + $report->tab4;
                }else if($report->tab2 == 11){
                    $Lain->bul11 = $Lain->bul11 + $report->tab4;
                }else if($report->tab2 == 12){
                    $Lain->bul12 = $Lain->bul12 + $report->tab4;
                }
                
            }
            
            
        }
        $Hasil->jumlah = $Hasil->bul1 + $Hasil->bul2 + $Hasil->bul3 + $Hasil->bul4 + $Hasil->bul5 + $Hasil->bul6 + $Hasil->bul7 + $Hasil->bul8 + $Hasil->bul9 + $Hasil->bul10 + $Hasil->bul11 + $Hasil->bul12;
        $Kos->jumlah = $Kos->bul1 + $Kos->bul2 + $Kos->bul3 + $Kos->bul4 + $Kos->bul5 + $Kos->bul6 + $Kos->bul7 + $Kos->bul8 + $Kos->bul9 + $Kos->bul10 + $Kos->bul11 + $Kos->bul12;
        
        $Kasar->bul1 = $Hasil->bul1 - $Kos->bul1;
        $Kasar->bul2 = $Hasil->bul2 - $Kos->bul2;
        $Kasar->bul3 = $Hasil->bul3 - $Kos->bul3;
        $Kasar->bul4 = $Hasil->bul4 - $Kos->bul4;
        $Kasar->bul5 = $Hasil->bul5 - $Kos->bul5;
        $Kasar->bul6 = $Hasil->bul6 - $Kos->bul6;
        $Kasar->bul7 = $Hasil->bul7 - $Kos->bul7;
        $Kasar->bul8 = $Hasil->bul8 - $Kos->bul8;
        $Kasar->bul9 = $Hasil->bul9 - $Kos->bul9;
        $Kasar->bul10 = $Hasil->bul10 - $Kos->bul10;
        $Kasar->bul11 = $Hasil->bul11 - $Kos->bul11;
        $Kasar->bul12 = $Hasil->bul12 - $Kos->bul12;
        $Kasar->jumlah = $Hasil->jumlah - $Kos->jumlah;

        $Perbelanjaan->jumlah = $Perbelanjaan->bul1 + $Perbelanjaan->bul2 + $Perbelanjaan->bul3 + $Perbelanjaan->bul4 + $Perbelanjaan->bul5 + $Perbelanjaan->bul6 + $Perbelanjaan->bul7 + $Perbelanjaan->bul8 + $Perbelanjaan->bul9 + $Perbelanjaan->bul10 + $Perbelanjaan->bul11 + $Perbelanjaan->bul12;
        $Lain->jumlah = $Lain->bul1 + $Lain->bul2 + $Lain->bul3 + $Lain->bul4 + $Lain->bul5 + $Lain->bul6 + $Lain->bul7 + $Lain->bul8 + $Lain->bul9 + $Lain->bul10 + $Lain->bul11 + $Lain->bul12;
        
        $Bersih->bul1 = $Bersih->bul1 + $Kasar->bul1 + $Lain->bul1 - $Perbelanjaan->bul1;
        $Bersih->bul2 = $Bersih->bul2 + $Kasar->bul2 + $Lain->bul2 - $Perbelanjaan->bul2;
        $Bersih->bul3 = $Bersih->bul3 + $Kasar->bul3 + $Lain->bul3 - $Perbelanjaan->bul3;
        $Bersih->bul4 = $Bersih->bul4 + $Kasar->bul4 + $Lain->bul4 - $Perbelanjaan->bul4;
        $Bersih->bul5 = $Bersih->bul5 + $Kasar->bul5 + $Lain->bul5 - $Perbelanjaan->bul5;
        $Bersih->bul6 = $Bersih->bul6 + $Kasar->bul6 + $Lain->bul6 - $Perbelanjaan->bul6;
        $Bersih->bul7 = $Bersih->bul7 + $Kasar->bul7 + $Lain->bul7 - $Perbelanjaan->bul7;
        $Bersih->bul8 = $Bersih->bul8 + $Kasar->bul8 + $Lain->bul8 - $Perbelanjaan->bul8;
        $Bersih->bul9 = $Bersih->bul9 + $Kasar->bul9 + $Lain->bul9 - $Perbelanjaan->bul9;
        $Bersih->bul10 = $Bersih->bul10 + $Kasar->bul10 + $Lain->bul10 - $Perbelanjaan->bul10;
        $Bersih->bul11 = $Bersih->bul11 + $Kasar->bul11 + $Lain->bul11 - $Perbelanjaan->bul11;
        $Bersih->bul12 = $Bersih->bul12 + $Kasar->bul12 + $Lain->bul12 - $Perbelanjaan->bul12;
        $Bersih->jumlah = $Bersih->jumlah + $Kasar->jumlah + $Lain->jumlah - $Perbelanjaan->jumlah;

        $result = '
        <tr class="align-middle">
            <td class="text-nowrap">HASIL JUALAN</td>
            <td class="text-nowrap">'.number_format($Hasil->bul1,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->bul2,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->bul3,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->bul4,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->bul5,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->bul6,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->bul7,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->bul8,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->bul9,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->bul10,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->bul11,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->bul12,2).'</td>
            <td class="text-nowrap">'.number_format($Hasil->jumlah,2).'</td>
        </tr>
        <tr class="align-middle">
            <td class="text-nowrap">KOS JUALAN</td>
            <td class="text-nowrap">'.number_format($Kos->bul1,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->bul2,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->bul3,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->bul4,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->bul5,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->bul6,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->bul7,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->bul8,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->bul9,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->bul10,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->bul11,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->bul12,2).'</td>
            <td class="text-nowrap">'.number_format($Kos->jumlah,2).'</td>
        </tr>
        <tr class="align-middle">
            <td class="text-nowrap">UNTUNG/RUGI KASAR</td>
            <td class="text-nowrap">'.number_format($Kasar->bul1,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->bul2,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->bul3,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->bul4,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->bul5,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->bul6,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->bul7,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->bul8,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->bul9,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->bul10,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->bul11,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->bul12,2).'</td>
            <td class="text-nowrap">'.number_format($Kasar->jumlah,2).'</td>
        </tr>
        <tr class="align-middle">
            <td class="text-nowrap">PERBELANJAAN PENTADBIRAN & OPERASI</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul1,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul2,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul3,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul4,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul5,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul6,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul7,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul8,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul9,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul10,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul11,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->bul12,2).'</td>
            <td class="text-nowrap">'.number_format($Perbelanjaan->jumlah,2).'</td>
        </tr>
        <tr class="align-middle">
            <td class="text-nowrap">HASIL-HASIL LAIN</td>
            <td class="text-nowrap">'.number_format($Lain->bul1,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->bul2,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->bul3,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->bul4,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->bul5,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->bul6,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->bul7,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->bul8,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->bul9,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->bul10,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->bul11,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->bul12,2).'</td>
            <td class="text-nowrap">'.number_format($Lain->jumlah,2).'</td>
        </tr>
        <tr class="align-middle">
            <td class="text-nowrap">UNTUNG/RUGI BERSIH</td>
            <td class="text-nowrap">'.number_format($Bersih->bul1,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->bul2,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->bul3,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->bul4,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->bul5,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->bul6,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->bul7,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->bul8,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->bul9,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->bul10,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->bul11,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->bul12,2).'</td>
            <td class="text-nowrap">'.number_format($Bersih->jumlah,2).'</td>
        </tr>
        ';

        return $result;
    }
}
