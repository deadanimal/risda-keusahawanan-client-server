<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usahawan;
use App\Models\Insentif;
use App\Models\JenisInsentif;
use App\Models\Report;
use App\Models\Pegawai;
use App\Models\Mukim;
use App\Models\AuditTrail;

class InsentifControllerWeb extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $authpegawai = Pegawai::where('id', $authuser->idpegawai)->first();
        // $authmukim = Mukim::where('U_Mukim_ID', $authpegawai->mukim)->first();
        if($authuser->role == 1){
            $users = Usahawan::select('namausahawan','nokadpengenalan','usahawanid','Kod_PT')->with(['PT'])->without(['user','pekebun','negeri','daerah','dun','parlimen','perniagaan','kateusah','syarikat','insentif','etnik','mukim','kampung','seksyen'])->get();
        }else if($authuser->role == 3){
            $users = Usahawan::select('namausahawan','nokadpengenalan','usahawanid','Kod_PT')->with(['PT'])
            ->without(['user','pekebun','negeri','daerah','dun','parlimen','perniagaan','kateusah','syarikat','insentif','etnik','mukim','kampung','seksyen'])
            ->where('U_Negeri_ID',$authpegawai->Mukim->U_Negeri_ID)->get();
        }else if($authuser->role == 4){
            $users = Usahawan::select('namausahawan','nokadpengenalan','usahawanid','Kod_PT')->with(['PT'])
            ->without(['user','pekebun','negeri','daerah','dun','parlimen','perniagaan','kateusah','syarikat','insentif','etnik','mukim','kampung','seksyen'])
            ->where('U_Daerah_ID',$authpegawai->Mukim->U_Daerah_ID)->get();
        }else if($authuser->role == 5){
            $users = Usahawan::select('namausahawan','nokadpengenalan','usahawanid','Kod_PT')->with(['PT'])
            ->without(['user','pekebun','negeri','daerah','dun','parlimen','perniagaan','kateusah','syarikat','insentif','etnik','mukim','kampung','seksyen'])
            ->where('U_Negeri_ID',$authpegawai->Mukim->U_Negeri_ID)->get();
        }else if($authuser->role == 6){
            $users = Usahawan::select('namausahawan','nokadpengenalan','usahawanid','Kod_PT')->with(['PT'])
            ->without(['user','pekebun','negeri','daerah','dun','parlimen','perniagaan','kateusah','syarikat','insentif','etnik','mukim','kampung','seksyen'])
            ->where('U_Daerah_ID',$authpegawai->Mukim->U_Daerah_ID)->get();
        }else{
            return redirect('/landing');
        }
        // dd($users);
        return view('insentifWeb.index'
        ,[
            'users'=>$users
        ]
        );
    }

    public function show($id)
    {
        $insentifs = Insentif::where('id_pengguna', $id)->orderBy('created_at', 'DESC')->get();
        $insentifCount = $insentifs->count();
        if($insentifCount >= 10){
            $addinsen = false;
        }else{
            $addinsen = true;
        }
        $ddInsentif = JenisInsentif::where('status', 'aktif')->get();
        $usahawan = Usahawan::where('usahawanid', $id)->first();
        return view('insentifWeb.insentifdetail'
        ,[
            'insentifs'=>$insentifs,
            'id_pengguna'=>$usahawan->usahawanid,
            'ddInsentif'=>$ddInsentif,
            'addinsen'=>$addinsen
        ]
        );
    }
    
    public function store(Request $request)
    {
        if($request->tahun_terima_insentif == null || $request->id_jenis_insentif == null || $request->nilai_insentif == null){
            echo '<script language="javascript">';
            echo 'alert("Data tidak lengkap");';
            echo "window.location.href='insentifdetail/".$request->id_pengguna."';";
            echo '</script>';
            // return redirect('/insentifdetail/'.$request->id_pengguna);
        }else{
            $userId = $request->user()->id;
            $insentif = new Insentif();

            $insentif->id_pengguna = $request->id_pengguna;
            $insentif->id_jenis_insentif = $request->id_jenis_insentif;
            $insentif->tahun_terima_insentif = $request->tahun_terima_insentif;
            $insentif->nilai_insentif = $request->nilai_insentif;
            $insentif->created_by = $userId;
            $insentif->modified_by = $userId;
            $insentif->save();
            
            $usahawan = Usahawan::where('usahawanid', $request->id_pengguna)->first();

            $audit = new AuditTrail();
            $authuser = Auth::user();
            $audit->idpegawai = $authuser->idpegawai;
            $audit->Type = 3;
            $audit->Desc = "Tambah data insentif untuk ".$usahawan->namausahawan."";
            $audit->Date = date("Y-m-d H:i:s");
            $audit->save();

            echo '<script language="javascript">';
            echo 'alert("Insentif Berjaya Di Simpan");';
            echo "window.location.href = '/insentifdetail/".$request->id_pengguna."';";
            echo '</script>';
            // return redirect('/insentifdetail/'.$request->id_pengguna);
        }
        
    }

    public function update(Request $request, $id)
    {
        $userId = $request->user()->id;
        $insentif = Insentif::where('id', $id)->first();

        $insentif->id_pengguna = $request->id_pengguna;
        $insentif->id_jenis_insentif = $request->id_jenis_insentif;
        $insentif->tahun_terima_insentif = $request->tahun_terima_insentif;
        $insentif->nilai_insentif = $request->nilai_insentif;
        $insentif->modified_by = $userId;
        $insentif->save();

        $usahawan = Usahawan::where('usahawanid', $request->id_pengguna)->first();

        $audit = new AuditTrail();
        $authuser = Auth::user();
        $audit->idpegawai = $authuser->idpegawai;
        $audit->Type = 3;
        $audit->Desc = "Kemaskini data insentif untuk ".$usahawan->namausahawan."";
        $audit->Date = date("Y-m-d H:i:s");
        $audit->save();

        echo '<script language="javascript">';
        echo 'alert("Insentif Berjaya Di Ubah");';
        echo "window.location.href = '/insentifdetail/".$request->id_pengguna."';";
        echo '</script>'; 
        // return redirect('/insentifdetail/'.$request->id_pengguna);
    }

    public function destroy($id)
    {
        $insentif=Insentif::find($id);
        $insentif->delete();
        
        $usahawan = Usahawan::where('usahawanid', $insentif->id_pengguna)->first();

        $audit = new AuditTrail();
        $authuser = Auth::user();
        $audit->idpegawai = $authuser->idpegawai;
        $audit->Type = 3;
        $audit->Desc = "Buang data insentif untuk ".$usahawan->namausahawan."";
        $audit->Date = date("Y-m-d H:i:s");
        $audit->save();

        echo '<script language="javascript">';
        echo 'alert("Insentif Berjaya Di Buang");';
        echo "window.location.href = '/insentifdetail/".$insentif->id_pengguna."';";
        echo '</script>';
        // return redirect(url()->previous());
    }
}
