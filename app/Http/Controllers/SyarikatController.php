<?php

namespace App\Http\Controllers;

use App\Models\Syarikat;
use App\Models\Usahawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SyarikatController extends Controller
{
    
    public function index()
    {
        $syarikat = Syarikat::all();
        
        return response()->json($syarikat);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request);
        $syarikat = new Syarikat();

        // if ($request->logo_syarikat) {
        //     $image = $request->logo_syarikat; // your base64 encoded
        //     $ext = explode(';base64', $image);
        //     $ext = explode('/', $ext[0]);
        //     $ext = $ext[1];
    
        //     $image = str_replace('data:image/' . $ext . ';base64,', '', $image);
        //     $image = str_replace(' ', '+', $image);
        //     $imageName = $id . '.' . $ext;
        //     if ($ext != null) {
        //         $result = File::put(public_path() . '/storage/syarikat/' . $imageName, base64_decode($image));
        //         $syarikat->logo_syarikat = "https://reds-training.risda.gov.my/storage/syarikat/" . $imageName;
        //     }

        // }

        if ($request->hasFile('logo_syarikat')) {
            $url ="storage/".$request->logo_syarikat->store('/syarikat');
            $syarikat->logo_syarikat = $url;
        }

        $syarikat->usahawanid = $request->usahawanid;
        $syarikat->namasyarikat = $request->namasyarikat;
        $syarikat->jenismilikanperniagaan = $request->jenismilikanperniagaan;
        $syarikat->nodaftarssm = $request->nodaftarssm;
        $syarikat->nodaftarpbt = $request->nodaftarpbt;
        $syarikat->nodaftarpersijilanhalal = $request->nodaftarpersijilanhalal;
        $syarikat->nodaftarmesti = $request->nodaftarmesti;
        $syarikat->tahunmulaoperasi = $request->tahunmulaoperasi;
        $syarikat->bilanganpekerja = $request->bilanganpekerja;
        $syarikat->alamat1_ssm = $request->alamat1_ssm;
        $syarikat->alamat2_ssm = $request->alamat2_ssm;
        $syarikat->alamat3_ssm = $request->alamat3_ssm;
        $syarikat->tarikh_mula_mof = $request->tarikh_mula_mof;
        $syarikat->tarikh_tamat_mof = $request->tarikh_tamat_mof;
        $syarikat->status_bumiputera = $request->status_bumiputera;
        $syarikat->tarikh_daftar_ssm = $request->tarikh_daftar_ssm;
        $syarikat->notelefon = $request->notelefon;
        $syarikat->no_hp = $request->no_hp;
        $syarikat->email = $request->email;
        // $syarikat->logo_syarikat = $request->logo_syarikat;
        $syarikat->prefix_id = $request->prefix_id;
        $syarikat->createdby_id = $request->usahawanid;
        $syarikat->createdby_kod_PT = $request->Kod_PT;
        $syarikat->modifiedby_id = $request->usahawanid;
        $syarikat->modifiedby_kod_PT = $request->Kod_PT;

        $syarikat->save();

        // return redirect('/syarikat');
        return response()->json($syarikat);
    }

    public function show($id)
    {
        return Syarikat::where('usahawanid',$id)->first();
        $syarikat = Usahawan::where('usahawans.usahawanid', $id)
        ->join('syarikats', 'syarikats.usahawanid', 'usahawans.usahawanid')
        ->select(
            'syarikats.logo_syarikat', 
            'syarikats.namasyarikat', 
            'syarikats.jenismilikanperniagaan',
            'syarikats.nodaftarssm',
            'syarikats.nodaftarpbt',
            'syarikats.nodaftarpersijilanhalal',
            'syarikats.nodaftarmesti',
            'syarikats.tahunmulaoperasi',
            'syarikats.bilanganpekerja',
            'syarikats.alamat1_ssm',
            'syarikats.alamat2_ssm',
            'syarikats.alamat3_ssm',
            'syarikats.tarikh_mula_mof',
            'syarikats.tarikh_tamat_mof',
            'syarikats.status_bumiputera',
            'syarikats.prefix_id',
            'syarikats.nama_akaun_bank',
            'syarikats.no_akaun_bank',
            'syarikats.notelefon',
            'syarikats.no_hp',
            'syarikats.email',
            'syarikats.usahawanid as usahawanid',
            'syarikats.id as syarikat_id',
            'usahawans.Kod_PT',
            
            )
        ->first();
        return response()->json($syarikat);
    }

   
    public function update(Request $request, $id)
    {
        $syarikat = Syarikat::where('usahawanid', $id)->first();
        // $syarikat->usahawanid = $request->usahawanid;

        // if ($request->logo_syarikat) {
        //     $image = $request->logo_syarikat; // your base64 encoded
        //     $ext = explode(';base64', $image);
        //     $ext = explode('/', $ext[0]);
        //     $ext = $ext[1];
    
        //     $image = str_replace('data:image/' . $ext . ';base64,', '', $image);
        //     $image = str_replace(' ', '+', $image);
        //     $imageName = $id . '.' . $ext;
        //     if ($ext != null) {
        //         $result = File::put(public_path() . '/storage/syarikat/' . $imageName, base64_decode($image));
        //         $syarikat->logo_syarikat = "https://reds-training.risda.gov.my/storage/syarikat/" . $imageName;
        //     }
        // }
        if ($request->hasFile('logo_syarikat')) {
            if (File::exists(public_path($syarikat->logo_syarikat))) {
                File::delete(public_path($syarikat->logo_syarikat));
           }
           $url ="storage/".$request->logo_syarikat->store('/buletin');
           $syarikat->logo_syarikat = $url;
        }


        $syarikat->namasyarikat = $request->namasyarikat;
        $syarikat->jenismilikanperniagaan = $request->jenismilikanperniagaan;
        $syarikat->nodaftarssm = $request->nodaftarssm;
        $syarikat->nodaftarpbt = $request->nodaftarpbt;
        $syarikat->nodaftarpersijilanhalal = $request->nodaftarpersijilanhalal;
        $syarikat->nodaftarmesti = $request->nodaftarmesti;
        $syarikat->tahunmulaoperasi = $request->tahunmulaoperasi;
        $syarikat->bilanganpekerja = $request->bilanganpekerja;
        $syarikat->alamat1_ssm = $request->alamat1_ssm;
        $syarikat->alamat2_ssm = $request->alamat2_ssm;
        $syarikat->alamat3_ssm = $request->alamat3_ssm;
        $syarikat->tarikh_mula_mof = $request->tarikh_mula_mof;
        $syarikat->tarikh_tamat_mof = $request->tarikh_tamat_mof;
        $syarikat->status_bumiputera = $request->status_bumiputera;
        $syarikat->tarikh_daftar_ssm = $request->tarikh_daftar_ssm;
        $syarikat->notelefon = $request->notelefon;
        $syarikat->no_hp = $request->no_hp;
        $syarikat->email = $request->email;
        // $syarikat->logo_syarikat = $request->logo_syarikat;
        $syarikat->prefix_id = $request->prefix_id;

        $syarikat->nama_akaun_bank = $request->nama_akaun_bank;
        $syarikat->no_akaun_bank = $request->no_akaun_bank;

        // $syarikat->createdby_id = $request->createdby_id;
        // $syarikat->createdby_kod_PT = $request->createdby_kod_PT;
        $syarikat->modifiedby_id = $request->usahawanid;
        $syarikat->modifiedby_kod_PT = $request->Kod_PT;

        $syarikat->save();

        return response()->json($syarikat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Syarikat  $syarikat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Syarikat $syarikat)
    {
        $syarikat->delete();
        return 'berjaya';
    }
}
