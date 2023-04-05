<?php

namespace App\Http\Controllers;

use App\Models\Perniagaan;
use App\Models\Usahawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PerniagaanController extends Controller
{
    
    public function index()
    {
        $perniagaan = Perniagaan::all();
        return response()->json($perniagaan);
    }

   
    public function store(Request $request)
    {
        $perniagaan = new Perniagaan();

        if ($request->hasFile('gambar_url')) {
            $url ="storage/".$request->gambar_url->store('/perniagaan');
           $perniagaan->gambar_url = $url;
        }
        $perniagaan->usahawanid = $request->usahawanid;
        $perniagaan->jenisperniagaan = $request->jenisperniagaan;
        $perniagaan->klusterperniagaan = $request->klusterperniagaan;
        $perniagaan->subkluster = $request->subkluster;
        $perniagaan->alamat1 = $request->alamat1;
        $perniagaan->alamat2 = $request->alamat2;
        $perniagaan->alamat3 = $request->alamat3;
        $perniagaan->bandar = $request->bandar;
        $perniagaan->poskod = $request->poskod;
        $perniagaan->U_Negeri_ID = $request->U_Negeri_ID;
        $perniagaan->U_Daerah_ID = $request->U_Daerah_ID;
        $perniagaan->U_Mukim_ID = $request->U_Mukim_ID;
        $perniagaan->U_Parlimen_ID = $request->U_Parlimen_ID;
        $perniagaan->U_Dun_ID = $request->U_Dun_ID;
        $perniagaan->U_Kampung_ID = $request->U_Kampung_ID;
        $perniagaan->U_Seksyen_ID = $request->U_Seksyen_ID;
        $perniagaan->latitud = $request->latitud;
        $perniagaan->logitud = $request->logitud;
        $perniagaan->facebook = $request->facebook;
        $perniagaan->instagram = $request->instagram;
        $perniagaan->twitter = $request->twitter;
        $perniagaan->lamanweb = $request->lamanweb;
        $perniagaan->dropship = $request->dropship;
        $perniagaan->ejen = $request->ejen;
        $perniagaan->stokis = $request->stokis;
        $perniagaan->outlet = $request->outlet;
        $perniagaan->domestik = $request->domestik;
        $perniagaan->luarnegara = $request->luarnegara;
        $perniagaan->pasaranonline = $request->pasaranonline;
        $perniagaan->purata_jualan_bulanan = $request->purata_jualan_bulanan;
        $perniagaan->peratus_kenaikan = $request->peratus_kenaikan;
        $perniagaan->hasil_jualan_tahunan = $request->hasil_jualan_tahunan;
        // $perniagaan->gambar_url = $request->gambar_url;
        $perniagaan->createdby_id = $request->createdby_id;
        $perniagaan->createdby_kod_PT = $request->createdby_kod_PT;
        $perniagaan->modifiedby_id = $request->modifiedby_id;
        $perniagaan->modifiedby_kod_PT = $request->modifiedby_kod_PT;

        $perniagaan->save();

        // return redirect('/perniagaan');
        return response()->json($perniagaan);
    }

   
    public function show($id)
    {
        $perniagaan = Usahawan::where('usahawans.usahawanid', $id)
        ->join('perniagaans', 'perniagaans.usahawanid', 'usahawans.usahawanid')
        ->first();
        return response()->json($perniagaan);
    }

    
    public function edit(Perniagaan $perniagaan)
    {
        return view('perniagaan.edit', [
            'perniagaan' => $perniagaan
        ]);
    }

    public function update(Request $request, $id)
    {
        $perniagaan = Perniagaan::where('usahawanid', $id)->first();
        if ($request->hasFile('gambar_url')) {
            if (File::exists(public_path($perniagaan->gambar_url))) {
                File::delete(public_path($perniagaan->gambar_url));
           }
            $url ="storage/".$request->gambar_url->store('/katalog');
            $perniagaan->gambar_url = $url;
        }
        // $perniagaan->usahawanid = $request->usahawanid;
        $perniagaan->jenisperniagaan = $request->jenisperniagaan;
        $perniagaan->klusterperniagaan = $request->klusterperniagaan;
        $perniagaan->subkluster = $request->subkluster;
        $perniagaan->alamat1 = $request->alamat1;
        $perniagaan->alamat2 = $request->alamat2;
        $perniagaan->alamat3 = $request->alamat3;
        $perniagaan->bandar = $request->bandar;
        $perniagaan->poskod = $request->poskod;
        $perniagaan->U_Negeri_ID = $request->U_Negeri_ID;
        $perniagaan->U_Daerah_ID = $request->U_Daerah_ID;
        $perniagaan->U_Mukim_ID = $request->U_Mukim_ID;
        $perniagaan->U_Parlimen_ID = $request->U_Parlimen_ID;
        $perniagaan->U_Dun_ID = $request->U_Dun_ID;
        $perniagaan->U_Kampung_ID = $request->U_Kampung_ID;
        $perniagaan->U_Seksyen_ID = $request->U_Seksyen_ID;
        $perniagaan->latitud = $request->latitud;
        $perniagaan->logitud = $request->logitud;
        $perniagaan->facebook = $request->facebook;
        $perniagaan->instagram = $request->instagram;
        $perniagaan->twitter = $request->twitter;
        $perniagaan->lamanweb = $request->lamanweb;
        $perniagaan->dropship = $request->dropship;
        $perniagaan->ejen = $request->ejen;
        $perniagaan->stokis = $request->stokis;
        $perniagaan->outlet = $request->outlet;
        $perniagaan->domestik = $request->domestik;
        $perniagaan->luarnegara = $request->luarnegara;
        $perniagaan->pasaranonline = $request->pasaranonline;
        $perniagaan->purata_jualan_bulanan = $request->purata_jualan_bulanan;
        $perniagaan->peratus_kenaikan = $request->peratus_kenaikan;
        $perniagaan->hasil_jualan_tahunan = $request->hasil_jualan_tahunan;

        $perniagaan->save();

       
        return response()->json($perniagaan);
    }


  
    public function destroy(Perniagaan $perniagaan)
    {
        if (File::exists(public_path($perniagaan->gambar_url))) {
            File::delete(public_path($perniagaan->gambar_url));
        }
        $r = $perniagaan->delete();
        return $r;
    }
}
