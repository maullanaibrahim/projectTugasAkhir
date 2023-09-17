<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receiving;
use App\Models\Purchase;
use App\Models\Purchase_detail;
use App\Models\Ppbje;
use App\Models\Ppbje_detail;

class ReceivingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receivings = Receiving::all();
        return view('receiving.index', [
            "title"         => "Data Receiving",
            "path"          => "Data Receiving",
            "receivings"    => $receivings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dateNow         = date('d-M-Y');
        $getDMY          = date('dmy');
        $rcvDefault      = $getDMY.'000';
        $countRCV        = Receiving::where('receiving_number', 'LIKE', 'RCV'.$getDMY.'%')->count();

        if($countRCV == 0){
            $noRCV       = $rcvDefault+1;
            $rcvNumber   = $noRCV;
        }else{
            $noRCV       = $rcvDefault+$countRCV+1;
            $rcvNumber   = $noRCV;
        }
        $purchase           = Purchase::where('id', NULL)->first();
        $purchase_details   = Purchase_detail::where('id', NULL)->get();
        $no                 = NULL;

        return view('receiving.create', [
            "title"             => "Buat Receiving",
            "path"              => "Receiving Order",
            "path2"             => "Buat Receiving",
            "dateNow"           => $dateNow,
            "rcvNumber"         => $rcvNumber,
            "purchase"          => $purchase,
            "purchase_details"  => $purchase_details,
            "no"                => $no
        ]);
    }

    public function getPurchaseID($id = 0)
    {
        $data = Purchase::where('purchase_number', $id)->first();
        return response()->json($data);
    }

    public function getPurchaseDetail(Request $request)
    {
        $dateNow            = date('d-M-Y');
        $purchase_number    = $request->purchase_number;
        $purchase_id        = $request->purchase_id;
        $getDMY             = date('dmy');
        $rcvDefault         = $getDMY.'000';
        $countRCV           = Receiving::where('receiving_number', 'LIKE', 'RCV'.$getDMY.'%')->count();

        if($countRCV == 0){
            $noRCV       = $rcvDefault+1;
            $rcvNumber   = $noRCV;
        }else{
            $noRCV       = $rcvDefault+$countRCV+1;
            $rcvNumber   = $noRCV;
        }
        $checkPO            = Purchase::where('id', $purchase_id)->count();
        $checkRcv           = Purchase::where([['id', $purchase_id],['receiving_id', '!=', NULL]])->count();
        $purchase           = Purchase::where('id', $purchase_id)->first();
        $purchase_details   = Purchase_detail::where('purchase_id', $purchase_id)->get();
        $no                 = 1;

        if($checkPO == NULL){
            return back()->with('poNull', 'Nomor PO tidak ada!');
        }
        elseif($checkRcv == 1){
            return back()->with('rcvNotNull', 'Nomor PO sudah di receiving!');
        }
        elseif($checkRcv == 0){
            return view('receiving.create', [
                "title"             => "Buat Receiving",
                "path"              => "Receiving Order",
                "path2"             => "Buat Receiving",
                "dateNow"           => $dateNow,
                "rcvNumber"         => $rcvNumber,
                "purchase"          => $purchase,
                "purchase_details"  => $purchase_details,
                "no"                => $no
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $receiving                      = new Receiving;
        $receiving->receiving_number    = $request['receiving_number'];
        $receiving->purchase_id         = $request['purchase_id'];
        $receiving->ppbje_id            = $request['ppbje_id'];
        $receiving->recipient           = $request['recipient'];
        $receiving->division_name       = $request['division_name'];
        $receiving->invoice_number      = $request['invoice_number'];
        $receiving->receiving_status    = $request['receiving_status'];
        $receiving->receiving_note      = $request['receiving_note'];
        $receiving->save();

        $receiving_id       = $receiving->id;
        $receiving_number   = $receiving->receiving_number;
        $purchase_id        = $receiving->purchase_id;
        $ppbje_id           = $receiving->ppbje_id;
        $purchase_number    = $request['purchase_number'];

        Purchase::where('id', $purchase_id)->update([
            'receiving_id'  => $receiving_id,
        ]);
        
        $countRcvByPO = Purchase::where([['id',$purchase_id],['receiving_id', '!=', NULL]])->count();
        if($countRcvByPO == 1){
            if($receiving->receiving_status == 'selesai'){
                Purchase::where('id', $purchase_id)->update([
                    'purchase_status'  => 'sudah diterima'
                ]);
            }
        }
        
        Ppbje_detail::where([['ppbje_id', $ppbje_id],['purchase_number', $purchase_number]])->update([
            'receiving_number'  => $receiving_number,
        ]);

        $countRcv           = Receiving::where('ppbje_id', $ppbje_id)->count();
        $countRcvFinished   = Receiving::where([['ppbje_id', $ppbje_id],['receiving_status', 'selesai']])->count();
        $countItemPpbje     = Ppbje_detail::where('ppbje_id', $ppbje_id)->count();
        $countRcvByPpbje    = Ppbje_detail::where([['ppbje_id', $ppbje_id],['receiving_number', '!=', NULL]])->count();
        if($countItemPpbje == $countRcvByPpbje){
            if($countRcv == $countRcvFinished ){
                Ppbje::where('id', $ppbje_id)->update([
                    'ppbje_status'  => 'selesai'
                ]);
            }
        }

        // Redirect to the supplier view if create data succeded
        return redirect('/receivings')->with('success', 'Receiving telah dibuatkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Receiving $receiving)
    {
        $no                 = 1;
        $purchase_id        = $receiving->purchase_id;
        $purchase_details   = Purchase_detail::where('purchase_id', $purchase_id)->get();

        return view('receiving.detail', [
            "title"             => "Detail Receiving",
            "path"              => "Receiving",
            "path2"             => "Detail",
            "no"                => $no,
            "receiving"         => $receiving,
            "purchase_details"  => $purchase_details
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receiving $receiving)
    {
        $getDMY             = date('dmy');
        $rcvDefault         = $getDMY.'000';
        $countRCV           = Receiving::where('receiving_number', 'LIKE', 'RCV'.$getDMY.'%')->count();

        if($countRCV == 0){
            $noRCV       = $rcvDefault+1;
            $rcvNumber   = $noRCV;
        }else{
            $noRCV       = $rcvDefault+$countRCV+1;
            $rcvNumber   = $noRCV;
        }

        $dateNow            = date('d-M-Y');
        $no                 = 1;
        $purchase_id        = $receiving->purchase_id;
        $keteranganRevisi   = "Revisi Receiving ".$receiving->receiving_number.". ";
        $purchase_details   = Purchase_detail::where('purchase_id', $purchase_id)->get();
        return view('receiving.edit', [
            "title"             => "Ubah Receiving",
            "path"              => "Receiving",
            "path2"             => "Ubah",
            "dateNow"           => $dateNow,
            "no"                => $no,
            "receiving"         => $receiving,
            "rcvNumber"         => $rcvNumber,
            "keteranganRevisi"  => $keteranganRevisi,
            "purchase_details"  => $purchase_details
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receiving $receiving)
    {
        $receiving                      = new Receiving;
        $receiving->receiving_number    = $request['receiving_number'];
        $receiving->purchase_id         = $request['purchase_id'];
        $receiving->ppbje_id            = $request['ppbje_id'];
        $receiving->recipient           = $request['recipient'];
        $receiving->division_name       = $request['division_name'];
        $receiving->invoice_number      = $request['invoice_number'];
        $receiving->receiving_status    = $request['receiving_status'];
        $receiving->receiving_note      = $request['receiving_note'];
        $receiving->save();

        $receiving_id       = $receiving->id;
        $receiving_number   = $receiving->receiving_number;
        $purchase_id        = $receiving->purchase_id;
        $ppbje_id           = $receiving->ppbje_id;
        $purchase_number    = $request['purchase_number'];
        $rcvIdOld           = $request['rcv_id_old'];

        Receiving::where('id', $rcvIdOld)->update([
            'receiving_status'  => 'selesai',
        ]);

        Purchase::where('id', $purchase_id)->update([
            'receiving_id'  => $receiving_id,
        ]);
        
        $countRcvByPO = Purchase::where([['id',$purchase_id],['receiving_id', '!=', NULL]])->count();
        if($countRcvByPO == 1){
            if($receiving->receiving_status == 'selesai'){
                Purchase::where('id', $purchase_id)->update([
                    'purchase_status'  => 'sudah diterima'
                ]);
            }
        }
        
        Ppbje_detail::where([['ppbje_id', $ppbje_id],['purchase_number', $purchase_number]])->update([
            'receiving_number'  => $receiving_number,
        ]);

        $countRcv           = Receiving::where('ppbje_id', $ppbje_id)->count();
        $countRcvFinished   = Receiving::where([['ppbje_id', $ppbje_id],['receiving_status', 'selesai']])->count();
        $countItemPpbje     = Ppbje_detail::where('ppbje_id', $ppbje_id)->count();
        $countRcvByPpbje    = Ppbje_detail::where([['ppbje_id', $ppbje_id],['receiving_number', '!=', NULL]])->count();
        if($countItemPpbje == $countRcvByPpbje){
            if($countRcv == $countRcvFinished ){
                Ppbje::where('id', $ppbje_id)->update([
                    'ppbje_status'  => 'selesai'
                ]);
            }
        }

        // Redirect to the supplier view if create data succeded
        return redirect('/receivings')->with('success', 'Revisi Receiving telah dibuatkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
