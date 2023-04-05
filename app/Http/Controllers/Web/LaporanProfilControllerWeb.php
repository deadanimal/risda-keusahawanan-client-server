<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// error_reporting(0);
// ini_set('memory_limit', '-1');
// ini_set('max_execution_time', 180);
use Illuminate\Support\Facades\Auth;

use App\Models\Insentif;
use App\Models\Report;
use App\Models\User;
use App\Models\Usahawan;
use App\Models\Perniagaan;
use App\Models\Aliran;
use App\Models\KategoriAliran;
use App\Models\Lawatan;
use App\Models\Pegawai;
use App\Models\Mukim;
use App\Models\PusatTanggungjawab;
use App\Models\Negeri;
use App\Models\Daerah;
use App\Models\Dun;
use App\Models\Parlimen;
use App\Models\Pekebun;
use App\Models\KategoriUsahawan;
use App\Models\Syarikat;
use App\Models\JenisPerniagaan;
use App\Models\JenisInsentif;

use App\Exports\LapProf;
use Maatwebsite\Excel\Facades\Excel;

class LaporanProfilControllerWeb extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $authpegawai = Pegawai::where('id', $authuser->idpegawai)->first();

        if($authuser->role == 1 || $authuser->role == 2){
            $users = Usahawan::select('namausahawan','Kod_PT','U_Negeri_ID','id')->with(['PT','negeri'])->without(['user','pekebun','daerah','dun','parlimen','perniagaan','kateusah','syarikat','insentif','etnik','mukim','kampung','seksyen'])->get();
            $ddNegeri = Negeri::select('U_Negeri_ID','Negeri')->get();
            // take(10)->get();
            // all();
        }else if($authuser->role == 3 || $authuser->role == 5){
            $users = Usahawan::where('U_Negeri_ID', $authpegawai->Mukim->U_Negeri_ID)->get();
            $ddNegeri = Negeri::select('U_Negeri_ID','Negeri')->where('U_Negeri_ID', $authpegawai->Mukim->U_Negeri_ID)->get();
        }else if($authuser->role == 4 || $authuser->role == 6){
            $users = Usahawan::where('U_Daerah_ID', $authpegawai->Mukim->U_Daerah_ID)->get();
            $ddNegeri = Negeri::select('U_Negeri_ID','Negeri')->where('U_Negeri_ID', $authpegawai->Mukim->U_Negeri_ID)->get();
        }else if($authuser->role == 7){
            $users = Usahawan::where('Kod_PT', $authpegawai->NamaPT)->get();
            $ddNegeri = Negeri::select('U_Negeri_ID','Negeri')->where('U_Negeri_ID', $authpegawai->Mukim->U_Negeri_ID)->get();
        }else{
            return redirect('/landing');
        }

        $ddPT = PusatTanggungjawab::where('status', 1)->get();
        
        return view('laporanprofil.index'
        ,[
            'users'=>$users,
            'ddPT'=>$ddPT,
            'ddNegeri'=>$ddNegeri
        ]
        );
    }

    public function show($id)
    {
        try{
            $users = Usahawan::where('id', $id)->first();
            $insentif2 = '';
            // dd($users);
            $negeri = Negeri::where('U_Negeri_ID', $users->U_Negeri_ID)->first();
            if(isset($negeri)){
                $users->negeri = $negeri->Negeri;
            }else{
                $users->negeri = '';
            }

            $PT = PusatTanggungjawab::where('Kod_PT', $users->Kod_PT)->first();
            if(isset($PT)){
                $users->PusatTang = $PT->keterangan;
            }else{
                $users->PusatTang = '';
            }

            $dateOfBirth = $users->tarikhlahir;
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $users->umur = $diff->format('%y');

            if($users->U_Jantina_ID == 1){
                $users->jantina = "Lelaki";
            }else if($users->U_Jantina_ID == 2){
                $users->jantina = "Perempuan";
            }else{
                $users->jantina = "Lain - Lain";
            }

            $users->taraf_pendidikan = "";
            if($users->U_Pendidikan_ID == 1){
                $users->taraf_pendidikan = "Tidak Bersekolah";
            }else if($users->U_Pendidikan_ID == 2){
                $users->taraf_pendidikan = "Sekolah Rendah / Setara";
            }else if($users->U_Pendidikan_ID == 3){
                $users->taraf_pendidikan = "Sekolah Menengah / Setara";
            }else if($users->U_Pendidikan_ID == 4){
                $users->taraf_pendidikan = "Kolej / Universiti / Setara";
            }
            $users->taraf_pendidikan_tinggi = "";
            if($users->U_Taraf_Pendidikan_Tertinggi_ID == 1){
                $users->taraf_pendidikan_tinggi = "UPSR/PSRA/Setaraf";
            }else if($users->U_Taraf_Pendidikan_Tertinggi_ID == 2){
                $users->taraf_pendidikan_tinggi = "PMR/SRP/LCE/Setaraf";
            }else if($users->U_Taraf_Pendidikan_Tertinggi_ID == 3){
                $users->taraf_pendidikan_tinggi = "SPM/MCE/Setaraf";
            }else if($users->U_Taraf_Pendidikan_Tertinggi_ID == 4){
                $users->taraf_pendidikan_tinggi = "STPM/Diploma/Setaraf";
            }else if($users->U_Taraf_Pendidikan_Tertinggi_ID == 5){
                $users->taraf_pendidikan_tinggi = "Ijazah Pertama/Ke Atas";
            }else if($users->U_Taraf_Pendidikan_Tertinggi_ID == 6){
                $users->taraf_pendidikan_tinggi = "Tiada";
            }
            // $users->taraf_pendidikan_tinggi = $users->U_Taraf_Pendidikan_Tertinggi_ID;
            $daerah = Daerah::select('Daerah')->where('U_Daerah_ID', $users->U_Daerah_ID)->first();
            $users->daerah = $daerah->Daerah;
            $dun = Dun::select('Dun')->where('U_Dun_ID', $users->U_Dun_ID)->first();
            $users->dun = $dun->Dun;
            $parlimen = Parlimen::select('Parlimen')->where('U_Parlimen_ID', $users->U_Parlimen_ID)->first();
            $users->parlimen = $parlimen->Parlimen;
            $pekebun = Pekebun::where('usahawanid', $users->usahawanid)->first();
            if(isset($pekebun)){
                $users->PKnoTS = $pekebun->noTS;
                $users->PKnoKP = $pekebun->No_KP;
            }
            $temp = KategoriUsahawan::where('id_kategori_usahawan', $users->id_kategori_usahawan)->first();
            if(isset($temp)){
                $users->KateUsahawan = $temp->nama_kategori_usahawan;
            }
            $perniagaan = Perniagaan::where('usahawanid', $users->usahawanid)->first();
            if(isset($perniagaan)){
                $JnsPerniagaan = JenisPerniagaan::where('kod_jenis_perniagaan', $perniagaan->jenisperniagaan)->first();
                if(isset($JnsPerniagaan)){
                    $users->JenisPerniagaan = $JnsPerniagaan->nama_jenis_perniagaan;
                }
                $users->KlusterPerniagaan = $perniagaan->klusterperniagaan;
                $users->SubKlusterPerniagaan = $perniagaan->subkluster;
                if($perniagaan->facebook != ""){
                    $users->facebook = $perniagaan->facebook;
                    $users->MediumPemasaran = "&nbsp Facebook <br/>\n";
                    $users->AlamatMediumPemasaran =$users->AlamatMediumPemasaran."&nbsp Facebook - ".$perniagaan->facebook." <br>";
                }
                if($perniagaan->instagram != ""){
                    $users->MediumPemasaran .= "&nbsp Instagram <br/>\n";
                    $users->AlamatMediumPemasaran =$users->AlamatMediumPemasaran."&nbsp Instagram - ".$perniagaan->instagram."<br/>\n";

                }
                if($perniagaan->twitter != ""){
                    $users->MediumPemasaran .= "&nbsp Twitter ";
                    $users->AlamatMediumPemasaran =$users->AlamatMediumPemasaran."&nbsp Twitter - ".$perniagaan->twitter;

                }
                // $users->MediumPemasaran = "Facebook, Instagram, Twitter";
                // ."Instagram - " .$perniagaan->instagram."Twitter - ".$perniagaan->twitter;
                $users->latitud = $perniagaan->latitud;
                $users->logitud = $perniagaan->logitud;
            }
            $syarikat = Syarikat::where('usahawanid', $users->usahawanid)->first();
            if(isset($syarikat)){
                $users->namasyarikat = $syarikat->namasyarikat;
                if($syarikat->jenismilikanperniagaan == "JPP01"){
                    $users->jenismilikan = "PEMILIKAN TUNGGAL";
                }else if($syarikat->jenismilikanperniagaan == "JPP02"){
                    $users->jenismilikan = "PERKONGSIAN";
                }else if($syarikat->jenismilikanperniagaan == "JPP03"){
                    $users->jenismilikan = "SYARIKAT SDN BHD";
                }else if($syarikat->jenismilikanperniagaan == "JPP04"){
                    $users->jenismilikan = "PERKONGSIAN LIABILITI TERHAD";
                }
                
                $users->nodaftarssm = $syarikat->nodaftarssm;
                $users->alamatsyarikat = $syarikat->alamat1_ssm.",".$syarikat->alamat2_ssm.",".$syarikat->alamat3_ssm;
                $users->emailsyarikat = $syarikat->email;
                $users->nodaftarpersijilanhalal = $syarikat->nodaftarpersijilanhalal;
                
            }
            // dd($users->usahawanid);
            $insentif = Insentif::where('id_pengguna', $users->usahawanid)->orderBy('tahun_terima_insentif', 'desc')->first();
            if(isset($insentif)){
                $jenisinsentif = JenisInsentif::where('id_jenis_insentif', $insentif->id_jenis_insentif)->first();
                if(isset($jenisinsentif)){
                    $users->jnsbantuansemasa = $jenisinsentif->nama_insentif;
                }
                $users->kelulusanbantuansemasa = $insentif->nilai_insentif;
                $users->kelulusanbantuansemasa = number_format($users->kelulusanbantuansemasa,2);
                $users->thnbantuansemasa = $insentif->tahun_terima_insentif;
            }

            $insentif2 = Insentif::where('id_pengguna', $users->usahawanid)->get();
            if(isset($insentif2)){
                foreach ($insentif2 as $insentif2s) {
                    $jenisinsentif = JenisInsentif::where('id_jenis_insentif', $insentif2s->id_jenis_insentif)->first();
                    if(isset($jenisinsentif)){
                        $insentif2s->namainsen = $jenisinsentif->nama_insentif;
                    }
                }  
            }else{
                $insentif2 = '';
            }
             

            $pengguna = User::where('usahawanid', $users->usahawanid)->first();
            $getYear = date("Y");
            $alirans = Aliran::where('id_pengguna', $pengguna->id)->where('id_kategori_aliran',1)->whereYear('tarikh_aliran', '=', $getYear)->get();
            // dd($aliran);
            if(isset($alirans)){
                foreach ($alirans as $aliran) {
                    $aliran->bulan = date('m', strtotime($aliran->tarikh_aliran));
                    if($aliran->bulan == 1){
                        $users->aliran1 = $users->aliran1 + $aliran->jumlah_aliran;
                        $users->aliran1 = number_format($users->aliran1,2);
                    }else if($aliran->bulan == 2){
                        $users->aliran2 = $users->aliran2 + $aliran->jumlah_aliran;
                        $users->aliran2 = number_format($users->aliran2,2);
                    }else if($aliran->bulan == 3){
                        $users->aliran3 = $users->aliran3 + $aliran->jumlah_aliran;
                        $users->aliran3 = number_format($users->aliran3,2);
                    }else if($aliran->bulan == 4){
                        $users->aliran4 = $users->aliran4 + $aliran->jumlah_aliran;
                        $users->aliran4 = number_format($users->aliran4,2);
                    }else if($aliran->bulan == 5){
                        $users->aliran5 = $users->aliran5 + $aliran->jumlah_aliran;
                        $users->aliran5 = number_format($users->aliran5,2);
                    }else if($aliran->bulan == 6){
                        $users->aliran6 = $users->aliran6 + $aliran->jumlah_aliran;
                        $users->aliran6 = number_format($users->aliran6,2);
                    }else if($aliran->bulan == 7){
                        $users->aliran7 = $users->aliran7 + $aliran->jumlah_aliran;
                        $users->aliran7 = number_format($users->aliran7,2);
                    }else if($aliran->bulan == 8){
                        $users->aliran8 = $users->aliran8 + $aliran->jumlah_aliran;
                        $users->aliran8 = number_format($users->aliran8,2);
                    }else if($aliran->bulan == 9){
                        $users->aliran9 = $users->aliran9 + $aliran->jumlah_aliran;
                        $users->aliran9 = number_format($users->aliran9,2);
                    }else if($aliran->bulan == 10){
                        $users->aliran10 = $users->aliran10 + $aliran->jumlah_aliran;
                        $users->aliran10 = number_format($users->aliran10,2);
                    }else if($aliran->bulan == 11){
                        $users->aliran11 = $users->aliran11 + $aliran->jumlah_aliran;
                        $users->aliran11 = number_format($users->aliran11,2);
                    }else if($aliran->bulan == 12){
                        $users->aliran12 = $users->aliran12 + $aliran->jumlah_aliran;
                        $users->aliran12 = number_format($users->aliran12,2);
                    }
                    $users->jumaliran = $users->jumaliran + $aliran->jumlah_aliran;
                }
            }
            
            $users->purataaliran = $users->jumaliran / 12;
            $users->jumaliran = number_format($users->jumaliran,2);
            $users->purataaliran = number_format($users->purataaliran, 2);

            if($users->purataaliran >= 2500){
                $users->capaisasaran = "capai";
            }else{
                $users->capaisasaran = "tidak capai";
            }
        
        }catch(\Exception $e){
            $insentif2 = '';
        }

        return view('laporanprofil.profdetail'
        ,[
            'user'=>$users,
            'insentif2'=>$insentif2
        ]
        );
    }

    public function generatereport(Request $request)
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }

        $getYear = date("Y");
        if($request->type == 1){
            $loguser = Auth::user();
            if(isset($loguser->idpegawai)){
                $pegawai = Pegawai::where('id', $loguser->idpegawai)->first();
            }
            Report::where('tab20', $loguser->id)->where('type', 1)->delete();
            if($loguser->role == 1 || $loguser->role == 2){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'users.id')
                ->where('usahawans.U_Negeri_ID', '<>', '')
                ->get()->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID']);
            }else if($loguser->role == 3 || $loguser->role == 5){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'users.id')
                ->where('usahawans.U_Negeri_ID',$pegawai->Mukim->U_Negeri_ID)
                ->get()->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID']);
            }
            // return $insentifs;
            $table = new \stdClass();
            $table->U_Negeri_ID = 0;
            $table->id_jenis_insentif = 0;
            $table->tahun_terima_insentif = 0;
            $table->count = 0;
            $table->nilai_insentif = 0;
            $table->aliran = 0;
            
            if($insentifs->count()==0){
                return "Tiada Data Insentif Dijumpai";
            }else{
                foreach ($insentifs as $insentif) {
                    foreach ($insentif as $insentif1){
                        foreach ($insentif1 as $insentif2){
                            $table->U_Negeri_ID = 0;
                            $table->id_jenis_insentif = 0;
                            $table->tahun_terima_insentif = 0;
                            $table->count = 0;
                            $table->nilai_insentif = 0;
                            $table->aliran = 0;
                            foreach ($insentif2 as $insentif3){
                                $table->U_Negeri_ID = $insentif3->U_Negeri_ID;
                                $table->id_jenis_insentif = $insentif3->id_jenis_insentif;
                                $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                $table->count = $table->count + 1;
                                $table->nilai_insentif = $table->nilai_insentif + $insentif3->nilai_insentif;
                                $aliran = Aliran::where('id_pengguna', $insentif3->id)
                                ->where('id_kategori_aliran',1)
                                ->whereYear('tarikh_aliran', $getYear)
                                ->sum('jumlah_aliran');
                                $table->aliran = $table->aliran + $aliran;
                                
                            }
                            $this->newreport(1,$table,'');
                        }
                    }
                }
                return "Laporan Berjaya Dijana";
            }
            
        }

        if($request->type == 2){
            $loguser = Auth::user();
            if(isset($loguser->idpegawai)){
                $pegawai = Pegawai::where('id', $loguser->idpegawai)->first();
            }
            Report::where('tab20', $loguser->id)->where('type', 2)->delete();
            if($loguser->role == 1 || $loguser->role == 2){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID', 'users.id')
                ->where('usahawans.U_Negeri_ID', '<>', '')
                ->where('usahawans.U_Daerah_ID', '<>', '')
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID','U_Daerah_ID']);
            }else if($loguser->role == 3 || $loguser->role == 5){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID', 'users.id')
                ->where('usahawans.U_Negeri_ID',$pegawai->Mukim->U_Negeri_ID)
                ->where('usahawans.U_Daerah_ID', '<>', '')
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID','U_Daerah_ID']);
            }else if($loguser->role == 4 || $loguser->role == 6){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID', 'users.id')
                ->where('usahawans.U_Daerah_ID',$pegawai->Mukim->U_Daerah_ID)
                ->where('usahawans.U_Negeri_ID', '<>', '')
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID','U_Daerah_ID']);
            }else if($loguser->role == 7){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID', 'users.id', 'usahawans.Kod_PT')
                ->where('usahawans.Kod_PT',$pegawai->NamaPT)
                ->where('usahawans.U_Negeri_ID', '<>', '')
                ->where('usahawans.U_Daerah_ID', '<>', '')
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID','U_Daerah_ID']);
            }
            $table = new \stdClass();
            $table->negeri = 0;
            $table->id_jenis_insentif = 0;
            $table->tahun_terima_insentif = 0;
            $table->count = 0;
            $table->nilai_insentif = 0;
            $table->aliran = 0;
            $table->daerah = 0;

            if($insentifs->count()==0){
                return "Tiada Data Insentif Dijumpai";
            }else{
                foreach ($insentifs as $insentif) {
                    foreach ($insentif as $insentif1){
                        foreach ($insentif1 as $insentif2){
                            foreach ($insentif2 as $insentif3){
                                $table->negeri = 0;
                                $table->id_jenis_insentif = 0;
                                $table->tahun_terima_insentif = 0;
                                $table->count = 0;
                                $table->nilai_insentif = 0;
                                $table->aliran = 0;
                                $table->daerah = 0;

                                foreach ($insentif3 as $insentif4){
                                    $table->negeri = $insentif4->U_Negeri_ID;
                                    $table->daerah = $insentif4->U_Daerah_ID;
                                    $table->id_jenis_insentif = $insentif4->id_jenis_insentif;
                                    $table->tahun_terima_insentif = $insentif4->tahun_terima_insentif;
                                    $table->count = $table->count + 1;
                                    $table->nilai_insentif = $table->nilai_insentif + $insentif4->nilai_insentif;
                                    $aliran = Aliran::where('id_pengguna', $insentif4->id)
                                    ->where('id_kategori_aliran',1)
                                    ->whereYear('tarikh_aliran', $getYear)
                                    ->sum('jumlah_aliran');
                                    $table->aliran = $table->aliran + $aliran;
                                    
                                }
                                $this->newreport(2,$table,'');
                            }
                        }
                    }
                }
                return "Laporan Berjaya Dijana";
            }
        }

        if($request->type == 3){
            $loguser = Auth::user();
            if(isset($loguser->idpegawai)){
                $pegawai = Pegawai::where('id', $loguser->idpegawai)->first();
            }

            Report::where('tab20', $loguser->id)->where('type', 3)->delete();

            if($loguser->role == 1 || $loguser->role == 2){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID','usahawans.U_Dun_ID', 'users.id')
                ->where('usahawans.U_Negeri_ID', '<>', '')
                ->where('usahawans.U_Daerah_ID', '<>', '')
                ->where('usahawans.U_Dun_ID', '<>', '')
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID','U_Daerah_ID','U_Dun_ID']);
            }else if($loguser->role == 3 || $loguser->role == 5){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID','usahawans.U_Dun_ID', 'users.id')
                ->where('usahawans.U_Negeri_ID',$pegawai->Mukim->U_Negeri_ID)
                ->where('usahawans.U_Daerah_ID', '<>', '')
                ->where('usahawans.U_Dun_ID', '<>', '')
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID','U_Daerah_ID','U_Dun_ID']);
            }else if($loguser->role == 4 || $loguser->role == 6){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID', 'usahawans.U_Dun_ID', 'users.id')
                ->where('usahawans.U_Daerah_ID',$pegawai->Mukim->U_Daerah_ID)
                ->where('usahawans.U_Negeri_ID', '<>', '')
                ->where('usahawans.U_Dun_ID', '<>', '')
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID','U_Daerah_ID','U_Dun_ID']);
            }else if($loguser->role == 7){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID', 'usahawans.U_Dun_ID', 'users.id', 'usahawans.Kod_PT')
                ->where('usahawans.Kod_PT',$pegawai->NamaPT)
                ->where('usahawans.U_Negeri_ID', '<>', '')
                ->where('usahawans.U_Daerah_ID', '<>', '')
                ->where('usahawans.U_Dun_ID', '<>', '')
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID','U_Daerah_ID','U_Dun_ID']);
            }

            $table = new \stdClass();
            $table->negeri = 0;
            $table->id_jenis_insentif = 0;
            $table->tahun_terima_insentif = 0;
            $table->count = 0;
            $table->nilai_insentif = 0;
            $table->aliran = 0;
            $table->daerah = 0;
            $table->dun = 0;

            if($insentifs->count()==0){
                return "Tiada Data Insentif Dijumpai";
            }else{
                foreach ($insentifs as $insentif) {
                    foreach ($insentif as $insentif1){
                        foreach ($insentif1 as $insentif2){
                            foreach ($insentif2 as $insentif3){
                                foreach ($insentif3 as $insentif4){
                                    $table->negeri = 0;
                                    $table->id_jenis_insentif = 0;
                                    $table->tahun_terima_insentif = 0;
                                    $table->count = 0;
                                    $table->nilai_insentif = 0;
                                    $table->aliran = 0;
                                    $table->daerah = 0;
                                    $table->dun = 0;

                                    foreach ($insentif4 as $insentif5){
                                        $table->negeri = $insentif5->U_Negeri_ID;
                                        $table->daerah = $insentif5->U_Daerah_ID;
                                        $table->dun = $insentif5->U_Dun_ID;
                                        $table->id_jenis_insentif = $insentif5->id_jenis_insentif;
                                        $table->tahun_terima_insentif = $insentif5->tahun_terima_insentif;
                                        $table->count = $table->count + 1;
                                        $table->nilai_insentif = $table->nilai_insentif + $insentif5->nilai_insentif;
                                        $aliran = Aliran::where('id_pengguna', $insentif5->id)
                                        ->where('id_kategori_aliran',1)
                                        ->whereYear('tarikh_aliran', $getYear)
                                        ->sum('jumlah_aliran');
                                        $table->aliran = $table->aliran + $aliran;
                                    }
                                    $this->newreport(3,$table,'');
                                }
                            }
                        }
                    }
                }
                return "Laporan Berjaya Dijana";
            }
        }
        
        if($request->type == 4){
            $loguser = Auth::user();
            if(isset($loguser->idpegawai)){
                $pegawai = Pegawai::where('id', $loguser->idpegawai)->first();
            }

            Report::where('tab20', $loguser->id)->where('type', 4)->delete();

            if($loguser->role == 1 || $loguser->role == 2){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('perniagaans', 'perniagaans.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'perniagaans.jenisperniagaan')
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID']);
            }else if($loguser->role == 3 || $loguser->role == 5){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('perniagaans', 'perniagaans.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'perniagaans.jenisperniagaan')
                ->where('usahawans.U_Negeri_ID',$pegawai->Mukim->U_Negeri_ID)
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID']);
            }else if($loguser->role == 4 || $loguser->role == 6){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('perniagaans', 'perniagaans.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'perniagaans.jenisperniagaan', 'usahawans.U_Daerah_ID')
                ->where('usahawans.U_Daerah_ID',$pegawai->Mukim->U_Daerah_ID)
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID']);
            }else if($loguser->role == 7){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('perniagaans', 'perniagaans.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'perniagaans.jenisperniagaan', 'usahawans.Kod_PT')
                ->where('usahawans.Kod_PT',$pegawai->NamaPT)
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID']);
            }

            $table = new \stdClass();
            $table->negeri = 0;
            $table->id_jenis_insentif = 0;
            $table->tahun_terima_insentif = 0;
            $table->countA = 0;
            $table->countB = 0;
            $table->countC = 0;
            $table->countD = 0;
            $table->countE = 0;
            if($insentifs->count()==0){
                return "Tiada Data Insentif Dijumpai";
            }else{
                foreach ($insentifs as $insentif) {
                    foreach ($insentif as $insentif1){
                        foreach ($insentif1 as $insentif2){
                            $table->negeri = 0;
                            $table->id_jenis_insentif = 0;
                            $table->tahun_terima_insentif = 0;
                            $table->countA = 0;
                            $table->countB = 0;
                            $table->countC = 0;
                            $table->countD = 0;
                            $table->countE = 0;
                            foreach ($insentif2 as $insentif3){
                                $table->negeri = $insentif3->U_Negeri_ID;
                                $table->id_jenis_insentif = $insentif3->id_jenis_insentif;
                                $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                $update = true;
                                if($insentif3->jenisperniagaan == "A"){
                                    $table->countA = $table->countA + 1;
                                }else if($insentif3->jenisperniagaan == "B"){
                                    $table->countB = $table->countB + 1;
                                }else if($insentif3->jenisperniagaan == "C"){
                                    $table->countC = $table->countC + 1;
                                }else if($insentif3->jenisperniagaan == "D"){
                                    $table->countD = $table->countD + 1;
                                }else if($insentif3->jenisperniagaan == "E"){
                                    $table->countE = $table->countE + 1;
                                }else{
                                    $update = false;
                                }
                            }
                            if($update == true){
                                $this->newreport(4,$table,'');
                            }
                        }
                    }             
                }
                return "Laporan Berjaya Dijana";
            }
        }

        if($request->type == 5){
            $loguser = Auth::user();
            if(isset($loguser->idpegawai)){
                $pegawai = Pegawai::where('id', $loguser->idpegawai)->first();
            }

            Report::where('tab20', $loguser->id)->where('type', 5)->delete();

            if($loguser->role == 1 || $loguser->role == 2){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('perniagaans', 'perniagaans.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'perniagaans.jenisperniagaan')
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID']);
            }else if($loguser->role == 3 || $loguser->role == 5){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('perniagaans', 'perniagaans.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'perniagaans.jenisperniagaan')
                ->where('usahawans.U_Negeri_ID',$pegawai->Mukim->U_Negeri_ID)
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID']);
            }else if($loguser->role == 4 || $loguser->role == 6){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('perniagaans', 'perniagaans.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'perniagaans.jenisperniagaan', 'usahawans.U_Daerah_ID')
                ->where('usahawans.U_Daerah_ID',$pegawai->Mukim->U_Daerah_ID)
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID']);
            }else if($loguser->role == 7){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('perniagaans', 'perniagaans.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'perniagaans.jenisperniagaan', 'usahawans.Kod_PT')
                ->where('usahawans.Kod_PT',$pegawai->NamaPT)
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','U_Negeri_ID']);
            }

            $table = new \stdClass();
            $table->negeri = 0;
            $table->id_jenis_insentif = 0;
            $table->tahun_terima_insentif = 0;
            $table->countA = 0;
            $table->valA = 0;
            $table->countB = 0;
            $table->valB = 0;
            $table->countC = 0;
            $table->valC = 0;
            $table->countD = 0;
            $table->valD = 0;
            $table->countE = 0;
            $table->valE = 0;
            if($insentifs->count()==0){
                return "Tiada Data Insentif Dijumpai";
            }else{
                foreach ($insentifs as $insentif) {
                    foreach ($insentif as $insentif1){
                        foreach ($insentif1 as $insentif2){
                            $table->negeri = 0;
                            $table->id_jenis_insentif = 0;
                            $table->tahun_terima_insentif = 0;
                            $table->countA = 0;
                            $table->valA = 0;
                            $table->countB = 0;
                            $table->valB = 0;
                            $table->countC = 0;
                            $table->valC = 0;
                            $table->countD = 0;
                            $table->valD = 0;
                            $table->countE = 0;
                            $table->valE = 0;
                            
                            foreach ($insentif2 as $insentif3){
                                $table->negeri = $insentif3->U_Negeri_ID;
                                $table->id_jenis_insentif = $insentif3->id_jenis_insentif;
                                $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                $update = true;
                                if($insentif3->jenisperniagaan == "A"){
                                    $table->countA = $table->countA + 1;
                                    $table->valA = $table->valA + $insentif3->nilai_insentif;
                                }else if($insentif3->jenisperniagaan == "B"){
                                    $table->countB = $table->countB + 1;
                                    $table->valB = $table->valB + $insentif3->nilai_insentif;
                                }else if($insentif3->jenisperniagaan == "C"){
                                    $table->countC = $table->countC + 1;
                                    $table->valC = $table->valC + $insentif3->nilai_insentif;
                                }else if($insentif3->jenisperniagaan == "D"){
                                    $table->countD = $table->countD + 1;
                                    $table->valD = $table->valD + $insentif3->nilai_insentif;
                                }else if($insentif3->jenisperniagaan == "E"){
                                    $table->countE = $table->countE + 1;
                                    $table->valE = $table->valE + $insentif3->nilai_insentif;
                                }else{
                                    $update = false;
                                }
                            }
                            if($update == true){
                                $this->newreport(5,$table,'');
                            }
                            // return $table;
                        }
                    }             
                }
                return "Laporan Berjaya Dijana";
            }
        }
        if($request->type == 6){
            $loguser = auth()->user();
            if(isset($loguser->idpegawai)){
                $pegawai = Pegawai::where('id', $loguser->idpegawai)->first();
            }
           Report::where('tab20', $loguser->id)->where('type', 6)->delete();


            if($loguser->role == 1 || $loguser->role == 2){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->select('insentifs.*', 'usahawans.tarikhlahir', 'usahawans.U_Jantina_ID')
                ->selectRaw("usahawans.age AS age")
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','age']);
            }else if($loguser->role == 3 || $loguser->role == 5){
                // $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                // ->select('insentifs.*', 'usahawans.tarikhlahir', 'usahawans.U_Jantina_ID', 'usahawans.U_Negeri_ID')
                // ->selectRaw("TIMESTAMPDIFF(YEAR, DATE(usahawans.tarikhlahir), current_date) AS age")
                // ->where('usahawans.U_Negeri_ID',$pegawai->Mukim->U_Negeri_ID)
                // ->get()
                // ->groupBy(['tahun_terima_insentif','id_jenis_insentif','age']);
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->select('insentifs.*', 'usahawans.tarikhlahir', 'usahawans.U_Jantina_ID', 'usahawans.U_Negeri_ID')
                ->selectRaw("usahawans.age AS age")
                ->where('usahawans.U_Negeri_ID',$pegawai->Mukim->U_Negeri_ID)
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','age']);
               


            }else if($loguser->role == 4 || $loguser->role == 6){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->select('insentifs.*', 'usahawans.tarikhlahir', 'usahawans.U_Jantina_ID', 'usahawans.U_Daerah_ID')
                ->selectRaw("usahawans.age AS age")
                ->where('usahawans.U_Daerah_ID',$pegawai->Mukim->U_Daerah_ID)
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','age']);
            }else if($loguser->role == 7){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->select('insentifs.*', 'usahawans.tarikhlahir', 'usahawans.U_Jantina_ID', 'usahawans.Kod_PT')
                ->selectRaw("usahawans.age AS age")
                ->where('usahawans.Kod_PT',$pegawai->NamaPT)
                ->get()
                ->groupBy(['tahun_terima_insentif','id_jenis_insentif','age']);
            }
            $table = new \stdClass();
            $table->umur = 0;
            $table->id_jenis_insentif = 0;
            $table->tahun_terima_insentif = 0;
            $table->jan1 = 0;
            $table->jan2 = 0;
            $table->jan3 = 0;
            $table->umurgrp = 0;
            
            if($insentifs->count()==0){
                return "Tiada Data Insentif Dijumpai";
            }else{
                foreach ($insentifs as $key1 => $insentif) {
                    foreach ($insentif as $key2 => $insentif1){
                        foreach ($insentif1 as $key => $insentif2){
                            $table->umur = 0;
                            $table->id_jenis_insentif = 0;
                            $table->tahun_terima_insentif = 0;
                            $table->jan1 = 0;
                            $table->jan2 = 0;
                            $table->jan3 = 0;
                            $table->umurgrp = 0;
                            if($key <= 20 ){
                                $reports = Report::where('tab20', Auth::user()->id)
                                ->where('type', 6)
                                ->where('tab2', $key2)
                                ->where('tab3', $key1)
                                ->where('tab8', 1)
                                ->first();
                                
                                if($reports){
                                    foreach ($insentif2 as $insentif3){
                                        if($insentif3->U_Jantina_ID == 1){
                                            $reports->tab4 = $reports->tab4 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $reports->tab5 = $reports->tab5 + 1;
                                        }else{
                                            $reports->tab6 = $reports->tab6 + 1;
                                        }
                                    }
                                    $reports->save();
                                }else{
                                    foreach ($insentif2 as $insentif3){
                                        $table->umur = "Bawah 20";
                                        $table->id_jenis_insentif = $insentif3->id_jenis_insentif;
                                        $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                        if($insentif3->U_Jantina_ID == 1){
                                            $table->jan1 = $table->jan1 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $table->jan2 = $table->jan2 + 1;
                                        }else{
                                            $table->jan3 = $table->jan3 + 1;
                                        }
                                        $table->umurgrp = 1;
                                    }
                                    $this->newreport(6,$table,"1");
                                }

                            }else if($key >= 21 && $key <= 30){
                                $reports = Report::where('tab20', Auth::user()->id)
                                ->where('type', 6)
                                ->where('tab2', $key2)
                                ->where('tab3', $key1)
                                ->where('tab8', 2)
                                ->first();
                                
                                if($reports){
                                    foreach ($insentif2 as $insentif3){
                                        if($insentif3->U_Jantina_ID == 1){
                                            $reports->tab4 = $reports->tab4 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $reports->tab5 = $reports->tab5 + 1;
                                        }else{
                                            $reports->tab6 = $reports->tab6 + 1;
                                        }
                                    }
                                    $reports->save();
                                }else{
                                    foreach ($insentif2 as $insentif3){
                                        $table->umur = "21-30";
                                        $table->id_jenis_insentif = $insentif3->id_jenis_insentif;
                                        $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                        if($insentif3->U_Jantina_ID == 1){
                                            $table->jan1 = $table->jan1 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $table->jan2 = $table->jan2 + 1;
                                        }else{
                                            $table->jan3 = $table->jan3 + 1;
                                        }
                                        $table->umurgrp = 2;
                                    }
                                    $this->newreport(6,$table,"1");
                                }
                                
                            }else if($key >= 31 && $key <= 40){
                                $reports = Report::where('tab20', Auth::user()->id)
                                ->where('type', 6)
                                ->where('tab2', $key2)
                                ->where('tab3', $key1)
                                ->where('tab8', 3)
                                ->first();
                                
                                if($reports){
                                    foreach ($insentif2 as $insentif3){
                                        if($insentif3->U_Jantina_ID == 1){
                                            $reports->tab4 = $reports->tab4 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $reports->tab5 = $reports->tab5 + 1;
                                        }else{
                                            $reports->tab6 = $reports->tab6 + 1;
                                        }
                                    }
                                    $reports->save();
                                }else{
                                    foreach ($insentif2 as $insentif3){
                                        $table->umur = "31-40";
                                        $table->id_jenis_insentif = $insentif3->id_jenis_insentif;
                                        $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                        if($insentif3->U_Jantina_ID == 1){
                                            $table->jan1 = $table->jan1 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $table->jan2 = $table->jan2 + 1;
                                        }else{
                                            $table->jan3 = $table->jan3 + 1;
                                        }
                                        $table->umurgrp = 3;
                                    }
                                    $this->newreport(6,$table,"1");
                                }
                            }else if($key >= 41 && $key <= 50){
                                $reports = Report::where('tab20', Auth::user()->id)
                                ->where('type', 6)
                                ->where('tab2', $key2)
                                ->where('tab3', $key1)
                                ->where('tab8', 4)
                                ->first();
                                
                                if($reports){
                                    foreach ($insentif2 as $insentif3){
                                        if($insentif3->U_Jantina_ID == 1){
                                            $reports->tab4 = $reports->tab4 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $reports->tab5 = $reports->tab5 + 1;
                                        }else{
                                            $reports->tab6 = $reports->tab6 + 1;
                                        }
                                    }
                                    $reports->save();
                                }else{
                                    foreach ($insentif2 as $insentif3){
                                        $table->umur = "41-50";
                                        $table->id_jenis_insentif = $insentif3->id_jenis_insentif;
                                        $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                        if($insentif3->U_Jantina_ID == 1){
                                            $table->jan1 = $table->jan1 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $table->jan2 = $table->jan2 + 1;
                                        }else{
                                            $table->jan3 = $table->jan3 + 1;
                                        }
                                        $table->umurgrp = 4;
                                    }
                                    $this->newreport(6,$table,"1");
                                }
                            }else if($key >= 51 && $key <= 60){
                                $reports = Report::where('tab20', Auth::user()->id)
                                ->where('type', 6)
                                ->where('tab2', $key2)
                                ->where('tab3', $key1)
                                ->where('tab8', 5)
                                ->first();
                                
                                if($reports){
                                    foreach ($insentif2 as $insentif3){
                                        if($insentif3->U_Jantina_ID == 1){
                                            $reports->tab4 = $reports->tab4 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $reports->tab5 = $reports->tab5 + 1;
                                        }else{
                                            $reports->tab6 = $reports->tab6 + 1;
                                        }
                                    }
                                    $reports->save();
                                }else{
                                    foreach ($insentif2 as $insentif3){
                                        $table->umur = "51-60";
                                        $table->id_jenis_insentif = $insentif3->id_jenis_insentif;
                                        $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                        if($insentif3->U_Jantina_ID == 1){
                                            $table->jan1 = $table->jan1 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $table->jan2 = $table->jan2 + 1;
                                        }else{
                                            $table->jan3 = $table->jan3 + 1;
                                        }
                                        $table->umurgrp = 5;
                                    }
                                    $this->newreport(6,$table,"1");
                                }
                            }else if($key >= 61 && $key <= 70){
                                $reports = Report::where('tab20', Auth::user()->id)
                                ->where('type', 6)
                                ->where('tab2', $key2)
                                ->where('tab3', $key1)
                                ->where('tab8', 6)
                                ->first();
                                
                                if($reports){
                                    foreach ($insentif2 as $insentif3){
                                        if($insentif3->U_Jantina_ID == 1){
                                            $reports->tab4 = $reports->tab4 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $reports->tab5 = $reports->tab5 + 1;
                                        }else{
                                            $reports->tab6 = $reports->tab6 + 1;
                                        }
                                    }
                                    $reports->save();
                                }else{
                                    foreach ($insentif2 as $insentif3){
                                        $table->umur = "61-70";
                                        $table->id_jenis_insentif = $insentif3->id_jenis_insentif;
                                        $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                        if($insentif3->U_Jantina_ID == 1){
                                            $table->jan1 = $table->jan1 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $table->jan2 = $table->jan2 + 1;
                                        }else{
                                            $table->jan3 = $table->jan3 + 1;
                                        }
                                        $table->umurgrp = 6;
                                    }
                                    $this->newreport(6,$table,"1");
                                }
                            }else if($key >= 71){
                                $reports = Report::where('tab20', Auth::user()->id)
                                ->where('type', 6)
                                ->where('tab2', $key2)
                                ->where('tab3', $key1)
                                ->where('tab8', 7)
                                ->first();
                                
                                if($reports){
                                    foreach ($insentif2 as $insentif3){
                                        if($insentif3->U_Jantina_ID == 1){
                                            $reports->tab4 = $reports->tab4 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $reports->tab5 = $reports->tab5 + 1;
                                        }else{
                                            $reports->tab6 = $reports->tab6 + 1;
                                        }
                                    }
                                    $reports->save();
                                }else{
                                    foreach ($insentif2 as $insentif3){
                                        $table->umur = "71 ke atas";
                                        $table->id_jenis_insentif = $insentif3->id_jenis_insentif;
                                        $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                        if($insentif3->U_Jantina_ID == 1){
                                            $table->jan1 = $table->jan1 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $table->jan2 = $table->jan2 + 1;
                                        }else{
                                            $table->jan3 = $table->jan3 + 1;
                                        }
                                        $table->umurgrp = 7;
                                    }
                                    $this->newreport(6,$table,"1");
                                }
                            }else{
                                $reports = Report::where('tab20', Auth::user()->id)
                                ->where('type', 6)
                                ->where('tab2', $key2)
                                ->where('tab3', $key1)
                                ->where('tab8', 8)
                                ->first();
                                
                                if($reports){
                                    foreach ($insentif2 as $insentif3){
                                        if($insentif3->U_Jantina_ID == 1){
                                            $reports->tab4 = $reports->tab4 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $reports->tab5 = $reports->tab5 + 1;
                                        }else{
                                            $reports->tab6 = $reports->tab6 + 1;
                                        }
                                    }
                                    $reports->save();
                                }else{
                                    foreach ($insentif2 as $insentif3){
                                        $table->umur = "Tidak diketahui umur";
                                        $table->id_jenis_insentif = $insentif3->id_jenis_insentif;
                                        $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                        if($insentif3->U_Jantina_ID == 1){
                                            $table->jan1 = $table->jan1 + 1;
                                        }else if($insentif3->U_Jantina_ID == 2){
                                            $table->jan2 = $table->jan2 + 1;
                                        }else{
                                            $table->jan3 = $table->jan3 + 1;
                                        }
                                        $table->umurgrp = 8;
                                    }
                                    $this->newreport(6,$table,"1");
                                }
                            }
                            
                        }
                    }
                }
                return "Laporan Berjaya Dijana";
            }
        }

        if($request->type == 7){
            $loguser = Auth::user();
            if(isset($loguser->idpegawai)){
                $pegawai = Pegawai::where('id', $loguser->idpegawai)->first();
            }

            Report::where('tab20', $loguser->id)->where('type', 7)->delete();

            if($loguser->role == 1 || $loguser->role == 2){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'users.id')
                ->get()->groupBy(['tahun_terima_insentif','U_Negeri_ID']);
            }else if($loguser->role == 3 || $loguser->role == 5){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'users.id')
                ->where('usahawans.U_Negeri_ID',$pegawai->Mukim->U_Negeri_ID)
                ->get()->groupBy(['tahun_terima_insentif','U_Negeri_ID']);
            }

            $table = new \stdClass();
            $table->negeri = 0;
            $table->tahun_terima_insentif = 0;
            $table->count = 0;
            $table->num1 = 0;
            $table->num2 = 0;
            $table->num3 = 0;

            if($insentifs->count()==0){
                return "Tiada Data Insentif Dijumpai";
            }else{
                foreach ($insentifs as $insentif) {
                    foreach ($insentif as $insentif1){
                        $table->negeri = 0;
                        $table->tahun_terima_insentif = 0;
                        $table->count = 0;
                        $table->num1 = 0;
                        $table->num2 = 0;
                        $table->num3 = 0;
                        foreach ($insentif1 as $insentif2){
                            $table->negeri = $insentif2->U_Negeri_ID;
                            $table->tahun_terima_insentif = $insentif2->tahun_terima_insentif;
                            $table->count = $table->count + 1;
                            $lawatan = Lawatan::where('id_pengguna', $insentif2->id)
                            ->where('status_lawatan', 4)
                            ->whereYear('tarikh_lawatan', $insentif2->tahun_terima_insentif)
                            ->first();
                            $month = date('m');
                            if($lawatan==null){
                                $table->num3 = $table->num3 + 1;
                            }else{
                                $lwtnmonth = date("m",strtotime($lawatan->tarikh_lawatan));
                                if($lwtnmonth == $month){
                                    $table->num1 = $table->num1 + 1;
                                }
                                $table->num2 = $table->num2 + 1;
                            }
                        }
                        $this->newreport(7,$table,'');
                    }
                }
            }

            return "Laporan Berjaya Dijana";
        }

        if($request->type == 8){
            $loguser = Auth::user();
            if(isset($loguser->idpegawai)){
                $pegawai = Pegawai::where('id', $loguser->idpegawai)->first();
            }

            Report::where('tab20', $loguser->id)->where('type', 8)->delete();

            if($loguser->role == 1 || $loguser->role == 2){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID', 'users.id')
                ->get()->groupBy(['tahun_terima_insentif','U_Negeri_ID','U_Daerah_ID']);
            }else if($loguser->role == 3 || $loguser->role == 5){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID', 'users.id')
                ->where('usahawans.U_Negeri_ID',$pegawai->Mukim->U_Negeri_ID)
                ->get()->groupBy(['tahun_terima_insentif','U_Negeri_ID','U_Daerah_ID']);
            }else if($loguser->role == 4 || $loguser->role == 6){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID', 'users.id')
                ->where('usahawans.U_Daerah_ID',$pegawai->Mukim->U_Daerah_ID)
                ->get()->groupBy(['tahun_terima_insentif','U_Negeri_ID','U_Daerah_ID']);
            }else if($loguser->role == 7){
                $insentifs = Insentif::join('usahawans', 'usahawans.usahawanid', '=', 'insentifs.id_pengguna')
                ->join('users', 'users.usahawanid', '=', 'usahawans.usahawanid')
                ->select('insentifs.*', 'usahawans.U_Negeri_ID', 'usahawans.U_Daerah_ID', 'users.id', 'usahawans.Kod_PT')
                ->where('usahawans.Kod_PT',$pegawai->NamaPT)
                ->get()->groupBy(['tahun_terima_insentif','U_Negeri_ID','U_Daerah_ID']);
            }

            $table = new \stdClass();
            $table->negeri = 0;
            $table->daerah = 0;
            $table->tahun_terima_insentif = 0;
            $table->count = 0;
            $table->num1 = 0;
            $table->num2 = 0;
            $table->num3 = 0;

            if($insentifs->count()==0){
                return "Tiada Data Insentif Dijumpai";
            }else{
                foreach ($insentifs as $insentif) {
                    foreach ($insentif as $insentif1){
                        foreach ($insentif1 as $insentif2){
                            $table->negeri = 0;
                            $table->daerah = 0;
                            $table->tahun_terima_insentif = 0;
                            $table->count = 0;
                            $table->num1 = 0;
                            $table->num2 = 0;
                            $table->num3 = 0;
                            foreach ($insentif2 as $insentif3){
                                $table->negeri = $insentif3->U_Negeri_ID;
                                $table->daerah = $insentif3->U_Daerah_ID;
                                $table->tahun_terima_insentif = $insentif3->tahun_terima_insentif;
                                $table->count = $table->count + 1;
                                $lawatan = Lawatan::where('id_pengguna', $insentif3->id)
                                ->where('status_lawatan', 4)
                                ->whereYear('tarikh_lawatan', $insentif3->tahun_terima_insentif)
                                ->first();
                                $month = date('m');
                                if($lawatan==null){
                                    $table->num3 = $table->num3 + 1;
                                }else{
                                    $lwtnmonth = date("m",strtotime($lawatan->tarikh_lawatan));
                                    if($lwtnmonth == $month){
                                        $table->num1 = $table->num1 + 1;
                                    }
                                    $table->num2 = $table->num2 + 1;
                                }
                            }
                            $this->newreport(8,$table,'');
                        }
                    }
                }
                return "Laporan Berjaya Dijana";
            }
        }

        if($request->type == 9){
            $loguser = Auth::user();
            if(isset($loguser->idpegawai)){
                $pegawai = Pegawai::where('id', $loguser->idpegawai)->first();
            }

            Report::where('tab20', $loguser->id)->where('type', 9)->delete();
            if($loguser->role == 1 || $loguser->role == 2){
                $lawatansUniqs = Lawatan::select('id_pengguna')->distinct()->get();

            }else if($loguser->role == 3 || $loguser->role == 5){
                $lawatansUniqs = Lawatan::join('users', 'users.id', '=', 'lawatans.id_pengguna')
                ->join('usahawans', 'usahawans.usahawanid', '=', 'users.usahawanid')
                ->select('id_pengguna')
                ->where('usahawans.U_Negeri_ID',$pegawai->Mukim->U_Negeri_ID)
                ->distinct()->get();
                
            }else if($loguser->role == 4 || $loguser->role == 6){
                $lawatansUniqs = Lawatan::join('users', 'users.id', '=', 'lawatans.id_pengguna')
                ->join('usahawans', 'usahawans.usahawanid', '=', 'users.usahawanid')
                ->select('id_pengguna')
                ->where('usahawans.U_Daerah_ID',$pegawai->Mukim->U_Daerah_ID)
                ->distinct()->get();

            }else if($loguser->role == 7){
                $lawatansUniqs = Lawatan::join('users', 'users.id', '=', 'lawatans.id_pengguna')
                ->join('usahawans', 'usahawans.usahawanid', '=', 'users.usahawanid')
                ->select('id_pengguna')
                ->where('usahawans.Kod_PT',$pegawai->NamaPT)
                ->distinct()->get();
                
            }

            if($lawatansUniqs->count()==0){
                return "Tiada Data Lawatan Dijumpai";
            }else{
                foreach ($lawatansUniqs as $lawatansUniq) {
                    $lawatan = Lawatan::where('id_pengguna',$lawatansUniq->id_pengguna)->first();
                    $user = User::where('id', $lawatan->id_pengguna)->first();
                    $usahawan = Usahawan::where('usahawanid', $user->usahawanid)->first();
                    if(isset($usahawan->U_Negeri_ID)){
                        $lawatan->negeri = $usahawan->U_Negeri_ID;
                        $lawatan->daerah = $usahawan->U_Daerah_ID;
                    }
                    $lawatan->year = date("Y",strtotime($lawatan->tarikh_lawatan));
                    
                    $reports = Report::where('tab20', Auth::user()->id)->where('type', 9)->get();
                    if($reports->count()==0){
                        $this->newreport(9,$lawatan,$lawatan->id);
                    }else{
                        $update = false;
                        foreach ($reports as $report) {
                            if($report->tab1 == $lawatan->negeri && $report->tab2 == $lawatan->year && $report->tab3 == $lawatan->daerah && $report->tab4 == $lawatan->id_pegawai){
                                $update = true;
                                $report->tab5 = $report->tab5 + 1;
                                if($lawatan->status_lawatan != 4){
                                    $report->tab8 = $report->tab8 + 1;
                                }else{
                                    $month = date('m');
                                    $lwtnmonth = date("m",strtotime($request->tarikh_lawatan));
                                    if($lwtnmonth == $month){
                                        $report->tab6 = $report->tab6 + 1;
                                    }
                                    $report->tab7 = $report->tab7 + 1;
                                }
                                $report->save();
                            }

                        }
                        if($update == false){
                            $this->newreport(9,$lawatan,$lawatan->id);
                        }
                    }
                    
                }
            }
            return "Laporan Berjaya Dijana";
        }

        if($request->type == 11){
            Report::where('tab20', Auth::user()->id)->where('type', 11)->delete();
            $usaha = Usahawan::where('id', $request->id)->first();
            $pengguna = User::where('usahawanid', $usaha->usahawanid)->first();
            if(isset($pengguna->id)){
                $alirans = Aliran::where('id_pengguna',$pengguna->id)->get();
                if($alirans->count()==0 || $alirans==''){
                    return "Tiada Data Aliran Dijumpai";
                }else{
                    $report = new Report();
                    $report->type = 11;
                    $report->tab1 = 1000;
                    $report->tab2 = 1000;
                    $report->tab8 = 2;
                    $report->tab20 = Auth::user()->id;
                    $report->save();
                    $report = new Report();
                    $report->type = 11;
                    $report->tab1 = 1000;
                    $report->tab2 = 1000;
                    $report->tab8 = 3;
                    $report->tab20 = Auth::user()->id;
                    $report->save();
                    foreach ($alirans as $aliran) {
                        $aliran->newdate = date("d-m-Y", strtotime($aliran->tarikh_aliran));
                        $aliran->bulan = date('m', strtotime($aliran->tarikh_aliran));
                        $aliran->tahun = date('Y', strtotime($aliran->tarikh_aliran));
                        $reports = Report::where('tab20', Auth::user()->id)->where('type', 11)->get();
                        if($reports->count()==0){
                            $this->newreport(11,$aliran,$aliran->id);
                        }else{
                            $this->newreport(11,$aliran,$aliran->id);
                        }
                    }
                    return "Laporan Berjaya Dijana";
                }
            }else{
                return "Tiada Data Aliran Dijumpai";
            }
        }

        if($request->type == 12){
            Report::where('tab20', Auth::user()->id)->where('type', 12)->delete();
            $usaha = Usahawan::where('id', $request->id)->first();
            $pengguna = User::where('usahawanid', $usaha->usahawanid)->first();
            $alirans = Aliran::where('id_pengguna',$pengguna->id)->get();
            if($alirans->count()==0){
                return "Tiada Data Aliran Dijumpai";
            }else{
                foreach ($alirans as $aliran) {
                    $aliran->newdate = date("d-m-Y", strtotime($aliran->tarikh_aliran));
                    $aliran->bulan = date('m', strtotime($aliran->tarikh_aliran));
                    $aliran->tahun = date('Y', strtotime($aliran->tarikh_aliran));
                    $reports = Report::where('tab20', Auth::user()->id)->where('type', 12)->get();
                    if($reports->count()==0){
                        $this->newreport(12,$aliran,$aliran->id);
                    }else{
                        $this->newreport(12,$aliran,$aliran->id);
                    }
                }
                return "Laporan Berjaya Dijana";
            }
        }

        if($request->type == 13){
            Report::where('tab20', auth()->id())->where('type', 13)->delete();

            $alirans = Aliran::all();

            if($alirans->count()==0){
                return "Tiada Data Aliran Dijumpai";
            }else{
                $reports = Report::where('tab20', Auth::user()->id)->where('type', 13)->get();

                foreach ($alirans as $aliran) {
                    $aliran->bulan = date('m', strtotime($aliran->tarikh_aliran));
                    $aliran->tahun = date('Y', strtotime($aliran->tarikh_aliran));


                    if($aliran->id_kategori_aliran == 1 || ($aliran->id_kategori_aliran == 2) || ($aliran->id_kategori_aliran == 11)){
                        $aliran->jeniskatealiran = 1;
                    }else if($aliran->id_kategori_aliran == 3 || ($aliran->id_kategori_aliran == 4) || ($aliran->id_kategori_aliran == 9) || ($aliran->id_kategori_aliran == 10) || ($aliran->id_kategori_aliran == 12)){
                        $aliran->jeniskatealiran = 2;
                    }else if($aliran->id_kategori_aliran == 13 || ($aliran->id_kategori_aliran == 14) || ($aliran->id_kategori_aliran == 15) || ($aliran->id_kategori_aliran == 16) || ($aliran->id_kategori_aliran == 17) || ($aliran->id_kategori_aliran == 18) || ($aliran->id_kategori_aliran == 19) || ($aliran->id_kategori_aliran == 20) || ($aliran->id_kategori_aliran == 21) || ($aliran->id_kategori_aliran == 22) || ($aliran->id_kategori_aliran == 23) || ($aliran->id_kategori_aliran == 24) || ($aliran->id_kategori_aliran == 25) || ($aliran->id_kategori_aliran == 26)){
                        $aliran->jeniskatealiran = 3;
                    }else if($aliran->id_kategori_aliran == 5 || ($aliran->id_kategori_aliran == 6) || ($aliran->id_kategori_aliran == 7) || ($aliran->id_kategori_aliran == 8)){
                        $aliran->jeniskatealiran = 4;
                    }

                    if($reports->count()==0){
                        $this->newreport(13,$aliran,$aliran->id);
                    }else{
                        $update = false;
                        foreach ($reports as $report) {
                            if($aliran->jeniskatealiran == $report->tab3 && ($aliran->tahun == $report->tab1) && ($aliran->bulan == $report->tab2)){
                                $update = true;
                                if($aliran->jeniskatealiran == 1){
                                    if($aliran->id_kategori_aliran == 11){
                                        $report->tab4 = $report->tab4 - $aliran->jumlah_aliran;
                                    }else{
                                        $report->tab4 = $report->tab4 + $aliran->jumlah_aliran;
                                    }

                                }else if($aliran->jeniskatealiran == 2){
                                    if($aliran->id_kategori_aliran == 3 || ($aliran->id_kategori_aliran == 4)){
                                        $report->tab4 = $report->tab4 + $aliran->jumlah_aliran;
                                    }else{
                                        $report->tab4 = $report->tab4 - $aliran->jumlah_aliran;
                                    }

                                }else if($aliran->jeniskatealiran == 3){
                                    $report->tab4 = $report->tab4 + $aliran->jumlah_aliran;

                                }else if($aliran->jeniskatealiran == 4){
                                    $report->tab4 = $report->tab4 + $aliran->jumlah_aliran;
                                }
                                $report->save();
                            }
                        }
                        if($update == false){
                            $this->newreport(13,$aliran,"1");
                        }
                    }
                }
            }
            return "Laporan Berjaya Dijana";
        }

        if($request->type == 14){
            Report::where('tab20', Auth::user()->id)->where('type', 14)->delete();
            $usaha = Usahawan::where('id', $request->id)->first();
            $pengguna = User::where('usahawanid', $usaha->usahawanid)->first();
            $alirans = Aliran::where('id_pengguna',$pengguna->id)->get();
            if($alirans->count()==0){
                return "Tiada Data Aliran Dijumpai";
            }else{
                foreach ($alirans as $aliran) {
                    $aliran->bulan = date('m', strtotime($aliran->tarikh_aliran));
                    $aliran->tahun = date('Y', strtotime($aliran->tarikh_aliran));
                    
                    $reports = Report::where('tab20', Auth::user()->id)->where('type', 14)->get();
                    if($reports->count()==0){
                        $this->newreport(14,$aliran,$aliran->id);
                    }else{
                        $update = false;
                        foreach ($reports as $report) {
                            if($aliran->bulan == $report->tab1 && ($aliran->tahun == $report->tab2) && ($aliran->id_kategori_aliran == $report->tab3)){
                                $update = true;
                                $report->tab5 = $report->tab5 + $aliran->jumlah_aliran;
                                $report->save();
                            }
                        }
                        if($update == false){
                            $this->newreport(14,$aliran,"1");
                        }
                    }
                }
            }
            return "Laporan Berjaya Dijana";
        }
    }

    public function newreport($type, $request, $others)
    {
        if($type == 1){
            $report = new Report();
            $report->type = 1;
            $report->tab1 = $request->U_Negeri_ID;
            $report->tab2 = $request->id_jenis_insentif;
            $report->tab3 = $request->tahun_terima_insentif;
            $report->tab4 = $request->count;
            $report->tab5 = $request->nilai_insentif;
            $report->tab6 = $request->aliran;
            $report->tab10 = $others;
            $report->tab20 = Auth::user()->id;
            $report->save();

        }else if($type == 2){
            $report = new Report();
            $report->type = 2;
            $report->tab1 = $request->negeri;
            $report->tab2 = $request->id_jenis_insentif;
            $report->tab3 = $request->tahun_terima_insentif;
            $report->tab4 = $request->count;
            $report->tab5 = $request->nilai_insentif;
            $report->tab6 = $request->aliran;
            $report->tab8 = $request->daerah;
            $report->tab10 = $others;
            $report->tab20 = Auth::user()->id;
            $report->save();

        }else if($type == 3){
            $report = new Report();
            $report->type = 3;
            $report->tab1 = $request->negeri;
            $report->tab2 = $request->id_jenis_insentif;
            $report->tab3 = $request->tahun_terima_insentif;
            $report->tab4 = $request->count;
            $report->tab5 = $request->nilai_insentif;
            $report->tab6 = $request->aliran;
            $report->tab8 = $request->daerah;
            $report->tab9 = $request->dun;
            $report->tab10 = $others;
            $report->tab20 = Auth::user()->id;
            $report->save();

        }else if($type == 4){
            $report = new Report();
            $report->type = 4;
            $report->tab1 = $request->negeri;
            $report->tab2 = $request->id_jenis_insentif;
            $report->tab3 = $request->tahun_terima_insentif;
            $report->tab4 = $request->countA;
            $report->tab5 = $request->countB;
            $report->tab6 = $request->countC;
            $report->tab7 = $request->countD;
            $report->tab8 = $request->countE;
            $report->tab20 = Auth::user()->id;
            $report->save();

        }else if($type == 5){
            $report = new Report();
            $report->type = 5;
            $report->tab1 = $request->negeri;
            $report->tab2 = $request->id_jenis_insentif;
            $report->tab3 = $request->tahun_terima_insentif;
            $report->tab4 = $request->countA;
            $report->tab5 = $request->valA;
            $report->tab6 = $request->countB;
            $report->tab7 = $request->valB;
            $report->tab8 = $request->countC;
            $report->tab9 = $request->valC;
            $report->tab10 = $request->countD;
            $report->tab11 = $request->valD;
            $report->tab12 = $request->countE;
            $report->tab13 = $request->valE;
            $report->tab20 = Auth::user()->id;
            $report->save();
            
        }else if($type == 6){
            $report = new Report();
            $report->type = 6;
            $report->tab1 = $request->umur;
            $report->tab2 = $request->id_jenis_insentif;
            $report->tab3 = $request->tahun_terima_insentif;
            $report->tab4 = $request->jan1;
            $report->tab5 = $request->jan2;
            $report->tab6 = $request->jan3;
            $report->tab8 = $request->umurgrp;
            $report->tab20 = Auth::user()->id;
            $report->save();
        }else if($type == 7){
            $report = new Report();
            $report->type = 7;
            $report->tab1 = $request->negeri;
            $report->tab2 = $request->tahun_terima_insentif;
            $report->tab3 = $request->count;
            $report->tab4 = $request->num1;
            $report->tab5 = $request->num2;
            $report->tab6 = $request->num3;
            $report->tab20 = Auth::user()->id;
            $report->save();
        }else if($type == 8){
            $report = new Report();
            $report->type = 8;
            $report->tab1 = $request->negeri;
            $report->tab2 = $request->daerah;
            $report->tab3 = $request->tahun_terima_insentif;
            $report->tab4 = $request->count;
            $report->tab5 = $request->num1;
            $report->tab6 = $request->num2;
            $report->tab7 = $request->num3;
            $report->tab20 = Auth::user()->id;
            $report->save();
        }else if($type == 9){
            $report = new Report();
            $report->type = 9;
            $report->tab1 = $request->negeri;
            $report->tab2 = $request->year;
            $report->tab3 = $request->daerah;
            $report->tab4 = $request->id_pegawai;
            $report->tab5 = 1;
            if($request->status_lawatan != 4){
                $report->tab8 = 1;
            }else{
                $month = date('m');
                $lwtnmonth = date("m",strtotime($request->tarikh_lawatan));
                if($lwtnmonth == $month){
                    $report->tab6 = 1;
                }
                $report->tab7 = 1;
            }
            $report->tab20 = Auth::user()->id;
            $report->save();
        }else if($type == 11){
            $report = new Report();
            $report->type = 11;
            $report->tab1 = $request->bulan;
            $report->tab2 = $request->tahun;
            $report->tab3 = $request->newdate;
            $report->tab4 = $request->id_kategori_aliran;
            $report->tab5 = $request->keterangan_aliran;

            // $kate_aliran = $request->id_kategori_aliran;
            $kate_aliran = KategoriAliran::where('id', $request->id_kategori_aliran)->first();
            if($kate_aliran->jenis_aliran == "tunai_masuk"){
                $report->tab6 = $request->jumlah_aliran;

            }else if($kate_aliran->jenis_aliran == "tunai_keluar"){
                $report->tab7 = $request->jumlah_aliran;
            }

            $report->tab8 = $kate_aliran->bahagian;
            $report->tab20 = Auth::user()->id;
            $report->save();

        }else if($type == 12){
            $report = new Report();
            $report->type = 12;
            $report->tab1 = $request->bulan;
            $report->tab2 = $request->tahun;
            $report->tab3 = $request->id_kategori_aliran;
            
            $kate_aliran = KategoriAliran::where('id', $request->id_kategori_aliran)->first();
            if(isset($kate_aliran)){
                if($kate_aliran->jenis_aliran == "tunai_masuk"){
                    $report->tab4 = 2;
    
                }else if($kate_aliran->jenis_aliran == "tunai_keluar"){
                    $report->tab4 = 1;
    
                }
                $report->tab5 = $request->newdate;
                $report->tab6 = $kate_aliran->nama_kategori_aliran;
                $report->tab7 = $request->jumlah_aliran;
                $report->tab20 = Auth::user()->id;
                $report->save();

                $report = new Report();
                $report->type = 12;
                $report->tab1 = $request->bulan;
                $report->tab2 = $request->tahun;
                $report->tab3 = 0;
                if($kate_aliran->jenis_aliran == "tunai_masuk"){
                    $report->tab4 = 2;
                }else if($kate_aliran->jenis_aliran == "tunai_keluar"){
                    $report->tab4 = 1;
                }
                $report->tab5 = $request->newdate;
                $report->tab6 = $kate_aliran->nama_kategori_aliran;
                $report->tab7 = $request->jumlah_aliran;
                $report->tab20 = Auth::user()->id;
                $report->save();
            }

        }else if($type == 13){
            $report = new Report();
            $report->type = 13;
            $report->tab1 = $request->tahun;
            $report->tab2 = $request->bulan;
            $report->tab3 = $request->jeniskatealiran;
            $report->tab4 = $request->jumlah_aliran;
            $report->tab20 = Auth::user()->id;
            $report->save();

        }else if($type == 14){
            $report = new Report();
            $report->type = 14;
            $report->tab1 = $request->bulan;
            $report->tab2 = $request->tahun;
            $report->tab3 = $request->id_kategori_aliran;
            $report->tab4 = $request->nama_kategori_aliran;
            $report->tab5 = $request->jumlah_aliran;
            $report->tab20 = Auth::user()->id;
            $report->save();
        }
    }

    public function ExcelLapProfil(Request $request)
    {
        // dd($request->to);
        return Excel::download(new LapProf($request->negeri), 'DatabaseProfil.xlsx');
    }
}
