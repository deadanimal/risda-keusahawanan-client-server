<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pegawai;

class PengurusanPenggunaController extends Controller
{
    

    public function tetapanStatus(Request $request){

        $id = $request->id;
        $user  = User::find($id);

        $user->status_pengguna = $request->status_pengguna;

        $user->save();


        // $pegawai = Pegawai::
    }
}
