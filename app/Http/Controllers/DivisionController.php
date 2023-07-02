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
        $validatedData = $request->validate([
            'nama_divisi'   => 'required|min:5|unique:divisions',
            'lokasi'        => 'required',
            'alamat'        => 'required|min:10|max:255',
        ],
        [
            'nama_divisi.required'  => 'Nama Divisi harus diisi!', 
            'nama_divisi.min'       => 'Ketikkan Nama Divisi minimal 5 huruf!',
            'unique'                => 'Nama Divisi sudah ada!',
            'lokasi.required'       => 'Lokasi harus diisi!',
            'alamat.required'       => 'Alamat harus diisi!',
            'alamat.min'            => 'Ketikkan Alamat minimal 10 huruf!',
            'alamat.max'            => 'Ketikkan Alamat maksimal 255 huruf!',
         ]);

         $nama_divisi = strtoupper($request['nama_divisi']);
         Division::create($validatedData);

         $company_name       = "PT. GRIYA PRATAMA";
         $cost               = new Cost;
         $cost->cost_name    = $request['nama_divisi'];
         $cost->region       = $request['lokasi'];
         $cost->company_name = $company_name;
         $cost->save();

         return redirect('/divisions')->with('success', 'Divisi '.$nama_divisi.' berhasil ditambahkan!');
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
    public function destroy(Division $division)
    {
        Division::destroy($division->id);
        return redirect('/divisions')->with('success', 'Divisi '.strtoupper($division->nama_divisi).' berhasil dihapus!');
    }
}
