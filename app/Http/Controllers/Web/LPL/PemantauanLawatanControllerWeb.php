<?php

namespace App\Http\Controllers\Web\LPL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\JenisInsentif;
use App\Models\Report;
use App\Models\Negeri;

class PemantauanLawatanControllerWeb extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $getYear = date("Y");
        $total = new \stdClass();
        $total->satu = 0;
        $total->dua = 0;
        $total->tiga = 0;
        $total->empat = 0;
        
        $reports = Report::where('type', 7)->where('tab20', $authuser->id)->where('tab2', $getYear)
        ->orderBy('tab1', 'ASC')
        ->orderBy('tab2', 'ASC')
        ->get();

        foreach ($reports as $report) {
            $negeri = Negeri::where('U_Negeri_ID', $report->tab1)->first();
            if(isset($negeri)){
                $report->negeri = $negeri->Negeri;
            }else{
                $report->negeri = "";
            }
            
            $total->satu = $total->satu + $report->tab3;
            $total->dua = $total->dua + $report->tab4;
            $total->tiga = $total->tiga + $report->tab5;
            $total->empat = $total->empat + $report->tab6;
        }
        foreach ($reports as $report) {
            if(isset($report->tab3) && isset($total->satu)){
                $report->percent = round(($report->tab3/$total->satu *100), 2);
            }else{
                $report->percent = 0;
            }
            
        }

        return view('pemantauanlawatan.index'
        ,[
            // 'ddInsentif'=>$ddInsentif,
            'reports'=>$reports,
            'total'=>$total,
            'getYear'=>$getYear
        ]
        );
    }

    public function show(Request $request)
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }

        if($request->tahun != null){
            $reports = Report::where('type', 7)->where('tab20', $authuser->id)->where('tab2', $request->tahun)
            ->orderBy('tab1', 'ASC')
            ->orderBy('tab2', 'ASC')
            ->get();
        }

        $result = "";
        $foot = "";
        $num=1;
        $total = new \stdClass();
        $total->satu = 0;
        $total->dua = 0;
        $total->tiga = 0;
        $total->empat = 0;
        foreach ($reports as $report) {
            $negeri = Negeri::where('U_Negeri_ID', $report->tab1)->first();
            if(isset($negeri)){
                $report->negeri = $negeri->Negeri;
            }else{
                $report->negeri = "";
            }
            $total->satu = $total->satu + $report->tab3;
            $total->dua = $total->dua + $report->tab4;
            $total->tiga = $total->tiga + $report->tab5;
            $total->empat = $total->empat + $report->tab6;
        }
        foreach ($reports as $report) {
            if(isset($report->tab3) && isset($total->satu)){
                $report->percent = round(($report->tab3/$total->satu *100), 2);
            }else{
                $report->percent = 0;
            }
            $result .= 
            '<tr class="align-middle" style="text-align: center;">
            <td class="text-nowrap" style="padding-right:2vh;"><label class="form-check-label">'.$num++.'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.$report->negeri.'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.$report->tab2.'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab3).'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab4).'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab5).'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab6).'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($report->percent,2).'</label></td>
            </tr>';
        }

        $foot .= '
        <tr class="align-middle" style="text-align: center;display:none;">
            <th></th>
            <th></th>
            <th class="text-nowrap">Jumlah</th>
            <th class="text-nowrap">'.number_format($total->satu).'</th>
            <th class="text-nowrap">'.number_format($total->dua).'</th>
            <th class="text-nowrap">'.number_format($total->tiga).'</th>
            <th class="text-nowrap">'.number_format($total->empat).'</th>
            <th class="text-nowrap">100</th>
        </tr>
        <tr class="align-middle" style="text-align: center;">
            <th class="text-nowrap" colspan="3"><label class="form-check-label">Jumlah</label></th>
            <th class="text-nowrap"><label class="form-check-label">'.number_format($total->satu).'</label></th>
            <th class="text-nowrap"><label class="form-check-label">'.number_format($total->dua).'</label></th>
            <th class="text-nowrap"><label class="form-check-label">'.number_format($total->tiga).'</label></th>
            <th class="text-nowrap"><label class="form-check-label">'.number_format($total->empat).'</label></th>
            <th class="text-nowrap"><label class="form-check-label">100</label></th>
        </tr>';

        return [$result, $foot];
    }
}
