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
            "title"     => "Data Supplier",
            "path"      => "Data Supplier",
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
            "suppliers" => Supplier::all(),
            "count"     => $count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validating data request from supplier.create
        $validatedData = $request->validate([
            'supplier_code'     => 'required|unique:suppliers',
            'supplier_name'     => 'required|min:4|max:50|unique:suppliers',
            'supplier_pic'      => 'required|min:2|max:25',
            'supplier_contact'  => 'required|min:11|max:25',
            'supplier_address'  => 'required|min:5|max:255',
            'term'              => 'required',
            'tax'               => 'required'
        ],
        // Create custom notification for the validation request
        [
            'supplier_name.required'    => 'Nama Supplier belum diisi!',
            'supplier_name.min'         => 'Ketikkan minimal 4 digit!',
            'supplier_name.max'         => 'Ketikkan maksimal 50 digit!',
            'supplier_name.unique'      => 'Nama Supplier sudah ada!',
            'supplier_pic.required'     => 'PIC Supplier belum diisi!',
            'supplier_pic.min'          => 'Ketikkan minimal 2 digit!',
            'supplier_pic.max'          => 'Ketikkan maksimal 25 digit!',
            'supplier_contact.required' => 'Kontak Supplier belum diisi!',
            'supplier_contact.min'      => 'Ketikkan minimal 11 digit!',
            'supplier_contact.max'      => 'Ketikkan maksimal 25 digit!',
            'supplier_address.required' => 'Alamat Supplier belum diisi!',
            'supplier_address.min'      => 'Ketikkan minimal 5 digit!',
            'supplier_address.max'      => 'Ketikkan maksimal 255 digit!'
        ]);
        // Saving data to branches table
        Supplier::create($validatedData);

        // Redirect to the supplier view if create data succeded
        $supplier_name = strtoupper($request['supplier_name']);
        return redirect('/suppliers')->with('success', 'Supplier '.$supplier_name.' berhasil ditambahkan!');
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
