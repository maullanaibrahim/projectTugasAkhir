<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Supplier;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return view('item.index', [
            "title" => "Data Item",
            "path"  => "Data Item",
            "items" => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Determine item code with autoincrement
        $hitung  = Item::count();
        $hitung1 = $hitung+1;
        $count   = sprintf("%04d", $hitung1);

        return view('item.create', [
            "title"     => "Tambah Data Item",
            "path"      => "Data Item",
            "path2"     => "Tambah",
            "items"     => Item::all(),
            "suppliers" => Supplier::all(),
            "count"     => $count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validating data request from branch.create
        $validatedData = $request->validate([
            'item_code'     => 'required',
            'item_name'     => 'required|min:5|max:100',
            'price'         => 'required',
            'unit'          => 'required',
            'supplier_id'   => 'required',
            'item_type'     => 'required'
        ],
        // Create custom notification for the validation request
        [
            'item_name.required'    => 'Nama Item belum diisi!',
            'item_name.min'         => 'Ketikkan minimal 5 huruf!',
            'item_name.max'         => 'Ketikkan maksimal 100 huruf!',
            'price.required'        => 'Harga belum diisi!',
            'unit.required'         => 'Satuan belum dipilih!',
            'supplier_id.required'  => 'Supplier belum dipilih!',
            'item_type.required'    => 'Jenis Item belum dipilih!',
        ]);
        // Saving data to items table
        Item::create($validatedData);

        // Redirect to the item view if create data succeded
        $item_name = strtoupper($request['item_name']);
        return redirect('/items')->with('success', 'Item '.$item_name.' berhasil ditambahkan!');
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
    public function destroy(Item $item)
    {
        Item::destroy($item->id);
        return redirect('/items')->with('success', 'Item '.strtoupper($item->item_name).' berhasil dihapus!');
    }
}
