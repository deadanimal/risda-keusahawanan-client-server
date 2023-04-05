<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    
    public function index()
    {
        $pegawai = Pegawai::without(['user', 'Mukim','PT','Negeri'] )
        ->get();

        // dd($pegawai);
        return response()->json($pegawai);
    }

    public function store(Request $request)
    {
        $pegawai = new Pegawai();

        $pegawai->nokp = $request->nokp;
        $pegawai->nama=$request->nama;
        $pegawai->nopekerja=$request->nopekerja;
        $pegawai->GelaranJwtn=$request->GelaranJwtn;
        $pegawai->NamaPT=$request->NamaPT;
        $pegawai->NamaPA=$request->NamaPA;
        $pegawai->NamaUnit=$request->NamaUnit;
        $pegawai->Jawatan=$request->Jawatan;
        $pegawai->StesenBertugas=$request->StesenBertugas;
        $pegawai->email=$request->email;
        $pegawai->notel=$request->notel;
        $pegawai->mukim=$request->mukim;
        $pegawai->peranan_pegawai=$request->peranan_pegawai;

        $pegawai->save();

        return redirect('/pegawai');
    }


    public function show($id)
    {
        $pegawai = Pegawai::without(['Mukim','Negeri'] )
        ->where('id', $id)
        ->get();

        return response()->json($pegawai);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', [
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {

        // dd($request);
        $pegawai->nokp = $request->nokp;
        $pegawai->nama=$request->nama;
        $pegawai->nopekerja=$request->nopekerja;
        $pegawai->GelaranJwtn=$request->GelaranJwtn;
        $pegawai->NamaPT=$request->NamaPT;
        $pegawai->NamaPA=$request->NamaPA;
        $pegawai->NamaUnit=$request->NamaUnit;
        $pegawai->Jawatan=$request->Jawatan;
        $pegawai->StesenBertugas=$request->StesenBertugas;
        $pegawai->email=$request->email;
        $pegawai->notel=$request->notel;
        $pegawai->mukim=$request->mukim;
        $pegawai->peranan_pegawai=$request->peranan_pegawai;

        $pegawai->save();

        return redirect('/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
