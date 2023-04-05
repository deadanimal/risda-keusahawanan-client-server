<?php

namespace App\Http\Controllers\Web\LPL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\JenisInsentif;
use App\Models\Report;
use App\Models\Negeri;
use App\Models\Daerah;

class PLDaerahControllerWeb extends Controller
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

        $reports = Report::where('type', 8)->where('tab20', $authuser->id)->where('tab3', $getYear)
        ->orderBy('tab3', 'ASC')
        ->orderBy('tab1', 'ASC')
        ->orderBy('tab2', 'ASC')
        ->get();

        foreach ($reports as $report) {
            $negeri = Negeri::where('U_Negeri_ID', $report->tab1)->first();
            if(isset($negeri)){
                $report->negeri = $negeri->Negeri;
            }
            $daerah = Daerah::where('U_Daerah_ID', $report->tab2)->first();
            if(isset($daerah)){
                $report->daerah = $daerah->Daerah;
            }
            $total->satu = $total->satu + $report->tab4;
            $total->dua = $total->dua + $report->tab5;
            $total->tiga = $total->tiga + $report->tab6;
            $total->empat = $total->empat + $report->tab7;
        }

        foreach ($reports as $report) {
            $report->percent = round(($report->tab4/$total->satu *100), 2);
        }

        return view('pemantauanlawatan.pantauDaerah'
        ,[
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
            $reports = Report::where('type', 8)->where('tab20', $authuser->id)->where('tab3', $request->tahun)
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
            }
            $daerah = Daerah::where('U_Daerah_ID', $report->tab2)->first();
            if(isset($daerah)){
                $report->daerah = $daerah->Daerah;
            }
            $total->satu = $total->satu + $report->tab4;
            $total->dua = $total->dua + $report->tab5;
            $total->tiga = $total->tiga + $report->tab6;
            $total->empat = $total->empat + $report->tab7;
        }

        foreach ($reports as $report) {
            $report->percent = round(($report->tab4/$total->satu *100), 2);

            $result .= 
            '<tr class="align-middle" style="text-align: center;">
                <td class="text-nowrap" style="padding-right:2vh;"><label class="form-check-label">'.$num++.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->negeri.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->daerah.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->tab3.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab4).'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab5).'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab6).'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab7).'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.number_format($report->percent,2).'</label></td>
            </tr>';
        }
        $foot .= '
        <tr class="align-middle" style="text-align: center;display:none;">
            <th></th>
            <th></th>
            <th></th>
            <th class="text-nowrap" >Jumlah</th>
            <th class="text-nowrap">'.number_format($total->satu).'</th>
            <th class="text-nowrap">'.number_format($total->dua).'</th>
            <th class="text-nowrap">'.number_format($total->tiga).'</th>
            <th class="text-nowrap">'.number_format($total->empat).'</th>
            <th class="text-nowrap">100</th>
        </tr>
        <tr class="align-middle" style="text-align: center;">
            <th class="text-nowrap" colspan="4"><label class="form-check-label">Jumlah</label></th>
            <th class="text-nowrap"><label class="form-check-label">'.number_format($total->satu).'</label></th>
            <th class="text-nowrap"><label class="form-check-label">'.number_format($total->dua).'</label></th>
            <th class="text-nowrap"><label class="form-check-label">'.number_format($total->tiga).'</label></th>
            <th class="text-nowrap"><label class="form-check-label">'.number_format($total->empat).'</label></th>
            <th class="text-nowrap"><label class="form-check-label">100</label></th>
        </tr>';

        return [$result, $foot];
    }
}
