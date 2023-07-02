<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Position;
use App\Models\Division;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            "title"     => "Register Account",
            "positions" => Position::orderBy('nama_jabatan', 'ASC')->get(),
            "divisions" => Division::orderBy('nama_divisi', 'ASC')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name'    => 'required|min:2|max:255',
            'last_name'     => 'required|min:2|max:255',
            'email'         => ['required', 'unique:users'],
            'password'      => 'required|min:5|max:255',
            'position_id'   => 'required',
            'division_id'   => 'required'
        ],
        [
            'first_name.required'   => 'Nama Depan Harus diisi!', 
            'first_name.min'        => 'Ketikkan Nama Depan minimal 2 digit!',
            'first_name.max'        => 'Ketikkan Nama Depan maksimal 255 digit!',
            'last_name.required'    => 'Nama Belakang harus diisi!', 
            'last_name.min'         => 'Ketikkan Nama Belakang minimal 2 digit!',
            'last_name.max'         => 'Ketikkan Nama Belakang maksimal 255 digit!',
            'email.required'        => 'Alamat Email harus diisi!', 
            'email'                 => 'Ketikkan Alamat Email yang valid!',
            'unique'                => 'Alamat Email telah digunakan!',
            'password.required'     => 'Password harus diisi!', 
            'password.min'          => 'Ketikkan Password minimal 5 digit!',
            'max'                   => 'Ketikkan maksimal 255 digit!',
            'position_id'           => 'Pilih Jabatan anda!',
            'division_id'           => 'Pilih Divisi anda!',
         ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/register')->with('success', 'Akun baru berhasil ditambahkan!');
    }
}
