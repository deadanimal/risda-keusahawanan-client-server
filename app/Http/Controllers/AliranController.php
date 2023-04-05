<?php

namespace App\Http\Controllers;

use App\Models\Aliran;
use App\Models\KategoriAliran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AliranController extends Controller
{
    public function index(Request $request)
    {
        $aliran = Aliran::orderBy('created_at', 'desc')
        ->whereMonth('tarikh_aliran', Carbon::now()->month)
        ->get();
        
        // $user = $request->user();

        // $aliran = Aliran::where('id_pengguna', $request->id)->get();
        
        return response()->json($aliran);
    }

    
    public function store(Request $request)
    {
        $aliran = new Aliran();

        $aliran->id_pengguna = $request->id_pengguna;
        $aliran->id_kategori_aliran = $request->id_kategori_aliran;
        $aliran->tarikh_aliran = $request->tarikh_aliran;
        $aliran->keterangan_aliran = $request->keterangan_aliran;
        $aliran->jumlah_aliran = $request->jumlah_aliran;
        $aliran->nama_dokumen = $request->nama_dokumen;

        $kategoriAliran = KategoriAliran::find($request->id_kategori_aliran);

        $aliran->kategori_aliran = $kategoriAliran->nama_kategori_aliran;

        
        
        $aliran->modified_by = $request->id_pengguna;
        $aliran->save();

        return response()->json($aliran);
    }

    public function uploadDoc(Request $request, $id){

        $aliran = Aliran::find($id);
        // dd($request);
        if ($request->hasFile('dokumen_lampiran')) {
            $dokumen_lampiran = $request->file('dokumen_lampiran')->store('dokumen_lampiran');
            $aliran->dokumen_lampiran =  $dokumen_lampiran;
            $aliran->save();
        } else {
            return response()->json("failed");
        }

        return response()->json($aliran);

    }

   
    public function show($id)
    {
        $aliran = Aliran::where('id_pengguna', $id)
        ->whereMonth('tarikh_aliran', Carbon::now()->month)
        ->orderBy('tarikh_aliran', 'desc')->get();

        return response()->json($aliran);
    }

    public function update(Request $request, Aliran $aliran)
    {
        $aliran->id_pengguna = $request->id_pengguna;
        $aliran->id_kategori_aliran = $request->id_kategori_aliran;
        $aliran->tarikh_aliran = $request->tarikh_aliran;
        $aliran->keterangan_aliran = $request->keterangan_aliran;
        $aliran->jumlah_aliran = $request->jumlah_aliran;
        $aliran->nama_dokumen = $request->nama_dokumen;

        $kategoriAliran = KategoriAliran::find($request->id_kategori_aliran);

        $aliran->kategori_aliran = $kategoriAliran->nama_kategori_aliran;
        
        $aliran->modified_by = $request->id_pengguna;
        $aliran->save();

        return response()->json($aliran);
    }

    
    public function destroy(Aliran $aliran)
    {
        $aliran->delete();

        return response()->json($aliran);
    }

    public function getCurrentYearData($id){

        // $aliran = Aliran::where('id_pengguna', $id)
        // ->where('id_kategori_aliran', 1)
        // ->whereBetween('tarikh_aliran', [
        //     Carbon::now()->startOfYear(),
        //     Carbon::now()->endOfYear(),
        // ])
        // ->orderBy('tarikh_aliran', 'desc')->get();

        $aliran = Aliran::where('id_pengguna', $id)
        ->where('id_kategori_aliran', 1)
        ->whereYear('tarikh_aliran', date('Y', strtotime('-1 year')))
        ->orderBy('tarikh_aliran', 'desc')->get();

        $total = 0;

        // dd($aliran);

        foreach($aliran as $x){
            $total += $x->jumlah_aliran;

        }
        // dd($total);

        return response()->json($total);

    }

    public function getCurrentMonthData($id){

       // dd(Carbon::now()->month);
        $aliran = Aliran::where('id_pengguna', $id)
        ->where('id_kategori_aliran', 1)
        ->whereMonth('tarikh_aliran', Carbon::now()->month)
        ->orderBy('tarikh_aliran', 'desc')->get();
        $total = 0;

        foreach($aliran as $x){
            $total += $x->jumlah_aliran;

        }
        // dd($total);
        return response()->json($total);

    }
}
