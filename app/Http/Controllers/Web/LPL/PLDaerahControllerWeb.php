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
                <td class="text-nowrap" style="padding-right:2vh;">'.$num++.'</td>
                <td class="text-nowrap">'.$report->negeri.'</td>
                <td class="text-nowrap">'.$report->daerah.'</td>
                <td class="text-nowrap">'.$report->tab3.'</td>
                <td class="text-nowrap">'.$report->tab4.'</td>
                <td class="text-nowrap">'.$report->tab5.'</td>
                <td class="text-nowrap">'.$report->tab6.'</td>
                <td class="text-nowrap">'.$report->tab7.'</td>
                <td class="text-nowrap">'.$report->percent.'</td>
            </tr>';
        }
        $foot .= '
        <tr class="align-middle" style="text-align: center;">
            <th class="text-nowrap" colspan="4">Jumlah</th>
            <th class="text-nowrap">'.$total->satu.'</th>
            <th class="text-nowrap">'.$total->dua.'</th>
            <th class="text-nowrap">'.$total->tiga.'</th>
            <th class="text-nowrap">'.$total->empat.'</th>
            <th class="text-nowrap">100</th>
        </tr>';

        return [$result, $foot];
    }
}
