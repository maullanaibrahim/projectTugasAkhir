<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            "title" => "Form Login"
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
            return redirect()->intended('/dashboard'.encrypt(auth()->user()->division->division_name).'-'.encrypt(auth()->user()->position->position_name) );
        }
 
        // Back to the login view if login failed
        return back()->with('loginError', 'No. Induk Karyawan atau Password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
