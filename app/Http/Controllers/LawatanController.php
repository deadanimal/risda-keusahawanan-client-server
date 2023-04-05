<?php

namespace App\Http\Controllers;

use App\Models\Insentif;
use App\Models\Lawatan;
use App\Models\Notifikasi;
use App\Models\Pegawai;
use App\Models\Usahawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Dompdf\Dompdf;
use Dompdf\Options;

class LawatanController extends Controller
{

    public function index()
    {
        $lawatan = Lawatan::all();
        return response()->json($lawatan);
    }

    public function store(Request $request)
    {
        $lawatan = new Lawatan();

        $lawatan->id_pengguna = $request->id_pengguna;
        $lawatan->id_pegawai = $request->id_pegawai;

        $lawatan->tarikh_lawatan = $request->tarikh_lawatan;
        $lawatan->masa_lawatan = $request->masa_lawatan;
        $lawatan->status_lawatan = "1";


        $lawatan->save();

        $notifikasi = new Notifikasi();
        $notifikasi->userid = $lawatan->id_pengguna;
        $notifikasi->tajuk = 'Tarikh Lawatan';
        $notifikasi->keterangan = 'Satu lawatan telah disetkan ke tempat anda, sila sahkan atau cadangkan tarikh baru yang bersesuaian';
        $notifikasi->modul = 'lawatan';
        $notifikasi->save();


        return response()->json($lawatan);
    }

    public function show($id)
    {
        $lawatan = Lawatan::where('lawatans.id_pegawai', $id)
            ->join('pegawais', 'pegawais.id', 'lawatans.id_pegawai')
            ->join('users', 'users.id', 'lawatans.id_pengguna')
            ->join('usahawans', 'usahawans.usahawanid', 'users.usahawanid')
            ->select(
                // 'pegawais.*',
                'lawatans.id as lawatan_id',
                'pegawais.nama as nama_pegawai',
                'usahawans.namausahawan',
                'usahawans.id as usahawan_id',
                'lawatans.updated_at',
                'lawatans.created_at',
                'lawatans.status_lawatan',
                'lawatans.tarikh_lawatan',
                'lawatans.masa_lawatan',
                'lawatans.gambar_lawatan',
                'lawatans.jenis_lawatan',
                'lawatans.id_tindakan_lawatan',
                'lawatans.komen',
                'lawatans.id_pegawai as id_pegawai',
                'users.id as id_pengguna'
            )
            ->orderBy('tarikh_lawatan', 'desc')
            ->get();

        return response()->json($lawatan);
    }

    public function showLawatanUsahawan($id)
    {

        $lawatan = User::where('users.id', $id)
            ->join('usahawans', 'usahawans.usahawanid', 'users.usahawanid')
            ->join('lawatans', 'lawatans.id_pengguna', 'users.id')
            ->join('pegawais', 'pegawais.id', 'lawatans.id_pegawai')
            ->select(
                'lawatans.id as lawatan_id',
                'pegawais.nama as nama_pegawai',
                'usahawans.namausahawan',
                'usahawans.id as usahawan_id',
                'lawatans.updated_at',
                'lawatans.created_at',
                'lawatans.status_lawatan',
                'lawatans.tarikh_lawatan',
                'lawatans.masa_lawatan',
                'lawatans.gambar_lawatan',
                'lawatans.jenis_lawatan',
                'lawatans.id_tindakan_lawatan',
                'lawatans.komen',
                'lawatans.id_pengguna',
                'lawatans.id_pegawai',
            )
            ->get();

        return response()->json($lawatan);
    }


    public function update(Request $request, Lawatan $lawatan)
    {
        $lawatan->tarikh_lawatan = $request->tarikh_lawatan;
        $lawatan->masa_lawatan = $request->masa_lawatan;
        $lawatan->status_lawatan = $request->status_lawatan;

        $lawatan->save();

        // $pegawaiid = 

        if ($request->status_lawatan == 1 || $request->status_lawatan == 2) {
            if ($request->role == "pegawai") {

                $notifikasi = new Notifikasi();
                $notifikasi->userid = $request->id_pengguna;
                $notifikasi->tajuk = 'Tarikh Lawatan';
                $notifikasi->keterangan = 'satu tarikh baru telah dicadangkan oleh pegawai';
                $notifikasi->modul = 'lawatan';
                $notifikasi->save();
            } else if ($request->role == "usahawan") {

                $user = User::where('idpegawai', $request->id_pegawai)
                    ->get()->first();

                $notifikasi = new Notifikasi();
                $notifikasi->userid = $user->id;
                $notifikasi->tajuk = 'Tarikh Lawatan';
                $notifikasi->keterangan = 'satu tarikh baru telah dicadangkan oleh usahawan';
                $notifikasi->modul = 'lawatan';
                $notifikasi->save();
            }
        } else  if ($request->status_lawatan == 3) {
            if ($request->role == "pegawai") {

                $notifikasi = new Notifikasi();
                $notifikasi->userid = $request->id_pengguna;
                $notifikasi->tajuk = 'Pengesahan Lawatan';
                $notifikasi->keterangan = 'Tarikh lawatan telah disahkan oleh pegawai';
                $notifikasi->modul = 'lawatan';
                $notifikasi->save();
            } else if ($request->role == "usahawan") {

                $user = User::where('idpegawai', $request->id_pegawai)
                    ->get()->first();

                $notifikasi = new Notifikasi();
                $notifikasi->userid = $user->id;
                $notifikasi->tajuk = 'Pengesahan Lawatan';
                $notifikasi->keterangan = 'Tarikh lawatan telah disahkan oleh usahawan';
                $notifikasi->modul = 'lawatan';
                $notifikasi->save();
            }
        }


        return response()->json($lawatan);
    }

    public function updateLaporan(Request $request, $id)
    {
        $lawatan = Lawatan::find($id);
        $lawatan->id_tindakan_lawatan = $request->id_tindakan_lawatan;
        $lawatan->jenis_lawatan = $request->jenis_lawatan;
        $lawatan->gambar_lawatan = $request->gambar_lawatan;
        $lawatan->komen = $request->komen;

        $lawatan->save();

        $notifikasi = new Notifikasi();
        $notifikasi->userid = $lawatan->id_pengguna;
        $notifikasi->tajuk = 'Laporan Lawatan';
        $notifikasi->keterangan = 'Dokumen lawatan telah dikemaskini';
        $notifikasi->modul = 'lawatan';
        $notifikasi->save();

        return response()->json($lawatan);
    }


    public function destroy(Lawatan $lawatan)
    {
        //
    }

    public function showUsahawanForLawatan($id_pegawai)
    {
        $usahawan = DB::table('pegawais')->where('pegawais.id', $id_pegawai)
            ->join('usahawans', 'usahawans.Kod_PT', 'pegawais.NamaPT')
            ->join('users', 'users.usahawanid', 'usahawans.usahawanid')
            ->select('users.id as id_pengguna', 'users.name')
            ->get();

        return response()->json($usahawan);
    }

    public function storeLaporan(Request $request)
    {

        $lawatan = new Lawatan();

        $lawatan->id_pengguna = $request->id_pengguna;
        $lawatan->id_pegawai = $request->id_pegawai;

        $lawatan->tarikh_lawatan = $request->tarikh_lawatan;
        $lawatan->masa_lawatan = $request->masa_lawatan;

        $lawatan->status_lawatan = "4";
        $lawatan->jenis_lawatan = $request->jenis_lawatan;
        $lawatan->id_tindakan_lawatan = $request->id_tindakan_lawatan;
        $lawatan->komen = $request->komen;
        $lawatan->gambar_lawatan = $request->gambar_lawatan;

        $lawatan->save();

        $notifikasi = new Notifikasi();
        $notifikasi->userid = $lawatan->id_pengguna;
        $notifikasi->tajuk = 'Laporan Lawatan';
        $notifikasi->keterangan = 'Satu laporan lawatan telah ditambah';
        $notifikasi->modul = 'lawatan';
        $notifikasi->save();


        return response()->json($lawatan);
    }

    public function showLaporan($id_pegawai)
    {
        $lawatan = DB::table('pegawais')->where('pegawais.id', $id_pegawai)
            ->join('lawatans', 'lawatans.id_pegawai', 'pegawais.id')
            ->join('users', 'users.id', 'lawatans.id_pengguna')
            ->select('users.name as nama_usahawan', 'lawatans.*')
            ->get();

        return response()->json($lawatan);
    }


    public function janaDokumenLawatan($id)
    {
        // dd("yeayyy");

        $year = date("Y");

        $lawatan = Lawatan::where('lawatans.id', $id)
            ->join('pegawais', 'pegawais.id', 'lawatans.id_pegawai')
            ->join('users', 'users.id', 'lawatans.id_pengguna')
            ->join('usahawans', 'usahawans.usahawanid', 'users.usahawanid')
            ->join('tindakan_lawatans', 'tindakan_lawatans.id', 'lawatans.id_tindakan_lawatan')
            ->select(
                "users.id as id_pengguna",
                "usahawans.usahawanid as usahawanid",
                "lawatans.gambar_lawatan",
                "lawatans.tarikh_lawatan",
                "lawatans.masa_lawatan",
                "pegawais.nama as nama_pegawai",
                "tindakan_lawatans.nama_tindakan_lawatan",
                "lawatans.komen",
            )
            ->get()->first();

        $usahawan = Usahawan::with(['user','pekebun','negeri','PT','daerah','dun','parlimen','perniagaan','kateusah','syarikat', 'insentif', 'etnik', 'mukim', 'kampung', 'seksyen'])
            ->where('usahawanid', $lawatan->usahawanid)
            ->first();

        // dd($usahawan);

        $insentif = Insentif::where('id_pengguna', $lawatan->usahawanid)
            ->join('jenis_insentifs', 'jenis_insentifs.id_jenis_insentif', 'insentifs.id_jenis_insentif')
            ->get();

        // dd($insentif);

        // dd($lawatan);

        $pdff = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $pdff->setOptions($options);
        $pdff->loadHtml(view('pdf.laporanLawatan', [
            'year' => $year,
            'lawatan' => $lawatan,
            'insentifs' => $insentif,
            'usahawan' => $usahawan
        ]));
        $customPaper = array(2, -35, 480, 627);
        $pdff->setPaper($customPaper);
        $pdff->render();
        // $pdff->stream(
        //     "laporan lawatan ".$lawatan->namausahawan,
        //     array("Attachment" => false)
        // );

        // exit(0);

        $fname = time() . "laporan lawatan " . $lawatan->namausahawan . ".pdf";
        $output = $pdff->output();

        \Storage::put('laporan_lawatan/' . $fname, $output);
        // file_put_contents(, $output);

        return response()->json('laporan_lawatan/' . $fname);
    }
}
