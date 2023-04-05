<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NotifikasiController extends Controller
{
    
    public function index()
    {
        $notifikasi = Notifikasi::all();

        return response()->json($notifikasi);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $notifikasi = Notifikasi::where('userid', $id)
        ->whereMonth('created_at', Carbon::now()->month)
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($notifikasi);
    }

    public function updateStatus($id){

        $notifikasi = Notifikasi::find($id);

        $notifikasi->readstatus = 1;
        $notifikasi->save();

        return response()->json($notifikasi);

    }

   
}
