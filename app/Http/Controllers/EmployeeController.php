<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Cost;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', [
            "title"     => "Data Karyawan",
            "path"      => "Data Karyawan",
            "employees" => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hitung  = Employee::count();
        $hitung1 = $hitung+1;
        $count   = sprintf("%05d", $hitung1);

        return view('employee.create', [
            "title"     => "Tambah Data Karyawan",
            "path"      => "Data Karyawan",
            "path2"     => "Tambah",
            "employees" => Employee::all(),
            "positions" => Position::orderBy('nama_jabatan', 'ASC')->get(),
            "costs"     => Cost::orderBy('cost_name', 'ASC')->get(),
            "count"     => $count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik'           => 'required|unique:employees',
            'employee_name' => 'required|min:2|max:255',
            'position_id'   => 'required',
            'cost_id'       => 'required'
        ],
        [
            'nik.required'              => 'NIK harus diisi!',
            'unique'                    => 'NIK sudah ada!',
            'employee_name.required'    => 'Nama Karyawan harus diisi!',
            'employee_name.min'         => 'Ketik minimal 2 digit!',
            'employee_name.max'         => 'Ketik maksimal 255 digit!',
            'position_id.required'      => 'Jabatan harus dipilih!',
            'cost_id.rquired'           => 'Cabang/Divisi harus dipilih!',
        ]);

        $employe_name = strtoupper($request['employee_name']);
        Employee::create($validatedData);
        return redirect('/employees')->with('success', $employe_name.' berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        Employee::destroy($employee->id);
        return redirect('/employees')->with('success', strtoupper($employee->employee_name).' berhasil dihapus!');
    }
}
