<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Purchase_detail;
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
    public function index($pos = 0)
    {
        $pos2 = decrypt($pos);
        if($pos2 == "Manager"){
            $purchases  = Purchase::where([['purchase_total', '>', 2000000],['approved', 'chief']])
            ->orWhere([['purchase_total', '>', 2000000],['approved', 'manager']])
            ->orWhere([['purchase_total', '>', 2000000],['approved', 'senior manager']])
            ->orWhere([['purchase_total', '>', 2000000],['approved', 'yes']])
            ->get();
        }
        elseif($pos2 == "Senior Manager"){
            $purchases  = Purchase::where([['purchase_total', '>', 5000000],['approved', 'manager']])
            ->orWhere([['purchase_total', '>', 5000000],['approved', 'senior manager']])
            ->orWhere([['purchase_total', '>', 5000000],['approved', 'yes']])
            ->get();
        }
        elseif($pos2 == "Direktur"){
            $purchases  = Purchase::where([['purchase_total', '>', 5000000],['approved', 'senior manager']])
            ->orWhere([['purchase_total', '>', 5000000],['approved', 'yes']])
            ->get();
        }
        else{
            $purchases  = Purchase::all();
        }

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
        $ppbje_details  = Ppbje_detail::where([['ppbje_id', $ppbjeID],['supplier_id', $supplierID],['purchase_number', NULL]])->get();
        $supplier       = Supplier::where('id', $supplierID)->first();
        $costTotal      = Ppbje_detail::where([['ppbje_id', $ppbjeID],['supplier_id', $supplierID]])->sum('price_total');
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
    public function store($pos = 0, Request $request)
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
        $purchase->user_id          = $request['user_id'];
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
        $purchaseNumber = $purchase->purchase_number;

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

        $item     = count($request['ppbje_detail_id']);
        
        if($item > 0){
            foreach ($request['ppbje_detail_id'] as $item => $value ){
                $data2 = array(
                'purchase_id'       => $purchaseID,
                'ppbje_detail_id'   => $request['ppbje_detail_id'][$item],
                'quantity'          => $request['quantity'][$item],
                'unit'              => $request['unit'][$item],
                'price'             => $request['price'][$item],
                'discount'          => $request['discount'][$item],
                'price_total'       => $request['price_total'][$item]
                );
                Purchase_detail::create($data2);
            }
        }

        $ppbjeID    = $request['ppbje_id'];
        $supplierID = $request['supplier_id'];
        Ppbje_detail::where([['ppbje_id', $ppbjeID],['supplier_id', $supplierID],['purchase_number', NULL]])->update(['purchase_number' => $purchaseNumber]);

        $countItem  = Ppbje_detail::where('ppbje_id', $ppbjeID)->count();
        $countPO    = Ppbje_detail::where([['ppbje_id', $ppbjeID],['purchase_number', '!=', NULL]])->count();

        if($countPO == $countItem){
            Ppbje::where('id', $ppbjeID)->update([
                'ppbje_status'  => 'persetujuan po',
            ]);
        }

        // Redirect to the Purchase Order view if create data succeded
        return redirect('/purchases'.$pos)->with('success', 'Purchase Order telah dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id = 0, $purchase = 0)
    {
        $purchaseID         = decrypt($id);
        $purchaseNumber     = decrypt($purchase);
        $purchase           = Purchase::where('id', $purchaseID)->first();
        $purchase_details   = Purchase_detail::where('purchase_id', $purchaseID)->get();
        $costTotal          = Purchase_detail::where('purchase_id', $purchaseID)->sum('price_total');

        return view('purchase.detail', [
            "title"             => "Purchase Order",
            "path"              => "Purchase Order",
            "path2"             => "Detail",
            "purchase"          => $purchase,
            "purchase_details"  => $purchase_details,
            'costTotal'         => $costTotal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($purchase = 0, $id = 0)
    {
        $purchaseNumber = decrypt($purchase);
        $purchase       = Purchase::where('id', $id)->first();
        $ppbje_details  = Ppbje_detail::where('purchase_number', $purchaseNumber)->get();
        $costTotal      = Ppbje_detail::where('purchase_number', $purchaseNumber)->sum('price_total');

        return view('purchase.edit', [
            "title"         => "Ubah Purchase Order",
            "path"          => "Data Purchase Order",
            "path2"         => "Ubah",
            "purchase"      => $purchase,
            "ppbje_details" => $ppbje_details,
            "costTotal"     => $costTotal
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
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

        $purchaseID = $purchase->id;

        Purchase::where('id', $purchaseID)->update([
            'shipping_address'  => $request['shipping_address'],
            'shipping_date'     => $request['shipping_date'],
            'receiver_pic'      => $request['receiver_pic'],
            'purchase_note'     => $request['purchase_note'],
        ]);

        // Redirect to the Purchase Order view if update data succeded
        return redirect('/purchases')->with('success', 'Purchase Order telah diubah!');
    }

    public function approval(Request $request, Purchase $purchase)
    {
        $status         = $request['status'];
        $pos            = $request['position'];
        $note           = $request['note'];
        $now            = date('d-M-Y',strtotime(now()));
        $get_id         = $purchase->id;
        $ppbjeID        = $purchase->ppbje_id;
        $po_number      = $purchase->purchase_number;
        $purchaseTotal  = $purchase->purchase_total;
        
        if($status == "menyetujui"){
            if($pos == "Chief"){
                Purchase_approval::where('purchase_id', $get_id)->update([
                    'status1' => $status,
                    'date1'   => $now,
                    'note1'   => $note
                ]);
                if($purchaseTotal <= 2000000){
                    Purchase::where('id', $get_id)->update([
                        'approved'          => 'yes',
                        'purchase_status'   => 'menunggu kiriman'
                    ]);
                }else{
                    Purchase::where('id', $get_id)->update([
                        'approved'      => 'chief',
                    ]);
                }
            }
            elseif($pos == "Manager"){
                Purchase_approval::where('purchase_id', $get_id)->update([
                    'status2' => $status,
                    'date2'   => $now,
                    'note2'   => $note
                ]);
                if($purchaseTotal <= 5000000){
                    Purchase::where('id', $get_id)->update([
                        'approved'          => 'yes',
                        'purchase_status'   => 'menunggu kiriman'
                    ]);
                }else{
                    Purchase::where('id', $get_id)->update([
                        'approved'      => 'manager',
                    ]);
                }
            }
            elseif($pos == "Senior Manager"){
                Purchase_approval::where('purchase_id', $get_id)->update([
                    'status3' => $status,
                    'date3'   => $now,
                    'note3'   => $note
                ]);
                if($purchaseTotal <= 10000000){
                    Purchase::where('id', $get_id)->update([
                        'approved'          => 'yes',
                        'purchase_status'   => 'menunggu kiriman'
                    ]);
                }else{
                    Purchase::where('id', $get_id)->update([
                        'approved'      => 'senior manager',
                    ]);
                }
            }
            elseif($pos == "Direktur"){
                Purchase_approval::where('purchase_id', $get_id)->update([
                    'status4' => $status,
                    'date4'   => $now,
                    'note4'   => $note
                ]);
                if($purchaseTotal > 10000000){
                    Purchase::where('id', $get_id)->update([
                        'approved'          => 'yes',
                        'purchase_status'   => 'menunggu kiriman'
                    ]);
                }
            }
            $id             = encrypt($get_id);
            $no             = encrypt($po_number);
            $countPO        = Purchase::where([['ppbje_id', $ppbjeID],['purchase_status', '!=', 'tidak disetujui']])->count();
            $countApproved  = Purchase::where([['ppbje_id', $ppbjeID],['approved', 'yes']])->count();

            if($countPO == $countApproved){
                Ppbje::where('id', $ppbjeID)->update([
                    'ppbje_status'  => 'menunggu kiriman'
                ]);
            }
            return redirect('/purchases/'.$id.'-'.$no)->with('success', $po_number.' telah disetujui!');
        }else{
            if($pos == "Chief"){
                Purchase_approval::where('purchase_id', $get_id)->update([
                    'status1' => $status,
                    'date1'   => $now,
                    'note1'   => $note
                ]);
                if($purchaseTotal <= 2000000){
                    Purchase::where('id', $get_id)->update([
                        'purchase_status'   => 'tidak disetujui',
                        'approved'          => 'chief'
                    ]);
                }
            }
            elseif($pos == "Manager"){
                Purchase_approval::where('purchase_id', $get_id)->update([
                    'status2' => $status,
                    'date2'   => $now,
                    'note2'   => $note
                ]);
                if($purchaseTotal <= 5000000){
                    Purchase::where('id', $get_id)->update([
                        'purchase_status'   => 'tidak disetujui',
                        'approved'          => 'manager'
                    ]);
                }
            }
            elseif($pos == "Senior Manager"){
                Purchase_approval::where('purchase_id', $get_id)->update([
                    'status3' => $status,
                    'date3'   => $now,
                    'note3'   => $note
                ]);
                if($purchaseTotal <= 10000000){
                    Purchase::where('id', $get_id)->update([
                        'purchase_status'   => 'tidak disetujui',
                        'approved'          => 'senior manager'
                    ]);
                }
            }
            elseif($pos == "Direktur"){
                Purchase_approval::where('purchase_id', $get_id)->update([
                    'status4' => $status,
                    'date4'   => $now,
                    'note4'   => $note
                ]);
                if($purchaseTotal <= 10000000){
                    Purchase::where('id', $get_id)->update([
                        'purchase_status'   => 'tidak disetujui',
                        'approved'          => 'direktur'
                    ]);
                }
            }
            $id = encrypt($get_id);
            $no = encrypt($po_number);
            Ppbje::where('id', $ppbjeID)->update([
                'ppbje_status'  => "berlangsung"
            ]);
            Ppbje_detail::where('purchase_number', $po_number)->update([
                'purchase_number'  => NULL
            ]);

            return redirect('/purchases/'.$id.'-'.$no)->with('success', $po_number.' tidak disetujui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
