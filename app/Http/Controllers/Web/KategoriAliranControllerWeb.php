<?php
 
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriAliran;
use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;

class KategoriAliranControllerWeb extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $kategorialiran = KategoriAliran::orderBy('created_at', 'DESC')->get();
        return view('komponendash.kategorialiran'
        ,[
            'kategorialiran'=>$kategorialiran
        ]
        );
    }

    public function store(Request $request)
    {
        if($request->jenis_aliran == null || $request->jenis_aliran_dua == null || $request->nama_kategori_aliran == null || $request->status_kategori_aliran == null){
            echo '<script language="javascript">';
            echo 'alert("Data Tidak Lengkap");';
            echo "window.location.href='/kategorialiran';";
            echo '</script>';
        }else{
            $kategorialiran = new KategoriAliran();
            $kategorialiran->jenis_aliran = $request->jenis_aliran;
            $kategorialiran->bahagian = $request->jenis_aliran_dua;
            $kategorialiran->nama_kategori_aliran = $request->nama_kategori_aliran;
            $kategorialiran->status_kategori_aliran = $request->status_kategori_aliran;
            $kategorialiran->save();

            $audit = new AuditTrail();
            $authuser = Auth::user();
            $audit->idpegawai = $authuser->idpegawai;
            $audit->Type = 4;
            $audit->Desc = "Tambah data Aliran";
            $audit->Date = date("Y-m-d H:i:s");
            $audit->save();

            echo '<script language="javascript">';
            echo 'alert("Kategori Aliran Berjaya Di Simpan");';
            echo "window.location.href='/kategorialiran';";
            echo '</script>';
        }
    }

    public function update(Request $request, $id)
    {
        if($request->jenis_aliran == null || $request->jenis_aliran_dua == null || $request->nama_kategori_aliran == null || $request->status_kategori_aliran == null){
            echo '<script language="javascript">';
            echo 'alert("Data Tidak Lengkap");';
            echo "window.location.href='/kategorialiran';";
            echo '</script>';
        }else{
            $kategorialiran = KategoriAliran::where('id', $id)->first();
            $kategorialiran->jenis_aliran = $request->jenis_aliran;
            $kategorialiran->bahagian = $request->jenis_aliran_dua;
            $kategorialiran->nama_kategori_aliran = $request->nama_kategori_aliran;
            $kategorialiran->status_kategori_aliran = $request->status_kategori_aliran;
            $kategorialiran->save();

            $audit = new AuditTrail();
            $authuser = Auth::user();
            $audit->idpegawai = $authuser->idpegawai;
            $audit->Type = 4;
            $audit->Desc = "Ubah data Aliran";
            $audit->Date = date("Y-m-d H:i:s");
            $audit->save();

            echo '<script language="javascript">';
            echo 'alert("Kategori Aliran Berjaya Di Ubah");';
            echo "window.location.href='/kategorialiran';";
            echo '</script>';
        }
    }

    public function destroy($id)
    {
        $kategorialiran=KategoriAliran::find($id);
        $kategorialiran->delete();

        $audit = new AuditTrail();
        $authuser = Auth::user();
        $audit->idpegawai = $authuser->idpegawai;
        $audit->Type = 4;
        $audit->Desc = "Buang data Aliran";
        $audit->Date = date("Y-m-d H:i:s");
        $audit->save();

        echo '<script language="javascript">';
        echo 'alert("Kategori Aliran Berjaya Di Buang");';
        echo "window.location.href='/kategorialiran';";
        echo '</script>';
    }
}
