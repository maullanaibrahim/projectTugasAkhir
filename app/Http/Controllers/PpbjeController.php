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
    public function asset($div = 0, $pos = 0)
    {
        $div2 = decrypt($div);
        $pos2 = decrypt($pos);
        $ppbje_type = "asset";
        
        if ($div2 == "Procurement"){
            if($pos2 == "Manager"){
                $ppbjes = Ppbje::where([
                    ['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'chief']
                ])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'manager']])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'senior manager']])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'yes']])
                ->get();
            }else{
                $ppbjes = Ppbje::where([
                    ['ppbje_type', $ppbje_type],
                    ['approved', 'yes'],
                    ['ppbje_note', 'beli']
                ])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2]])
                ->get();
            }
        }elseif ($div2 == "Asset Management"){
            if($pos2 == "Manager"){
                $ppbjes = Ppbje::where([
                    ['ppbje_type', $ppbje_type],
                    ['maker_division', $div2],
                    ['approved', 'chief']
                ])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'manager']])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'senior manager']])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'yes']])
                ->get();
            }else{
                $ppbjes = Ppbje::where([
                    ['ppbje_type', $ppbje_type],
                    ['approved', 'yes']
                ])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2]])
                ->get();
            }
        }elseif ($div2 == "Operational 1"){
            $ppbjes = Ppbje::where([
                ['ppbje_type','=',$ppbje_type],
                ['maker_division','=', ['Regional A', 'Regional B', 'Regional C']],
                ['cost_total', '>', 2000000],
                ['approved', 'chief']
            ])
            ->orWhere([['maker_division','=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'manager']])
            ->orWhere([['maker_division','=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'senior manager']])
            ->orWhere([['maker_division','=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'direktur']])
            ->orWhere([['maker_division','=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'yes']])
            ->get();
        }elseif ($div2 == "Operational 2"){
            $ppbjes = Ppbje::where([
                ['ppbje_type','=',$ppbje_type],
                ['maker_division','=', ['Regional D', 'Regional E', 'Regional F']],
                ['cost_total', '>', 2000000],
                ['approved', 'chief']
            ])
            ->orWhere([['maker_division','=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'manager']])
            ->orWhere([['maker_division','=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'senior manager']])
            ->orWhere([['maker_division','=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'direktur']])
            ->orWhere([['maker_division','=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'yes']])
            ->get();
        }elseif ($pos2 == "Senior Manager"){
            $ppbjes = Ppbje::where([
                ['ppbje_type','=',$ppbje_type],['cost_total', '>', 5000000],['approved', 'manager']
            ])
            ->orWhere([['ppbje_type','=',$ppbje_type],['cost_total', '>', 5000000],['approved', 'senior manager']])
            ->orWhere([['ppbje_type','=',$ppbje_type],['cost_total', '>', 5000000],['approved', 'yes']])
            ->get();
        }elseif ($pos2 == "Direktur"){
            $ppbjes = Ppbje::where([
                ['ppbje_type','=',$ppbje_type],['cost_total', '>', 10000000],['approved', 'senior manager']
            ])
            ->orWhere([['ppbje_type','=',$ppbje_type],['cost_total', '>', 10000000],['approved', 'yes']])
            ->get();
        }else{
            if($pos2 == "Manager"){
                $ppbjes = Ppbje::where([
                    ['ppbje_type', $ppbje_type],
                    ['maker_division', $div2],
                    ['approved', 'chief']
                ])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'manager']])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'senior manager']])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'yes']])
                ->get();
            }else{
                $ppbjes = Ppbje::where([['ppbje_type','=',$ppbje_type],['maker_division','=', $div2]])->get();
            }
        }

        $ppbje_detail = Ppbje_detail::all();
        
        return view('ppbje.index', [
            "sendurl"   => "asset",
            "title"     => "PPBJe Asset",
            "path"      => "PPBJe Asset",
            "div"       => $div,
            "pos"       => $pos,
            "ppbjes"    => $ppbjes
        ]);
    }

    public function nonAsset($div = 0, $pos = 0)
    {
        $div2 = decrypt($div);
        $pos2 = decrypt($pos);
        $ppbje_type = "non asset";

        if ($div2 == "Procurement"){
            if($pos2 == "Manager"){
                $ppbjes = Ppbje::where([
                    ['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'chief']
                ])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'manager']])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'senior manager']])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'yes']])
                ->get();
            }else{
                $ppbjes = Ppbje::where([['ppbje_type', $ppbje_type],['approved', 'yes']])->orWhere([['ppbje_type', $ppbje_type], ['maker_division', $div2]])->get();
            }
        }elseif ($div2 == "Asset Management"){
            $ppbjes = Ppbje::where([['ppbje_type', $ppbje_type], ['maker_division', $div2]])->get();
        }elseif ($div2 == "Operational 1"){
            $ppbjes = Ppbje::where([
                ['ppbje_type','=',$ppbje_type],
                ['maker_division','=', ['Regional A', 'Regional B', 'Regional C']],
                ['cost_total', '>', 2000000],
                ['approved', 'chief']
            ])
            ->orWhere([['maker_division','=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'manager']])
            ->orWhere([['maker_division','=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'senior manager']])
            ->orWhere([['maker_division','=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'direktur']])
            ->orWhere([['maker_division','=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'yes']])
            ->get();
        }elseif ($div2 == "Operational 2"){
            $ppbjes = Ppbje::where([
                ['ppbje_type','=',$ppbje_type],
                ['maker_division','=', ['Regional D', 'Regional E', 'Regional F']],
                ['cost_total', '>', 2000000],
                ['approved', 'chief']
            ])
            ->orWhere([['maker_division','=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'manager']])
            ->orWhere([['maker_division','=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'senior manager']])
            ->orWhere([['maker_division','=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'direktur']])
            ->orWhere([['maker_division','=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_type','=',$ppbje_type],['cost_total', '>', 2000000],['approved', 'yes']])
            ->get();
        }elseif ($pos2 == "Senior Manager"){
            $ppbjes = Ppbje::where([
                ['ppbje_type','=',$ppbje_type],['cost_total', '>', 5000000],['approved', 'manager']
            ])
            ->orWhere([['ppbje_type','=',$ppbje_type],['cost_total', '>', 5000000],['approved', 'senior manager']])
            ->orWhere([['ppbje_type','=',$ppbje_type],['cost_total', '>', 5000000],['approved', 'yes']])
            ->get();
        }elseif ($pos2 == "Direktur"){
            $ppbjes = Ppbje::where([
                ['ppbje_type','=',$ppbje_type],['cost_total', '>', 10000000],['approved', 'senior manager']
            ])
            ->orWhere([['ppbje_type','=',$ppbje_type],['cost_total', '>', 10000000],['approved', 'yes']])
            ->get();
        }else{
            if($pos2 == "Manager"){
                $ppbjes = Ppbje::where([
                    ['ppbje_type', $ppbje_type],
                    ['maker_division', $div2],
                    ['approved', 'chief']
                ])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'manager']])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'senior manager']])
                ->orWhere([['ppbje_type', $ppbje_type],['maker_division', $div2],['cost_total', '>', 2000000],['approved', 'yes']])
                ->get();
            }else{
                $ppbjes = Ppbje::where([['ppbje_type','=',$ppbje_type],['maker_division','=', $div2]])->get();
            }
        }

        return view('ppbje.index', [
            "sendurl"   => "nonAsset",
            "title"     => "PPBJe Non Asset",
            "path"      => "PPBJe Non Asset",
            "div"       => $div,
            "pos"       => $pos,
            "ppbjes"    => $ppbjes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createAsset($div = 0, $pos = 0)
    {
        $item_type          = "asset";
        $div2               = decrypt($div);
        $getDivision        = Division::where('division_name', $div2)->first();
        $getYear            = date('Y',strtotime(now()));
        $hitungPpbje        = Ppbje::where('maker_division', $div2)->count();
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
            "div"           => $div,
            "pos"           => $pos,
            "totalPpbje"    => $totalPpbje
        ]);
    }

    public function createNonAsset($div = 0, $pos = 0)
    {
        $item_type          = "non asset";
        $div2               = decrypt($div);
        $getDivision        = Division::where('division_name', $div2)->first();
        $getYear            = date('Y',strtotime(now()));
        $hitungPpbje        = Ppbje::where('maker_division', $div2)->count();
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
            "div"           => $div,
            "pos"           => $pos,
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
            'quantity'      => 'required',
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
        $approved       = "no";
        $ppbje_status   = "belum disetujui";

        $ppbje                      = new Ppbje;
        $ppbje->ppbje_number        = $data['ppbje_number'];
        $ppbje->maker               = $data['maker'];
        $ppbje->maker_division      = $data['maker_division'];
        $ppbje->cost_id             = $data['cost_id'];
        $ppbje->region              = $data['region'];
        $ppbje->applicant_nik       = $data['applicant_nik'];
        $ppbje->applicant_name      = $data['applicant_name'];
        $ppbje->applicant_position  = $data['applicant_position'];
        $ppbje->applicant_division  = $data['applicant_division'];
        $ppbje->date_of_need        = $data['date_of_need'];
        $ppbje->ppbje_type          = $data['ppbje_type'];
        $ppbje->reason              = $data['reason'];
        $ppbje->cost_total          = $cost_total;
        $ppbje->approved            = $approved;
        $ppbje->ppbje_status        = $ppbje_status;
        $ppbje->save();

        $ppbje_id       = $ppbje->id;
        $getDivision    = $ppbje->employee_division;
        $status         = "belum disetujui";

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
                'supplier_id'   => $data['supplier_id'][$item],
                'quantity'      => $data['quantity'][$item],
                'price'         => $data['price'][$item],
                'discount'      => $data['discount'][$item],
                'price_total'   => $data['price_total'][$item]
                );
                Ppbje_detail::create($data2);
            }
        }
        // $url : function to determine the url redirect (Asset or Non Asset)
        $url = $data['sendUrl'];
        return redirect('/ppbje-'.$url)->with('success', 'PPBJe baru telah dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($div = 0, $pos = 0, Ppbje $ppbje)
    {
        $get_id         = $ppbje->id;
        $ppbje_detail   = Ppbje_detail::where('ppbje_id', $get_id)->get();
        $no             = 1;

        if($ppbje['ppbje_type'] == "asset"){
            $url  = "-asset".$div."-".$pos;
            return view('ppbje.detail', [
                "url"             => $url,
                "title"           => "PPBJe Asset",
                "path"            => "PPBJe Asset",
                "path2"           => "Detail",
                "ppbje"           => $ppbje,
                "ppbje_details"   => $ppbje_detail,
                'no'              => $no
            ]);
        }else{
            $url  = "-nonAsset".$div."-".$pos;
            return view('ppbje.detail', [
                "url"             => $url,
                "title"           => "PPBJe Non Asset",
                "path"            => "PPBJe NonAsset",
                "path2"           => "Detail",
                "ppbje"           => $ppbje,
                "ppbje_details"   => $ppbje_detail,
                'no'              => $no
            ]);
        }
    }

    public function progress($ppbje = 0, $type = 0)
    {
        $ppbjeID        = decrypt($ppbje);
        $ppbjeType      = decrypt($type);
        $ppbje          = Ppbje::where('id', $ppbjeID)->first();
        $ppbje_detail   = Ppbje_detail::where('ppbje_id', $ppbjeID)->get();
        $getSuppliers   = Ppbje_detail::where([['ppbje_id', $ppbjeID], ['purchase_number', NULL]])->select('supplier_id')->distinct()->get();
        $no             = 1;
        
        return view('ppbje.progress', [
            "title"           => "Progress",
            "path"            => "PPBJe ".ucwords($ppbjeType),
            "path2"           => "Progress",
            "ppbje"           => $ppbje,
            "ppbje_details"   => $ppbje_detail,
            "getSuppliers"    => $getSuppliers,
            "no"              => $no
        ]);
    }

    public function stock($ppbje = 0)
    {
        $ppbjeID        = $ppbje;
        $ppbje          = Ppbje::where('id', $ppbjeID)->first();
        $ppbje_detail   = Ppbje_detail::where('ppbje_id', $ppbjeID)->get();
        $no             = 1;
        
        return view('ppbje.stock', [
            "title"           => "Tandai Stock",
            "path"            => "PPBJe Asset",
            "path2"           => "Tandai Stock",
            "ppbje"           => $ppbje,
            "ppbje_details"   => $ppbje_detail,
            "no"              => $no
        ]);
    }

    public function updateStock(Request $request, Ppbje_detail $detail)
    {
        $note       = $request['note'];
        $ppbjeID    = $detail->ppbje_id;
        $detailID   = $detail->id;
        $itemName   = $detail->item->item_name;

        if($note == "stock asset"){
            Ppbje_detail::where('id', $detailID)->update([
                'purchase_number' => $note
            ]);
            $countItem  = Ppbje_detail::where('ppbje_id', $ppbjeID)->count();
            $countPO    = Ppbje_detail::where([['ppbje_id', $ppbjeID],['purchase_number', '!=', NULL]])->count();

            if($countPO == $countItem){
                Ppbje::where('id', $ppbjeID)->update([
                    'ppbje_status'  => 'menunggu kiriman',
                    'ppbje_note'    => $note
                ]);
            }
            return redirect('/ppbje-asset/stock'.$ppbjeID)->with('success', strtoupper($itemName).' telah ditandai Stock Asset!');
        }else{
            Ppbje::where('id', $ppbjeID)->update([
                'ppbje_note' => $note
            ]);
            return redirect('/ppbje-asset/stock'.$ppbjeID)->with('success', 'Item lainnya telah ditandai Beli melalui Procurement!');
        }
    }

    public function updateMutation($ppbje = 0, Request $request)
    {
        $noMutation = $request['mutationNumber'];
        $ppbjeID    = $ppbje;
        $ppbjeType  = "selesai";

        Ppbje_detail::where('ppbje_id', $ppbjeID)->update([
            'receiving_number' => $noMutation
        ]);
        $countItem  = Ppbje_detail::where('ppbje_id', $ppbjeID)->count();
        $countRcv   = Ppbje_detail::where([['ppbje_id', $ppbjeID],['receiving_number', '!=', NULL]])->count();

        if($countRcv == $countItem){
            Ppbje::where('id', $ppbjeID)->update([
                'ppbje_status'  => 'selesai',
            ]);
        }
        return redirect()->back()->with('success', 'Nomor mutasi telah diinput!');
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
    public function update($div = 0, $pos = 0, Request $request, Ppbje $ppbje)
    {
        $status     = $request['status'];
        $note       = $request['note'];
        $url        = $request['sendUrl'];
        $position   = $request['position'];
        $now        = date('d-M-Y',strtotime(now()));
        $get_id     = $ppbje->id;
        $no_ppbje   = $ppbje->ppbje_number;
        $cost_total = $ppbje->cost_total;
        $ppbje_type = $ppbje->ppbje_type;

        if($status == "batal"){
            PPBJe::where('id', $get_id)->update(['ppbje_status' => 'batal']);
            return redirect('/ppbje-'.$url.$div.'-'.$pos)->with('success', 'PPBJe '.$no_ppbje.' telah dibatalkan!');
        }

        elseif($status == "menyetujui"){
            if($position == "Chief"){
                Ppbje_approval::where('ppbje_id', $get_id)->update([
                    'status1' => $status,
                    'date1'   => $now,
                    'note1'   => $note
                ]);
                if($cost_total <= 2000000){
                    if($ppbje_type == "asset"){
                        Ppbje::where('id', $get_id)->update([
                            'approved'      => 'yes',
                            'ppbje_status'  => 'berlangsung',
                            'ppbje_note'    => 'cek stock'
                        ]);                        
                    }
                    elseif($ppbje_type == "non asset"){
                        Ppbje::where('id', $get_id)->update([
                            'approved'      => 'yes',
                            'ppbje_status'  => 'berlangsung',
                            'ppbje_note'    => 'beli'
                        ]);                        
                    }
                }
                else{
                    Ppbje::where('id', $get_id)->update([
                        'approved'      => 'chief',
                    ]);
                }
            }

            if($position == "Manager"){
                Ppbje_approval::where('ppbje_id', $get_id)->update([
                    'status2' => $status,
                    'date2'   => $now,
                    'note2'   => $note
                ]);
                if($cost_total <= 5000000){
                    if($ppbje_type == "asset"){
                        Ppbje::where('id', $get_id)->update([
                            'approved'      => 'yes',
                            'ppbje_status'  => 'berlangsung',
                            'ppbje_note'    => 'cek stock'
                        ]);                        
                    }
                    elseif($ppbje_type == "non asset"){
                        Ppbje::where('id', $get_id)->update([
                            'approved'      => 'yes',
                            'ppbje_status'  => 'berlangsung',
                            'ppbje_note'    => 'beli'
                        ]);                        
                    }
                }
                else{
                    Ppbje::where('id', $get_id)->update([
                        'approved'      => 'manager',
                    ]);
                }
            }

            if($position == "Senior Manager"){
                Ppbje_approval::where('ppbje_id', $get_id)->update([
                    'status3' => $status,
                    'date3'   => $now,
                    'note3'   => $note
                ]);
                if($cost_total <= 10000000){
                    if($ppbje_type == "asset"){
                        Ppbje::where('id', $get_id)->update([
                            'approved'      => 'yes',
                            'ppbje_status'  => 'berlangsung',
                            'ppbje_note'    => 'cek stock'
                        ]);                        
                    }
                    elseif($ppbje_type == "non asset"){
                        Ppbje::where('id', $get_id)->update([
                            'approved'      => 'yes',
                            'ppbje_status'  => 'berlangsung',
                            'ppbje_note'    => 'beli'
                        ]);                        
                    }
                }
                else{
                    Ppbje::where('id', $get_id)->update([
                        'approved'      => 'senior manager',
                    ]);
                }
            }

            if($position == "Direktur"){
                Ppbje_approval::where('ppbje_id', $get_id)->update([
                    'status4' => $status,
                    'date4'   => $now,
                    'note4'   => $note
                ]);
                if($cost_total > 10000000){
                    if($ppbje_type == "asset"){
                        Ppbje::where('id', $get_id)->update([
                            'approved'      => 'yes',
                            'ppbje_status'  => 'berlangsung',
                            'ppbje_note'    => 'cek stock'
                        ]);                        
                    }
                    elseif($ppbje_type == "non asset"){
                        Ppbje::where('id', $get_id)->update([
                            'approved'      => 'yes',
                            'ppbje_status'  => 'berlangsung',
                            'ppbje_note'    => 'beli'
                        ]);                        
                    }
                }
            }
            return redirect('/ppbje'.$url.'/'.$get_id)->with('success', 'PPBJe '.$no_ppbje.' telah disetujui!');
        }

        elseif($status == "tidak menyetujui"){
            if($position == "Chief"){
                Ppbje_approval::where('ppbje_id', $get_id)->update([
                    'status1'   => $status,
                    'date1'     => $now,
                    'note1'     => $note
                ]);
                if($ppbje_type == "asset"){
                    Ppbje::where('id', $get_id)->update([
                        'ppbje_status'  => 'tidak disetujui'
                    ]);                        
                }
                elseif($ppbje_type == "non asset"){
                    Ppbje::where('id', $get_id)->update([
                        'ppbje_status'  => 'tidak disetujui'
                    ]);                        
                }
            }
            if($position == "Manager"){
                Ppbje_approval::where('ppbje_id', $get_id)->update([
                    'status2'   => $status,
                    'date2'     => $now,
                    'note2'     => $note
                ]);
                if($ppbje_type == "asset"){
                    Ppbje::where('id', $get_id)->update([
                        'ppbje_status'  => 'tidak disetujui'
                    ]);                        
                }
                elseif($ppbje_type == "non asset"){
                    Ppbje::where('id', $get_id)->update([
                        'ppbje_status'  => 'tidak disetujui'
                    ]);                        
                }
            }
            if($position == "Senior Manager"){
                Ppbje_approval::where('ppbje_id', $get_id)->update([
                    'status3'   => $status,
                    'date3'     => $now,
                    'note3'     => $note
                ]);
                if($ppbje_type == "asset"){
                    Ppbje::where('id', $get_id)->update([
                        'ppbje_status'  => 'tidak disetujui'
                    ]);                        
                }
                elseif($ppbje_type == "non asset"){
                    Ppbje::where('id', $get_id)->update([
                        'ppbje_status'  => 'tidak disetujui'
                    ]);                        
                }
            }
            if($position == "Direktur"){
                Ppbje_approval::where('ppbje_id', $get_id)->update([
                    'status4'   => $status,
                    'date4'     => $now,
                    'note4'     => $note
                ]);
                if($ppbje_type == "asset"){
                    Ppbje::where('id', $get_id)->update([
                        'ppbje_status'  => 'tidak disetujui'
                    ]);                        
                }
                elseif($ppbje_type == "non asset"){
                    Ppbje::where('id', $get_id)->update([
                        'ppbje_status'  => 'tidak disetujui'
                    ]);                        
                }
            }
            return redirect('/ppbje'.$url.'/'.$get_id)->with('success', 'PPBJe '.$no_ppbje.' telah disetujui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id = 0, Ppbje $ppbje)
    {
        if ($ppbje['ppbje_type'] == "asset"){
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
