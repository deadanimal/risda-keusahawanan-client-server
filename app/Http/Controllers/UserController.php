<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Config\Exception\ValidationException;

class UserController extends Controller
{
    
    public function index()
    {
        $user = User::all();

        return response()->json($user);
    }

   
    public function store(Request $request)
    {
        $user = User::where('no_kp', $request->no_kp)->get()->first();

        
        if (!$user || !Hash::check($request->password, $user->password)) {
            // throw ValidationException::withMessages([
            //     'no_kp' => ['The provided credentials are incorrect.'],
            // ]);
            return response()->json();

            
        }
        return response()->json($user);

        // $token = $request->user()->createToken($request->token_name);

        // return ['token' => $token->plainTextToken];
    }

   
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }

    public function checkUser(Request $request)
    {
        $user = User::where('no_kp', $request->no_kp)->get()->first();

        if ($user != null) {
            return response()->json("success");
        } else {
            return response()->json("failed");
        }
    }
}
