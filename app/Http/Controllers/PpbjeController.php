<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppbje;
use App\Models\Ppbje_detail;
use App\Models\Ppbje_approval;
use App\Models\Cost;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Division;
use App\Models\Item;

class PpbjeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function asset($id = 0)
    {
        $id2 = decrypt($id);
        $ppbje_type = "ASSET";
        if ($id2 == "Procurement"){
            $ppbjes = Ppbje::where('ppbje_type', $ppbje_type)->get();
        }else{
            $ppbjes = Ppbje::where([['ppbje_type','=',$ppbje_type],['maker_division','=', $id2]])->get();
        }
        
        return view('ppbje.index', [
            "sendurl"   => "asset",
            "title"     => "PPBJe Asset",
            "path"      => "PPBJe Asset",
            "id"        => $id,
            "ppbjes"    => $ppbjes
        ]);
    }

    public function nonAsset($id = 0)
    {
        $id2 = decrypt($id);
        $ppbje_type = "NON ASSET";
        if ($id2 == "Procurement"){
            $ppbjes = Ppbje::where('ppbje_type', $ppbje_type)->get();
        }else{
            $ppbjes = Ppbje::where([['ppbje_type','=',$ppbje_type],['maker_division','=', $id2]])->get();
        }

        return view('ppbje.index', [
            "sendurl"   => "nonAsset",
            "title"     => "PPBJe Non Asset",
            "path"      => "PPBJe Non Asset",
            "id"        => $id,
            "ppbjes"    => $ppbjes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createAsset($id = 0)
    {
        $item_type          = "ASSET";
        $id2                = decrypt($id);
        $getDivision        = Division::where('division_name', $id2)->first();
        $getYear            = date('Y',strtotime(now()));
        $hitungPpbje        = Ppbje::where('maker_division', $id2)->count();
        $totalPpbje         = $hitungPpbje+1;

        return view('ppbje.create', [
            "sendurl"       => "asset",
            "title"         => "Buat PPBJe Asset",
            "path"          => "PPBJe Asset",
            "path2"         => "Buat PPBJe",
            "ppbjes"        => Ppbje::all(),
            "costs"         => Cost::all(),
            "employees"     => Employee::all(),
            "items"         => Item::where('item_type', $item_type)->get(),
            "ppbje_type"    => $item_type,
            "getYear"       => $getYear,
            "division"      => $getDivision,
            "id"            => $id,
            "totalPpbje"    => $totalPpbje
        ]);
    }

    public function createNonAsset($id = 0)
    {
        $item_type          = "NON ASSET";
        $id2                = decrypt($id);
        $getDivision        = Division::where('division_name', $id2)->first();
        $getYear            = date('Y',strtotime(now()));
        $hitungPpbje        = Ppbje::where('maker_division', $id2)->count();
        $totalPpbje         = $hitungPpbje+1;

        return view('ppbje.create', [
            "sendurl"       => "nonAsset",
            "title"         => "Buat PPBJe Non Asset",
            "path"          => "PPBJe Non Asset",
            "path2"         => "Buat PPBJe",
            "ppbjes"        => Ppbje::all(),
            "costs"         => Cost::all(),
            "employees"     => Employee::all(),
            "items"         => Item::where('item_type', $item_type)->get(),
            "ppbje_type"    => $item_type,
            "getYear"       => $getYear,
            "division"      => $getDivision,
            "id"            => $id,
            "totalPpbje"    => $totalPpbje
        ]);
    }

    public function getCost($id = 0)
    {
        $data = Cost::where('id',$id)->first();
        return response()->json($data);
    }

    public function getChief($id = 0)
    {
        $data = Employee::where([['cost_id','=',$id],['position_id','=', "3"]])->first();
        return response()->json($data);
    }
    
    public function getManager($id = 0)
    {
        if ($id == 3 or $id == 4 or $id == 5){
            $data = Employee::where([['cost_id','=',9],['position_id','=', 8]])->first();
        }elseif ($id == 6 or $id == 7 or $id == 8){
            $data = Employee::where([['cost_id','=',10],['position_id','=', 8]])->first();
        }else{
            $data = Employee::where([['cost_id','=',$id],['position_id','=', 8]])->first();
        }
        return response()->json($data);
    }
    
    public function getSeniorManager($id = 0)
    {
        $data = Employee::where('position_id', 9)->first();
        return response()->json($data);
    }

    public function getDirector($id = 0)
    {
        $data = Employee::where('position_id', 4)->first();
        return response()->json($data);
    }

    public function getApplicant($id = 0)
    {
        $data = Employee::where('id',$id)->first();
        return response()->json($data);
    }

    public function getPosition($id = 0)
    {
        $data = Position::where('id',$id)->first();
        return response()->json($data);
    }

    public function getDivision($id = 0)
    {
        $data = Cost::where('id',$id)->first();
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
            'quantity'       => 'required',
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
            'quantity'               => 'Isi!'
        ]);

        $data           = $request->all();
        $price_total    = $data['price_total'];
        $cost_total     = array_sum($price_total);
        $ppbje_note     = "belum disetujui";

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
        $ppbje->ppbje_note          = $ppbje_note;
        $ppbje->save();

        $ppbje_id       = $ppbje->id;
        $getDivision    = $ppbje->employee_division;
        $status         = "BELUM DISETUJUI";

        $ppbje_approval                 = new Ppbje_approval; 
        $ppbje_approval->ppbje_id       = $ppbje_id;
        $ppbje_approval->status1        = $status;
        $ppbje_approval->chief          = $data['chief'];
        $ppbje_approval->status2        = $status;
        $ppbje_approval->manager        = $data['manager'];
        $ppbje_approval->status3        = $status;
        $ppbje_approval->senior_manager = $data['senior_manager'];
        $ppbje_approval->status4        = $status;
        $ppbje_approval->direktur       = $data['direktur'];
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
    public function show($id = 0, Ppbje $ppbje)
    {
        $get_id         = $ppbje->id;
        $ppbje_detail   = Ppbje_detail::where('ppbje_id', $get_id)->get();
        $jml_barang     = count($ppbje_detail);
        $no             = 1;

        if($ppbje['ppbje_type'] == "ASSET"){
            $url  = "-asset".$id;
            return view('ppbje.detail', [
                "url"             => $url,
                "title"           => "PPBJe Asset",
                "path"            => "PPBJe Asset",
                "path2"           => "Detail",
                "ppbje"           => $ppbje,
                "ppbje_details"   => $ppbje_detail,
                "jml_barang"      => $jml_barang,
                'no'              => $no
            ]);
        }else{
            $url  = "-nonAsset".$id;
            return view('ppbje.detail', [
                "url"             => $url,
                "title"           => "PPBJe Non Asset",
                "path"            => "PPBJe NonAsset",
                "path2"           => "Detail",
                "ppbje"           => $ppbje,
                "ppbje_details"   => $ppbje_detail,
                "jml_barang"      => $jml_barang,
                'no'              => $no
            ]);
        }
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
    public function update($id = 0, Request $request, Ppbje $ppbje)
    {
        $validatedData = $request->validate([
            'ppbje_note'     => 'required'
        ]);
        PPBJe::where('id', $ppbje->id)
            ->update($validatedData);

        $url = $request['sendUrl'];
        $no_ppbj = $ppbje->ppbje_number;
        return redirect('/ppbje-'.$url.$id)->with('success', 'PPBJe '.$no_ppbj.' berhasil dibatalkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id = 0, Ppbje $ppbje)
    {
        if ($ppbje['ppbje_type'] == "ASSET"){
            Ppbje::destroy($ppbje->id);
            Ppbje_approval::destroy('ppbje_id', $ppbje->id);

            $ppbje_detail = Ppbje_detail::where('ppbje_id', $ppbje->id)->get();

            Ppbje_detail::destroy($ppbje_detail);

            $no_ppbj = $ppbje->ppbje_number;
            return redirect('/ppbje-asset'.$id)->with('success', 'PPBJe '.$no_ppbj.' telah dihapus!');
        }else{
            Ppbje::destroy($ppbje->id);
            Ppbje_approval::destroy('ppbje_id', $ppbje->id);

            $ppbje_detail = Ppbje_detail::where('ppbje_id', $ppbje->id)->get();

            Ppbje_detail::destroy($ppbje_detail);

            $no_ppbj = $ppbje->ppbje_number;
            return redirect('/ppbje-nonAsset'.$id)->with('success', 'PPBJe '.$no_ppbj.' telah dihapus!');
        }
    }
}
