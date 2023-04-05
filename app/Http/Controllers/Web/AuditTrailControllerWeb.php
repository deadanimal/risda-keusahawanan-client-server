<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Usahawan;
use App\Models\AuditTrail;
use App\Models\Pegawai;

class AuditTrailControllerWeb extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $today = date("Y");
        $Audits = AuditTrail::with('pegawais')->whereYear('Date', $today)->orderBy('Date', 'DESC')->get();
        foreach ($Audits as $Audit) {
            $Audit->user = $Audit->idpegawai;
            if($Audit->Type == 1){
                $Audit->jenis = "Tetapan Pegawai";
            }else if($Audit->Type == 2){
                $Audit->jenis = "Tetapan Usahawan";
            }else if($Audit->Type == 3){
                $Audit->jenis = "Insentif";
            }else if($Audit->Type == 4){
                $Audit->jenis = "Tetapan Komponen";
            }
            // $pegawai = Pegawai::where('id', $Audit->idpegawai)->first();
            // if(isset($pegawai)){
            //     $Audit->pegawai = $pegawai->nama;
            // }
        }
        // $users = Usahawan::all();
        // foreach ($users as $usahawan) {
        //     $user = new User();
        //     $user->name = $usahawan->namausahawan;
        //     $user->email = $usahawan->email;
        //     $user->password = '$2y$10$VVZ2AGrw1UyJzJqC.JwIveLgQxw75IPtnlC3oXIpzc0AKUkDU/aOK';
        //     $user->usahawanid = $usahawan->id;
        //     $user->status_pengguna = 1;
        //     $user->no_kp = $usahawan->nokadpengenalan;
        //     $user->role = 1;
        //     $user->type = 2;
        //     $user->profile_status = 0;
        //     $user->save();
        // }
        return view('audittrail.index'
        ,[
            'Audits'=>$Audits
        ]
        );
    }

    public function show(Request $request)
    {
        // dd($request);
        $from = date($request->start);
        $to = date($request->end);
        if ($from == $to){
            $Audits = AuditTrail::whereDate('Date', $from)->orderBy('Date', 'DESC')->get();
        }else{
            $Audits = AuditTrail::whereBetween('Date', [$from, $to])->orderBy('Date', 'DESC')->get();
        }
        // dd($from .'--'. $to);
        
        $result = '';
        foreach ($Audits as $Audit) {
            $Audit->user = $Audit->idpegawai;
            if($Audit->Type == 1){
                $Audit->jenis = "Tetapan Pegawai";
            }else if($Audit->Type == 2){
                $Audit->jenis = "Tetapan Usahawan";
            }else if($Audit->Type == 3){
                $Audit->jenis = "Insentif";
            }else if($Audit->Type == 4){
                $Audit->jenis = "Tetapan Komponen";
            }
            // $pegawai = Pegawai::where('id', $Audit->idpegawai)->first();
            $pegawai = Pegawai::find($Audit->idpegawai);
            if(isset($pegawai)){
                $Audit->pegawai = $pegawai->nama;
            }

            $result .='
                <tr class="border-bottom-0 rounded-0 border-x-0 border border-300">
                    <td class="notification-time">'.date("d-m-Y h:ia", strtotime($Audit->Date)).'</td>
                    <td class="notification-body"><p class="mb-1"><strong>'.$Audit->pegawai.'</strong> '.$Audit->Desc.' di <strong>'.$Audit->jenis.'</strong></p></td>
                </tr>
            ';
        }
        return $result;
    }
}
