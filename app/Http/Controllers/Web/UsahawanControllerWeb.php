<?php

namespace App\Http\Controllers\Web;
ini_set('memory_limit', '-1');
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Usahawan;
use App\Models\PusatTanggungjawab;
use App\Models\Negeri;
use App\Models\Pegawai;
use App\Models\Mukim;
use App\Models\Daerah;
use App\Models\Parlimen;
use App\Models\Dun;
use App\Models\Kampung;
use App\Models\Seksyen;
use App\Models\KategoriUsahawan;
use App\Models\AuditTrail;
use App\Models\Pekebun;
use App\Models\Syarikat;
use App\Models\Perniagaan;
// use App\Models\Etnik;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
error_reporting(0);

class UsahawanControllerWeb extends Controller
{
    public function index()
    {
        $ddPT = PusatTanggungjawab::where('status', 1)->orderBy('keterangan','ASC')->get();
        $ddNegeri = Negeri::where('status', 1)->get();

        return view('usahawanWeb.landing'
        ,[
            'ddNegeri'=>$ddNegeri,
            'ddPT'=>$ddPT
        ]
        );
    }

    public function CariUsahawan(Request $request)
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $authpegawai = Pegawai::where('id', $authuser->idpegawai)->first();
        $authmukim = Mukim::where('U_Mukim_ID', $authpegawai->mukim)->first();
        $ddPT = PusatTanggungjawab::where('status', 1)->get();
        $ddNegeri = Negeri::where('status', 1)->get();
        $ddDaerah = Daerah::where('status', 1)->get();
        $ddMukim = Mukim::where('status', 1)->get();
        $ddParlimen = Parlimen::all();
        $ddDun = Dun::all();
        $ddKampung = Kampung::select('U_Kampung_ID','Kampung')->where('status', 1)->get();
        $ddSeksyen = Seksyen::where('status', 1)->get();
        $ddKateUsahawan = KategoriUsahawan::where('status_kategori_usahawan', 'aktif')->get();
        if($authuser->role == 1){
            $users = Usahawan::without(['PT','daerah','dun','parlimen','kateusah','syarikat','etnik','mukim','kampung','seksyen','insentif']);
        }else if($authuser->role == 3){
            $users = Usahawan::where('U_Negeri_ID',$authmukim->U_Negeri_ID);
        }else if($authuser->role == 4){
            $users = Usahawan::where('U_Daerah_ID',$authmukim->U_Daerah_ID);
        }else if($authuser->role == 7){
            $users = Usahawan::where('Kod_PT',$authpegawai->NamaPT);
        }else{
            return redirect('/landing');
        }

        if(!empty($request->nama)){
            $users->where('namausahawan', 'like', '%'.$request->nama.'%');
        }
        if(!empty($request->noKP)){
            $users->where('nokadpengenalan', 'like', '%'.$request->noKP.'%');
        }
        if(!empty($request->negeri)){
            $users->where('U_Negeri_ID', $request->negeri);
        }
        if(!empty($request->PT)){
            $users->where('Kod_PT', $request->PT);
        }
        if(!empty($request->StatProf)){
            $users->where('status_profil',0);
        }

        $result = $users->get();

        return view('usahawanWeb.index',[
            'users'=>$result,
            'ddPT'=>$ddPT,
            'ddNegeri'=>$ddNegeri,
            'ddDaerah'=>$ddDaerah,
            'ddMukim'=>$ddMukim,
            'ddParlimen'=>$ddParlimen,
            'ddDun'=>$ddDun,
            'ddKampung'=>$ddKampung,
            'ddSeksyen'=>$ddSeksyen,
            'ddKateUsahawan'=>$ddKateUsahawan
        ]);
    }

    public function ViewAllUsahawan()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $authpegawai = Pegawai::where('id', $authuser->idpegawai)->first();
        $authmukim = Mukim::where('U_Mukim_ID', $authpegawai->mukim)->first();
        $ddPT = PusatTanggungjawab::where('status', 1)->get();
        $ddNegeri = Negeri::where('status', 1)->get();
        $ddDaerah = Daerah::where('status', 1)->get();
        $ddMukim = Mukim::where('status', 1)->get();
        $ddParlimen = Parlimen::all();
        $ddDun = Dun::all();
        $ddKampung = Kampung::select('U_Kampung_ID','Kampung')->where('status', 1)->get();
        $ddSeksyen = Seksyen::where('status', 1)->get();
        $ddKateUsahawan = KategoriUsahawan::where('status_kategori_usahawan', 'aktif')->get();
        if($authuser->role == 1){
            // $users = Usahawan::without(['PT','daerah','dun','parlimen','kateusah','syarikat','etnik','mukim','kampung','seksyen','insentif'])->get();
            $users = Usahawan::with(['user','pekebun','negeri','perniagaan'])->get();
        }else if($authuser->role == 3){
            $users = Usahawan::where('U_Negeri_ID',$authmukim->U_Negeri_ID)->get();
        }else if($authuser->role == 4){
            $users = Usahawan::where('U_Daerah_ID',$authmukim->U_Daerah_ID)->get();
        }else if($authuser->role == 7){
            $users = Usahawan::where('Kod_PT',$authpegawai->NamaPT)->get();
        }else{
            return redirect('/landing');
        }

        return view('usahawanWeb.index',[
            'users'=>$users,
            'ddPT'=>$ddPT,
            'ddNegeri'=>$ddNegeri,
            'ddDaerah'=>$ddDaerah,
            'ddMukim'=>$ddMukim,
            'ddParlimen'=>$ddParlimen,
            'ddDun'=>$ddDun,
            'ddKampung'=>$ddKampung,
            'ddSeksyen'=>$ddSeksyen,
            'ddKateUsahawan'=>$ddKateUsahawan
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('usahawanid', $id)->first();
        $user->name = $request->namausahawan;
        $user->email = $request->email;
        $user->no_kp = $request->nokadpengenalan;
        $user->save();

        $usahawan = Usahawan::where('usahawanid', $id)->first();
        $usahawan->namausahawan = $request->namausahawan;
        $usahawan->nokadpengenalan = $request->nokadpengenalan;
        $usahawan->usahawanid = $request->No_Usahawan;
        $tarikh = date("Y-m-d", strtotime($request->tarikhlahir));  
        $usahawan->tarikhlahir = $tarikh;
        $usahawan->U_Jantina_ID = $request->U_Jantina_ID;
        $usahawan->U_Bangsa_ID = $request->U_Bangsa_ID;
        $usahawan->U_Etnik_ID = $request->U_Etnik_ID;
        $usahawan->U_Pendidikan_ID = $request->U_Pendidikan_ID;
        $usahawan->U_Taraf_Pendidikan_Tertinggi_ID = $request->U_Taraf_Pendidikan_Tertinggi_ID;
        $usahawan->statusperkahwinan = $request->statusperkahwinan;
        $usahawan->Kod_PT = $request->Kod_PT;
        $usahawan->alamat1 = $request->alamat1;
        $usahawan->alamat2 = $request->alamat2;
        $usahawan->alamat3 = $request->alamat3;
        $usahawan->bandar = $request->bandar;
        $usahawan->poskod = $request->poskod;
        $usahawan->U_Negeri_ID = $request->U_Negeri_ID;
        $usahawan->U_Daerah_ID = $request->U_Daerah_ID;
        $usahawan->U_Mukim_ID = $request->U_Mukim_ID;
        $usahawan->U_Parlimen_ID = $request->U_Parlimen_ID;
        $usahawan->U_Dun_ID = $request->U_Dun_ID;
        $usahawan->U_Kampung_ID = $request->U_Kampung_ID;
        $usahawan->U_Seksyen_ID = $request->U_Seksyen_ID;
        $usahawan->id_kategori_usahawan = $request->id_kategori_usahawan;
        // if($request->gambarusahawan()) {
        //     $path = $request->gambarusahawan('file')->store('uploads');
        //     $usahawan->gambar_url =  $path;
        // }
        $usahawan->notelefon = $request->notelefon;
        $usahawan->nohp = $request->nohp;
        $usahawan->email = $request->email;
        $usahawan->save();

        // negeriperniaga

        $audit = new AuditTrail();
        $authuser = Auth::user();
        $audit->idpegawai = $authuser->idpegawai;
        $audit->Type = 2;
        $audit->Desc = "Kemaskini data untuk ".$request->namausahawan."";
        $audit->Date = date("Y-m-d H:i:s");
        $audit->save();

        echo '<script language="javascript">';
        echo 'alert("Profil Usahawan Berjaya Di Kemaskini");';
        echo "window.location.href = '/usahawanWeb';";
        echo '</script>';
        // return redirect('/usahawanWeb');
    }

    public function usahawanPost(Request $request)
    {
        if($request->type == 'status'){
            $user = User::where('usahawanid', $request->id)->update([
                'status_pengguna' => $request->status
            ]);
            // $user->status_pengguna = 
            // $user->save();
            $audit = new AuditTrail();

            $authuser = Auth::user();
            $audit->idpegawai = $authuser->idpegawai;
            $audit->Type = 2;
            $audit->Desc = "Ubah Status Profil Usahawan ".$request->namausahawan."";
            $audit->Date = date("Y-m-d H:i:s");
            $audit->save();
        } 
        if($request->type == 'kawasan'){
            //$user = User::where('usahawanid', $request->id)->first();
            $usahawan = Usahawan::where('usahawanid', $request->id)->first();
            $usahawan->Kod_PT = $request->status;
            $usahawan->save();
            
            $audit = new AuditTrail();
            $authuser = Auth::user();
            $audit->idpegawai = $authuser->idpegawai;
            $audit->Type = 2;
            $audit->Desc = "Tetapkan Pusat Tanggungjawab Usahawan ".$request->namausahawan."";
            $audit->Date = date("Y-m-d H:i:s");
            $audit->save();
        }
        
    }

    public function SahUsahawanProfil(Request $request)
    {
        $usahawan = Usahawan::where('usahawanid', $request->id)->first();
        $usahawan->status_profil = 1;
        $usahawan->save();

        $audit = new AuditTrail();
        $authuser = Auth::user();
        $audit->idpegawai = $authuser->idpegawai;
        $audit->Type = 2;
        $audit->Desc = "Sahkan Profil Usahawan ".$request->namausahawan."";
        $audit->Date = date("Y-m-d H:i:s");
        $audit->save();
    }

    public function UploadProfile(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]); 
        $imgname = $request->id.'.'.$request->file->extension();
        $request->file->move(public_path('images'), $imgname);

        $usahawan = Usahawan::where('usahawanid', $request->id)->first();
        $usahawan->gambar_url = '../images/'.$imgname;
        $usahawan->save();

        return '../images/'.$imgname;
    }

    public function usahawanGet(Request $req)
    {
        $client = new \GuzzleHttp\Client();
        try{
            $request = $client->request('GET', 'https://www4.risda.gov.my/espek/portalpkprofiltanah/?nokp='.$req->nokp.'', [
                'auth' => ['99891c082ecccfe91d99a59845095f9c47c4d14e', '1cc11a9fec81dc1f99f353f403d6f5bac620aa8f']
            ]);

            $response = $request->getBody()->getContents();
            $vals = json_decode($response);
    
            $pekebun = Pekebun::where('usahawanid', $req->idusahawan)->first();
            if(isset($pekebun)){
                $pekebun->Nama_PK = $vals[0]->Nama_PK;
                $pekebun->No_KP = $vals[0]->No_KP;
                $pekebun->save();
            }else{
                $pekebun = new Pekebun();
                $pekebun->Nama_PK = $vals[0]->Nama_PK;
                $pekebun->No_KP = $vals[0]->No_KP;
                $pekebun->usahawanid = $req->idusahawan;
                $pekebun->save();
            }
    
            return $vals;
        }
        catch(\Exception $e){
            // dd($e);
            return '400';
        }
       
        // dd($vals);
    }

    public function usahawanPost2(Request $request)
    {
        // return $request->id;
        $user = User::where('usahawanid', $request->id)->first();
        $user->password = Hash::make('Reds@12345');
        $user->profile_status = 0;
        $user->save();

    }

    public function usahawanPK(Request $request){
        $client = new \GuzzleHttp\Client();
        try{
            $nama = $request->nama;
            $nokp = $request->nokp;
            $negeri = $request->negeri;
            $kodpt = $request->kodpt;

            $link = 'https://pekebunkecil-dev.borang.my/manage/api/permohonan-usahawan?';
            if($nama != null){
                $link .= 'nama_penuh='.$nama.'&';
            }
            if($kodpt != null){
                $link .= 'pusat_tanggungjawab='.$kodpt.'&';
            }
            if($nokp != null){
                $link .= 'no_kp='.$nokp.'&';
            }
            if($negeri != null){
                $link .= 'negeri='.$negeri.'&';
            }

            $token = '3EgjkvnnuYzAEd1-FiN-BNiI1Nv7YwuM';
            $headers = [
                'Authorization' => 'Bearer ' . $token,        
                'Accept'        => 'application/json',
            ];
            $request = $client->request('GET', $link, [
                'headers' => $headers]
            );

            $response = $request->getBody()->getContents();
            $vals = json_decode($response);
            // return $vals;
            foreach ($vals as $val){
                // return $val;
                if(is_int($val)){
                    // return $val;
                    $usahawan = Usahawan::where('nokadpengenalan', $vals->no_kad_pengenalan)->first();
                    if(!isset($usahawan)){
                        $usahawanNew = new Usahawan();
                        $usahawanNew->namausahawan = $vals->nama_penuh;
                        $usahawanNew->nokadpengenalan = $vals->no_kad_pengenalan;
                        $usahawanNew->email = $vals->alamat_emel;
                        $usahawanNew->U_Daerah_ID = $vals->daerah_pusat_tanggungjawab;
                        $usahawanNew->status_daftar_usahawan = $vals->kategori;
                        $usahawanNew->U_Negeri_ID = $vals->negeri_pusat_tanggungjawab;
                        $usahawanNew->notelefon = $vals->no_telefon;
                        $usahawanNew->U_Kampung_ID = $vals->alamat_surat_menyurat->kampung;
                        $usahawanNew->alamat1 = $vals->alamat_surat_menyurat->no_rumah;
                        $usahawanNew->alamat2 = $vals->alamat_surat_menyurat->nama_jalan;
                        $usahawanNew->poskod = $vals->alamat_surat_menyurat->poskod;
                        $usahawanNew->bandar = $vals->alamat_surat_menyurat->bandar;
                        $usahawanNew->usahawanid = $vals->usahawan_id;
                        $usahawanNew->save();

                        $userNew = new User();
                        $userNew->name = $vals->nama_penuh;
                        $userNew->email = $vals->alamat_emel;
                        $userNew->usahawanid = $vals->usahawan_id;
                        $userNew->status_pengguna = 0;
                        $userNew->no_kp = $vals->no_kad_pengenalan;
                        $userNew->type = 2;
                        $userNew->profile_status = 0;
                        $userNew->save();

                        $syarikat = new Syarikat();
                        $syarikat->namasyarikat = $vals->nama_syarikat;
                        $syarikat->usahawanid = $vals->usahawan_id;
                        $syarikat->save();

                        $pekebun = new Pekebun();
                        $pekebun->No_KP = $vals->no_kp_pekebun_kecil;
                        $pekebun->usahawanid = $vals->usahawan_id;
                        $pekebun->save();

                        $perniagaan = New Perniagaan();
                        $perniagaan->alamat1 = $vals->alamat_penuh_perniagaan->no_rumah;
                        $perniagaan->alamat2 = $vals->alamat_penuh_perniagaan->nama_jalan;
                        $perniagaan->bandar = $vals->alamat_penuh_perniagaan->bandar;
                        $perniagaan->U_Kampung_ID = $vals->alamat_penuh_perniagaan->kampung;
                        $perniagaan->U_Negeri_ID = $vals->alamat_penuh_perniagaan->negeri;
                        $perniagaan->poskod = $vals->alamat_penuh_perniagaan->poskod;
                        $perniagaan->usahawanid = $vals->usahawan_id;
                        $perniagaan->save();
                        
                    }
                    return $vals;

                }else{
                    $usahawan = Usahawan::where('nokadpengenalan', $val->no_kad_pengenalan)->orWhere('email',$val->email)->first();
                    // return $usahawan;
                    if(!isset($usahawan)){
                        // return $val;
                        $usahawanNew = new Usahawan();
                        $usahawanNew->namausahawan = $val->nama_penuh;
                        $usahawanNew->nokadpengenalan = $val->no_kad_pengenalan;
                        $usahawanNew->email = $val->alamat_emel;
                        $usahawanNew->U_Daerah_ID = $val->daerah_pusat_tanggungjawab;
                        $usahawanNew->status_daftar_usahawan = $val->kategori;
                        $usahawanNew->U_Negeri_ID = $val->negeri_pusat_tanggungjawab;
                        $usahawanNew->notelefon = $val->no_telefon;
                        $usahawanNew->U_Kampung_ID = $val->alamat_surat_menyurat->kampung;
                        $usahawanNew->alamat1 = $val->alamat_surat_menyurat->no_rumah;
                        $usahawanNew->alamat2 = $val->alamat_surat_menyurat->nama_jalan;
                        $usahawanNew->poskod = $val->alamat_surat_menyurat->poskod;
                        $usahawanNew->bandar = $val->alamat_surat_menyurat->bandar;
                        $usahawanNew->usahawanid = $val->usahawan_id;
                        $usahawanNew->save();

                        $userNew = new User();
                        $userNew->name = $val->nama_penuh;
                        $userNew->enail = $val->alamat_emel;
                        $userNew->usahawanid = $val->usahawan_id;
                        $userNew->status_pengguna = 0;
                        $userNew->no_kp = $val->no_kad_pengenalan;
                        $userNew->type = 2;
                        $userNew->profile_status = 0;
                        $userNew->save();

                        $syarikat = new Syarikat();
                        $syarikat->namasyarikat = $val->nama_syarikat;
                        $syarikat->usahawanid = $val->usahawan_id;
                        $syarikat->save();

                        $pekebun = new Pekebun();
                        $pekebun->No_KP = $val->no_kp_pekebun_kecil;
                        $pekebun->usahawanid = $val->usahawan_id;
                        $pekebun->save();

                        $perniagaan = New Perniagaan();
                        $perniagaan->alamat1 = $val->alamat_penuh_perniagaan->no_rumah;
                        $perniagaan->alamat2 = $val->alamat_penuh_perniagaan->nama_jalan;
                        $perniagaan->bandar = $val->alamat_penuh_perniagaan->bandar;
                        $perniagaan->U_Kampung_ID = $val->alamat_penuh_perniagaan->kampung;
                        $perniagaan->U_Negeri_ID = $val->alamat_penuh_perniagaan->negeri;
                        $perniagaan->poskod = $val->alamat_penuh_perniagaan->poskod;
                        $perniagaan->usahawanid = $val->usahawan_id;
                        $perniagaan->save();
                            
                    }
                }
            }
            
            return $vals;
        }
        catch(\Exception $e){
            // dd($e);
            return '400';
        }
    }
}
 