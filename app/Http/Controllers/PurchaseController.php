<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Purchase_approval;
use App\Models\Ppbje;
use App\Models\Ppbje_detail;
use App\Models\Supplier;
use App\Models\Employee;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases  = Purchase::all();
        return view('purchase.index', [
            "title"     => "Purchase Order",
            "path"      => "Purchase Order",
            "purchases" => $purchases
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($ppbje = 0, $supplier = 0)
    {
        $ppbjeID        = decrypt($ppbje);
        $supplierID     = decrypt($supplier);
        $ppbje          = Ppbje::where('id', $ppbjeID)->first();
        $ppbje_details  = Ppbje_detail::where([['ppbje_id', $ppbjeID], ['supplier_id', $supplierID]])->get();
        $supplier       = Supplier::where('id', $supplierID)->first();
        $costTotal      = Ppbje_detail::where([['ppbje_id', $ppbjeID], ['supplier_id', $supplierID]])->sum('price_total');
        $chiefPrc       = Employee::where([['cost_id', 11], ['position_id', 3]])->first();
        $mgrPrc         = Employee::where([['cost_id', 11], ['position_id', 8]])->first();
        $srManager      = Employee::where('position_id', 9)->first();
        $direktur       = Employee::where('position_id', 4)->first();

        if($supplier->tax == "PPN"){
            $ppn    = $costTotal*11/100;
        }else{
            $ppn    = 0;
        }

        $getMY          = date('my');
        $poDefault      = $getMY.'000';
        $countPO        = Purchase::where('purchase_number', 'LIKE', 'PO'.$getMY.'%')->count();

        if($countPO == 0){
            $noPO       = $poDefault+1;
            $po_number  = $noPO;
        }else{
            $noPO       = $poDefault+$countPO+1;
            $po_number  = $noPO;
        }
        return view('purchase.create', [
            "title"         => "Buat Purchase Order",
            "path"          => "Purchase Order",
            "path2"         => "Buat Purchase Order",
            "ppbje"         => $ppbje,
            "ppbje_details" => $ppbje_details,
            "supplier"      => $supplier,
            "costTotal"     => $costTotal,
            "ppn"           => $ppn,
            "po_number"     => $po_number,
            "chiefPrc"      => $chiefPrc,
            "mgrPrc"        => $mgrPrc,
            "srManager"     => $srManager,
            "direktur"      => $direktur
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validating data request from supplier.create
        $validatedData = $request->validate([
            'shipping_address'  => 'required|min:10|max:255',
            'shipping_date'     => 'required',
            'receiver_pic'      => 'required|min:2|max:25',
            'purchase_note'     => 'max:255',
        ],
        // Create custom notification for the validation request
        [
            'shipping_address.required' => 'Alamat Kirim belum diisi!',
            'shipping_address.min'      => 'Ketikkan minimal 10 digit!',
            'shipping_address.max'      => 'Ketikkan maksimal 255 digit!',
            'shipping_date.required'    => 'Tanggal Kirim belum diisi!',
            'receiver_pic.required'     => 'PIC Penerima belum diisi!',
            'receiver_pic.min'          => 'Ketikkan minimal 2 digit!',
            'receiver_pic.max'          => 'Ketikkan maksimal 25 digit!',
            'purchase_note.max'         => 'Ketikkan maksimal 255 digit!'
        ]);

        $purchase_status    = "belum disetujui";
        $dateNow            = date('d-m-Y');
        $purchase_expired   = date('d-m-Y', strtotime($dateNow. ' + 14 days'));

        $purchase                   = new Purchase;
        $purchase->purchase_number  = $request['purchase_number'];
        $purchase->purchase_expired = $purchase_expired;
        $purchase->purchase_maker   = $request['purchase_maker'];
        $purchase->supplier_id      = $request['supplier_id'];
        $purchase->purchase_total   = $request['purchase_total'];
        $purchase->ppbje_id         = $request['ppbje_id'];
        $purchase->cost_id          = $request['cost_id'];
        $purchase->shipping_address = $request['shipping_address'];
        $purchase->shipping_date    = $request['shipping_date'];
        $purchase->receiver_pic     = $request['receiver_pic'];
        $purchase->approved         = "no";
        $purchase->purchase_status  = $purchase_status;
        $purchase->purchase_note    = $request['purchase_note'];
        $purchase->save();

        $purchaseID = $purchase->id;

        $purchase_approval                  = new Purchase_approval;
        $purchase_approval->purchase_id     = $purchaseID;
        $purchase_approval->status1         = $purchase_status;
        $purchase_approval->chief           = $request['chief'];
        $purchase_approval->status2         = $purchase_status;
        $purchase_approval->manager         = $request['manager'];
        $purchase_approval->status3         = $purchase_status;
        $purchase_approval->senior_manager  = $request['senior_manager'];
        $purchase_approval->status4         = $purchase_status;
        $purchase_approval->direktur        = $request['direktur'];
        $purchase_approval->save();

        $ppbjeID    = $request['ppbje_id'];
        $supplierID = $request['supplier_id'];
        Ppbje_detail::where([['ppbje_id', $ppbjeID], ['supplier_id', $supplierID]])->update(['purchase_id' => $purchaseID]);

        // Redirect to the register view if create data succeded
        return redirect('/purchases')->with('success', 'Purchase Order telah dibuat!');
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
    public function destroy(string $id)
    {
        //
    }
}
