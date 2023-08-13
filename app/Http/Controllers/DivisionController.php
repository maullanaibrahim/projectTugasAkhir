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
        $locations  = ["head office", "distribution center"];

        return view('division.create', [
            "title"     => "Tambah Data Divisi",
            "path"      => "Data Divisi",
            "path2"     => "Tambah",
            "locations" => $locations,
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
            'division_code' => 'required|max:3|unique:divisions',
            'division_name' => 'required|min:5|unique:divisions',
            'location'      => 'required',
            'address'       => 'required|min:10|max:255',
        ],
        // Create custom notification for the validation request
        [
            'division_code.required'    => 'Kode Divisi harus diisi!', 
            'division_code.max'         => 'Maksimal 3 huruf!',
            'division_code.unique'      => 'Kode Divisi sudah ada!',
            'division_name.required'    => 'Nama Divisi harus diisi!', 
            'division_name.min'         => 'Ketikkan Nama Divisi minimal 5 huruf!',
            'division_name.unique'      => 'Nama Divisi sudah ada!',
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
        $cost->company_name = "PT. Maulana Sukses Selalu";
        $cost->status       = "aktif";
        $cost->save();

        // Redirect to the division view if create data succeded
        $division_name = strtoupper($request['division_name']);
        return redirect('/divisions')->with('success', 'Divisi '.$division_name.' telah ditambahkan!');
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
        $locations  = ["head office", "distribution center"];
        $division_name  = $division->division_name;

        return view('division.edit', [
            "title"     => "Ubah Data Divisi",
            "path"      => "Data Divisi",
            "path2"     => "Ubah",
            "cost"      => Cost::where('cost_name', $division_name)->first(),
            "locations" => $locations,
            "division"  => $division
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division)
    {
        // Validating data request from division.edit
        $rules = [
            'location'      => 'required',
            'address'       => 'required|min:10|max:255',
        ];

        if($request->division_code != $division->division_code){
            $rules['division_code'] = 'required|max:3|unique:divisions';
        }

        if($request->division_name != $division->division_name){
            $rules['division_name'] = 'required|min:5|unique:divisions';
        }

        // Create custom notification for the validation request
        $validatedData = $request->validate($rules,
        [
            'division_code.required'    => 'Kode Divisi harus diisi!', 
            'division_code.max'         => 'Maksimal 3 huruf!',
            'division_code.unique'      => 'Kode Divisi sudah ada!',
            'division_name.required'    => 'Nama Divisi harus diisi!', 
            'division_name.min'         => 'Ketikkan Nama Divisi minimal 5 huruf!',
            'division_name.unique'      => 'Nama Divisi sudah ada!',
            'location.required'         => 'Lokasi harus diisi!',
            'address.required'          => 'Alamat harus diisi!',
            'address.min'               => 'Ketikkan Alamat minimal 10 huruf!',
            'address.max'               => 'Ketikkan Alamat maksimal 255 huruf!',
        ]);

        // Updating data to branches table
        Division::where('id', $division->id)
            ->update($validatedData);
        
        $costID = $request['cost_id'];
        // Updating data to costs table too
        $cost               = Cost::find($costID);
        $cost->cost_name    = $request['division_name'];
        $cost->region       = $request['location'];
        $cost->status       = "aktif";
        $cost->save();
        
        return redirect('/divisions')->with('success', 'Data Divisi telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        // $cost = Cost::where('cost_name', $division->division_name)->get();
        // Division::destroy($division->id);
        // Cost::destroy($cost);
        // return redirect('/divisions')->with('success', 'Divisi '.strtoupper($division->division_name).' telah dihapus!');
    }
}
