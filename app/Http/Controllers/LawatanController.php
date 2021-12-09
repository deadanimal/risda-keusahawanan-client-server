<?php

namespace App\Http\Controllers;

use App\Models\Lawatan;
use App\Models\Pegawai;
use App\Models\Usahawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        // $lawatan->id_tindakan_lawatan = $request->id_tindakan_lawatan;
        // $lawatan->jenis_lawatan = $request->jenis_lawatan;
        $lawatan->tarikh_lawatan = $request->tarikh_lawatan;
        $lawatan->masa_lawatan = $request->masa_lawatan;
        $lawatan->status_lawatan = "usahawan";
        // $lawatan->gambar_lawatan = $request->gambar_lawatan;
        // $lawatan->komen = $request->komen;
        // $lawatan->modified_by = $$request->id_pengguna;

        $lawatan->save();

        return response()->json($lawatan);
    }

    public function show($id)
    {
        $date = date("Y-m-d");
        $test = Lawatan::where([
            ['tarikh_lawatan', '<=', $date],
            ['status_lawatan', '=', "disahkan"],
        ])
            ->get()
            ->map(function ($lawatan) {
                $lawatan->status_lawatan = str_replace($lawatan->status_lawatan, '', 'selesai');
                $lawatan->save();
                return $lawatan;
            });

        // foreach($test as $test){
        // $test->save();
        // dd($test);
        // }


        $lawatan = Pegawai::where('pegawais.id', $id)
            ->join('usahawans', 'usahawans.Kod_PT', 'pegawais.NamaPT')
            ->join('users', 'users.usahawanid', 'usahawans.id')
            ->join('lawatans', 'lawatans.id_pengguna', 'users.id')
            ->select('lawatans.id as lawatan_id', 'pegawais.nama as nama_pegawai', 'usahawans.namausahawan', 'usahawans.id as usahawan_id', 'lawatans.updated_at', 'lawatans.created_at', 'lawatans.status_lawatan', 'lawatans.tarikh_lawatan', 'lawatans.masa_lawatan', 'lawatans.gambar_lawatan', 'lawatans.jenis_lawatan', 'lawatans.id_tindakan_lawatan', 'lawatans.komen')
            ->get();

        return response()->json($lawatan);
    }

    public function showLawatanUsahawan($id)
    {
        $date = date("Y-m-d");
        $test = Lawatan::where([
            ['tarikh_lawatan', '<=', $date],
            ['status_lawatan', '=', "disahkan"],
        ])
            ->get()
            ->map(function ($lawatan) {
                $lawatan->status_lawatan = str_replace($lawatan->status_lawatan, '', 'selesai');
                $lawatan->save();
                return $lawatan;
            });

        $lawatan = User::where('users.id', $id)
            ->join('usahawans', 'usahawans.id', 'users.usahawanid')
            ->join('lawatans', 'lawatans.id_pengguna', 'users.id')
            ->join('pegawais', 'pegawais.id', 'lawatans.id_pegawai')
            ->select('lawatans.id as lawatan_id', 'pegawais.nama as nama_pegawai', 'usahawans.namausahawan', 'usahawans.id as usahawan_id', 'lawatans.updated_at', 'lawatans.created_at', 'lawatans.status_lawatan', 'lawatans.tarikh_lawatan', 'lawatans.masa_lawatan')
            ->get();

        return response()->json($lawatan);
    }

    // public function updateLawatanUsahawan(Request $request, $id)
    // {
    //     $lawatan = Lawatan::find($id);

    //     $lawatan->tarikh_lawatan = $request->tarikh_lawatan;
    //     $lawatan->masa_lawatan = $request->masa_lawatan;
    //     $lawatan->status_lawatan = "pending_pegawai";

    //     $lawatan->save();

    //     return response()->json($lawatan);
    // }


    public function update(Request $request, Lawatan $lawatan)
    {
        $lawatan->tarikh_lawatan = $request->tarikh_lawatan;
        $lawatan->masa_lawatan = $request->masa_lawatan;
        $lawatan->status_lawatan = $request->status_lawatan;

        $lawatan->save();

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
            ->join('users', 'users.usahawanid', 'usahawans.id')
            ->select('users.id as id_pengguna', 'users.name')
            ->get();

        return response()->json($usahawan);
    }
}
