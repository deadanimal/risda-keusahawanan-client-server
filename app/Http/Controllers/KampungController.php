<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KampungController extends Controller
{
    public function index()
    {
        $kampung = DB::table('kampungs')->get();

        // dd($daerah);
        return response()->json($kampung);
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
