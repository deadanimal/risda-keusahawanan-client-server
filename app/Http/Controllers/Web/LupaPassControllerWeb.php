<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\LupaPassword;

use App\Models\User;
use App\Models\Pegawai;

class LupaPassControllerWeb extends Controller
{
    public function index()
    {
        // $authuser = Auth::user();
        // if(!isset($authuser)){
        //     return redirect('/landing');
        // }
        return view('LupaPass');
    }

    public function store(Request $request)
    {
        // $authuser = Auth::user();
        // if(!isset($authuser)){
        //     return redirect('/landing');
        // }
        $request->validate([
            'email' => ['required'],
            // 'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        $user = User::where('email', $request->email)->first();
        if(!isset($user)){
            echo '<script language="javascript">';
            echo 'alert("Email Tiada Dalam Pengkalan Data");';
            echo "window.location.href = '/LupaPass';";
            echo '</script>';
        }

        $pass = Hash::make($request->new_password);
        
        $pegawai = Pegawai::where('id', $user->idpegawai)->first();

        $user->email = $request->email;
        $user->password = $pass;
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        $pegawai->email = $request->email;
        $pegawai->save();

        $maildata = [
            'name' => $user->name,
            'email' => $request->email,
            'password' => $request->new_password
        ];
        Mail::to($request->email)->send(new \App\Mail\LupaPassword($maildata));

        echo '<script language="javascript">';
        echo 'alert("Kemaskini Akaun Berjaya");';
        echo "window.location.href = '/landing';";
        echo '</script>';
    }

}
