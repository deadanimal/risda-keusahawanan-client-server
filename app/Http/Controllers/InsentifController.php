<?php

namespace App\Http\Controllers;

use App\Models\Insentif;
use App\Models\Usahawan;
use Illuminate\Http\Request;

class InsentifController extends Controller
{
    
    public function index()
    {
        $insentif = Insentif::all();
        return response()->json($insentif);
    }

    public function store(Request $request)
    {
        $insentif = new Insentif();

        $insentif->id_pengguna = $request->id_pengguna;
        $insentif->id_jenis_insentif = $request->id_jenis_insentif;
        $insentif->tahun_terima_insentif = $request->tahun_terima_insentif;
        $insentif->nilai_insentif = $request->nilai_insentif;
        $insentif->created_by = $request->created_by;
        $insentif->modified_by = $request->modified_by;

        $insentif->save();

        return redirect('/insentif');
    }

   
    public function show($id)
    {

        $insentif = Insentif::where('id_pengguna', $id)
        ->join('jenis_insentifs', 'jenis_insentifs.id_jenis_insentif', 'insentifs.id_jenis_insentif')
        ->get();

        // dd($insentif);

        return response()->json($insentif);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Insentif  $insentif
     * @return \Illuminate\Http\Response
     */
    public function edit(Insentif $insentif)
    {
        return view('insentif.edit', [
            'insentif' => $insentif
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Insentif  $insentif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insentif $insentif)
    {
        $insentif->id_pengguna = $request->id_pengguna;
        $insentif->id_jenis_insentif = $request->id_jenis_insentif;
        $insentif->tahun_terima_insentif = $request->tahun_terima_insentif;
        $insentif->nilai_insentif = $request->nilai_insentif;
        $insentif->created_by = $request->created_by;
        $insentif->modified_by = $request->modified_by;

        $insentif->save();

        return redirect('/insentif');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Insentif  $insentif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insentif $insentif)
    {
        //
    }
}
