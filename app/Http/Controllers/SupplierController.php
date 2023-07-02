<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', [
            "title" => "Data Supplier",
            "path" => "Data Supplier",
            "suppliers" => $suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hitung  = Supplier::count();
        $hitung1 = $hitung+1;
        $count   = sprintf("%04d", $hitung1);

        return view('supplier.create', [
            "title"     => "Tambah Data Supplier",
            "path"      => "Data Supplier",
            "path2"     => "Tambah",
            "suppliers"   => Supplier::all(),
            "count"      => $count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_supplier'   => 'required|unique:suppliers',
            'nama_supplier'   => 'required|min:4|max:50|unique:suppliers',
            'pic_supplier'    => 'required|min:2|max:25',
            'kontak_supplier' => 'required|min:11|max:25',
            'alamat_supplier' => 'required|min:5|max:255',
            'top'             => 'required|min:5|max:10',
            'pkp'             => 'required|min:2|max:5',
        ],
        [
            'nama_supplier.required'   => 'Nama Supplier belum diisi!',
            'nama_supplier.min'        => 'Ketikkan minimal 4 digit!',
            'nama_supplier.max'        => 'Ketikkan maksimal 50 digit!',
            'nama_supplier.unique'     => 'Nama Supplier sudah ada!',
            'pic_supplier.required'    => 'PIC Supplier belum diisi!',
            'pic_supplier.min'         => 'Ketikkan minimal 2 digit!',
            'pic_supplier.max'         => 'Ketikkan maksimal 25 digit!',
            'kontak_supplier.required' => 'Kontak Supplier belum diisi!',
            'kontak_supplier.min'      => 'Ketikkan minimal 11 digit!',
            'kontak_supplier.max'      => 'Ketikkan maksimal 25 digit!',
            'alamat_supplier.required' => 'Alamat Supplier belum diisi!',
            'alamat_supplier.min'      => 'Ketikkan minimal 5 digit!',
            'alamat_suppliermax'       => 'Ketikkan maksimal 255 digit!',
        ]);

        $nama_supplier = strtoupper($request['nama_supplier']);
        Supplier::create($validatedData);
        return redirect('/suppliers')->with('success', 'Supplier '.$nama_supplier.' berhasil ditambahkan!');
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
    public function destroy(Supplier $supplier)
    {
        Supplier::destroy($supplier->id);
        return redirect('/suppliers')->with('success', 'Supplier '.$supplier->nama_supplier.' berhasil dihapus!');
    }
}
