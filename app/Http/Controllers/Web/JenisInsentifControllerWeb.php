<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisInsentif;
use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;

class JenisInsentifControllerWeb extends Controller
{
    public function index()
    {
        $jenisinsentif = JenisInsentif::orderBy('created_at', 'DESC')->get();
        return view('komponendash.jenisinsentif'
        ,[
            'jenisinsentifs'=>$jenisinsentif
        ] 
        );

    }

    public function store(Request $request)
    {
        $checkinsen = JenisInsentif::where('id_jenis_insentif',$request->id_jenis_insentif)->first();
        if($checkinsen != null){

            echo '<script language="javascript">';
            echo 'alert("Ralat! Kod Insentif Sudah Wujud. Data Tidak Disimpan");';
            echo "window.location.href='/jenisinsentif';";
            echo '</script>';

        }else{
            if($request->id_jenis_insentif == null || $request->nama_insentif == null || $request->status == null){
                echo '<script language="javascript">';
                echo 'alert("Data Tidak Lengkap");';
                echo "window.location.href='/jenisinsentif';";
                echo '</script>';
            }else{
                $jenisinsentif = new JenisInsentif();
                $jenisinsentif->id_jenis_insentif = $request->id_jenis_insentif;
                $jenisinsentif->nama_insentif = $request->nama_insentif;
                $jenisinsentif->status = $request->status;
                $jenisinsentif->save();

                $audit = new AuditTrail();
                $authuser = Auth::user();
                $audit->idpegawai = $authuser->idpegawai;
                $audit->Type = 4;
                $audit->Desc = "Tambah data Jenis Insentif";
                $audit->Date = date("Y-m-d H:i:s");
                $audit->save();

                echo '<script language="javascript">';
                echo 'alert("Jenis Insentif Berjaya Di Simpan");';
                echo "window.location.href='/jenisinsentif';";
                echo '</script>';
            }
        }
    }

    public function update(Request $request, $id)
    {
        if($request->id_jenis_insentif == null || $request->nama_insentif == null || $request->status == null){
            echo '<script language="javascript">';
            echo 'alert("Data Tidak Lengkap");';
            echo "window.location.href='/jenisinsentif';";
            echo '</script>';
        }else{

            $jenisinsentif = JenisInsentif::where('id', $id)->first();
            $jenisinsentif->id_jenis_insentif = $request->id_jenis_insentif;
            $jenisinsentif->nama_insentif = $request->nama_insentif;
            $jenisinsentif->status = $request->status;
            $jenisinsentif->save();

            // dd($id);
            $audit = new AuditTrail();
            $authuser = Auth::user();
            $audit->idpegawai = $authuser->idpegawai;
            $audit->Type = 4;
            $audit->Desc = "Ubah data Jenis Insentif";
            $audit->Date = date("Y-m-d H:i:s");
            $audit->save();

            echo '<script language="javascript">';
            echo 'alert("Jenis Insentif Berjaya Di Ubah");';
            echo "window.location.href='/jenisinsentif';";
            echo '</script>';
        }
    }

    public function destroy($id)
    {
        $jenisinsentif=JenisInsentif::find($id);
        $jenisinsentif->delete();

        $audit = new AuditTrail();
        $authuser = Auth::user();
        $audit->idpegawai = $authuser->idpegawai;
        $audit->Type = 4;
        $audit->Desc = "Buang data Jenis Insentif";
        $audit->Date = date("Y-m-d H:i:s");
        $audit->save();

        echo '<script language="javascript">';
        echo 'alert("Jenis Insentif Berjaya Di Buang")';
        echo '</script>';
        return redirect('/jenisinsentif');
    }

}
