<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            "title" => "Login Account"
        ]);
    }

    public function authenticate(Request $request)
    {
        // Validating data request from login.index
        $credentials = $request->validate([
            'nik'       => ['required'],
            'password'  => ['required'],
        ],
        // Create custom notification for the validation request
        [
            'email.required'    => 'Nomor Induk Karyawan harus diisi!',
            'password.required' => 'Password harus diisi!'
         ]);
 
        // Login Attempt
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            // Redirect to the dashboard view if login succeded
            return redirect()->intended('/dashboard');
        }
 
        // Back to the login view if login failed
        return back()->with('loginError', 'Nomor Induk atau Password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
