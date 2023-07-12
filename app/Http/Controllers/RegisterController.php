<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Position;
use App\Models\Division;
use App\Models\Employee;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            "title"     => "Register Account",
            // Sending data from position and division table to register view with Ascending data sorted
            "positions" => Position::orderBy('position_name', 'ASC')->get(),
            "divisions" => Division::orderBy('division_name', 'ASC')->get(),
        ]);
    }

    public function store(Request $request)
    {
        // Validating data request from register.index
        $validatedData = $request->validate([
            'first_name'    => 'required|min:2|max:255',
            'last_name'     => 'required|min:2|max:255',
            'nik'           => ['required', 'unique:users'],
            'password'      => 'required|min:5|max:255',
            'position_id'   => 'required',
            'division_id'   => 'required'
        ],
        // Create custom notification for the validation request
        [
            'first_name.required'   => 'Nama Depan Harus diisi!', 
            'first_name.min'        => 'Ketikkan Nama Depan minimal 2 digit!',
            'first_name.max'        => 'Ketikkan Nama Depan maksimal 255 digit!',
            'last_name.required'    => 'Nama Belakang harus diisi!', 
            'last_name.min'         => 'Ketikkan Nama Belakang minimal 2 digit!',
            'last_name.max'         => 'Ketikkan Nama Belakang maksimal 255 digit!',
            'nik.required'          => 'Nomor Induk Karyawan harus diisi!', 
            'unique'                => 'Nomor Induk Karyawan telah digunakan!',
            'password.required'     => 'Password harus diisi!', 
            'password.min'          => 'Ketikkan Password minimal 5 digit!',
            'max'                   => 'Ketikkan maksimal 255 digit!',
            'position_id'           => 'Pilih Jabatan anda!',
            'division_id'           => 'Pilih Divisi anda!',
        ]);

        // Encrypt Password
        $validatedData['password'] = Hash::make($validatedData['password']);
        // Saving data to users table
        User::create($validatedData);

        $employee_name = $request['first_name'].' '.$request['last_name'];

        // Saving data to costs table too
        $cost                   = new Employee;
        $cost->nik              = $request['nik'];
        $cost->employee_name    = $employee_name;
        $cost->position_id      = $request['position_id'];
        $cost->cost_id          = $request['division_id'];
        $cost->company          = "PT. MAULANA SUKSES SELALU";
        $cost->save();

        // Redirect to the register view if create data succeded
        $first_name = strtoupper($request['first_name']);
        return redirect('/register')->with('success', 'User '.$first_name.' berhasil di daftarkan!');
    }
}
