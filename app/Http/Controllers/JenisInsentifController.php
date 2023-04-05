<?php

namespace App\Http\Controllers;

use App\Models\JenisInsentif;
use Illuminate\Http\Request;

class JenisInsentifController extends Controller
{
    
    public function index()
    {
        $jenis_Insentif = JenisInsentif::all();
        
        return response()->json($jenis_Insentif);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jenis_Insentif = new JenisInsentif();

        $jenis_Insentif->nama_insentif = $request->nama_insentif ;
        $jenis_Insentif->status = $request->status ;

        $jenis_Insentif->save();

        return redirect('/jenis_insentif');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisInsentif  $jenis_Insentif
     * @return \Illuminate\Http\Response
     */
    public function show(JenisInsentif $jenis_Insentif)
    {
        return view('jenis_Insentif.show', [
            'jenis_Insentif' => $jenis_Insentif
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisInsentif  $jenis_Insentif
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisInsentif $jenis_Insentif)
    {
        return view('jenis_Insentif.edit', [
            'jenis_Insentif' => $jenis_Insentif
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisInsentif  $jenis_Insentif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisInsentif $jenis_Insentif)
    {
        $jenis_Insentif->nama_insentif = $request->nama_insentif ;
        $jenis_Insentif->status = $request->status ;

        $jenis_Insentif->save();

        return redirect('/jenis_insentif');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisInsentif  $jenis_Insentif
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisInsentif $jenis_Insentif)
    {
        //
    }
}
