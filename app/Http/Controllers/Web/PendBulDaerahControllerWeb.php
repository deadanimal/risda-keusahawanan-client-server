<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\JenisInsentif;
use App\Models\Report;
use App\Models\Negeri;
use App\Models\Daerah;

use App\Exports\PendBulDaerah;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Exception;

class PendBulDaerahControllerWeb extends Controller
{
    public function index()
    {
        try{
            $authuser = Auth::user();
            if(isset($authuser)){
                $getYear = date("Y");
                $ddInsentif = JenisInsentif::where('status', 'aktif')->get();
                $reports = Report::where('type', 2)->where('tab3', $getYear)->where('tab20', $authuser->id)
                ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->orderBy('tab8', 'ASC')->get();

                $c_penerima = 0;
                $c_insentif = 0;
                $c_jualan = 0;
                $c_puratajual = 0;

            }else{
                return redirect('/landing');
            }
            
            foreach ($reports as $report) {
                $negeri = Negeri::where('U_Negeri_ID', $report->tab1)->first();
                $report->negeri = $negeri->Negeri;
                $jenisinsentif = JenisInsentif::where('id_jenis_insentif', $report->tab2)->first();
                $report->jenis = $jenisinsentif->nama_insentif;
                $daerah = Daerah::where('U_Daerah_ID', $report->tab8)->first();
                $report->daerah = $daerah->Daerah;
                $c_penerima = $c_penerima + $report->tab4;
                $c_insentif = $c_insentif + $report->tab5;
                $report->tab7 = $report->tab6 / $report->tab4;
                $c_jualan = $c_jualan + $report->tab6; 
                $c_puratajual = $c_puratajual + $report->tab7; 
            }
        }
        catch(Exception $e){

        }
        

        return view('pendapatanbulanan.pendbulDaerah'
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
        try{
            $authuser = Auth::user();
            if(!isset($authuser)){
                return redirect('/landing');
            }
            if($request->tahun == null){
                $reports = Report::where('type', 2)
                ->where('tab2', $request->id_jenis_insentif)->where('tab20', $authuser->id)
                ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->orderBy('tab8', 'ASC')->get();
            }
            if($request->id_jenis_insentif == null){
                $reports = Report::where('type', 2)
                ->where('tab3', $request->tahun)->where('tab20', $authuser->id)
                ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->orderBy('tab8', 'ASC')->get();
            }
            if($request->id_jenis_insentif != null && $request->tahun != null){
                $reports = Report::where('type', 2)
                ->where('tab2', $request->id_jenis_insentif)
                ->where('tab3', $request->tahun)->where('tab20', $authuser->id)
                ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->orderBy('tab8', 'ASC')->get();
            }
            if($request->id_jenis_insentif == null && $request->tahun == null){
                $reports = Report::where('type', 2)->where('tab20', $authuser->id)
                ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab1', 'ASC')->orderBy('tab8', 'ASC')->get();
            }
    
            $result = "";
            $tfoot = "";
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
                $daerah = Daerah::where('U_Daerah_ID', $report->tab8)->first();
                if(isset($daerah)){
                    $report->daerah = $daerah->Daerah;
                }else{
                    $report->daerah = '';
                }
                $c_penerima = $c_penerima + $report->tab4;
                $c_insentif = $c_insentif + $report->tab5;
                $report->tab7 = $report->tab6 / $report->tab4;
                $c_jualan = $c_jualan + $report->tab6; 
                $c_puratajual = $c_puratajual + $report->tab7; 
    
                $result .= 
                '<tr class="align-middle" style="text-align: center;">
                    <td class="text-nowrap" style="padding-right:2vh;"><label class="form-check-label">'.$report->negeri.'</label></td>
                    <td class="text-nowrap"><label class="form-check-label">'.$report->daerah.'</label></td>
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
                <td style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">JUMLAH</label></td>
                <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_penerima).'</label></td>
                <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_insentif,2).'</label></td>
                <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_jualan,2).'</label></td>
                <td class="text-nowrap" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">'.number_format($c_puratajual,2).'</label></td>
            </tr>
            <tr class="align-middle" style="text-align: center;">
                <td colspan="4" style="border-top: 1px solid black;border-bottom: 1px solid black;"><label class="form-check-label">JUMLAH</label></td>
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
        catch(Exception $e){}
    }

    public function export2($tahun, $jenis)
    {
            return Excel::download(new PendBulDaerah($tahun,$jenis), 'PendapatanBulananDaerah.xlsx');
    }
}
