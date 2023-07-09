<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Cost;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return view('branch.index', [
            "title"     => "Data Cabang",
            "path"      => "Data Cabang",
            "branches"  => $branches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branch.create', [
            "title"     => "Tambah Data Cabang",
            "path"      => "Data Cabang",
            "path2"     => "Tambah",
            "branches"  => Branch::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validating data request from branch.create
        $validatedData = $request->validate([
            'branch_code'       => 'required|max:3|unique:branches',
            'branch_name'       => 'required|min:5|max:50|unique:branches',
            'regional'          => 'required|max:1',
            'area'              => 'required|max:1',
            'branch_address'    => 'required|min:10|max:255',
        ],
        // Create custom notification for the validation request
        [
            'branch_code.required'      => 'Harus diisi!', 
            'branch_code.max'           => 'Maksimal 3 huruf!',
            'branch_code.unique'        => 'Kode Cabang sudah ada!',
            'branch_name.required'      => 'Nama Cabang harus diisi!',
            'branch_name.min'           => 'Ketikkan Nama Cabang minimal 5 huruf!',
            'branch_name.max'           => 'Ketikkan Nama Cabang maksimal 50 huruf!',
            'branch_name.unique'        => 'Nama Cabang sudah ada!',
            'regional.required'         => 'Regional harus diisi!',
            'regional.max'              => 'Maksimal 1 digit!',
            'area.required'             => 'Area harus diisi!',
            'area.max'                  => 'Maksimal 1 digit!',
            'branch_address.required'   => 'Alamat harus diisi!',
            'branch_address.min'        => 'Ketikkan Alamat minimal 10 huruf!',
            'branch_address.max'        => 'Ketikkan Alamat maksimal 255 huruf!',
        ]);
        // Saving data to branches table
        Branch::create($validatedData);

        // Saving data to costs table too
        $cost               = new Cost;
        $cost->cost_name    = $request['branch_name'];
        $cost->region       = $request['regional'];
        $cost->company_name = "PT. MAULANA SUKSES SELALU";
        $cost->save();

        // Redirect to the branch view if create data succeded
        $branch_name = strtoupper($request['branch_name']);
        return redirect('/branches')->with('success', 'Cabang '.$branch_name.' berhasil ditambahkan!');
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
    public function edit(Branch $branch)
    {
        return view('branch.edit', [
            "title"     => "Edit Data Cabang",
            "path"      => "Data Cabang",
            "path2"     => "Edit",
            "branch"    => $branch
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
    public function destroy(Branch $branch)
    {
        $cost = Cost::where('cost_name', $branch->branch_name)->get();
        Branch::destroy($branch->id);
        Cost::destroy($cost);
        return redirect('/branches')->with('success', 'Cabang '.strtoupper($branch->branch_name).' berhasil dihapus!');
    }
}
