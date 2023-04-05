<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TindakanLawatan;
use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;

class TindakanLawatanControllerWeb extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $tindakanlawatan = TindakanLawatan::orderBy('created_at', 'DESC')->get();
        return view('komponendash.tindakanlawatan'
        ,[
            'tindakanlawatan'=>$tindakanlawatan
        ]
        );
    }

    public function store(Request $request)
    {
        if($request->nama_tindakan_lawatan == null || $request->status_tindakan_lawatan == null){
            echo '<script language="javascript">';
            echo 'alert("Data Tidak Lengkap");';
            echo "window.location.href='/tindakanlawatan';";
            echo '</script>';
        }else{

            $tindakanlawatan = new TindakanLawatan();
            $tindakanlawatan->nama_tindakan_lawatan = $request->nama_tindakan_lawatan;
            $tindakanlawatan->status_tindakan_lawatan = $request->status_tindakan_lawatan;
            $tindakanlawatan->save();

            $audit = new AuditTrail();
            $authuser = Auth::user();
            $audit->idpegawai = $authuser->idpegawai;
            $audit->Type = 4;
            $audit->Desc = "Tambah data Tindakan Lawatan";
            $audit->Date = date("Y-m-d H:i:s");
            $audit->save();

            echo '<script language="javascript">';
            echo 'alert("Kategori Aliran Berjaya Di Simpan");';
            echo "window.location.href='/tindakanlawatan';";
            echo '</script>';
        }
        
    }

    public function update(Request $request, $id)
    {
        if($request->nama_tindakan_lawatan == null || $request->status_tindakan_lawatan == null){
            echo '<script language="javascript">';
            echo 'alert("Data Tidak Lengkap");';
            echo "window.location.href='/tindakanlawatan';";
            echo '</script>';
        }else{

            $tindakanlawatan = TindakanLawatan::where('id', $id)->first();
            $tindakanlawatan->nama_tindakan_lawatan = $request->nama_tindakan_lawatan;
            $tindakanlawatan->status_tindakan_lawatan = $request->status_tindakan_lawatan;
            $tindakanlawatan->save();

            $audit = new AuditTrail();
            $authuser = Auth::user();
            $audit->idpegawai = $authuser->idpegawai;
            $audit->Type = 4;
            $audit->Desc = "Ubah data Tindakan Lawatan";
            $audit->Date = date("Y-m-d H:i:s");
            $audit->save();

            echo '<script language="javascript">';
            echo 'alert("Tindakan Lawatan Berjaya Di Ubah");';
            echo "window.location.href='/tindakanlawatan';";
            echo '</script>';
        }
    }

    public function destroy($id)
    {
        $tindakanlawatan=TindakanLawatan::find($id);
        $tindakanlawatan->delete();

        $audit = new AuditTrail();
        $authuser = Auth::user();
        $audit->idpegawai = $authuser->idpegawai;
        $audit->Type = 4;
        $audit->Desc = "Buang data Tindakan Lawatan";
        $audit->Date = date("Y-m-d H:i:s");
        $audit->save();

        echo '<script language="javascript">';
        echo 'alert("Tindakan Lawatan Berjaya Di Buang")';
        echo '</script>';
        return redirect('/tindakanlawatan');
    }

}
