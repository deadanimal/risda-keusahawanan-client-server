<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use Illuminate\Support\Facades\DB;

class DaerahController extends Controller
{
    public function index()
    {
        $daerah = DB::table('daerahs')->get();

        // dd($daerah);
        return response()->json($daerah);
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
