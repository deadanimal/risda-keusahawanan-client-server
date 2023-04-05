<?php

namespace App\Http\Controllers;

use App\Models\Pekebun;
use Illuminate\Http\Request;

class PekebunController extends Controller
{

    public function index()
    {
        $pekebun = Pekebun::all();
        // return view('pekebun.index', [
        //     'pekebun' => $pekebun
        // ]);
        return response()->json($pekebun);
    }


    public function store(Request $request)
    {
        $pekebun = new Pekebun();

        $pekebun->usahawanid = $request->usahawanid;
        $pekebun->status_daftar_usahawan = $request->status_daftar_usahawan;
        $pekebun->Nama_PK = $request->Nama_PK;
        $pekebun->No_KP = $request->No_KP;
        // $pekebun->noTS = $request->noTS;
        // $pekebun->No_Geran = $request->No_Geran;
        // $pekebun->No_Lot = $request->No_Lot;
        // $pekebun->U_Negeri_ID = $request->U_Negeri_ID;
        // $pekebun->U_Daerah_ID = $request->U_Daerah_ID;
        // $pekebun->U_Mukim_ID = $request->U_Mukim_ID;
        // $pekebun->U_Parlimen_ID = $request->U_Parlimen_ID;
        // $pekebun->U_Dun_ID = $request->U_Dun_ID;
        // $pekebun->U_Kampung_ID = $request->U_Kampung_ID;
        // $pekebun->U_Seksyen_ID = $request->U_Seksyen_ID;
        // $pekebun->keluasan_hektar = $request->keluasan_hektar;
        // $pekebun->jenis_tanaman_kebun = $request->jenis_tanaman_kebun;

        $pekebun->save();

        return response()->json($pekebun);
    }


    public function show($id)
    {
        $pekebun = Pekebun::where('usahawanid', $id)->get()->first();
        return response()->json($pekebun);
    }


    public function update(Request $request, Pekebun $pekebun)
    {
        // $pekebun->usahawanid =$request->usahawanid;
        $pekebun->Nama_PK = $request->Nama_PK;
        $pekebun->No_KP = $request->No_KP;
        $pekebun->noTS = $request->noTS;

        $pekebun->save();

        // return redirect('/pekebun');
        return response()->json($pekebun);
    }

    public function getPekebunEspek($nokp)
    {


        // dd($nokp);
        $client = new \GuzzleHttp\Client();

        try {
            $request = $client->request('GET', 'https://www4.risda.gov.my/espek/portalpkprofiltanah/?nokp=' . $nokp . '', [
                'auth' => ['99891c082ecccfe91d99a59845095f9c47c4d14e', '1cc11a9fec81dc1f99f353f403d6f5bac620aa8f']
            ]);

            // dd($request);
            $response = $request->getBody()->getContents();
            $vals = json_decode($response);


            return response()->json($vals);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json('400');
        }
    }



    public function getNoTS($nokp)
    {

        // dd($nokp);
        $client = new \GuzzleHttp\Client();
        try {

            $request = $client->request('GET', 'https://www4.risda.gov.my/fire/getnots/?nokp=' . $nokp . '', [
                'auth' => ['99891c082ecccfe91d99a59845095f9c47c4d14e', '3b22692be6da322303c98c1541a74f596458d80e']
            ]);
            $response = $request->getBody()->getContents();
            $vals = json_decode($response);
            // dd($vals);

            return response()->json($vals);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json('400');
        }
    }

    public function destroy(Pekebun $pekebun)
    {
        $pekebun->delete();
        return 'berjaya';
    }
}
