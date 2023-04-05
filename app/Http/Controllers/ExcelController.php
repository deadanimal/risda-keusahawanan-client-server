<?php

namespace App\Http\Controllers;

use App\Exports\BukuTunai;
use App\Exports\Lejer;
use App\Exports\Pnl;
use App\Exports\TestExport;
use App\Models\Aliran;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Input;
use App\Item;
use App\Models\User;
use Excel;
use PDF;
// use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    //
    public function bukuTunaiExcel(Request $request)
    {

        $id = $request->id;
        $month = $request->bulan;
        $year = $request->tahun;

        $aliran = User::all();

        $fname = 'buku-tunai-excel/'. time() . '-buku-tunai-' . $month . $year.'.xlsx';
        Excel::store(new BukuTunai($id, $month, $year), $fname);
        
        return response()->json($fname) ;

    }

    public function bukuTunaiPdf(Request $request)
    {

        $id = $request->id;
        $month = $request->bulan;
        $year = $request->tahun;

        $user_id = $id;

        $aliran = Aliran::where('id_pengguna', $user_id)
            ->whereMonth('tarikh_aliran', '=', $month)
            ->whereYear('tarikh_aliran', '=', $year)
            ->get();

        foreach ($aliran as $a) {
            $T = $a->tarikh_aliran;
            $n = explode(' ',$T);
            $new = $n[1].' '.$n[0].' '.$n[2];
    
            $a['newTarikh'] = $new;
        }        

        $pdf = PDF::loadView('excel.buku-tunai', [
            'alirans' => $aliran,
            'id' => $user_id,
            'bulan' => $month,
            'tahun' => $year,
        ]);

        $fname = time() . '-buku-tunai-' . $month . $year.'.pdf';

        \Storage::put('buku-tunai-pdf/' . $fname, $pdf->output());

        // dd($file);

        return response()->json("buku-tunai-pdf/".$fname);

    }


    public function pnlExcel(Request $request)
    {

        // dd($id);
        $id = $request->id;
        $month = $request->bulan;
        $year = $request->tahun;

        $aliran = User::all();
       

        // $fname = 'pnl-excel-'. time() . '-pnl-' . $month . $year.'.xlsx';
        // return Excel::download(new Pnl($id, $month, $year), $fname);
        
        // return response()->json($fname) ;

        $fname = 'pnl-excel/'. time() . '-pnl-' . $month . $year.'.xlsx';
        Excel::store(new pnl($id, $month, $year), $fname);
        
        return response()->json($fname) ;

    }

    public function pnlPdf(Request $request){

        $id = $request->id;
        $month = $request->bulan;
        $year = $request->tahun;


        $user_id = $id;


        $syarikat = User::where('users.id', $user_id)
        ->join('usahawans', 'usahawans.usahawanid','users.usahawanid')
        ->join('syarikats', 'syarikats.usahawanid','users.usahawanid')
        ->select('syarikats.namasyarikat')
        ->get()->first();

        // return response()->json($syarikat);


        $aliran = Aliran::where('id_pengguna', $user_id)
        ->whereMonth('tarikh_aliran', '=', $month)
        ->whereYear('tarikh_aliran', '=', $year)
        ->get();


        $jualan_perolehan = 0;
        $deposit_jualan = 0;
        $pulangan_belian = 0;
        $stok_akhir = 0;
        
        $hasil_sewaan = 0;
        $hasil_dividen = 0;
        $hasil_komisen = 0;
        $hasil_lain = 0;

        $belian = 0;
        $deposit_belian = 0;
        $pulangan_jualan = 0;
        $stok_awal = 0;
        $kos_pengeposan = 0;
        
        $kos_alat_tulis = 0;
        $bayaran_sewa = 0;
        $upah_gaji_pekerja = 0;
        $upah_gaji_sendiri = 0;
        $kwsp_socso = 0;
        
        $bayaran_bil = 0;
        $petrol_tol_parking = 0;
        $penyelenggaraan = 0;
        $belian_aset = 0;
        $bayaran_komisen = 0;
        $cukai_zakat = 0;
        $bayaran_lain = 0;

        // dd($aliran);

        foreach($aliran as $aliranTemp){

            if($aliranTemp->id_kategori_aliran == 1){
                $jualan_perolehan += $aliranTemp->jumlah_aliran;

            }else if($aliranTemp->id_kategori_aliran == 2){
                $deposit_jualan += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 3){
                $pulangan_belian += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 4){
                $stok_akhir += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 5){
                $hasil_sewaan += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 6){
                $hasil_dividen += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 7){
                $hasil_komisen += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 8){
                $hasil_lain += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 9){
                $belian += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 10){
                $deposit_belian += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 11){
                $pulangan_jualan += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 12){
                $stok_awal += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 13){
                $kos_pengeposan += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 14){
                $kos_alat_tulis += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 15){
                $bayaran_sewa += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 16){
                $upah_gaji_pekerja += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 17){
                $upah_gaji_sendiri += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 18){
                $kwsp_socso += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 19){
                $bayaran_bil += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 20){
                $petrol_tol_parking += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 21){
                $penyelenggaraan += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 22){
                $belian_aset += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 23){
                $bayaran_komisen += $aliranTemp->jumlah_aliran;
 
            } else if($aliranTemp->id_kategori_aliran == 24){
                $cukai_zakat += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 26){
                $bayaran_lain += $aliranTemp->jumlah_aliran;

            }
        }


        $pdf = PDF::loadView('excel.pnl', [
            'id' => $user_id,
            'bulan' => $month,
            'tahun' => $year,

            'syarikat' => $syarikat,

            'jualan_perolehan' => $jualan_perolehan,
            'deposit_jualan' => $deposit_jualan,
            'pulangan_jualan' => $pulangan_jualan,
            'stok_awal' => $stok_awal,
            'deposit_belian'=> $deposit_belian,
            'belian'=> $belian,
            'pulangan_belian'=>$pulangan_belian,
            'stok_akhir'=>$stok_akhir,

            'kos_pengeposan'=>$kos_pengeposan,
            'kos_alat_tulis'=>$kos_alat_tulis,
            'bayaran_sewa'=>$bayaran_sewa,
            'upah_gaji_pekerja'=>$upah_gaji_pekerja,
            'upah_gaji_sendiri'=>$upah_gaji_sendiri,
            'kwsp_socso'=>$kwsp_socso,
            'bayaran_bil'=>$bayaran_bil,
            'petrol_tol_parking'=>$petrol_tol_parking,
            'penyelenggaraan'=>$penyelenggaraan,
            'belian_aset'=>$belian_aset,
            'bayaran_komisen'=>$bayaran_komisen,
            'cukai_zakat'=>$cukai_zakat,
            'bayaran_lain'=>$bayaran_lain,

            'hasil_komisen'=>$hasil_komisen,
            'hasil_dividen'=>$hasil_dividen,
            'hasil_sewaan'=>$hasil_sewaan,
            'hasil_lain'=>$hasil_lain,
        ]);

        $fname = time() . '-pnl-' . $month . $year.".pdf";

        \Storage::put('pnl-pdf/' . $fname, $pdf->output());

        return response()->json("pnl-pdf/".$fname);

    }


    public function lejerExcel(Request $request)
    {

        $id = $request->id;
        $month = $request->bulan;
        $year = $request->tahun;

        $aliran = User::all();
       

        $fname = 'Lejer-excel/'. time() . '-Lejar-' . $month . $year.'.xlsx';
        Excel::store(new Lejer($id, $month, $year), $fname);
        
        return response()->json($fname) ;

    }

    public function lejerPdf(Request $request){

        $id = $request->id;
        $month = $request->bulan;
        $year = $request->tahun;


        $user_id = $id;


        $aliran = Aliran::where('id_pengguna', $user_id)
        ->whereMonth('tarikh_aliran', '=', $month)
        ->whereYear('tarikh_aliran', '=', $year)
        ->get();

        $jualan_perolehan = 0;
        $deposit_jualan = 0;
        $pulangan_belian = 0;
        $stok_akhir = 0;
        
        $hasil_sewaan = 0;
        $hasil_dividen = 0;
        $hasil_komisen = 0;
        $hasil_lain = 0;

        $belian = 0;
        $deposit_belian = 0;
        $pulangan_jualan = 0;
        $stok_awal = 0;
        $kos_pengeposan = 0;
        
        $kos_alat_tulis = 0;
        $bayaran_sewa = 0;
        $upah_gaji_pekerja = 0;
        $upah_gaji_sendiri = 0;
        $kwsp_socso = 0;
        
        $bayaran_bil = 0;
        $petrol_tol_parking = 0;
        $penyelenggaraan = 0;
        $belian_aset = 0;
        $bayaran_komisen = 0;
        $cukai_zakat = 0;
        $bayaran_lain = 0;
        $bayaran_pinjaman =0;

        // dd($aliran);

        foreach($aliran as $aliranTemp){

            if($aliranTemp->id_kategori_aliran == 1){
                $jualan_perolehan += $aliranTemp->jumlah_aliran;

            }else if($aliranTemp->id_kategori_aliran == 2){
                $deposit_jualan += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 3){
                $pulangan_belian += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 4){
                $stok_akhir += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 5){
                $hasil_sewaan += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 6){
                $hasil_dividen += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 7){
                $hasil_komisen += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 8){
                $hasil_lain += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 9){
                $belian += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 10){
                $deposit_belian += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 11){
                $pulangan_jualan += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 12){
                $stok_awal += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 13){
                $kos_pengeposan += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 14){
                $kos_alat_tulis += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 15){
                $bayaran_sewa += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 16){
                $upah_gaji_pekerja += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 17){
                $upah_gaji_sendiri += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 18){
                $kwsp_socso += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 19){
                $bayaran_bil += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 20){
                $petrol_tol_parking += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 21){
                $penyelenggaraan += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 22){
                $belian_aset += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 23){
                $bayaran_komisen += $aliranTemp->jumlah_aliran;
 
            } else if($aliranTemp->id_kategori_aliran == 24){
                $cukai_zakat += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 25){
                $bayaran_pinjaman += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 26){
                $bayaran_lain += $aliranTemp->jumlah_aliran;

            }
        }

        $nextmonth = new Carbon('first day of next month');

        foreach ($aliran as $a) {
            $T = $a->tarikh_aliran;
            $n = explode(' ',$T);
            $new = $n[0].' '.$n[1];

            $a['newTarikh'] = $new;
        }


        $pdf = PDF::loadView('excel.lejer', [
            'alirans'=>$aliran,
            'id' => $user_id,
            'bulan' => $month,
            'nextmonth'=>$nextmonth,
            'tahun' => $year,

            'jualan_perolehan' => $jualan_perolehan,
            'deposit_jualan' => $deposit_jualan,
            'pulangan_jualan' => $pulangan_jualan,
            'stok_awal' => $stok_awal,
            'deposit_belian'=> $deposit_belian,
            'belian'=> $belian,
            'pulangan_belian'=>$pulangan_belian,
            'stok_akhir'=>$stok_akhir,

            'kos_pengeposan'=>$kos_pengeposan,
            'kos_alat_tulis'=>$kos_alat_tulis,
            'bayaran_sewa'=>$bayaran_sewa,
            'upah_gaji_pekerja'=>$upah_gaji_pekerja,
            'upah_gaji_sendiri'=>$upah_gaji_sendiri,
            'kwsp_socso'=>$kwsp_socso,
            'bayaran_bil'=>$bayaran_bil,
            'petrol_tol_parking'=>$petrol_tol_parking,
            'penyelenggaraan'=>$penyelenggaraan,
            'belian_aset'=>$belian_aset,
            'bayaran_komisen'=>$bayaran_komisen,
            'cukai_zakat'=>$cukai_zakat,
            'bayaran_pinjaman'=>$bayaran_pinjaman,
            'bayaran_lain'=>$bayaran_lain,

            'hasil_komisen'=>$hasil_komisen,
            'hasil_dividen'=>$hasil_dividen,
            'hasil_sewaan'=>$hasil_sewaan,
            'hasil_lain'=>$hasil_lain,
        ]);

        

        $fname = time() . '-Lejer-' . $month . $year.".pdf";

        // return $pdf->download($fname . '.pdf');

        \Storage::put('Lejer-pdf/' . $fname, $pdf->output());

        return response()->json("Lejer-pdf/".$fname);

    }



    public function calcPNL(Request $request){

        $id = $request->id;
        $month = $request->bulan;
        $year = $request->tahun;

        // $id = 1;
        // $month = 1;
        // $year = 2022;

        $user_id = $id;


        $aliran = Aliran::where('id_pengguna', $user_id)
        ->whereMonth('tarikh_aliran', '=', $month)
        ->whereYear('tarikh_aliran', '=', $year)
        ->get();


        $jualan_perolehan = 0;
        $deposit_jualan = 0;
        $pulangan_belian = 0;
        $stok_akhir = 0;
        
        $hasil_sewaan = 0;
        $hasil_dividen = 0;
        $hasil_komisen = 0;
        $hasil_lain = 0;

        $belian = 0;
        $deposit_belian = 0;
        $pulangan_jualan = 0;
        $stok_awal = 0;
        $kos_pengeposan = 0;
        
        $kos_alat_tulis = 0;
        $bayaran_sewa = 0;
        $upah_gaji_pekerja = 0;
        $upah_gaji_sendiri = 0;
        $kwsp_socso = 0;
        
        $bayaran_bil = 0;
        $petrol_tol_parking = 0;
        $penyelenggaraan = 0;
        $belian_aset = 0;
        $bayaran_komisen = 0;
        $cukai_zakat = 0;
        $bayaran_lain = 0;


        foreach($aliran as $aliranTemp){

            if($aliranTemp->id_kategori_aliran == 1){
                $jualan_perolehan += $aliranTemp->jumlah_aliran;

            }else if($aliranTemp->id_kategori_aliran == 2){
                $deposit_jualan += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 3){
                $pulangan_belian += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 4){
                $stok_akhir += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 5){
                $hasil_sewaan += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 6){
                $hasil_dividen += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 7){
                $hasil_komisen += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 8){
                $hasil_lain += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 9){
                $belian += $aliranTemp->jumlah_aliran;
                
            } else if($aliranTemp->id_kategori_aliran == 10){
                $deposit_belian += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 11){
                $pulangan_jualan += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 12){
                $stok_awal += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 13){
                $kos_pengeposan += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 14){
                $kos_alat_tulis += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 15){
                $bayaran_sewa += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 16){
                $upah_gaji_pekerja += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 17){
                $upah_gaji_sendiri += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 18){
                $kwsp_socso += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 19){
                $bayaran_bil += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 20){
                $petrol_tol_parking += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 21){
                $penyelenggaraan += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 22){
                $belian_aset += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 23){
                $bayaran_komisen += $aliranTemp->jumlah_aliran;
 
            } else if($aliranTemp->id_kategori_aliran == 24){
                $cukai_zakat += $aliranTemp->jumlah_aliran;

            } else if($aliranTemp->id_kategori_aliran == 26){
                $bayaran_lain += $aliranTemp->jumlah_aliran;

            }
        }

        //hasil jualan
        $jualan_bersih = $jualan_perolehan + $deposit_jualan - $pulangan_jualan;
       
        //kos jualan
        $belian_bersih = $deposit_belian + $belian;
        $kos_belian = $belian_bersih - $pulangan_belian;
        $kos_barang_sedia_dijual = $stok_awal + $kos_belian;
        $kos_jualan = $kos_barang_sedia_dijual - $stok_akhir;


        // opex
        $jumlah_perbelanjaan = $kos_pengeposan + $kos_alat_tulis + $bayaran_sewa + $upah_gaji_pekerja + $upah_gaji_sendiri + $kwsp_socso + $bayaran_bil + $petrol_tol_parking + $penyelenggaraan + $belian_aset + $bayaran_komisen + $cukai_zakat + $bayaran_lain;


        //untung rugi kasar
        $untung_rugi_kasar = $jualan_bersih - $kos_jualan;


        $vars = array(
            "hasil_jualan"=>$jualan_bersih, 
            "kos_jualan"=>$kos_jualan,
            "opex"=>$jumlah_perbelanjaan,
            "untung_rugi_kasar"=> $untung_rugi_kasar,
        );

        // dd($vars);

        return response()->json($vars);

    }
}
