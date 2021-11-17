<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JenisInsentif;
use App\Models\Report;
use App\Models\Negeri;

class LaporanInsentifControllerWeb extends Controller
{
    public function index()
    {
        $ddInsentif = JenisInsentif::where('status', 'aktif')->get();
        $reports = Report::where('type', 4)
        ->orderBy('tab3', 'ASC')
        ->orderBy('tab2', 'ASC')
        ->orderBy('tab1', 'ASC')
        ->get();

        $total = new \stdClass();
        $total->satu = 0;
        $total->dua = 0;
        $total->tiga = 0;
        $total->empat = 0;
        $total->lima = 0;
        $total->enam = 0;
        $percent = new \stdClass();
        $percent->satu = 0;
        $percent->dua = 0;
        $percent->tiga = 0;
        $percent->empat = 0;
        $percent->lima = 0;
        $percent->enam = 0;

        foreach ($reports as $report) {
            $negeri = Negeri::where('U_Negeri_ID', $report->tab1)->first();
            if(isset($negeri)){
                $report->negeri = $negeri->Negeri;
            }
            
            $jenisinsentif = JenisInsentif::where('id_jenis_insentif', $report->tab2)->first();
            $report->jenis = $jenisinsentif->nama_insentif;

            $total->satu = $total->satu + $report->tab4;
            $total->dua = $total->dua + $report->tab5;
            $total->tiga = $total->tiga + $report->tab6;
            $total->empat = $total->empat + $report->tab7;
            $total->lima = $total->lima + $report->tab8;

            $report->jumproject = $report->tab4 + $report->tab5 + $report->tab6 + $report->tab7 + $report->tab8;
            $total->enam = $total->enam + $report->jumproject;
        }
        foreach ($reports as $report) {
            if($total->satu != 0){
                $report->percent1 = round(($report->tab4/$total->satu)*100, 2);
            }
            if($total->dua != 0){
                $report->percent2 = round(($report->tab5/$total->dua)*100, 2);
            }
            if($total->tiga != 0){
                $report->percent3 = round(($report->tab6/$total->tiga)*100, 2);
            }
            if($total->empat != 0){
                $report->percent4 = round(($report->tab7/$total->empat)*100, 2);
            }
            if($total->lima != 0){
                $report->percent5 = round(($report->tab8/$total->lima)*100, 2);
            }
            
            $percent->satu = $total->satu / $total->enam *100;
            $percent->dua = $total->dua / $total->enam *100;
            $percent->tiga = $total->tiga / $total->enam *100;
            $percent->empat = $total->empat / $total->enam *100;
            $percent->lima = $total->lima / $total->enam *100;
            $percent->enam = 100;
            $report->jumprojectpercent = round(($report->jumproject / $total->enam) *100, 2);
        }
        return view('laporaninsentif.index'
        ,[
            'ddInsentif'=>$ddInsentif,
            'reports'=>$reports,
            'total'=>$total,
            'percent'=>$percent
        ]
        );
    }

    public function show(Request $request, $tahun)
    {
        $total = new \stdClass();
        $total->satu = 0;
        $total->dua = 0;
        $total->tiga = 0;
        $total->empat = 0;
        $total->lima = 0;
        $total->enam = 0;
        $percent = new \stdClass();
        $percent->satu = 0;
        $percent->dua = 0;
        $percent->tiga = 0;
        $percent->empat = 0;
        $percent->lima = 0;
        $percent->enam = 0;

        if($request->tahun == null){
            $reports = Report::where('type', 4)
            ->where('tab2', $request->id_jenis_insentif)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->get();
        }
        if($request->id_jenis_insentif == null){
            $reports = Report::where('type', 4)
            ->where('tab3', $request->tahun)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->get();
        }
        if($request->id_jenis_insentif != null && $request->tahun != null){
            $reports = Report::where('type', 4)
            ->where('tab2', $request->id_jenis_insentif)
            ->where('tab3', $request->tahun)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->get();
        }
        if($request->id_jenis_insentif == null && $request->tahun == null){
            $reports = Report::where('type', 4)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->get();
        }

        $result = "";
        $num=1;
        foreach ($reports as $report) {
            $negeri = Negeri::where('U_Negeri_ID', $report->tab1)->first();
            $report->negeri = $negeri->Negeri;
            $jenisinsentif = JenisInsentif::where('id_jenis_insentif', $report->tab2)->first();
            $report->jenis = $jenisinsentif->nama_insentif;

            $total->satu = $total->satu + $report->tab4;
            $total->dua = $total->dua + $report->tab5;
            $total->tiga = $total->tiga + $report->tab6;
            $total->empat = $total->empat + $report->tab7;
            $total->lima = $total->lima + $report->tab8;

            $report->jumproject = $report->tab4 + $report->tab5 + $report->tab6 + $report->tab7 + $report->tab8;
            $total->enam = $total->enam + $report->jumproject;

        }
        foreach ($reports as $report) {
            if($total->satu != 0){
                $report->percent1 = round(($report->tab4/$total->satu)*100, 2);
            }
            if($total->dua != 0){
                $report->percent2 = round(($report->tab5/$total->dua)*100, 2);
            }
            if($total->tiga != 0){
                $report->percent3 = round(($report->tab6/$total->tiga)*100, 2);
            }
            if($total->empat != 0){
                $report->percent4 = round(($report->tab7/$total->empat)*100, 2);
            }
            if($total->lima != 0){
                $report->percent5 = round(($report->tab8/$total->lima)*100, 2);
            }
            
            $percent->satu = $total->satu / $total->enam *100;
            $percent->dua = $total->dua / $total->enam *100;
            $percent->tiga = $total->tiga / $total->enam *100;
            $percent->empat = $total->empat / $total->enam *100;
            $percent->lima = $total->lima / $total->enam *100;
            $percent->enam = 100;
            $report->jumprojectpercent = round(($report->jumproject / $total->enam) *100, 2);

            $result .= 
            '<tr class="align-middle" style="text-align: center;">
                <td class="text-nowrap" style="padding-right:2vh;"><label class="form-check-label">'.$num++.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->negeri.'</label></td>
                <td class="text-nowrap" style="text-align: left;"><label class="form-check-label">'.$report->jenis.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->tab3.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->tab4.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->percent1.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->tab5.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->percent2.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->tab6.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->percent3.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->tab7.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->percent4.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->tab8.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->percent5.'</label></td>
                <td class="text-nowrap" style="padding-left:2vh;"><label class="form-check-label">'.$report->jumproject.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->jumprojectpercent.'</label></td>
            </tr>';
        }
        $result .=
        '<tr class="align-middle" style="text-align: center;">
            <td colspan="4"></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$total->satu.'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$percent->satu.'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$total->dua.'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$percent->dua.'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$total->tiga.'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$percent->tiga.'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$total->empat.'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$percent->empat.'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$total->lima.'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$percent->lima.'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$total->enam.'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.$percent->enam.'</label></td>
        </tr>
        ';       

        return $result;
    }
}
