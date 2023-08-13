<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Item;

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
        $hitung     = Supplier::count();
        $hitung1    = $hitung+1;
        $count      = sprintf("%04d", $hitung1);
        $terms      = ["TUNAI", "14 HARI", "21 HARI", "30 HARI", "60 HARI"];
        $taxes      = ["PPN", "NON PPN"];

        return view('supplier.create', [
            "title"     => "Tambah Data Supplier",
            "path"      => "Data Supplier",
            "path2"     => "Tambah",
            "suppliers" => Supplier::all(),
            "terms"     => $terms,
            "taxes"     => $taxes,
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
        return redirect('/suppliers')->with('success', 'Supplier '.$supplier_name.' telah ditambahkan!');
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
    public function edit(Supplier $supplier)
    {
        $terms      = ["TUNAI", "14 HARI", "21 HARI", "30 HARI", "60 HARI"];
        $taxes      = ["PPN", "NON PPN"];

        return view('supplier.edit', [
            "title"     => "Ubah Data Supplier",
            "path"      => "Data Supplier",
            "path2"     => "Ubah",
            "terms"     => $terms,
            "taxes"     => $taxes,
            "supplier"  => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Validating data request from branch.edit
        $rules = [
            'supplier_pic'      => 'required|min:2|max:25',
            'supplier_contact'  => 'required|min:11|max:25',
            'supplier_address'  => 'required|min:5|max:255',
            'term'              => 'required',
            'tax'               => 'required'
        ];

        if($request->supplier_code != $supplier->supplier_code){
            $rules['supplier_code'] = 'required|unique:suppliers';
        }

        if($request->supplier_name != $supplier->supplier_name){
            $rules['supplier_name'] = 'required|min:4|max:50|unique:suppliers';
        }

        // Create custom notification for the validation request
        $validatedData = $request->validate($rules,
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

        // Updating data to branches table
        Supplier::where('id', $supplier->id)
            ->update($validatedData);
        
        return redirect('/suppliers')->with('success', 'Data Supplier telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        // $item = Item::where('supplier_id', $supplier->id)->get();
        // Supplier::destroy($supplier->id);
        // Item::destroy($item);
        // return redirect('/suppliers')->with('success', 'Supplier '.$supplier->nama_supplier.' berhasil dihapus!');
    }
}
