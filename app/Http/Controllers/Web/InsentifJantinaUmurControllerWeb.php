<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\JenisInsentif;
use App\Models\Report;

class InsentifJantinaUmurControllerWeb extends Controller
{
    /*
    UMUR -
    1 - Bawah 20
    2 - 21-30
    3 - 31-40
    4 - 41-50
    5 - 51-60
    6 - 61-70
    7 - 71 ke atas
    8 - tidak diketahui

    Jantina -
    1 - lelaki
    2 - perempuan
    3 - lain2
    */

    public function index()
    {
        $ddInsentif = JenisInsentif::where('status', 'aktif')->get();
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $getYear = date("Y");
        $reports = Report::where('type', 6)->where('tab3', $getYear)->where('tab20', $authuser->id)
        ->orderBy('tab3', 'ASC')
        ->orderBy('tab2', 'ASC')
        ->orderBy('tab8', 'ASC')
        ->get();

        $jumlah = new \stdClass();
        $jumlah->satu = 0;
        $jumlah->dua = 0;
        $jumlah->tiga = 0;
        $jumlah->empat = 0;
        $jumlah->lima = 0;
        $jumlah->enam = 0;
        $jumlah->tujuh = 0;
        $jumlah->lapan = 0;

        foreach ($reports as $report) {
            $jumlah->satu = $jumlah->satu + $report->tab4;
            $jumlah->tiga = $jumlah->tiga + $report->tab5;
            $jumlah->lima = $jumlah->lima + $report->tab6;
            $report->jumbil = $report->tab4 + $report->tab5 + $report->tab6;
            $jumlah->tujuh = $jumlah->tujuh + $report->jumbil;

            $jenisinsentif = JenisInsentif::where('id_jenis_insentif', $report->tab2)->first();
            if(isset($jenisinsentif)){
                $report->jenis = $jenisinsentif->nama_insentif;
            }
        }

        foreach ($reports as $report) {
            if($jumlah->satu != 0){
                $report->percent1 = $report->tab4 / $jumlah->satu * 100;
            }
            if($jumlah->tiga != 0){
                $report->percent2 = $report->tab5 / $jumlah->tiga * 100;
            }
            if($jumlah->lima != 0){
                $report->percent3 = $report->tab6 / $jumlah->lima * 100;
            }
            
            $report->jumpercent = round($report->jumbil / $jumlah->tujuh * 100, 2);
            $jumlah->lapan = $jumlah->lapan + $report->jumpercent;
        }

        $jumlah->lapan = round($jumlah->lapan, 0);

        return view('laporaninsentif.insenjantinaumur'
        ,[
            'ddInsentif'=>$ddInsentif,
            'reports'=>$reports,
            'jumlah'=>$jumlah,
            'getYear'=>$getYear
        ]
        );
    }

    public function show(Request $request, $tahun)
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $jumlah = new \stdClass();
        $jumlah->satu = 0;
        $jumlah->dua = 0;
        $jumlah->tiga = 0;
        $jumlah->empat = 0;
        $jumlah->lima = 0;
        $jumlah->enam = 0;
        $jumlah->tujuh = 0;
        $jumlah->lapan = 0;

        if($request->tahun == null){
            $reports = Report::where('type', 6)
            ->where('tab2', $request->id_jenis_insentif)->where('tab3', $getYear)->where('tab20', $authuser->id)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab8', 'ASC')->get();
        }
        if($request->id_jenis_insentif == null){
            $reports = Report::where('type', 6)
            ->where('tab3', $request->tahun)->where('tab20', $authuser->id)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab8', 'ASC')->get();
        }
        if($request->id_jenis_insentif != null && $request->tahun != null){
            $reports = Report::where('type', 6)
            ->where('tab2', $request->id_jenis_insentif)
            ->where('tab3', $request->tahun)->where('tab20', $authuser->id)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab8', 'ASC')->get();
        }
        if($request->id_jenis_insentif == null && $request->tahun == null){
            $reports = Report::where('type', 6)->where('tab3', $getYear)->where('tab20', $authuser->id)
            ->orderBy('tab3', 'ASC')->orderBy('tab2', 'ASC')->orderBy('tab8', 'ASC')->get();
        }

        $result = "";
        $foot = "";
        foreach ($reports as $report) {
            $jumlah->satu = $jumlah->satu + $report->tab4;
            $jumlah->tiga = $jumlah->tiga + $report->tab5;
            $jumlah->lima = $jumlah->lima + $report->tab6;
            $report->jumbil = $report->tab4 + $report->tab5 + $report->tab6;
            $jumlah->tujuh = $jumlah->tujuh + $report->jumbil;
            $jenisinsentif = JenisInsentif::where('id_jenis_insentif', $report->tab2)->first();
            if(isset($jenisinsentif)){
                $report->jenis = $jenisinsentif->nama_insentif;
            }
        }

        foreach ($reports as $report) {
            if($jumlah->satu != 0){
                $report->percent1 = $report->tab4 / $jumlah->satu * 100;
            }
            if($jumlah->tiga != 0){
                $report->percent2 = $report->tab5 / $jumlah->tiga * 100;
            }
            if($jumlah->lima != 0){
                $report->percent3 = $report->tab6 / $jumlah->lima * 100;
            }
            if($jumlah->tujuh != 0){
                $report->jumpercent = round($report->jumbil / $jumlah->tujuh * 100, 2);
            }
            
            $jumlah->lapan = $jumlah->lapan + $report->jumpercent;

            $result .= 
            '<tr class="align-middle" style="text-align: center;">
                <td class="text-nowrap" style="padding-right:2vh;"><label class="form-check-label">'.$report->tab1.'</label></td>
                <td class="text-nowrap" ><label class="form-check-label">'.$report->jenis.'</label></td>
                <td class="text-nowrap" ><label class="form-check-label">'.$report->tab3.'</label></td>
                <td class="text-nowrap" ><label class="form-check-label">'.number_format($report->tab4).'</label></td>
                <td class="text-nowrap" ><label class="form-check-label">'.number_format($report->percent1,2).'</label></td>
                <td class="text-nowrap" ><label class="form-check-label">'.number_format($report->tab5).'</label></td>
                <td class="text-nowrap" ><label class="form-check-label">'.number_format($report->percent2,2).'</label></td>
                <td class="text-nowrap" ><label class="form-check-label">'.number_format($report->tab6).'</label></td>
                <td class="text-nowrap" ><label class="form-check-label">'.number_format($report->percent3,2).'</label></td>
                <td class="text-nowrap" ><label class="form-check-label">'.number_format($report->jumbil).'</label></td>
                <td class="text-nowrap" ><label class="form-check-label">'.number_format($report->jumpercent,2).'</label></td>
            </tr>';
        }

        $foot .= '
        <tr class="align-middle" style="text-align: center;display:none;">
            <th></th>
            <th></th>
            <td class="text-nowrap">Jumlah</td>
            <td class="text-nowrap">'.number_format($jumlah->satu).'</td>
            <td class="text-nowrap">'.number_format($jumlah->dua,2).'</td>
            <td class="text-nowrap">'.number_format($jumlah->tiga).'</td>
            <td class="text-nowrap">'.number_format($jumlah->empat,2).'</td>
            <td class="text-nowrap">'.number_format($jumlah->lima).'</td>
            <td class="text-nowrap">'.number_format($jumlah->enam,2).'</td>
            <td class="text-nowrap">'.number_format($jumlah->tujuh).'</td>
            <td class="text-nowrap">'.number_format($jumlah->lapan,2).'</td>
        </tr>
        <tr class="align-middle" style="text-align: center;">
            <td class="text-nowrap" colspan="3"><label class="form-check-label">Jumlah</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($jumlah->satu).'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($jumlah->dua,2).'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($jumlah->tiga).'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($jumlah->empat,2).'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($jumlah->lima).'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($jumlah->enam,2).'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($jumlah->tujuh).'</label></td>
            <td class="text-nowrap"><label class="form-check-label">'.number_format($jumlah->lapan,2).'</label></td>
        </tr>';

        return [$result, $foot];
    }
}

?>