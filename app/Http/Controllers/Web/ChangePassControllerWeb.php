<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;

use App\Models\User;
use App\Models\Pegawai;

class ChangePassControllerWeb extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        return view('ChangePass'
        ,[
            'user'=>$authuser
        ]
        );
    }

    public function store(Request $request)
    {
        $authuser = Auth::user();
        if(!isset($authuser)){
            return redirect('/landing');
        }
        $request->validate([
            'email' => ['required'],
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        $check = Hash::check($request->current_password, auth()->user()->password);
        if($check == false){
            echo '<script language="javascript">';
            echo 'alert("Kata Laluan Lama Tidak Tepat");';
            echo "window.location.href = '/ChangePass';";
            echo '</script>';
        }else{
            $pass = Hash::make($request->new_password);
            $user = User::where('id', $authuser->id)->first();
            $pegawai = Pegawai::where('id', $user->idpegawai)->first();

            $user->email = $request->email;
            $user->password = $pass;
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            $pegawai->email = $request->email;
            $pegawai->save();
            
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            echo '<script language="javascript">';
            echo 'alert("Kemaskini Akaun Berjaya");';
            echo "window.location.href = '/landing';";
            echo '</script>';

            // $maildata = [
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'password' => $defpassword
            // ];
            // Mail::to($request->email)->send(new \App\Mail\ForgotPassword($maildata));
        }
    }

}
