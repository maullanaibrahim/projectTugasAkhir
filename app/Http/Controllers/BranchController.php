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
        $validatedData = $request->validate([
            'kode_cabang'     => 'required|max:3|unique:branches',
            'nama_cabang'     => 'required|min:5|max:50|unique:branches',
            'wilayah'         => 'required',
            'regional'        => 'required',
            'area'            => 'required',
            'alamat_cabang'   => 'required|min:10|max:255',
         ],
         [
            'kode_cabang.required'  => 'Harus diisi!', 
            'kode_cabang.max'       => 'Maksimal 3 huruf!',
            'kode_cabang.unique'    => 'Kode Cabang sudah ada!',
            'nama_cabang.required'  => 'Nama Cabang harus diisi!',
            'nama_cabang.min'       => 'Ketikkan Nama Cabang minimal 5 huruf!',
            'nama_cabang.max'       => 'Ketikkan Nama Cabang maksimal 50 huruf!',
            'nama_cabang.unique'    => 'Nama Cabang sudah ada!',
            'wilayah.required'      => 'Wilayah harus dipilih!',
            'regional.required'     => 'Regional harus dipilih!',
            'area.required'         => 'Area harus dipilih!',
            'alamat_cabang.required'=> 'Arlamat harus diisi!',
            'alamat_cabang.min'     => 'Ketikkan Alamat minimal 10 huruf!',
            'alamat_cabang.max'     => 'Ketikkan Alamat maksimal 255 huruf!',
        ]);
   
        $nama_cabang = strtoupper($request['nama_cabang']);
        Branch::create($validatedData);

        $company_name       = "PT. GRIYA PRATAMA";
        $cost               = new Cost;
        $cost->cost_name    = $request['nama_cabang'];
        $cost->region       = $request['regional'];
        $cost->company_name = $company_name;
        $cost->save();

        return redirect('/branches')->with('success', 'Cabang '.$nama_cabang.' berhasil ditambahkan!');
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
    public function destroy(Branch $branch)
    {
        Branch::destroy($branch->id);
        return redirect('/branches')->with('success', 'Cabang '.strtoupper($branch->nama_cabang).' berhasil dihapus!');
    }
}
