<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!auth()->attempt($credentials)){
            return response()->json(['message' => 'Credentials are not valid'], 401);
        }

        $user = auth()->user();

        return response()->json([
            'token' => $user->createToken('apitodus')->plainTextToken
        ]);
    }
}
