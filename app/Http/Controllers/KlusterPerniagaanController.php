<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKlusterPerniagaanRequest;
use App\Http\Requests\UpdateKlusterPerniagaanRequest;
use App\Models\KlusterPerniagaan;

class KlusterPerniagaanController extends Controller
{
    
    public function index()
    {
        $kluster = KlusterPerniagaan::all();

        return response()->json($kluster);
    }

   
}
