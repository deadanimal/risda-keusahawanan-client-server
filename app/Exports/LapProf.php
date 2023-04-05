<?php

namespace App\Exports;
use Illuminate\Support\Facades\Auth;
use App\Models\Usahawan;
use App\Models\Pegawai;
use App\Models\Mukim;
use App\Models\Insentif;
use App\Models\Aliran;
use App\Models\User;
use App\Models\jenisinsentif;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class LapProf extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, FromArray, WithHeadings
{
    protected $negeri;

    function __construct($negeri) {
        $this->negeri = $negeri;
    }
    /**
    * @return \Illuminate\Support\Arrayable
    */
    public function array(): array
    {
        // dd($this->negeri);
        $authuser = Auth::user();
        if(isset($authuser)){
            $authpegawai = Pegawai::where('id', $authuser->idpegawai)->first();
        }else{
            return redirect('/landing');
        }
        
        $authmukim = Mukim::where('U_Mukim_ID', $authpegawai->mukim)->first();
        // $users = Usahawan::take(5)->get();
        if($authuser->role == 1 || $authuser->role == 2){
            $users = Usahawan::without(['insentif'])
            ->where('U_Negeri_ID', $this->negeri)
            ->get();
            // take(5)->get();
            // all();
        }else if($authuser->role == 3 || $authuser->role == 5){
            $users = Usahawan::without(['insentif'])
            ->where('U_Negeri_ID', $authmukim->U_Negeri_ID)
            ->where('U_Negeri_ID', $this->negeri)
            ->get();
        }else if($authuser->role == 4 || $authuser->role == 6){
            $users = Usahawan::without(['insentif'])
            ->where('U_Daerah_ID', $authmukim->U_Daerah_ID)
            ->where('U_Negeri_ID', $this->negeri)
            ->get();
        }else if($authuser->role == 7){
            $users = Usahawan::without(['insentif'])
            ->where('Kod_PT', $authpegawai->NamaPT)
            ->where('U_Negeri_ID', $this->negeri)
            ->get();
        }

        $array = [];

        foreach($users as $usahawan){
            $excel = (object)[];
            $excel->data1 = '';
            $excel->data2 = '';
            $excel->data3 = '';
            $excel->data4 = '';
            $excel->data5 = '';
            $excel->data6 = '';
            $excel->data7 = '';
            $excel->data8 = '';
            $excel->data9 = '';
            $excel->data10 = '';
            $excel->data11 = '';
            $excel->data12= '';
            $excel->data13 = '';
            $excel->data14 = '';
            $excel->data15 = '';
            $excel->data16 = '';
            $excel->data17 = '';
            $excel->data18 = '';
            $excel->data19 = '';
            $excel->data20 = '';
            $excel->data21 = '';
            $excel->data22 = '';
            $excel->data23 = '';
            $excel->data24 = '';
            $excel->data25 = '';
            $excel->data26 = '';
            $excel->data27 = '';
            $excel->data28 = '';
            $excel->data29 = '';
            $excel->data30 = '';
            $excel->data31 = '';
            $excel->data32 = '';
            $excel->data33 = '';
            $excel->data34 = '';
            $excel->data35 = '';
            $excel->data36 = '';
            $excel->data37 = '';
            $excel->data38 = '';
            $excel->data39 = '';
            $excel->data40 = '';
            $excel->data41 = '';
            $excel->data42 = '';
            $excel->data43 = '';
            $excel->data44 = '';
            $excel->data45 = '';
            $excel->data46 = '';
            $excel->data47 = '';
            $excel->data48 = '';
            $excel->data49 = '';
            $excel->data50 = '';
            $excel->data51 = '';
            $excel->data52 = '';

            $dateOfBirth = $usahawan->tarikhlahir;
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $usahawan->umur = $diff->format('%y');

            if($usahawan->U_Jantina_ID == 1){
                $usahawan->jantina = "Lelaki";
            }else if($usahawan->U_Jantina_ID == 2){
                $usahawan->jantina = "Perempuan";
            }else{
                $usahawan->jantina = "Lain - Lain";
            }
            
            if($usahawan->U_Pendidikan_ID == 1){
                $usahawan->taraf_pendidikan = 'UPSR/PSRA/Setaraf';
            }else if($usahawan->U_Pendidikan_ID == 2){
                $usahawan->taraf_pendidikan = 'PMR/SRP/LCE/Setaraf';
            }else if($usahawan->U_Pendidikan_ID == 3){
                $usahawan->taraf_pendidikan = 'SPM/MCE/Setaraf';
            }else if($usahawan->U_Pendidikan_ID == 4){
                $usahawan->taraf_pendidikan = 'STPM/Diploma/Setaraf';
            }else if($usahawan->U_Pendidikan_ID == 5){
                $usahawan->taraf_pendidikan = 'Ijazah Pertama/Ke Atas';
            }else if($usahawan->U_Pendidikan_ID == 6){
                $usahawan->taraf_pendidikan = 'Tiada';
            }else{
                $usahawan->taraf_pendidikan = '';
            }
            
            $usahawan->MediumPemasaran = '';
            $usahawan->AlamatMediumPemasaran = '';

            if(isset($usahawan->perniagaan)){
                
                if($usahawan->perniagaan->facebook != ""){
                    $usahawan->MediumPemasaran = $usahawan->MediumPemasaran."Facebook ";
                    $usahawan->AlamatMediumPemasaran = $usahawan->AlamatMediumPemasaran."Facebook - ".$usahawan->perniagaan->facebook;
                }
                if($usahawan->perniagaan->instagram != ""){
                    $usahawan->MediumPemasaran = $usahawan->MediumPemasaran."Instagram ";
                    $usahawan->AlamatMediumPemasaran = $usahawan->AlamatMediumPemasaran."Instagram - ".$usahawan->perniagaan->instagram;
                }
                if($usahawan->perniagaan->twitter != ""){
                    $usahawan->MediumPemasaran = $usahawan->MediumPemasaran."Twitter ";
                    $usahawan->AlamatMediumPemasaran = $usahawan->AlamatMediumPemasaran."Twitter - ".$usahawan->perniagaan->twitter;
                }
            }
            
            if(isset($usahawan->syarikat)){
                if($usahawan->syarikat->jenismilikanperniagaan == "JPP01"){
                    $usahawan->jenismilikan = "PEMILIKAN TUNGGAL";
                }else if($usahawan->syarikat->jenismilikanperniagaan == "JPP02"){
                    $usahawan->jenismilikan = "PERKONGSIAN";
                }else if($usahawan->syarikat->jenismilikanperniagaan == "JPP03"){
                    $usahawan->jenismilikan = "SYARIKAT SDN BHD";
                }else if($usahawan->syarikat->jenismilikanperniagaan == "JPP04"){
                    $usahawan->jenismilikan = "PERKONGSIAN LIABILITI TERHAD";
                }

                $usahawan->alamatsyarikat = $usahawan->syarikat->alamat1_ssm.",".$usahawan->syarikat->alamat2_ssm.",".$usahawan->syarikat->alamat3_ssm;
            }
            $usahawan->jnsbantuansemasa = "";
            $usahawan->kelulusanbantuansemasa = "";
            $usahawan->thnbantuansemasa = "";
            $insentif = Insentif::where('id_pengguna', $usahawan->usahawanid)->first();
            if(isset($insentif)){
                $usahawan->jnsbantuansemasa = $insentif->jenis->nama_insentif;
                $usahawan->kelulusanbantuansemasa = $insentif->nilai_insentif;
                $usahawan->thnbantuansemasa = $insentif->tahun_terima_insentif;
            }

            $insentif2 = Insentif::where('id_pengguna', $usahawan->usahawanid)->get();
            $usahawan->insentifsebelumnama = "";
            $usahawan->insentifsebelumjum = "";
            $usahawan->insentifsebelumtahun = "";
            foreach ($insentif2 as $insentif2s) {
                if(isset($insentif2s->jenis)){
                    $usahawan->insentifsebelumnama = $usahawan->insentifsebelumnama."/".$insentif2s->jenis->nama_insentif;
                }
                $usahawan->insentifsebelumjum = $usahawan->insentifsebelumjum."/".$insentif2s->nilai_insentif;
                $usahawan->insentifsebelumtahun = $usahawan->insentifsebelumtahun."/".$insentif2s->tahun_terima_insentif;
            }
            // // dd($usahawan->usahawanid);
            // $pengguna = User::where('usahawanid', $usahawan->usahawanid)->first();
            $getYear = date("Y");
            unset($usahawan->aliran1);
            unset($usahawan->aliran2);
            unset($usahawan->aliran3);
            unset($usahawan->aliran4);
            unset($usahawan->aliran5);
            unset($usahawan->aliran6);
            unset($usahawan->aliran7);
            unset($usahawan->aliran8);
            unset($usahawan->aliran9);
            unset($usahawan->aliran10);
            unset($usahawan->aliran11);
            unset($usahawan->aliran12);
            if(isset($usahawan->user->id)){
                $alirans = Aliran::where('id_pengguna', $usahawan->user->id)->where('id_kategori_aliran',1)->whereYear('tarikh_aliran', '=', $getYear)->get();
            }else{
                unset($alirans);
            }
            
            // dd($alirans);
            if(isset($alirans)){
                foreach ($alirans as $aliran) {
                    $aliran->bulan = date('m', strtotime($aliran->tarikh_aliran));
                    if($aliran->bulan == 1){
                        $usahawan->aliran1 = $usahawan->aliran1 + $aliran->jumlah_aliran;
                    }else if($aliran->bulan == 2){
                        $usahawan->aliran2 = $usahawan->aliran2 + $aliran->jumlah_aliran;
                    }else if($aliran->bulan == 3){
                        $usahawan->aliran3 = $usahawan->aliran3 + $aliran->jumlah_aliran;
                    }else if($aliran->bulan == 4){
                        $usahawan->aliran4 = $usahawan->aliran4 + $aliran->jumlah_aliran;
                    }else if($aliran->bulan == 5){
                        $usahawan->aliran5 = $usahawan->aliran5 + $aliran->jumlah_aliran;
                    }else if($aliran->bulan == 6){
                        $usahawan->aliran6 = $usahawan->aliran6 + $aliran->jumlah_aliran;
                    }else if($aliran->bulan == 7){
                        $usahawan->aliran7 = $usahawan->aliran7 + $aliran->jumlah_aliran;
                    }else if($aliran->bulan == 8){
                        $usahawan->aliran8 = $usahawan->aliran8 + $aliran->jumlah_aliran;
                    }else if($aliran->bulan == 9){
                        $usahawan->aliran9 = $usahawan->aliran9 + $aliran->jumlah_aliran;
                    }else if($aliran->bulan == 10){
                        $usahawan->aliran10 = $usahawan->aliran10 + $aliran->jumlah_aliran;
                    }else if($aliran->bulan == 11){
                        $usahawan->aliran11 = $usahawan->aliran11 + $aliran->jumlah_aliran;
                    }else if($aliran->bulan == 12){
                        $usahawan->aliran12 = $usahawan->aliran12 + $aliran->jumlah_aliran;
                    }
                    $usahawan->jumaliran = $usahawan->jumaliran + $aliran->jumlah_aliran;
                }
                $usahawan->purataaliran = $usahawan->jumaliran / 12;
            }else{

                $usahawan->aliran1 = 0;
                $usahawan->aliran2 = 0;
                $usahawan->aliran3 = 0;
                $usahawan->aliran4 = 0;
                $usahawan->aliran5 = 0;
                $usahawan->aliran6 = 0;
                $usahawan->aliran7 = 0;
                $usahawan->aliran8 = 0;
                $usahawan->aliran9 = 0;
                $usahawan->aliran10 = 0;
                $usahawan->aliran11 = 0;
                $usahawan->aliran12 = 0;
                $usahawan->jumaliran = 0;
                $usahawan->purataaliran = 0;
            }

            if($usahawan->purataaliran >= 2500){
                $usahawan->capaisasaran = "capai";
            }else{
                $usahawan->capaisasaran = "tidak capai";
            }

            if(isset($usahawan->negeri)){
                $excel->data1 = $usahawan->negeri->Negeri;
            }
            
            if(isset($usahawan->PT)){
                $excel->data2 = $usahawan->PT->keterangan;
            }
            
            $excel->data3 = $usahawan->namausahawan;
            $excel->data4 = $usahawan->nokadpengenalan;
            $excel->data5 = $usahawan->umur;
            $excel->data6 = $usahawan->jantina;
            $excel->data7 = $usahawan->taraf_pendidikan;
            $excel->data8 = $usahawan->alamat1.','.$usahawan->alamat2.','.$usahawan->alamat3;
            $excel->data9 = $usahawan->poskod;
            if(isset($usahawan->daerah)){
                $excel->data10 = $usahawan->daerah->Daerah;
            }
            if(isset($usahawan->negeri)){
                $excel->data11 = $usahawan->negeri->Negeri;
            }
            if(isset($usahawan->dun)){
                $excel->data12 = $usahawan->dun->Dun;
            }
            if(isset($usahawan->parlimen)){
                $excel->data13 = $usahawan->parlimen->Parlimen;
            }   
            
            
            $excel->data14 = $usahawan->notelefon.'/'.$usahawan->nohp;
            if(isset($usahawan->pekebun)){
                $excel->data15 = $usahawan->pekebun->noTS;
                $excel->data16 = $usahawan->pekebun->No_KP;
            }
            
            $excel->data17 = $usahawan->status_daftar_usahawan;
            if(isset($usahawan->perniagaan)){
                if(isset($usahawan->perniagaan->jenis)){
                    $excel->data18 = $usahawan->perniagaan->jenis->nama_jenis_perniagaan;
                }
                
                $excel->data19 = $usahawan->perniagaan->klusterperniagaan;
                $excel->data20 = $usahawan->perniagaan->subkluster;
            }
            
            $excel->data21 = $usahawan->MediumPemasaran;
            $excel->data22 = $usahawan->AlamatMediumPemasaran;
            $excel->data23 = $usahawan->jnsbantuansemasa;
            $excel->data24 = $usahawan->kelulusanbantuansemasa;
            $excel->data25 = $usahawan->thnbantuansemasa;
            $excel->data26 = $usahawan->aliran1;
            $excel->data27 = $usahawan->aliran2;
            $excel->data28 = $usahawan->aliran3;
            $excel->data29 = $usahawan->aliran4;
            $excel->data30 = $usahawan->aliran5;
            $excel->data31 = $usahawan->aliran6;
            $excel->data32 = $usahawan->aliran7;
            $excel->data33 = $usahawan->aliran8;
            $excel->data34 = $usahawan->aliran9;
            $excel->data35 = $usahawan->aliran10;
            $excel->data36 = $usahawan->aliran11;
            $excel->data37 = $usahawan->aliran12;
            $excel->data38 = $usahawan->jumaliran;
            $excel->data39 = $usahawan->purataaliran;
            $excel->data40 = $usahawan->capaisasaran;
            if(isset($usahawan->kateusah)){
                $excel->data41 = $usahawan->kateusah->nama_kategori_usahawan;
            }
            
            if(isset($usahawan->syarikat)){
                $excel->data42 = $usahawan->syarikat->namasyarikat;
            }
            
            $excel->data43 = $usahawan->jenismilikan;
            if(isset($usahawan->syarikat)){
                $excel->data44 = $usahawan->syarikat->nodaftarssm;
            }
            
            $excel->data45 = $usahawan->alamatsyarikat;
            if(isset($usahawan->perniagaan)){
                $excel->data46 = $usahawan->perniagaan->latitud;
                $excel->data47 = $usahawan->perniagaan->logitud;
            }
            
            if(isset($usahawan->syarikat)){
                $excel->data48 = $usahawan->syarikat->email;
            }
            
            $excel->data49 = $usahawan->insentifsebelumnama;
            $excel->data50 = $usahawan->insentifsebelumjum;
            $excel->data51 = $usahawan->insentifsebelumtahun;
            if(isset($usahawan->syarikat)){
                $excel->data52 = $usahawan->syarikat->nodaftarpersijilanhalal;
            }
            
            $array[] = array(
                        "data1"=>$excel->data1, 
                        "data2"=>$excel->data2,
                        "data3"=>$excel->data3,
                        "data4"=>$excel->data4,
                        "data5"=>$excel->data5,
                        "data6"=>$excel->data6,
                        "data7"=>$excel->data7,
                        "data8"=>$excel->data8,
                        "data9"=>$excel->data9,
                        "data10"=>$excel->data10,
                        "data11"=>$excel->data11,
                        "data12"=>$excel->data12,
                        "data13"=>$excel->data13,
                        "data14"=>$excel->data14,
                        "data15"=>$excel->data15,
                        "data16"=>$excel->data16,
                        "data17"=>$excel->data17,
                        "data18"=>$excel->data18,
                        "data19"=>$excel->data19,
                        "data20"=>$excel->data20,
                        "data21"=>$excel->data21,
                        "data22"=>$excel->data22,
                        "data23"=>$excel->data23,
                        "data24"=>$excel->data24,
                        "data25"=>$excel->data25,
                        "data26"=>$excel->data26,
                        "data27"=>$excel->data27,
                        "data28"=>$excel->data28,
                        "data29"=>$excel->data29,
                        "data30"=>$excel->data30,
                        "data31"=>$excel->data31,
                        "data32"=>$excel->data32,
                        "data33"=>$excel->data33,
                        "data34"=>$excel->data34,
                        "data35"=>$excel->data35,
                        "data36"=>$excel->data36,
                        "data37"=>$excel->data37,
                        "data38"=>$excel->data38,
                        "data39"=>$excel->data39,
                        "data40"=>$excel->data40,
                        "data41"=>$excel->data41,
                        "data42"=>$excel->data42,
                        "data43"=>$excel->data43,
                        "data44"=>$excel->data44,
                        "data45"=>$excel->data45,
                        "data46"=>$excel->data46,
                        "data47"=>$excel->data47,
                        "data48"=>$excel->data48,
                        "data49"=>$excel->data49,
                        "data50"=>$excel->data50,
                        "data51"=>$excel->data51,
                        "data52"=>$excel->data52
                        
            );
        }
        // dd($array);
        return $array;
    }

    public function headings(): array
    {
        return [
            ['NEGERI','PT RISDA','NAMA PEMOHON','NO K/P','UMUR','JANTINA','TARAF PENDIDIKAN','ALAMAT','POSKOD','DAERAH','NEGERI','DUN','PARLIMEN','NO TEL','NO SIC/ NO T/S (PEKEBUN KECIL)','NO K/P (PEKEBUN KECIL)','KATEGORI PEMOHON','JENIS PERNIAGAAN','KLUSTER PROJEK','SUB KLUSTER (PRODUK/ PERKHIDMATAN)','MEDIUM PEMASARAN (MEDIA SOSIAL)','ALAMAT MEDIUM (MEDIA SOSIAL)','JENIS BANTUAN (PROGRAM THN SEMASA)','KELULUSAN BANTUAN THN SEMASA (RM)','TAHUN TERIMA BANTUAN THN SEMASA','JUMLAH JUALAN BULANAN  (RM)  - TAHUN 2021','','','','','','','','','','','','JUMLAH JUALAN (RM)','PURATA JUALAN BULANAN (RM)','PENCAPAIAN SASARAN RM 2500/BLN','KATEGORI USAHAWAN','NAMA SYSRIKAT','JENIS MILIKAN SYARIKAT','NO. DAFTAR SYARIKAT (SSM)','ALAMAT SYARIKAT/ PERNIAGAAN','KOORDINAT PREMIS PERNIAGAAN','','E-MAIL','LAIN-LAIN BANTUAN RISDA TAHUN SEBELUM','','','NO SIJIL HALAL JAKIM'],
            ['','','','','','','','','','','','','','','','','','','','','','','','','','JAN','FEB','MAC','APR','MEI','JUN','JUL','AUG','SEP','OKT','NOV','DIS','','','','','','','','','LATITUD','LONGITUD','','JENIS BANTUAN','KELULUSAN BANTUAN (RM)','TAHUN TERIMA'],
        ];
    }
}