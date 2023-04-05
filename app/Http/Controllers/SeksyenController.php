<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SeksyenController extends Controller
{
    public function index()
    {
        $seksyen = DB::table('seksyens')->get();

        // dd($daerah);
        return response()->json($seksyen);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
