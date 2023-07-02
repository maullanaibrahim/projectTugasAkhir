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
            "path" => "Data Item",
            "items" => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        $validatedData = $request->validate([
            'kode_item'     => 'required',
            'nama_item'     => 'required|min:5|max:100',
            'harga'           => 'required',
            'satuan'          => 'required',
            'supplier_id'     => 'required',
            'jenis_item'    => 'required'
        ],
        [
            'nama_item.required'     => 'Nama Item belum diisi!',
            'nama_item.min'          => 'Ketikkan minimal 5 huruf!',
            'nama_item.max'          => 'Ketikkan maksimal 100 huruf!',
            'harga.required'           => 'Harga belum diisi!',
            'satuan.required'          => 'Satuan belum dipilih!',
            'supplier_id.required'     => 'Supplier belum dipilih!',
            'jenis_item.required'    => 'Jenis Item belum dipilih!',
        ]);

        $nama_item = strtoupper($request['nama_item']);
        Item::create($validatedData);
        return redirect('/items')->with('success', 'Item '.$nama_item.' berhasil ditambahkan!');
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
        return redirect('/items')->with('success', 'Item '.strtoupper($item->nama_item).' berhasil dihapus!');
    }
}
