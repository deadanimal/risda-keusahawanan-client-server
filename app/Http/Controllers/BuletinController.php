<?php

namespace App\Http\Controllers;

use App\Models\Buletin;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BuletinController extends Controller
{

    public function index()
    {
        $buletin = Buletin::orderBy('updated_at', 'desc')->get();
        return response()->json($buletin);
    }

    public function store(Request $request)
    {
     
        $buletin = new Buletin();

        if ($request->hasFile('gambar_buletin')) {
            $url ="storage/".$request->gambar_buletin->store('/buletin');
            $buletin->gambar_buletin = $url;
        }

        $buletin->id_pegawai = $request->id_pegawai;
        $buletin->tajuk = $request->tajuk;
        $buletin->tarikh = $request->tarikh;
        $buletin->keterangan_lain = $request->keterangan_lain;
        $buletin->status = $request->status;
        // $buletin->gambar_buletin = $request->gambar_buletin;
        $buletin->url = $request->url;
      

        $buletin->save();

        // $image = $request->gambar_buletin; // your base64 encoded
        // $ext = explode(';base64', $image);
        // $ext = explode('/', $ext[0]);
        // $ext = $ext[1];
        // $image = str_replace('data:image/' . $ext . ';base64,', '', $image);
        // $image = str_replace(' ', '+', $image);
        // $imageName = $buletin->id . '.' . $ext;
        // File::put(public_path() . '/storage/buletin/' . $imageName, base64_decode($image));

        // $url = url("/storage/buletin/".$imageName);
        // $buletin->update([
        //     'gambar_buletin'=> $url,
        // ]);

        return response()->json($buletin);
    }

    public function show($id)
    {
        $buletin = Buletin::where('id_pegawai', $id)->get();
        return response()->json($buletin);
    }

    public function update(Request $request, Buletin $buletin)
    {
        if ($request->hasFile('gambar_buletin')) {
            if (File::exists(public_path($buletin->gambar_buletin))) {
                File::delete(public_path($buletin->gambar_buletin));
           }
           $url ="storage/".$request->gambar_buletin->store('/buletin');
           $buletin->gambar_buletin = $url;
        }

        $buletin->tajuk = $request->tajuk;
        $buletin->tarikh = $request->tarikh;
        $buletin->keterangan_lain = $request->keterangan_lain;
        $buletin->status = $request->status;
        // $buletin->url = $request->url;
        // $buletin->url = "/images/buletin/" . $imageName;
        // $buletin->gambar_buletin = $request->gambar_buletin;

        $buletin->save();

        return response()->json($buletin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buletin  $buletin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buletin $buletin)
    {
        $buletin->delete();
        return 'deleted';
    }

}
