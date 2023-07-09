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
        // Access employee view
        return view('employee.create', [
            "title"     => "Tambah Data Karyawan",
            "path"      => "Data Karyawan",
            "path2"     => "Tambah",
            "employees" => Employee::all(),
            "positions" => Position::orderBy('position_name', 'ASC')->get(),
            "costs"     => Cost::orderBy('cost_name', 'ASC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validating data request from employee.create
        $validatedData = $request->validate([
            'nik'               => 'required|min:5|max:255|unique:employees',
            'employee_name'     => 'required|min:2|max:255',
            'employee_position' => 'required',
            'employee_location' => 'required',
            'company'           => 'required'
        ],
        // Create custom notification for the validation request
        [
            'nik.required'                  => 'NIK harus diisi!',
            'nik.min'                       => 'Ketik minimal 2 digit!',
            'nik.max'                       => 'Ketik maksimal 255 digit!',
            'unique'                        => 'NIK sudah ada!',
            'employee_name.required'        => 'Nama Karyawan harus diisi!',
            'employee_name.min'             => 'Ketik minimal 2 digit!',
            'employee_name.max'             => 'Ketik maksimal 255 digit!',
            'employe_position.required'     => 'Jabatan harus dipilih!',
            'employee_location.required'    => 'Cabang/Divisi harus dipilih!'
        ]);
        // Saving data to employees table
        Employee::create($validatedData);

        // Redirect to the employee view if create data succeded
        $employe_name = strtoupper($request['employee_name']);
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
