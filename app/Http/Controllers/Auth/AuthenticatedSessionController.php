<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user != null){
            if($user->type == 1){
                // dd($user);
                // if($user->email_verified_at != null){
                    // dd($user->profile_status);
                    if($user->status_pengguna == 1){
                        $request->authenticate();
                        $request->session()->regenerate();
                        return redirect('/dash');
                    }else{
                        echo '<script language="javascript">';
                        echo 'alert("Akaun Tidak Aktif. Sila Minta Admin Aktifkan Akaun Anda Untuk Meneruskan ke Aplikasi");';
                        echo "window.location.href='/';";
                        echo '</script>';
                    }
                // }else{
                //     echo '<script language="javascript">';
                //     echo 'alert("Akaun Belum Aktif. Sila Aktifkan Akaun Untuk Meneruskan ke Applikasi");';
                //     echo "window.location.href='/';";
                //     echo '</script>';
                // }
            }else{
                echo '<script language="javascript">';
                echo 'alert("Sistem web hanyalah digunakan oleh pegawai sahaja");';
                echo "window.location.href='/';";
                echo '</script>';
            }
        }else{
            echo '<script language="javascript">';
            echo 'alert("Email tiada dalam senarai pegawai");';
            echo "window.location.href='/';";
            echo '</script>';
        }
        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
