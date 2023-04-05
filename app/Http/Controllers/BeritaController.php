<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Berita::all();
        return view('berita.index', [
            'berita' => $berita
        ]);
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
        $berita = new Berita();

        $berita->tarikh_berita = $request->tarikh_berita;
        $berita->tajuk_berita = $request->tajuk_berita;
        $berita->gambar_berita = $request->gambar_berita;
        $berita->keterangan_berita = $request->keterangan_berita;
        $berita->modifiedby = $request->modifiedby;
        $berita->save();

        return redirect('/berita');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        return view('berita.show', [
            'berita' => $berita
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $berita)
    {
        return view('berita.edit', [
            'berita' => $berita
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $berita)
    {
        $berita->tarikh_berita = $request->tarikh_berita;
        $berita->tajuk_berita = $request->tajuk_berita;
        $berita->gambar_berita = $request->gambar_berita;
        $berita->keterangan_berita = $request->keterangan_berita;
        $berita->modifiedby = $request->modifiedby;
        $berita->save();

        return redirect('/berita');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        //
    }
}
