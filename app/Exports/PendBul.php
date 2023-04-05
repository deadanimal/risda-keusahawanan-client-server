<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\Negeri;
use App\Models\JenisInsentif;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendBul implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $tahun;

    function __construct($tahun,$jenis) {
        $this->tahun = $tahun;
        $this->jenis = $jenis;
    }

    public function collection()
    {


                // foreach ($users as $usahawan) {

        //         $dateOfBirth = $usahawan->tarikhlahir;
        //         $today = date("Y-m-d");
        //         $diff = date_diff(date_create($dateOfBirth), date_create($today));
        //         $usahawan->umur = $diff->format('%y');

        //         if($usahawan->U_Jantina_ID == 1){
        //             $usahawan->jantina = "Lelaki";
        //         }else if($usahawan->U_Jantina_ID == 2){
        //             $usahawan->jantina = "Perempuan";
        //         }else{
        //             $usahawan->jantina = "Lain - Lain";
        //         }
                
        //         if($usahawan->U_Pendidikan_ID == 1){
        //             $usahawan->taraf_pendidikan = 'UPSR/PSRA/Setaraf';
        //         }else if($usahawan->U_Pendidikan_ID == 2){
        //             $usahawan->taraf_pendidikan = 'PMR/SRP/LCE/Setaraf';
        //         }else if($usahawan->U_Pendidikan_ID == 3){
        //             $usahawan->taraf_pendidikan = 'SPM/MCE/Setaraf';
        //         }else if($usahawan->U_Pendidikan_ID == 4){
        //             $usahawan->taraf_pendidikan = 'STPM/Diploma/Setaraf';
        //         }else if($usahawan->U_Pendidikan_ID == 5){
        //             $usahawan->taraf_pendidikan = 'Ijazah Pertama/Ke Atas';
        //         }else if($usahawan->U_Pendidikan_ID == 6){
        //             $usahawan->taraf_pendidikan = 'Tiada';
        //         }else{
        //             $usahawan->taraf_pendidikan = '';
        //         }
                
        //         $usahawan->MediumPemasaran = "";
        //         $usahawan->AlamatMediumPemasaran = "";

        //         if(isset($usahawan->perniagaan)){
                    
        //             if($usahawan->perniagaan->facebook != ""){
        //                 $usahawan->MediumPemasaran .= "Facebook ";
        //                 $usahawan->AlamatMediumPemasaran .= "Facebook - ".$usahawan->perniagaan->facebook;
        //             }
        //             if($usahawan->perniagaan->instagram != ""){
        //                 $usahawan->MediumPemasaran .= "Instagram ";
        //                 $usahawan->AlamatMediumPemasaran .= "Instagram - ".$usahawan->perniagaan->instagram;
        //             }
        //             if($usahawan->perniagaan->twitter != ""){
        //                 $usahawan->MediumPemasaran .= "Twitter ";
        //                 $usahawan->AlamatMediumPemasaran .= "Twitter - ".$usahawan->perniagaan->twitter;
        //             }
        //         }
                
        //         if(isset($usahawan->syarikat)){
        //             if($usahawan->syarikat->jenismilikanperniagaan == "JPP01"){
        //                 $usahawan->jenismilikan = "PEMILIKAN TUNGGAL";
        //             }else if($usahawan->syarikat->jenismilikanperniagaan == "JPP02"){
        //                 $usahawan->jenismilikan = "PERKONGSIAN";
        //             }else if($usahawan->syarikat->jenismilikanperniagaan == "JPP03"){
        //                 $usahawan->jenismilikan = "SYARIKAT SDN BHD";
        //             }else if($usahawan->syarikat->jenismilikanperniagaan == "JPP04"){
        //                 $usahawan->jenismilikan = "PERKONGSIAN LIABILITI TERHAD";
        //             }

        //             $usahawan->alamatsyarikat = $usahawan->syarikat->alamat1_ssm.",".$usahawan->syarikat->alamat2_ssm.",".$usahawan->syarikat->alamat3_ssm;
        //         }

        //         $insentif = Insentif::where('id_pengguna', $usahawan->usahawanid)->orderBy('tahun_terima_insentif', 'desc')->first();
        //         if(isset($insentif)){
        //             $jenisinsentif = JenisInsentif::where('id_jenis_insentif', $insentif->id_jenis_insentif)->first();
        //             if(isset($jenisinsentif)){
        //                 $usahawan->jnsbantuansemasa = $jenisinsentif->nama_insentif;
        //             }
        //             $usahawan->kelulusanbantuansemasa = $insentif->nilai_insentif;
        //             $usahawan->thnbantuansemasa = $insentif->tahun_terima_insentif;
        //         }

        //         $insentif2 = Insentif::where('id_pengguna', $usahawan->usahawanid)->get();
        //         foreach ($insentif2 as $insentif2s) {
        //             $jenisinsentif = JenisInsentif::where('id_jenis_insentif', $insentif2s->id_jenis_insentif)->first();
        //             if(isset($jenisinsentif)){
        //                 $usahawan->insentifsebelumnama = $usahawan->insentifsebelumnama."/".$jenisinsentif->nama_insentif;
        //             }
        //             $usahawan->insentifsebelumjum = $usahawan->insentifsebelumjum."/".$insentif2s->nilai_insentif;
        //             $usahawan->insentifsebelumtahun = $usahawan->insentifsebelumtahun."/".$insentif2s->tahun_terima_insentif;
        //         }
        //         // dd($usahawan->usahawanid);
        //         $pengguna = User::where('usahawanid', $usahawan->usahawanid)->first();
        //         $getYear = date("Y");
        //         unset($usahawan->aliran1);
        //         unset($usahawan->aliran2);
        //         unset($usahawan->aliran3);
        //         unset($usahawan->aliran4);
        //         unset($usahawan->aliran5);
        //         unset($usahawan->aliran6);
        //         unset($usahawan->aliran7);
        //         unset($usahawan->aliran8);
        //         unset($usahawan->aliran9);
        //         unset($usahawan->aliran10);
        //         unset($usahawan->aliran11);
        //         unset($usahawan->aliran12);
        //         if(isset($pengguna)){
        //             $alirans = Aliran::where('id_pengguna', $pengguna->id)->where('id_kategori_aliran',1)->whereYear('tarikh_aliran', '=', $getYear)->get();
        //         }else{
        //             unset($alirans);
        //         }
                
        //         // dd($aliran);
        //         if(isset($alirans)){
        //             foreach ($alirans as $aliran) {
        //                 $aliran->bulan = date('m', strtotime($aliran->tarikh_aliran));
        //                 if($aliran->bulan == 1){
        //                     $usahawan->aliran1 = $usahawan->aliran1 + $aliran->jumlah_aliran;
        //                 }else if($aliran->bulan == 2){
        //                     $usahawan->aliran2 = $usahawan->aliran2 + $aliran->jumlah_aliran;
        //                 }else if($aliran->bulan == 3){
        //                     $usahawan->aliran3 = $usahawan->aliran3 + $aliran->jumlah_aliran;
        //                 }else if($aliran->bulan == 4){
        //                     $usahawan->aliran4 = $usahawan->aliran4 + $aliran->jumlah_aliran;
        //                 }else if($aliran->bulan == 5){
        //                     $usahawan->aliran5 = $usahawan->aliran5 + $aliran->jumlah_aliran;
        //                 }else if($aliran->bulan == 6){
        //                     $usahawan->aliran6 = $usahawan->aliran6 + $aliran->jumlah_aliran;
        //                 }else if($aliran->bulan == 7){
        //                     $usahawan->aliran7 = $usahawan->aliran7 + $aliran->jumlah_aliran;
        //                 }else if($aliran->bulan == 8){
        //                     $usahawan->aliran8 = $usahawan->aliran8 + $aliran->jumlah_aliran;
        //                 }else if($aliran->bulan == 9){
        //                     $usahawan->aliran9 = $usahawan->aliran9 + $aliran->jumlah_aliran;
        //                 }else if($aliran->bulan == 10){
        //                     $usahawan->aliran10 = $usahawan->aliran10 + $aliran->jumlah_aliran;
        //                 }else if($aliran->bulan == 11){
        //                     $usahawan->aliran11 = $usahawan->aliran11 + $aliran->jumlah_aliran;
        //                 }else if($aliran->bulan == 12){
        //                     $usahawan->aliran12 = $usahawan->aliran12 + $aliran->jumlah_aliran;
        //                 }
        //                 $usahawan->jumaliran = $usahawan->jumaliran + $aliran->jumlah_aliran;
        //             }
        //         }
                
        //         $usahawan->purataaliran = $usahawan->jumaliran / 12;

        //         if($usahawan->purataaliran >= 2500){
        //             $usahawan->capaisasaran = "capai";
        //         }else{
        //             $usahawan->capaisasaran = "tidak capai";
        //         }
        // }
         
                

       
        // }
        return "test";
    }

    public function headings(): array
    {
        return ["No", "NEGERI", "PT RISDA", "NAMA PEMOHON", "NO K/P", "JUMLAH JUALAN", "PURATA JUALAN"];
    }
}
