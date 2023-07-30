<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppbje;

class DashboardController extends Controller
{
    public function index($id = 0)
    {
        $id = decrypt($id);

        if($id == "Procurement"){
            $total_ppbjes       = Ppbje::where('ppbje_note', '=', 'beli')->count();
            $ppbje_processes    = Ppbje::where([['ppbje_status', '=', 'berlangsung'],['ppbje_note', '=', 'beli']])->count();
            $ppbje_finishes     = Ppbje::where([['ppbje_status', '=', 'selesai'],['ppbje_note', '=', 'beli']])->count();
            $jan                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 1)->count();
            $ppbje_cancels      = 0;
            $jan                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 1)->count();
            $feb                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 2)->count();
            $mar                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 3)->count();
            $apr                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 4)->count();
            $may                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 5)->count();
            $jun                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 6)->count();
            $jul                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 7)->count();
            $aug                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 8)->count();
            $sep                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 9)->count();
            $oct                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 10)->count();
            $nov                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 11)->count();
            $dec                = Ppbje::where('ppbje_note', '=', 'beli')->whereMonth('updated_at', 12)->count();
        }
        elseif($id == "Asset Management"){
            $total_ppbjes       = Ppbje::where('ppbje_type', "ASSET")->count();
            $ppbje_processes    = Ppbje::where([['ppbje_status', '=', 'berlangsung'],['ppbje_note', '=', 'cek stock']])->count();
            $ppbje_finishes     = Ppbje::where([['ppbje_type', '=', 'ASSET'],['ppbje_status', "selesai"]])->count();
            $ppbje_cancels      = 0;
            $jan                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 1)->count();
            $feb                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 2)->count();
            $mar                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 3)->count();
            $apr                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 4)->count();
            $may                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 5)->count();
            $jun                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 6)->count();
            $jul                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 7)->count();
            $aug                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 8)->count();
            $sep                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 9)->count();
            $oct                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 10)->count();
            $nov                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 11)->count();
            $dec                = Ppbje::where('ppbje_type', "ASSET")->whereMonth('updated_at', 12)->count();
        }
        elseif($id == "Operational 1"){
            $total_ppbjes       = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->count();
            $ppbje_processes    = Ppbje::where([['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_status', '=', 'berlangsung']])->count();
            $ppbje_finishes     = Ppbje::where([['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_status', '=', 'selesai']])->count();
            $ppbje_cancels      = Ppbje::where([['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_status', '=', 'batal']])->count();
            $jan                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 1)->count();
            $feb                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 2)->count();
            $mar                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 3)->count();
            $apr                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 4)->count();
            $may                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 5)->count();
            $jun                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 6)->count();
            $jul                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 7)->count();
            $aug                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 8)->count();
            $sep                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 9)->count();
            $oct                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 10)->count();
            $nov                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 11)->count();
            $dec                = Ppbje::where('maker_division', '=', ['Regional A', 'Regional B', 'Regional C'])->whereMonth('updated_at', 12)->count();
        }
        elseif($id == "Operational 2"){
            $total_ppbjes       = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->count();
            $ppbje_processes    = Ppbje::where([['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_status', '=', 'berlangsung']])->count();
            $ppbje_finishes     = Ppbje::where([['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_status', '=', 'selesai']])->count();
            $ppbje_cancels      = Ppbje::where([['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_status', '=', 'batal']])->count();
            $jan                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 1)->count();
            $feb                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 2)->count();
            $mar                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 3)->count();
            $apr                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 4)->count();
            $may                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 5)->count();
            $jun                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 6)->count();
            $jul                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 7)->count();
            $aug                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 8)->count();
            $sep                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 9)->count();
            $oct                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 10)->count();
            $nov                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 11)->count();
            $dec                = Ppbje::where('maker_division', '=', ['Regional D', 'Regional E', 'Regional F'])->whereMonth('updated_at', 12)->count();
        }
        else{
            $total_ppbjes       = Ppbje::where('maker_division', $id)->count();
            $ppbje_processes    = Ppbje::where([['maker_division', '=', $id],['ppbje_status', '=', 'berlangsung']])->count();
            $ppbje_finishes     = Ppbje::where([['maker_division', '=', $id],['ppbje_status', '=', 'selesai']])->count();
            $ppbje_cancels      = Ppbje::where([['maker_division', '=', $id],['ppbje_status', '=', 'batal']])->count();
            $jan                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 1)->count();
            $feb                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 2)->count();
            $mar                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 3)->count();
            $apr                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 4)->count();
            $may                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 5)->count();
            $jun                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 6)->count();
            $jul                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 7)->count();
            $aug                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 8)->count();
            $sep                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 9)->count();
            $oct                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 10)->count();
            $nov                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 11)->count();
            $dec                = Ppbje::where('maker_division', $id)->whereMonth('updated_at', 12)->count();
        }

        return view('dashboard.index', [
            "url"               => "",
            "title"             => "Dashboard",
            "path"              => "Dashboard",
            "total_ppbjes"      => $total_ppbjes,
            "ppbje_processes"   => $ppbje_processes,
            "ppbje_finishes"    => $ppbje_finishes,
            "ppbje_cancels"     => $ppbje_cancels,
            "jan"               => $jan,
            "feb"               => $feb,
            "mar"               => $mar,
            "apr"               => $apr,
            "may"               => $may,
            "jun"               => $jun,
            "jul"               => $jul,
            "aug"               => $aug,
            "sep"               => $sep,
            "oct"               => $oct,
            "nov"               => $nov,
            "dec"               => $dec
        ]);
    }
}
