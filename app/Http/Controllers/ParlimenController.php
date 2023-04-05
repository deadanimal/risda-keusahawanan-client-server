<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParlimenController extends Controller
{
    public function index()
    {
        $mukim = DB::table('parlimens')->get();

        // dd($daerah);
        return response()->json($mukim);
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
