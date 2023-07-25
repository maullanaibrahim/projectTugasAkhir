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
        $units   = ["BOX", "BUAH", "DRUM", "GALON", "JERIGEN", "KALENG", "KG", "LEMBAR", "LITER", "LS", "LUSIN", "M2", "PACK", "PAIL", "PCS", "SET", "UNIT"];
        $types   = ["ASSET", "NON ASSET"];

        return view('item.create', [
            "title"     => "Tambah Data Item",
            "path"      => "Data Item",
            "path2"     => "Tambah",
            "items"     => Item::all(),
            "suppliers" => Supplier::all(),
            "units"     => $units,
            "types"     => $types,
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
            'item_name'     => 'required|min:5|max:100|unique:items',
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
            'item_name.unique'      => 'Nama Item sudah ada!',
            'price.required'        => 'Harga belum diisi!',
            'unit.required'         => 'Satuan belum dipilih!',
            'supplier_id.required'  => 'Supplier belum dipilih!',
            'item_type.required'    => 'Jenis Item belum dipilih!',
        ]);
        // Saving data to items table
        $dataItem = array(
            'item_code'     => $request['item_code'],
            'item_name'     => $request['item_name'],
            'price'         => str_replace('.','',$request->price),
            'unit'          => $request['unit'],
            'supplier_id'   => $request['supplier_id'],
            'item_type'     => $request['item_type']
        );
        Item::create($dataItem);

        // Redirect to the item view if create data succeded
        $item_name = strtoupper($request['item_name']);
        return redirect('/items')->with('success', 'Item '.$item_name.' telah ditambahkan!');
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
    public function edit(Item $item)
    {
        $units   = ["BOX", "BUAH", "DRUM", "GALON", "JERIGEN", "KALENG", "KG", "LEMBAR", "LITER", "LS", "LUSIN", "M2", "PACK", "PAIL", "PCS", "SET", "UNIT"];
        $types   = ["ASSET", "NON ASSET"];

        return view('item.edit', [
            "title"     => "Tambah Data Item",
            "path"      => "Data Item",
            "path2"     => "Tambah",
            "suppliers" => Supplier::all(),
            "item"      => $item,
            "units"     => $units,
            "types"     => $types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        // Validating data request from branch.edit
        $rules = [
            'item_code'     => 'required',
            'price'         => 'required',
            'unit'          => 'required',
            'supplier_id'   => 'required',
            'item_type'     => 'required'
        ];

        if($request->item_name != $item->item_name){
            $rules['item_name'] = 'required|min:5|max:100|unique:items';
        }

        // Create custom notification for the validation request
        $validatedData = $request->validate($rules,
        [
            'item_name.required'    => 'Nama Item belum diisi!',
            'item_name.min'         => 'Ketikkan minimal 5 huruf!',
            'item_name.max'         => 'Ketikkan maksimal 100 huruf!',
            'item_name.unique'      => 'Nama Item sudah ada!',
            'price.required'        => 'Harga belum diisi!',
            'unit.required'         => 'Satuan belum dipilih!',
            'supplier_id.required'  => 'Supplier belum dipilih!',
            'item_type.required'    => 'Jenis Item belum dipilih!',
        ]);
        $dataItem = array(
            'item_name'     => $request['item_name'],
            'price'         => str_replace('.','',$request->price),
            'unit'          => $request['unit'],
            'supplier_id'   => $request['supplier_id'],
            'item_type'     => $request['item_type']
        );

        // Updating data to branches table
        Item::where('id', $item->id)
            ->update($dataItem);
        
        return redirect('/items')->with('success', 'Data Item telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Item::destroy($item->id);
        // return redirect('/items')->with('success', 'Item '.strtoupper($item->item_name).' berhasil dihapus!');
    }
}
