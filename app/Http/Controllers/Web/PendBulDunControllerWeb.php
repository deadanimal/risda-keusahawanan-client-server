<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\JenisInsentif;
use App\Models\Report;
use App\Models\Negeri;
use App\Models\Dun;
use App\Models\Parlimen;

use App\Exports\PendBulDun;
use Maatwebsite\Excel\Facades\Excel;

class PendBulDunControllerWeb extends Controller
{
    public function index()
    {
        try{
            $authuser = Auth::user();
            if(isset($authuser)){
                $getYear = date("Y");
                $ddInsentif = JenisInsentif::where('status', 'aktif')->get();
                $reports = Report::where('type', 3)->where('tab3', $getYear)->where('tab20', $authuser->id)
                ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->orderBy('tab9', 'ASC')->get();

                $c_penerima = 0;
                $c_insentif = 0;
                $c_jualan = 0;
                $c_puratajual = 0;
                
            }else{
                return redirect('/landing');
            }

        }catch(Exception $e){}
        try{
            foreach ($reports as $report) {
                $negeri = Negeri::where('U_Negeri_ID', $report->tab1)->first();
                if(isset($negeri)){
                    $report->negeri = $negeri->Negeri;
                }
                $jenisinsentif = JenisInsentif::where('id_jenis_insentif', $report->tab2)->first();
                if(isset($jenisinsentif)){
                    $report->jenis = $jenisinsentif->nama_insentif;
                }
                $dun = Dun::where('U_Dun_ID', $report->tab9)->first();
                if(isset($dun)){
                    $report->dun = $dun->Dun;
                    $parlimen = Parlimen::where('U_Parlimen_ID', $dun->U_Parlimen_ID)->first();
                    $report->parlimen = $parlimen->Parlimen;
                }
                $c_penerima = $c_penerima + $report->tab4;
                $c_insentif = $c_insentif + $report->tab5;
                $report->tab7 = $report->tab6 / $report->tab4;
                $c_jualan = $c_jualan + $report->tab6; 
                $c_puratajual = $c_puratajual + $report->tab7; 
            }
        }catch(Exception $e){}

        return view('pendapatanbulanan.pendbulDun'
        ,[
            'ddInsentif'=>$ddInsentif,
            'reports'=>$reports,
            'c_penerima'=>$c_penerima,
            'c_insentif'=>$c_insentif,
            'getYear'=>$getYear,
            'c_jualan'=>$c_jualan,
            'c_puratajual'=>$c_puratajual
        ]
        );
    }

    public function show(Request $request, $tahun)
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        if($request->tahun == null){
            $reports = Report::where('type', 3)
            ->where('tab2', $request->id_jenis_insentif)->where('tab20', $authuser->id)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->orderBy('tab9', 'ASC')->get();
        }
        if($request->id_jenis_insentif == null){
            $reports = Report::where('type', 3)
            ->where('tab3', $request->tahun)->where('tab20', $authuser->id)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->orderBy('tab9', 'ASC')->get();
        }
        if($request->id_jenis_insentif != null && $request->tahun != null){
            $reports = Report::where('type', 3)
            ->where('tab2', $request->id_jenis_insentif)
            ->where('tab3', $request->tahun)->where('tab20', $authuser->id)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->orderBy('tab9', 'ASC')->get();
        }
        if($request->id_jenis_insentif == null && $request->tahun == null){
            $reports = Report::where('type', 3)->where('tab20', $authuser->id)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->orderBy('tab9', 'ASC')->get();
        }
        
        $result = "";
        $tfoot ="";
        $num=1;
        $c_penerima = 0;
        $c_insentif = 0;
        $c_jualan = 0;
        $c_puratajual = 0;
        foreach ($reports as $report) {
            $negeri = Negeri::where('U_Negeri_ID', $report->tab1)->first();
            if(isset($negeri)){
                $report->negeri = $negeri->Negeri;
            }else{
                $report->negeri = '';
            }
            $jenisinsentif = JenisInsentif::where('id_jenis_insentif', $report->tab2)->first();
            if(isset($jenisinsentif)){
                $report->jenis = $jenisinsentif->nama_insentif;
            }else{
                $report->jenis = '';
            }
            $dun = Dun::where('U_Dun_ID', $report->tab9)->first();
            if(isset($dun)){
                $report->dun = $dun->Dun;
                $parlimen = Parlimen::where('U_Parlimen_ID', $dun->U_Parlimen_ID)->first();
                if(isset($parlimen)){
                    $report->parlimen = $parlimen->Parlimen;
                }else{
                    $report->parlimen = '';
                }
            }
            
            $c_penerima = $c_penerima + $report->tab4;
            $c_insentif = $c_insentif + $report->tab5;
            $report->tab7 = $report->tab6 / $report->tab4;
            $c_jualan = $c_jualan + $report->tab6; 
            $c_puratajual = $c_puratajual + $report->tab7; 

            $result .= 
            '<tr class="align-middle" style="text-align: center;">
                <td class="text-nowrap" style="padding-right:2vh;"><label class="form-check-label">'.$report->negeri.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->parlimen.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->dun.'</label></td>
                <td class="text-nowrap" style="text-align: left;"><label class="form-check-label">'.$report->jenis.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.$report->tab3.'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab4).'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab5,2).'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab6,2).'</label></td>
                <td class="text-nowrap"><label class="form-check-label">'.number_format($report->tab7,2).'</label></td>
            </tr>';
        }
        $tfoot .=
        '
        <tr class="align-middle" style="text-align: center;display:none;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">JUMLAH</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_penerima).'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_insentif,2).'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_jualan,2).'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_puratajual,2).'</label></td>
        </tr>
        <tr class="align-middle" style="text-align: center;">
            <td colspan="5" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">JUMLAH</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_penerima).'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_insentif,2).'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_jualan,2).'</label></td>
            <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_puratajual,2).'</label></td>
        </tr>
        ';  
        $c_insentif = number_format($c_insentif,2);
        $c_jualan = number_format($c_jualan,2);
        
        return [$result,$tfoot,$c_insentif,$c_jualan];
    }

    public function export3($tahun, $jenis)
    {
            return Excel::download(new PendBulDun($tahun,$jenis), 'PendapatanBulananDun.xlsx');
    }
}
