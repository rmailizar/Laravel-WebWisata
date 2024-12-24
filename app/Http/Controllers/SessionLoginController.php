<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SessionLoginController extends Controller
{
    public function form(){
        return view('auth.login');
    }

    public function login_proses(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            return redirect()->route('visitors.index');
        } else{
            return redirect()->route('login')->with('failed', 'Email atau Password salah!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu Berhasil Logout!');
    }
}
