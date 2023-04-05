<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NegeriController extends Controller
{
    public function index()
    {
        $negeri = DB::table('negeris')->get();

        // dd($daerah);
        return response()->json($negeri);
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
