<?php

namespace App\Http\Controllers;

use App\Models\TindakanLawatan;
use Illuminate\Http\Request;

class TindakanLawatanController extends Controller
{
    
    public function index()
    {
        $tindakanLawatan = TindakanLawatan::all();

        return response()->json($tindakanLawatan);
    }

   
}
