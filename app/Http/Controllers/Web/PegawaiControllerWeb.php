<?php

namespace App\Http\Controllers\Web;
// ini_set('max_execution_time', 180);
// error_reporting(0);
ini_set('memory_limit', '-1');
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use App\Models\Peranan;
use App\Models\User;
use App\Models\Mukim;
use App\Models\Negeri;
use App\Models\Daerah;
use App\Models\Usahawan;
use App\Models\AuditTrail;
use App\Models\PusatTanggungjawab;

class PegawaiControllerWeb extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $authpegawai = Pegawai::where('id', $authuser->idpegawai)->first();
        if($authuser->role == 1){
            $ddMukim = Mukim::select('U_Mukim_ID','Mukim')->orderBy('Mukim', 'ASC')->get();
            $ddPT = PusatTanggungjawab::select('Kod_PT','keterangan')->orderBy('keterangan', 'ASC')->get();
        }else if($authuser->role == 3 || $authuser->role == 5){
            $ddMukim = Mukim::where('status', 1)->where('U_Negeri_ID', $authpegawai->Mukim->U_Negeri_ID)->orderBy('Mukim', 'ASC')->get();
            $ddPT = PusatTanggungjawab::select('Kod_PT','keterangan')->where('Kod_PT', $authpegawai->NamaPT)->orderBy('keterangan', 'ASC')->get();
        }else if($authuser->role == 4 || $authuser->role == 6){
            $ddMukim = Mukim::where('status', 1)->where('U_Daerah_ID', $authpegawai->Mukim->U_Daerah_ID)->orderBy('Mukim', 'ASC')->get();
            $ddPT = PusatTanggungjawab::select('Kod_PT','keterangan')->where('Kod_PT', $authpegawai->NamaPT)->orderBy('keterangan', 'ASC')->get();
        }

        return view('pegawaiWeb.landing'
        ,[
            'ddMukim'=>$ddMukim,
            'ddPT'=>$ddPT
        ]
        );
    }

    public function CariPegawai(Request $request){
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $authpegawai = Pegawai::where('id', $authuser->idpegawai)->first();

        if($authuser->role == 1){
            $pegawai = Pegawai::select('pegawais.*');
            $ddPeranan = Peranan::All();
            $ddMukim = Mukim::select('U_Mukim_ID','Mukim')->orderBy('Mukim', 'ASC')->get();
            $ddPT = PusatTanggungjawab::select('Kod_PT','keterangan')->orderBy('keterangan', 'ASC')->get();
        }else if($authuser->role == 3 || $authuser->role == 5){
            // $pegawai = Pegawai::join('mukims', 'pegawais.mukim', '=', 'mukims.U_Mukim_ID')->select('pegawais.*')->where('mukims.U_Negeri_ID',$authpegawai->Mukim->U_Negeri_ID);
            $pegawai = Pegawai::where('negeri',$authpegawai->negeri)->get();
            $ddPeranan = Peranan::where('peranan_id', '>=', '3')->get();
            $ddMukim = Mukim::where('status', 1)->where('U_Negeri_ID', $authpegawai->Mukim->U_Negeri_ID)->orderBy('Mukim', 'ASC')->get();
            $ddPT = PusatTanggungjawab::select('Kod_PT','keterangan')->where('Kod_PT', $authpegawai->NamaPT)->orderBy('keterangan', 'ASC')->get();
        }else if($authuser->role == 4 || $authuser->role == 6){
            $pegawai = Pegawai::join('mukims', 'pegawais.mukim', '=', 'mukims.U_Mukim_ID')->select('pegawais.*')->where('mukims.U_Daerah_ID',$authpegawai->Mukim->U_Daerah_ID)->get();
            $ddPeranan = Peranan::where('peranan_id', '>=', '4')->get();
            $ddMukim = Mukim::where('status', 1)->where('U_Daerah_ID', $authpegawai->Mukim->U_Daerah_ID)->orderBy('Mukim', 'ASC')->get();
            $ddPT = PusatTanggungjawab::select('Kod_PT','keterangan')->where('Kod_PT', $authpegawai->NamaPT)->orderBy('keterangan', 'ASC')->get();
        }

        if(!empty($request->nama)){
            $pegawai->where('nama', 'like', '%'.$request->nama.'%');
        }
        if(!empty($request->nokp)){
            $pegawai->where('nokp', 'like', '%'.$request->nokp.'%');
        }
        if(!empty($request->mukim)){
            $pegawai->where('mukim', $request->mukim);
        }
        if(!empty($request->PT)){
            $pegawai->where('NamaPT', $request->PT);
        }

        if($authuser->role == 1){
            $result = $pegawai->get();
        }else if($authuser->role == 3 || $authuser->role == 5){
            $result = $pegawai->unique();
        }else if($authuser->role == 4 || $authuser->role == 6){
            $result = $pegawai->unique();
        }
        // dd($result);

        return view('pegawaiWeb.index'
        ,[
            'pegawai'=>$result,
            'ddPeranan'=>$ddPeranan,
            'ddMukim'=>$ddMukim,
            'nama'=>$request->nama,
            'mukim'=>$request->mukim,
            'kodpt'=>$request->PT,
            'nokp'=>$request->nokp,
            'ddPT'=>$ddPT
        ]
        );
    }

    public function ViewAll()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $authpegawai = Pegawai::where('id', $authuser->idpegawai)->first();
        // $authmukim = $authpegawai->Negeri;
        if($authuser->role == 1){
            $pegawai = Pegawai::all();
            $ddPeranan = Peranan::All();
            $ddMukim = Mukim::select('U_Mukim_ID','Mukim')->orderBy('Mukim', 'ASC')->get();
        }else if($authuser->role == 3 || $authuser->role == 5){
            // $pegawai = Pegawai::join('mukims', 'pegawais.mukim', '=', 'mukims.U_Mukim_ID')->select('pegawais.*')->where('mukims.U_Negeri_ID',$authpegawai->Mukim->U_Negeri_ID)->get()->unique();
            $pegawai = Pegawai::where('negeri',$authpegawai->negeri)->get();
            $ddPeranan = Peranan::where('peranan_id', '>=', '3')->get();
            $ddMukim = Mukim::where('status', 1)->where('U_Negeri_ID', $authpegawai->Mukim->U_Negeri_ID)->orderBy('Mukim', 'ASC')->get();
        }else if($authuser->role == 4 || $authuser->role == 6){
            $pegawai = Pegawai::join('mukims', 'pegawais.mukim', '=', 'mukims.U_Mukim_ID')->select('pegawais.*')->where('mukims.U_Daerah_ID',$authpegawai->Mukim->U_Daerah_ID)->get()->unique();
            $ddPeranan = Peranan::where('peranan_id', '>=', '4')->get();
            $ddMukim = Mukim::where('status', 1)->where('U_Daerah_ID', $authpegawai->Mukim->U_Daerah_ID)->orderBy('Mukim', 'ASC')->get();
        }else{
            return redirect('/landing');
        }

        return view('pegawaiWeb.index'
        ,[
            'pegawai'=>$pegawai,
            'ddPeranan'=>$ddPeranan,
            'ddMukim'=>$ddMukim
        ]
        );
    }

    public function pegawaiPost(Request $request)
    {
        // dd($request);
        $user = User::where('idpegawai', $request->id)->first();
        $user->status_pengguna = $request->status;
        $user->role = $request->peranan;
        $user->save();

        $pegawai = Pegawai::where('id', $request->id)->first();
        $pegawai->peranan_pegawai = $request->peranan;
        // $pegawai->mukim = $request->mukim;
        $pegawai->save();

        $audit = new AuditTrail();
        $authuser = Auth::user();
        $audit->idpegawai = $authuser->idpegawai;
        $audit->Type = 1;
        $audit->Desc = "Kemaskini data untuk ".$pegawai->nama."";
        $audit->Date = date("Y-m-d H:i:s");
        $audit->save();

        return '/pegawaiWeb';
    }

    public function show(Request $request)
    {
        $mukim = new \stdClass();
        $mukim->negeri = "";
        $mukim->daerah = "";

        $mukim = Mukim::where('U_Mukim_ID', $request->value)->first();

        $pegawai = Pegawai::where('id', $request->id)->first();
        $pegawai->mukim = $request->value;
        if(isset($mukim->U_Negeri_ID)){
            $pegawai->negeri = $mukim->U_Negeri_ID;
        }
        $pegawai->save();

        
        return $mukim;
    }

    public function pegawaiPost2(Request $request)
    {
        if($request->nama == null && $request->kodpt == null && $request->nokp == null){
            return 'nodata';
        }
        $nama = $request->nama;
        $kodpt = $request->kodpt;
        $nokp = $request->nokp;
        // dd($request->nokp);
        $client = new \GuzzleHttp\Client();
        try{
            $link = 'https://www4.risda.gov.my/fire/getstaffIndividu/staff.php?';
            if($nama != null){
                $link .= 'nama='.$nama.'&';
            }
            if($kodpt != null){
                $link .= 'kodpt='.$kodpt.'&';
            }
            if($nokp != null){
                $link .= 'nokp='.$nokp.'&';
            }
            $request = $client->request('GET', $link, [
                'auth' => ['99891c082ecccfe91d99a59845095f9c47c4d14e', 'f9d00dae5c6d6d549c306bae6e88222eb2f84307']
            ]);
            $response = $request->getBody()->getContents();
            $vals = json_decode($response);
            // return $vals->data;
            if(isset($vals)){
                if(isset($vals->data)){
                    $vals = $vals->data;
                    // return count((array)$vals);
                    // dd($vals);
                    foreach ($vals as $val){
                        if(is_string($val)){
                            // return 'okay';
                            if ($vals->email != null) {
                                $pegawai = Pegawai::where('nokp', $vals->nokp)->orWhere('email',$vals->email)->first();
                            }else{
                                $pegawai = Pegawai::where('nokp', $vals->nokp)->first();
                            }
                           
                            if(!isset($pegawai)){
                                $newpegawai = new Pegawai();
                                $newpegawai->nama = $vals->nama;
                                $newpegawai->nokp = $vals->nokp;
                                $newpegawai->nopekerja = $vals->nopekerja;
                                $newpegawai->GelaranJwtn = $vals->GelaranJwtn;
                                $newpegawai->NamaPT = $vals->Kod_PT;
                                $newpegawai->NamaPA = $vals->NamaPA;
                                $newpegawai->NamaUnit = $vals->NamaUnit;
                                $newpegawai->Jawatan = $vals->Jawatan;
                                $newpegawai->StesenBertugas = $vals->StesenBertugas;
                                $newpegawai->email = $vals->email;
                                $newpegawai->notel = $vals->notel;
                                $newpegawai->negeri = $vals->U_Negeri_ID;
                                $newpegawai->mukim = "";
                                $newpegawai->peranan_pegawai = "";
        
                                $newpegawai->save();
        
                                $newuser = new User();
                                $newuser->name = $vals->nama;
                                $newuser->email = $vals->email;
                                $newuser->idpegawai = $newpegawai->id;
                                $newuser->status_pengguna = 0;
                                $newuser->no_kp = $vals->nokp;
                                $newuser->role = 0;
                                $newuser->type = 1;
                                $newuser->profile_status = 0;
                                $newuser->save();
                                
                                return 'complete';
                            }else{
                                return 'done';
                            }

                        }else{
                            // return 'banyak';
                            if ($vals->email != null) {
                                $pegawai = Pegawai::where('nokp', $vals->nokp)->orWhere('email',$vals->email)->first();
                            }else{
                                $pegawai = Pegawai::where('nokp', $vals->nokp)->first();
                            }
                         
                            if(!isset($pegawai)){
                                $newpegawai = new Pegawai();
                                $newpegawai->nama = $val->nama;
                                $newpegawai->nokp = $val->nokp;
                                $newpegawai->nopekerja = $val->nopekerja;
                                $newpegawai->GelaranJwtn = $val->GelaranJwtn;
                                $newpegawai->NamaPT = $val->Kod_PT;
                                $newpegawai->NamaPA = $val->NamaPA;
                                $newpegawai->NamaUnit = $val->NamaUnit;
                                $newpegawai->Jawatan = $val->Jawatan;
                                $newpegawai->StesenBertugas = $val->StesenBertugas;
                                $newpegawai->email = $val->email;
                                $newpegawai->notel = $val->notel;
                                $newpegawai->negeri = $val->U_Negeri_ID;
                                $newpegawai->mukim = "";
                                $newpegawai->peranan_pegawai = "";
        
                                $newpegawai->save();
        
                                $newuser = new User();
                                $newuser->name = $val->nama;
                                $newuser->email = $val->email;
                                $newuser->idpegawai = $newpegawai->id;
                                $newuser->status_pengguna = 0;
                                $newuser->no_kp = $val->nokp;
                                $newuser->role = 0;
                                $newuser->type = 1;
                                $newuser->profile_status = 0;
                                $newuser->save();
                                return 'complete';

                            }else{
                                return 'done';
                            }
                        }
                    }
                  
                    return $vals;
                }else{
                    return '300';
                }
            }else{
                return '300';
            }
        }
        catch(\Exception $e){
            dd($e);
            return '400';
        }
        return true;
    }



      public function calculateage()
      { 
       $usahawan = Usahawan::all();
            foreach ($usahawan as $u) {
                $ic = $u->nokadpengenalan;
                if (strlen($ic) == 12) {
                    $tahun = "19".$ic[0].$ic[1];
                    $bulan = $ic[2].$ic[3];
                    $hari = $ic[4].$ic[5];

                    $tarikh_lahir = $tahun."-".$bulan."-".$hari;
                    $u->update([
                        'tarikhlahir'=>$tarikh_lahir,
                    ]);
                }
              
                $age = explode('-',$u->tarikhlahir);
                $cage = (int)now()->format('Y') - (int)$age[0];
                if ($cage == (int)now()->format('Y')) {
                   $u->update([
                    'age'=>'0'
                   ]);
                }else {
                    $u->update([
                    'age'=>$cage
                   ]);
                }

            }
            dd($usahawan);
      }
}
