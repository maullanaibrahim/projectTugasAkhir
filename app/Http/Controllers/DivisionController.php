<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Cost;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::all();
        return view('division.index', [
            "title"     => "Data Divisi",
            "path"      => "Data Divisi",
            "divisions" => $divisions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('division.create', [
            "title"     => "Tambah Data Divisi",
            "path"      => "Data Divisi",
            "path2"     => "Tambah",
            "divisions" => Division::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validating data request from division.create
        $validatedData = $request->validate([
            'division_name' => 'required|min:5|unique:divisions',
            'location'      => 'required',
            'address'       => 'required|min:10|max:255',
        ],
        // Create custom notification for the validation request
        [
            'division_name.required'    => 'Nama Divisi harus diisi!', 
            'division_name.min'         => 'Ketikkan Nama Divisi minimal 5 huruf!',
            'unique'                    => 'Nama Divisi sudah ada!',
            'location.required'         => 'Lokasi harus diisi!',
            'address.required'          => 'Alamat harus diisi!',
            'address.min'               => 'Ketikkan Alamat minimal 10 huruf!',
            'address.max'               => 'Ketikkan Alamat maksimal 255 huruf!',
        ]);
        // Saving data to branches table
        Division::create($validatedData);

        // Saving data to costs table too
        $cost               = new Cost;
        $cost->cost_name    = $request['division_name'];
        $cost->region       = $request['location'];
        $cost->company_name = "PT. MAULANA SUKSES SELALU";
        $cost->save();

        // Redirect to the division view if create data succeded
        $division_name = strtoupper($request['division_name']);
        return redirect('/divisions')->with('success', 'Divisi '.$division_name.' berhasil ditambahkan!');
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
    public function edit(Division $division)
    {
        return view('division.edit', [
            "title"     => "Edit Data Divisi",
            "path"      => "Data Divisi",
            "path2"     => "Edit",
            "division"    => $division
        ]);
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
    public function destroy(Division $division)
    {
        $cost = Cost::where('cost_name', $division->division_name)->get();
        Division::destroy($division->id);
        Cost::destroy($cost);
        return redirect('/divisions')->with('success', 'Divisi '.strtoupper($division->division_name).' berhasil dihapus!');
    }
}
