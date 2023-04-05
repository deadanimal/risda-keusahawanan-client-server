<?php

namespace App\Http\Controllers\Web\LAT;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\KategoriAliran;

class PenyataUntungRugiDetailControllerWeb extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }

        $getYear = date("Y");
        $val = new \stdClass();
        $val->jum1 = 0;
        $val->jum2 = 0;
        $val->jum3 = 0;
        $val->jum4 = 0;
        $val->jum5 = 0;
        $val->jum6 = 0;
        $val->jum7 = 0;
        $val->jum8 = 0;
        $val->jum9 = 0;
        $val->jum10 = 0;
        $val->jum11 = 0;
        $val->jum12 = 0;
        $val->jum13 = 0;
        $val->jum14 = 0;
        $val->jum15 = 0;
        $val->jum16 = 0;
        $val->jum17 = 0;
        $val->jum18 = 0;
        $val->jum19 = 0;
        $val->jum20 = 0;
        $val->jum21 = 0;
        $val->jum22 = 0;
        $val->jum23 = 0;
        $val->jum24 = 0;
        $val->jum25 = 0;
        $val->jum26 = 0;
        $val->jum27 = 0;
        $val->jum28 = 0;
        $val->jum29 = 0;
        $val->jum30 = 0;
        $val->jum31 = 0;
        $val->jum32 = 0;
        $val->jum33 = 0;
        $val->jum34 = 0;

        $reports = Report::where('type', 14)
        ->where('tab20', $authuser->id)
        ->where('tab2', $getYear)
        ->orderBy('tab3', 'ASC')
        ->orderBy('tab2', 'ASC')
        ->orderBy('tab1', 'ASC')
        ->get();

        foreach($reports as $report){
            if($report->tab3 == 1){
                $val->jum1 = $val->jum1 + $report->tab5;
            }else if($report->tab3 == 2){
                $val->jum2 = $val->jum2 + $report->tab5;
            }else if($report->tab3 == 11){
                $val->jum3 = $val->jum3 + $report->tab5;
            }else if($report->tab3 == 12){
                $val->jum5 = $val->jum5 + $report->tab5;
            }else if($report->tab3 == 10){
                $val->jum6 = $val->jum6 + $report->tab5;
            }else if($report->tab3 == 9){
                $val->jum7 = $val->jum7 + $report->tab5;
            }else if($report->tab3 == 3){
                $val->jum9 = $val->jum9 + $report->tab5;
            }else if($report->tab3 == 4){
                $val->jum12 = $val->jum12 + $report->tab5;
            }else if($report->tab3 == 13){
                $val->jum15 = $val->jum15 + $report->tab5;
            }else if($report->tab3 == 14){
                $val->jum16 = $val->jum16 + $report->tab5;
            }else if($report->tab3 == 15){
                $val->jum17 = $val->jum17 + $report->tab5;
            }else if($report->tab3 == 16){
                $val->jum18 = $val->jum18 + $report->tab5;
            }else if($report->tab3 == 17){
                $val->jum19 = $val->jum19 + $report->tab5;
            }else if($report->tab3 == 18){
                $val->jum20 = $val->jum20 + $report->tab5;
            }else if($report->tab3 == 19){
                $val->jum21 = $val->jum21 + $report->tab5;
            }else if($report->tab3 == 20){
                $val->jum22 = $val->jum22 + $report->tab5;
            }else if($report->tab3 == 21){
                $val->jum23 = $val->jum23 + $report->tab5;
            }else if($report->tab3 == 22){
                $val->jum24 = $val->jum24 + $report->tab5;
            }else if($report->tab3 == 23){
                $val->jum25 = $val->jum25 + $report->tab5;
            }else if($report->tab3 == 24){
                $val->jum26 = $val->jum26 + $report->tab5;
            }else if($report->tab3 == 26){
                $val->jum27 = $val->jum27 + $report->tab5;
            }else if($report->tab3 == 7){
                $val->jum29 = $val->jum29 + $report->tab5;
            }else if($report->tab3 == 6){
                $val->jum30 = $val->jum30 + $report->tab5;
            }else if($report->tab3 == 5){
                $val->jum31 = $val->jum31 + $report->tab5;
            }else if($report->tab3 == 8){
                $val->jum32 = $val->jum32 + $report->tab5;
            }
        }
        $val->jum4 = ($val->jum1 + $val->jum2) - $val->jum3;
        $val->jum8 = $val->jum6 + $val->jum7;
        $val->jum10 = $val->jum8 - $val->jum9;
        $val->jum11 = $val->jum10 + $val->jum5;
        $val->jum13 = $val->jum11 - $val->jum12;
        $val->jum14 = $val->jum4 - $val->jum13;
        $val->jum28 = $val->jum15 + $val->jum16 + $val->jum17 + $val->jum18 + $val->jum19 + $val->jum20 + $val->jum21 + $val->jum22 + $val->jum23
        + $val->jum24 + $val->jum25 + $val->jum26 + $val->jum27;
        $val->jum33 = $val->jum29 + $val->jum30 + $val->jum31 + $val->jum32;
        $val->jum34 = $val->jum4 - $val->jum13 - $val->jum28 + $val->jum33;
        return view('laporanalirantunai.untungrugidetail'
        ,[
            'val'=>$val
        ]
        );
    }

    public function show(Request $request)
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }

        if($request->bulan == null){
            $reports = Report::where('type', 14)
            ->where('tab20', $authuser->id)
            ->where('tab2', $request->tahun)
            ->orderBy('tab3', 'ASC')
            ->orderBy('tab2', 'ASC')
            ->orderBy('tab1', 'ASC')
            ->get();
        }
        if($request->bulan != null && $request->tahun != null){
            $reports = Report::where('type', 14)
            ->where('tab20', $authuser->id)
            ->where('tab2', $request->tahun)
            ->where('tab1', $request->bulan)
            ->orderBy('tab3', 'ASC')
            ->orderBy('tab2', 'ASC')
            ->orderBy('tab1', 'ASC')
            ->get();
        }

        $val = new \stdClass();
        $val->jum1 = 0;
        $val->jum2 = 0;
        $val->jum3 = 0;
        $val->jum4 = 0;
        $val->jum5 = 0;
        $val->jum6 = 0;
        $val->jum7 = 0;
        $val->jum8 = 0;
        $val->jum9 = 0;
        $val->jum10 = 0;
        $val->jum11 = 0;
        $val->jum12 = 0;
        $val->jum13 = 0;
        $val->jum14 = 0;
        $val->jum15 = 0;
        $val->jum16 = 0;
        $val->jum17 = 0;
        $val->jum18 = 0;
        $val->jum19 = 0;
        $val->jum20 = 0;
        $val->jum21 = 0;
        $val->jum22 = 0;
        $val->jum23 = 0;
        $val->jum24 = 0;
        $val->jum25 = 0;
        $val->jum26 = 0;
        $val->jum27 = 0;
        $val->jum28 = 0;
        $val->jum29 = 0;
        $val->jum30 = 0;
        $val->jum31 = 0;
        $val->jum32 = 0;
        $val->jum33 = 0;
        $val->jum34 = 0;

        foreach($reports as $report){
            if($report->tab3 == 1){
                $val->jum1 = $val->jum1 + $report->tab5;
            }else if($report->tab3 == 2){
                $val->jum2 = $val->jum2 + $report->tab5;
            }else if($report->tab3 == 11){
                $val->jum3 = $val->jum3 + $report->tab5;
            }else if($report->tab3 == 12){
                $val->jum5 = $val->jum5 + $report->tab5;
            }else if($report->tab3 == 10){
                $val->jum6 = $val->jum6 + $report->tab5;
            }else if($report->tab3 == 9){
                $val->jum7 = $val->jum7 + $report->tab5;
            }else if($report->tab3 == 3){
                $val->jum9 = $val->jum9 + $report->tab5;
            }else if($report->tab3 == 4){
                $val->jum12 = $val->jum12 + $report->tab5;
            }else if($report->tab3 == 13){
                $val->jum15 = $val->jum15 + $report->tab5;
            }else if($report->tab3 == 14){
                $val->jum16 = $val->jum16 + $report->tab5;
            }else if($report->tab3 == 15){
                $val->jum17 = $val->jum17 + $report->tab5;
            }else if($report->tab3 == 16){
                $val->jum18 = $val->jum18 + $report->tab5;
            }else if($report->tab3 == 17){
                $val->jum19 = $val->jum19 + $report->tab5;
            }else if($report->tab3 == 18){
                $val->jum20 = $val->jum20 + $report->tab5;
            }else if($report->tab3 == 19){
                $val->jum21 = $val->jum21 + $report->tab5;
            }else if($report->tab3 == 20){
                $val->jum22 = $val->jum22 + $report->tab5;
            }else if($report->tab3 == 21){
                $val->jum23 = $val->jum23 + $report->tab5;
            }else if($report->tab3 == 22){
                $val->jum24 = $val->jum24 + $report->tab5;
            }else if($report->tab3 == 23){
                $val->jum25 = $val->jum25 + $report->tab5;
            }else if($report->tab3 == 24){
                $val->jum26 = $val->jum26 + $report->tab5;
            }else if($report->tab3 == 26){
                $val->jum27 = $val->jum27 + $report->tab5;
            }else if($report->tab3 == 7){
                $val->jum29 = $val->jum29 + $report->tab5;
            }else if($report->tab3 == 6){
                $val->jum30 = $val->jum30 + $report->tab5;
            }else if($report->tab3 == 5){
                $val->jum31 = $val->jum31 + $report->tab5;
            }else if($report->tab3 == 8){
                $val->jum32 = $val->jum32 + $report->tab5;
            }
        }
        $val->jum4 = ($val->jum1 + $val->jum2) - $val->jum3;
        $val->jum8 = $val->jum6 + $val->jum7;
        $val->jum10 = $val->jum8 - $val->jum9;
        $val->jum11 = $val->jum10 + $val->jum5;
        $val->jum13 = $val->jum11 - $val->jum12;
        $val->jum14 = $val->jum4 - $val->jum13;
        $val->jum28 = $val->jum15 + $val->jum16 + $val->jum17 + $val->jum18 + $val->jum19 + $val->jum20 + $val->jum21 + $val->jum22 + $val->jum23
        + $val->jum24 + $val->jum25 + $val->jum26 + $val->jum27;
        $val->jum33 = $val->jum29 + $val->jum30 + $val->jum31 + $val->jum32;
        $val->jum34 = $val->jum4 - $val->jum13 - $val->jum28 + $val->jum33;

        $result = '
        <tr class="align-middle" style="text-align: left;">
            <td>HASIL JUALAN / PEROLEHAN (SALES)</td>
            <td class="text-nowrap"></td> 
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Jualan/ Perolehan</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum1,2).'</td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Deposit Jualan</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum2,2).'</td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Pulangan Jualan</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum3,2).'</td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Jualan Bersih</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum4,2).'</td>
        </tr>
        <tr>
            <td style="padding-top: 20px;"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">KOS LANGSUNG / KOS JUALAN (COGS)</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Stok Awal</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum5,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Deposit Belian </td>
            <td class="text-nowrap">'.number_format($val->jum6,2).'</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Belian</td>
            <td class="text-nowrap">'.number_format($val->jum7,2).'</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Belian Bersih</td>
            <td class="text-nowrap">'.number_format($val->jum8,2).'</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Pulangan Belian</td>
            <td class="text-nowrap">'.number_format($val->jum9,2).'</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Kos Belian</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum10,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Kos Barang Sedia Dijual</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum11,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Stok Akhir</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum12,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Kos Jualan</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum13,2).'</td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">UNTUNG / RUGI KASAR</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum14,2).'</td>
        </tr>
        <tr>
            <td style="padding-top: 20px;"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">PERBELANJAAN PENTADBIRAN DAN OPERASI (OPEX)</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Kos Pengeposan</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum15,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Kos Alat Tulis</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum16,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Bayaran Sewa</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum17,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Upah/ Gaji Pekerja</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum18,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Upah/ Gaji Sendiri</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum19,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">KWSP/ SOCSO</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum20,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Bayaran Bil (Utiliti)</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum21,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Petrol/ Tol/ Parking</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum22,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Penyelenggaraan</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum23,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Belian Aset</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum24,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Bayaran Komisen</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum25,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Cukai/ Zakat</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum26,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Bayaran Lain</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum27,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">JUMLAH PERBELANJAAN PENTADBIRAN DAN OPERASI</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum28,2).'</td>
        </tr>
        <tr>
            <td style="padding-top: 20px;"></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">HASIL - HASIL LAIN</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Hasil Komisen</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum29,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Hasil Dividen</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum30,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Hasil Sewaan</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum31,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">Hasil Lain</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum32,2).'</td>
            <td class="text-nowrap"></td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">JUMLAH HASIL -HASIL LAIN</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum33,2).'</td>
        </tr>
        <tr class="align-middle" style="text-align: left;">
            <td class="text-nowrap">UNTUNG / RUGI BERSIH</td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap"></td>
            <td class="text-nowrap">'.number_format($val->jum34,2).'</td>
        </tr>
        ';

        return $result;

    }
}
?>
