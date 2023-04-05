<?php

namespace App\Http\Controllers\Web\LAT;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\KategoriAliran;

class LaporanLejarDetailControllerWeb extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }

        $getYear = date("Y");

        $reports1 = Report::where('type', 12)
        ->where('tab20', $authuser->id)
        ->where('tab2', $getYear)
        ->where('tab3', 0)
        ->orderBy('tab2', 'ASC')
        ->orderBy('tab1', 'ASC')
        ->get();

        $reports2 = Report::where('type', 12)
        ->where('tab20', $authuser->id)
        ->where('tab2', $getYear)
        ->where('tab3', '!=', 0)
        ->orderBy('tab3', 'ASC')
        ->orderBy('tab2', 'ASC')
        ->orderBy('tab1', 'ASC')
        ->get();
        $total = 0;

        $total1 = 0;
        $total2 = 0;
        $totalHB1 = 0;

        $jumlah = 0;

        $val = new \stdClass();
        $val->satu = 0;
        $val->dua = 0;
        foreach($reports1 as $report1){
            // dd($report1->tab9);
            if($report1->tab4 == 2){
                $total1 = $total1 + $report1->tab7;
            }
            if($report1->tab4 == 1){
                $total2 = $total2 + $report1->tab7;
            }
        }
        $totalHB1 = $total1 - $total2;
        if($total1 > $total2){
            $jumlah = $total1;
            $val->satu = 2;
            $val->dua = $totalHB1;
        }else{
            $jumlah = $total2;
            $val->satu = 1;
            $val->dua = -$totalHB1;
            
        }

        foreach($reports2 as $key => $report2){
            $prevRow = new \stdClass();
            $prevRow->tab3 = 0;
            if (isset($reports2[$key + 1])) {
                $prevRow = $reports2[$key + 1];
            }else{
                $prevRow->tab3 = 0;
            }
            
            if($report2->tab3 != $prevRow->tab3){
                $total = $total + $report2->tab7;
                $report2->tab8 = "BAKI H/B";
                $report2->tab9 = $total;
                $total = 0;
            }else{
                $total = $total + $report2->tab7;
                $report2->tab8 = 0;
                $report2->tab9 = 0.00;
            }
        }
        
        return view('laporanalirantunai.lejardetail'
        ,[
            'reports1'=>$reports1,
            'reports2'=>$reports2,
            'jumlah'=>$jumlah,
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
            $reports1 = Report::where('type', 12)
            ->where('tab20', $authuser->id)
            ->where('tab2', $request->tahun)
            ->where('tab3', 0)
            ->orderBy('tab2', 'ASC')
            ->orderBy('tab1', 'ASC')
            ->get();

            $reports2 = Report::where('type', 12)
            ->where('tab20', $authuser->id)
            ->where('tab2', $request->tahun)
            ->where('tab3', '!=', 0)
            ->orderBy('tab3', 'ASC')
            ->orderBy('tab2', 'ASC')
            ->orderBy('tab1', 'ASC')
            ->get();
        }
        if($request->bulan != null && $request->tahun != null){
            $reports1 = Report::where('type', 12)
            ->where('tab20', $authuser->id)
            ->where('tab2', $request->tahun)
            ->where('tab1', $request->bulan)
            ->where('tab3', 0)
            ->orderBy('tab2', 'ASC')
            ->orderBy('tab1', 'ASC')
            ->get();

            $reports2 = Report::where('type', 12)
            ->where('tab20', $authuser->id)
            ->where('tab2', $request->tahun)
            ->where('tab1', $request->bulan)
            ->where('tab3', '!=', 0)
            ->orderBy('tab3', 'ASC')
            ->orderBy('tab2', 'ASC')
            ->orderBy('tab1', 'ASC')
            ->get();
        }
        $result = '<tr>
            <td style="text-align: left">DR</td>
            <td></td>
            <td colspan="2" style="text-align: center">TUNAI A/C</td>
            <td style="display: none;"></td>
            <td></td>
            <td style="text-align: right">CR</td>
        </tr>';

        $total1 = 0;
        $total2 = 0;

        $val = new \stdClass();
        $val->satu = 0;
        $val->dua = 0;

        $totalHB1 = 0;

        $total = 0;
        $reportcount = $reports1->count();
        foreach($reports1 as $report1){
            if($report1->tab4 == 2){
                $total1 = $total1 + $report1->tab7;
            }
            if($report1->tab4 == 1){
                $total2 = $total2 + $report1->tab7;
            }
        }
        $totalHB1 = $total1 - $total2;
        if($total1 > $total2){
            $jumlah = $total1;
            $val->satu = 2;
            $val->dua = $totalHB1;
        }else{
            $jumlah = $total2;
            $val->satu = 1;
            $val->dua = -$totalHB1;
        }

        foreach($reports1 as $report1){
            if($report1->tab7 == null){
                $report1->tab7 = 0;
            }
            if ($reportcount > 1 && ($report1->tab4 == 2)){
                $result .= '<tr>
                    <td class="text-nowrap">'.$report1->tab5.'</td>
                    <td>'.$report1->tab6.'</td>
                    <td>'.number_format($report1->tab7,2).'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
            }
            if ($reportcount > 1 && ($report1->tab4 == 1)){
                $result .= '<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>'.$report1->tab5.'</td>
                    <td>'.$report1->tab6.'</td>
                    <td>'.number_format($report1->tab7,2).'</td>
                </tr>';
            }
            if($reports1->last() == $report1) {
                if($report1->tab4 == 2){
                    $result .= '<tr>
                        <td class="text-nowrap">'.$report1->tab5.'</td>
                        <td>'.$report1->tab6.'</td>
                        <td>'.number_format($report1->tab7,2).'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';
                }
                if ($report1->tab4 == 1){
                    $result .= '<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>'.$report1->tab5.'</td>
                        <td>'.$report1->tab6.'</td>
                        <td>'.number_format($report1->tab7,2).'</td>
                    </tr>';
                }
                if ($val->satu == 1){
                    $result .= '<tr>
                        <td></td>
                        <td>BAKI H/B</td>
                        <td>'.number_format($val->dua,2).'</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>';
                }
                if ($val->satu == 2){
                    $result .= '<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>BAKI H/B</td>
                    <td>'.number_format($val->dua,2).'</td>
                    </tr>';
                }
                $result .= '<tr>
                <td></td>
                <td>Jumlah</td>
                <td>'.number_format($jumlah,2).'</td>
                <td></td>
                <td>Jumlah</td>
                <td>'.number_format($jumlah,2).'</td>
                </tr>';
                if ($val->satu == 1){
                    $result .= '<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Baki B/B</td>
                    <td>'.number_format($val->dua,2).'</td>
                    </tr>';
                }

                if ($val->satu == 2){
                    $result .= '<tr>
                    <td></td>
                    <td>Baki B/B</td>
                    <td>'.number_format($val->dua,2).'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>';
                }
            }
        }

        foreach($reports2 as $key => $report2){
            $prevRow = new \stdClass();
            $prevRow->tab3 = 0;
            if (isset($reports2[$key + 1])) {
                $prevRow = $reports2[$key + 1];
            }else{
                $prevRow->tab3 = 0;
            }
            
            if($report2->tab3 != $prevRow->tab3){
                $total = $total + $report2->tab7;
                $report2->tab8 = "BAKI H/B";
                $report2->tab9 = $total;
                $total = 0;
            }else{
                $total = $total + $report2->tab7;
                $report2->tab8 = 0;
                $report2->tab9 = 0;
            }
        }

        foreach($reports2 as $key => $report2){
            $prevRow = new \stdClass();
            $prevRow->tab3 = 0;
            if (isset($reports2[$key - 1])) {
                $prevRow = $reports2[$key - 1];
            }else{
                $prevRow->tab3 = 0;
            }

            if($report2->tab7 == null){
                $report2->tab7 = 0;
            }
            if($report2->tab9 == null){
                $report2->tab9 = 0;
            }

            if ($report2->tab3 != $prevRow->tab3){
                $result .= '<tr>
                    <td style="padding-top: 30px;border:none !important;"></td>
                    <td style="border:none !important;"></td>
                    <td style="border:none !important;"></td>
                    <td style="border:none !important;"></td>
                    <td style="border:none !important;"></td>
                    <td style="border:none !important;"></td>
                </tr>
                <tr style="text-align: center">
                    <td style="text-align: left;">DR</td>
                    <td></td>
                    <td colspan="2" class="text-nowrap">'.$report2->tab6.' A/C</td>
                    <td style="display: none;"></td>
                    <td></td>
                    <td style="text-align: right;">CR</td>
                </tr>';
            
                if ($report2->tab4 == 1){
                    $result .= '<tr>
                    <td class="text-nowrap">'.$report2->tab5.'</td>
                    <td>'.$report2->tab6.'</td>
                    <td>'.number_format($report2->tab7,2).'</td>
                    <td class="text-nowrap"></td>
                    <td>'.$report2->tab8.'</td>
                    <td>'.number_format($report2->tab9,2).'</td>
                    </tr>';
                }
                if($report2->tab4 == 2){
                    $result .= '<tr>
                    <td class="text-nowrap"></td>
                    <td>'.$report2->tab8.'</td>
                    <td>'.number_format($report2->tab9,2).'</td>
                    <td class="text-nowrap">'.$report2->tab5.'</td>
                    <td>'.$report2->tab6.'</td>
                    <td>'.number_format($report2->tab7,2).'</td>
                    </tr>';
                }
            }
            else{
                if ($report2->tab4 == 1){
                    $result .= '<tr>
                    <td class="text-nowrap">'.$report2->tab5.'</td>
                    <td>'.$report2->tab6.'</td>
                    <td>'.number_format($report2->tab7,2).'</td>
                    <td class="text-nowrap"></td>
                    <td>'.$report2->tab8.'</td>
                    <td>'.number_format($report2->tab9,2).'</td>
                    </tr>';
                }
                if($report2->tab4 == 2){
                    $result .= '<tr>
                    <td class="text-nowrap"></td>
                    <td>'.$report2->tab8.'</td>
                    <td>'.number_format($report2->tab9,2).'</td>
                    <td class="text-nowrap">'.$report2->tab5.'</td>
                    <td>'.$report2->tab6.'</td>
                    <td>'.number_format($report2->tab7,2).'</td>
                    </tr>';
                }
            }
            if ($report2->tab8 == "BAKI H/B" && ($report2->tab4 == 1)){
                $result .= '
                <tr>
                    <td></td>
                    <td>Jumlah</td>
                    <td>'.number_format($report2->tab9,2).'</td>
                    <td></td>
                    <td>Jumlah</td>
                    <td>'.number_format($report2->tab9,2).'</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Baki B/B</td>
                    <td>'.number_format($report2->tab9,2).'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
            }
            if ($report2->tab8 == "BAKI H/B" && ($report2->tab4 == 2)){
                $result .= '
                <tr>
                    <td></td>
                    <td>Jumlah</td>
                    <td>'.number_format($report2->tab9,2).'</td>
                    <td></td>
                    <td>Jumlah</td>
                    <td>'.number_format($report2->tab9,2).'</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Baki B/B</td>
                    <td>'.number_format($report2->tab9,2).'</td>
                </tr>';
            }
        }
        return $result;
    }
}