<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppbje;
use App\Models\Ppbje_detail;
use App\Models\Ppbje_approval;
use App\Models\Cost;
use App\Models\Employee;
use App\Models\Item;

class PpbjeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function asset()
    {
        $ppbje_type = "ASSET";
        $ppbjes     = Ppbje::where('ppbje_type', $ppbje_type)->get();
        
        return view('ppbje.index', [
            "sendurl"   => "asset",
            "title"     => "PPBJe Asset",
            "path"      => "PPBJe Asset",
            "ppbjes"    => $ppbjes
        ]);
    }

    public function nonAsset()
    {
        $ppbje_type = "NON ASSET";
        $ppbjes     = Ppbje::where('ppbje_type', $ppbje_type)->get();

        return view('ppbje.index', [
            "sendurl"   => "nonAsset",
            "title"     => "PPBJe Non Asset",
            "path"      => "PPBJe Non Asset",
            "ppbjes"    => $ppbjes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createAsset()
    {
        $item_type = "ASSET";

        return view('ppbje.create', [
            "sendurl"       => "asset",
            "title"         => "Buat PPBJe Asset",
            "path"          => "PPBJe Asset",
            "path2"         => "Buat PPBJe",
            "ppbjes"        => Ppbje::all(),
            "costs"         => Cost::all(),
            "employees"     => Employee::all(),
            "items"         => Item::where('item_type', $item_type)->get(),
            "ppbje_type"    => $item_type
        ]);
    }

    public function createNonAsset()
    {
        $item_type = "NON ASSET";

        return view('ppbje.create', [
            "sendurl"       => "nonAsset",
            "title"         => "Buat PPBJe Non Asset",
            "path"          => "PPBJe Non Asset",
            "path2"         => "Buat PPBJe",
            "ppbjes"        => Ppbje::all(),
            "costs"         => Cost::all(),
            "employees"     => Employee::all(),
            "items"         => Item::where('item_type', $item_type)->get(),
            "ppbje_type"    => $item_type
        ]);
    }

    public function getCost($id = 0)
    {
        $data = Cost::where('id',$id)->first();
        return response()->json($data);
    }

    public function getApplicant($id = 0)
    {
        $data = Employee::where('id',$id)->first();
        return response()->json($data);
    }

    public function getItem($id = 0)
    {
        $data = Item::where('id',$id)->first();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ppbje_number'  => 'required|min:5|max:20|unique:ppbjes',
            'cost_id'       => 'required',
            'employee_id'   => 'required',
            'date_of_need'  => 'required',
            'reason'        => 'required|min:15|max:255',
            'item_id'       => 'required',
            'qantity'       => 'required',
        ],
        [
            'ppbje_number.required' => 'No. PPBJe belum diisi!', 
            'ppbje_number.min'      => 'Ketikkan minimal 5 digit!',
            'max'                   => 'Ketikkan maksimal 20 digit!',
            'unique'                => 'No. PPBJe sudah digunakan!',
            'cost_id'               => 'Beban Biaya belum dipilih!',
            'employee_id'           => 'Pemohon belum dipilih!',
            'date_of_need'          => 'Tentukan Tgl Kebutuhan!',
            'reason.required'       => 'Tolong jelaskan Alasan Permintaan!',
            'reason.min'            => 'Ketikkan minimal 15 huruf!',
            'reason.max'            => 'Ketikkan maksimal 255 huruf!',
            'item_id'               => 'Nama Barang belum dipilih!',
            'qantity'               => 'Isi!'
        ]);

        $data           = $request->all();
        $price_total    = $data['price_total'];
        $cost_total     = array_sum($price_total);

        $ppbje                      = new Ppbje;
        $ppbje->ppbje_number        = $data['ppbje_number'];
        $ppbje->maker               = $data['maker'];
        $ppbje->maker_division      = $data['maker_division'];
        $ppbje->cost_id             = $data['cost_id'];
        $ppbje->region              = $data['region'];
        $ppbje->employee_id         = $data['employee_id'];
        $ppbje->employee_position   = $data['employee_position'];
        $ppbje->employee_division   = $data['employee_division'];
        $ppbje->date_of_need        = $data['date_of_need'];
        $ppbje->ppbje_type          = $data['ppbje_type'];
        $ppbje->reason              = $data['reason'];
        $ppbje->cost_total          = $cost_total;
        $ppbje->ppbje_note          = "berlangsung";
        $ppbje->save();

        $ppbje_id   = $ppbje->id;
        $status     = "BELUM DISETUJUI";

        if($data['maker_division'] == "Asset Management")

        $ppbje_approval            = new Ppbje_approval; 
        $ppbje_approval->ppbje_id  = $ppbje_id;
        $ppbje_approval->status1   = $status;
        $ppbje_approval->status2   = $status;
        $ppbje_approval->status3   = $status;
        $ppbje_approval->status4   = $status;
        $ppbje_approval->save();

        $item     = count($data['item_id']);
        
        if($item > 0){
            foreach ($data['item_id'] as $item => $value ){
                $data2 = array(
                'ppbje_id'      => $ppbje->id,
                'item_id'       => $data['item_id'][$item],
                'quantity'      => $data['quantity'][$item],
                'price'         => $data['price'][$item],
                'price_total'   => $data['price_total'][$item]
                );
                Ppbje_detail::create($data2);
            }
        }
        // $url : function to determine the url redirect (Asset or Non Asset)
        $url = $data['sendUrl'];
        return redirect('/ppbje-'.$url)->with('success', 'PPBJe baru berhasil dibuat!');
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
    public function destroy(Ppbje $ppbje)
    {
        if ($ppbje['jenis_ppbje'] == "ASSET"){
            Ppbje::destroy($ppbje->id);
            Ppbje_approval::destroy('ppbje_id', $ppbje->id);

            $ppbje_detail = Ppbje_detail::where('ppbje_id', $ppbje->id)->get();

            Ppbje_detail::destroy($ppbje_detail);
            return redirect('/ppbje-asset')->with('success', 'PPBJe telah dihapus!');
        }else{
            Ppbje::destroy($ppbje->id);
            Ppbje_approval::destroy('ppbje_id', $ppbje->id);

            $ppbje_detail = Ppbje_detail::where('ppbje_id', $ppbje->id)->get();

            Ppbje_detail::destroy($ppbje_detail);
            return redirect('/ppbje-nonAsset')->with('success', 'PPBJe telah dihapus!');
        }
    }
}
