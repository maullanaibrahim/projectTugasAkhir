<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppbje;
use App\Models\User;
use App\Models\Division;
use App\Models\Purchase;

class DashboardController extends Controller
{
    public function index($div = 0, $pos = 0)
    {
        $div        = decrypt($div);
        $pos        = decrypt($pos);
        $thisYear   = date('Y',strtotime(now()));

        if($pos == "Admin" or $pos == "Staff" or $pos == "Chief"){
            if($div == "Procurement"){
                $ppbje_totals       = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->count();
                $ppbje_approving    = Ppbje::where([['maker_division', '=', $div],['approved', '=', 'no']])->count();
                $ppbje_processes    = Ppbje::where([
                    ['ppbje_status', '=', 'berlangsung'],
                    ['ppbje_note', '=', 'beli']])
                ->orWhere([['ppbje_status', '=', 'persetujuan po'],['ppbje_note', '=', 'beli']])
                ->orWhere([['ppbje_status', '=', 'menunggu kiriman'],['ppbje_note', '=', 'beli']])
                ->count();
                $ppbje_finishes     = Ppbje::where([['ppbje_status', '=', 'selesai'],['ppbje_note', '=', 'beli']])->count();
                $po_totals          = Purchase::count();
                if($pos == "Chief"){
                    $po_approving       = Purchase::where('approved', "no")->count();
                }elseif($pos == "Admin" or $pos == "Staff"){
                    $po_approving       = Purchase::where('purchase_status', "belum disetujui")->count();
                }
                $jan                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 1)->count();
                $feb                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 2)->count();
                $mar                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 3)->count();
                $apr                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 4)->count();
                $may                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 5)->count();
                $jun                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 6)->count();
                $jul                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 7)->count();
                $aug                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 8)->count();
                $sep                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 9)->count();
                $oct                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 10)->count();
                $nov                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 11)->count();
                $dec                = Ppbje::where([['approved', '=', 'yes'],['ppbje_note', '=', 'beli']])->whereMonth('updated_at', 12)->count();
            }
            elseif($div == "Asset Management"){
                $ppbje_totals       = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->count();
                $ppbje_approving    = Ppbje::where([['maker_division', '=', $div],['approved', '=', 'no']])->count();
                $ppbje_processes    = Ppbje::where([
                    ['ppbje_type', '=', 'ASSET'],
                    ['ppbje_status', '=', 'berlangsung'],
                    ['ppbje_note', '=', 'cek stock']
                ])
                ->orWhere([['ppbje_type', '=', 'ASSET'],['ppbje_status', '=', 'berlangsung'],['ppbje_note', '=', 'beli']])
                ->orWhere([['ppbje_type', '=', 'ASSET'],['ppbje_status', '=', 'persetujuan po'],['ppbje_note', '=', 'beli']])
                ->orWhere([['ppbje_type', '=', 'ASSET'],['ppbje_status', '=', 'menunggu kiriman']])
                ->count();
                $ppbje_finishes     = Ppbje::where([['ppbje_type', '=', 'ASSET'],['ppbje_status', '=', 'selesai']])->count();
                $po_totals          = 0;
                $po_approving       = 0;
                $jan                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 1)->count();
                $feb                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 2)->count();
                $mar                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 3)->count();
                $apr                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 4)->count();
                $may                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 5)->count();
                $jun                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 6)->count();
                $jul                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 7)->count();
                $aug                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 8)->count();
                $sep                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 9)->count();
                $oct                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 10)->count();
                $nov                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 11)->count();
                $dec                = Ppbje::where([['ppbje_type', '=', 'ASSET'],['approved', '=', 'yes']])->whereMonth('updated_at', 12)->count();
            }
            else{
                $ppbje_totals       = Ppbje::where('maker_division', $div)->count();
                $ppbje_approving    = Ppbje::where([['maker_division', '=', $div],['approved', '=', 'no']])->count();
                $ppbje_processes    = Ppbje::where([
                    ['maker_division', '=', $div],['ppbje_status', '=', 'berlangsung']])
                ->orWhere([['maker_division', '=', $div],['ppbje_status', '=', 'persetujuan po']])
                ->orWhere([['maker_division', '=', $div],['ppbje_status', '=', 'menunggu kiriman']])
                ->count();
                $ppbje_finishes     = Ppbje::where([['maker_division', '=', $div],['ppbje_status', '=', 'selesai']])->count();
                $po_totals          = 0;
                $po_approving       = 0;
                $jan                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 1)->count();
                $feb                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 2)->count();
                $mar                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 3)->count();
                $apr                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 4)->count();
                $may                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 5)->count();
                $jun                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 6)->count();
                $jul                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 7)->count();
                $aug                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 8)->count();
                $sep                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 9)->count();
                $oct                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 10)->count();
                $nov                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 11)->count();
                $dec                = Ppbje::where([['maker_division', $div],['approved', '=', 'yes']])->whereMonth('updated_at', 12)->count();
            }
        }
        elseif($pos == "Manager"){
            if($div == "Operational 1"){
                $ppbje_totals       = Ppbje::where([
                    ['cost_total', '>', 2000000],
                    ['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],
                    ['approved', 'chief']
                ])
                ->orWhere([['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['cost_total', '>', 2000000],['approved', 'manager']])
                ->orWhere([['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['cost_total', '>', 2000000],['approved', 'senior manager']])
                ->orWhere([['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['cost_total', '>', 2000000],['approved', 'yes']])
                ->count();
                $ppbje_approving    = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', 'chief']])->count();
                $ppbje_processes    = Ppbje::where([
                    ['cost_total', '>', 2000000],
                    ['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],
                    ['ppbje_status', '=', 'berlangsung']])
                ->orWhere([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_status', '=', 'persetujuan po']])
                ->orWhere([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_status', '=', 'menunggu kiriman']])
                ->count();
                $ppbje_finishes     = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['ppbje_status', '=', 'selesai']])->count();
                $po_totals          = 0;
                $po_approving       = 0;
                $jan                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 1)->count();
                $feb                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 2)->count();
                $mar                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 3)->count();
                $apr                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 4)->count();
                $may                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 5)->count();
                $jun                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 6)->count();
                $jul                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 7)->count();
                $aug                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 8)->count();
                $sep                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 9)->count();
                $oct                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 10)->count();
                $nov                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 11)->count();
                $dec                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional A', 'Regional B', 'Regional C']],['approved', "yes"]])->whereMonth('updated_at', 12)->count();
            }
            elseif($div == "Operational 2"){
                $ppbje_totals       = Ppbje::where([
                    ['cost_total', '>', 2000000],
                    ['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],
                    ['approved', 'chief']
                ])
                ->orWhere([['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['cost_total', '>', 2000000],['approved', 'manager']])
                ->orWhere([['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['cost_total', '>', 2000000],['approved', 'senior manager']])
                ->orWhere([['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['cost_total', '>', 2000000],['approved', 'yes']])
                ->count();
                $ppbje_approving    = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', 'chief']])->count();
                $ppbje_processes    = Ppbje::where([
                    ['cost_total', '>', 2000000],
                    ['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],
                    ['ppbje_status', '=', 'berlangsung']])
                ->orWhere([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_status', '=', 'persetujuan po']])
                ->orWhere([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_status', '=', 'menunggu kiriman']])
                ->count();
                $ppbje_finishes     = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['ppbje_status', '=', 'selesai']])->count();
                $po_totals          = 0;
                $po_approving       = 0;
                $jan                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 1)->count();
                $feb                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 2)->count();
                $mar                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 3)->count();
                $apr                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 4)->count();
                $may                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 5)->count();
                $jun                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 6)->count();
                $jul                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 7)->count();
                $aug                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 8)->count();
                $sep                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 9)->count();
                $oct                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 10)->count();
                $nov                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 11)->count();
                $dec                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', ['Regional D', 'Regional E', 'Regional F']],['approved', "yes"]])->whereMonth('updated_at', 12)->count();
            }
            else{
                $ppbje_totals = Ppbje::where([
                    ['maker_division', '=', $div],['cost_total', '>', 2000000],['approved', 'chief']
                ])
                ->orWhere([['maker_division', '=', $div],['cost_total', '>', 2000000],['approved', 'manager']])
                ->orWhere([['maker_division', '=', $div],['cost_total', '>', 2000000],['approved', 'senior manager']])
                ->orWhere([['maker_division', '=', $div],['cost_total', '>', 2000000],['approved', 'yes']])
                ->count();
                $ppbje_approving    = Ppbje::where([['maker_division', '=', $div],['cost_total', '>', 2000000],['approved', '=', 'chief']])->count();
                $ppbje_processes    = Ppbje::where([
                    ['cost_total', '>', 2000000],['maker_division', '=', $div],['ppbje_status', '=', 'berlangsung']])
                ->orWhere([['cost_total', '>', 2000000],['maker_division', '=', $div],['ppbje_status', '=', 'persetujuan po']])
                ->orWhere([['cost_total', '>', 2000000],['maker_division', '=', $div],['ppbje_status', '=', 'menunggu kiriman']])
                ->count();
                $ppbje_finishes     = Ppbje::where([['cost_total', '>', 2000000],['maker_division', '=', $div],['ppbje_status', '=', 'selesai']])->count();
                $po_totals          = Purchase::where([
                    ['purchase_total', '>', 2000000],['approved', "chief"]])
                ->orWhere([['purchase_total', '>', 2000000],['approved', "manager"]])
                ->orWhere([['purchase_total', '>', 2000000],['approved', "senior manager"]])
                ->orWhere([['purchase_total', '>', 2000000],['approved', "yes"]])
                ->count();
                $po_approving       = Purchase::where([['purchase_total', '>', 2000000],['approved', "chief"]])->count();
                $jan                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 1)->count();
                $feb                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 2)->count();
                $mar                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 3)->count();
                $apr                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 4)->count();
                $may                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 5)->count();
                $jun                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 6)->count();
                $jul                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 7)->count();
                $aug                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 8)->count();
                $sep                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 9)->count();
                $oct                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 10)->count();
                $nov                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 11)->count();
                $dec                = Ppbje::where([['cost_total', '>', 2000000],['maker_division', $div],['approved', "yes"]])->whereMonth('updated_at', 12)->count();
            }
        }
        elseif($pos == "Senior Manager"){
            $ppbje_totals       = Ppbje::where([
                ['cost_total', '>', 5000000],['approved', 'manager']])
            ->orWhere([['cost_total', '>', 5000000],['approved', 'senior manager']])
            ->orWhere([['cost_total', '>', 5000000],['approved', 'yes']])
            ->count();
            $ppbje_approving    = Ppbje::where([['cost_total', '>', 5000000],['approved', 'manager']])->count();
            $po_totals          = Purchase::where([
                ['purchase_total', '>', 5000000],['approved', "manager"]])
            ->orWhere([['purchase_total', '>', 5000000],['approved', "senior manager"]])
            ->orWhere([['purchase_total', '>', 5000000],['approved', "yes"]])
            ->count();
            $po_approving       = Purchase::where([['purchase_total', '>', 5000000],['approved', "manager"]])->count();
            $ppbje_processes    = Ppbje::where([['cost_total', '>', 5000000],['ppbje_status', '=', 'berlangsung']])->count();
            $ppbje_finishes     = Ppbje::where([['cost_total', '>', 5000000],['ppbje_status', '=', 'selesai']])->count();
            $jan                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 1)->count();
            $feb                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 2)->count();
            $mar                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 3)->count();
            $apr                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 4)->count();
            $may                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 5)->count();
            $jun                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 6)->count();
            $jul                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 7)->count();
            $aug                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 8)->count();
            $sep                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 9)->count();
            $oct                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 10)->count();
            $nov                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 11)->count();
            $dec                = Ppbje::where([['cost_total', '>', 5000000],['approved', "yes"]])->whereMonth('updated_at', 12)->count();
        }
        elseif($pos == "Direktur"){
            $ppbje_totals       = Ppbje::where([
                ['cost_total', '>', 10000000],
                ['approved', 'senior manager']
            ])
            ->orWhere([['cost_total', '>', 10000000],['approved', 'yes']])
            ->count();
            $ppbje_approving    = Ppbje::where([['cost_total', '>', 10000000],['approved', '=', 'senior manager']])->count();
            $po_totals          = Purchase::where([
                ['purchase_total', '>', 10000000],['approved', "senior manager"]])
            ->orWhere([['purchase_total', '>', 10000000],['approved', "yes"]])
            ->count();
            $po_approving       = Purchase::where([['purchase_total', '>', 10000000],['approved', "senior manager"]])->count();
            $ppbje_processes    = Ppbje::where([['cost_total', '>', 10000000],['ppbje_status', '=', 'berlangsung']])->count();
            $ppbje_finishes     = Ppbje::where([['cost_total', '>', 10000000],['ppbje_status', '=', 'selesai']])->count();
            $jan                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 1)->count();
            $feb                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 2)->count();
            $mar                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 3)->count();
            $apr                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 4)->count();
            $may                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 5)->count();
            $jun                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 6)->count();
            $jul                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 7)->count();
            $aug                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 8)->count();
            $sep                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 9)->count();
            $oct                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 10)->count();
            $nov                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 11)->count();
            $dec                = Ppbje::where([['cost_total', '>', 10000000],['approved', "yes"]])->whereMonth('updated_at', 12)->count();
        }

        return view('dashboard.index', [
            "url"               => "",
            "title"             => "Dashboard",
            "path"              => "Dashboard",
            "ppbje_totals"      => $ppbje_totals,
            "po_totals"         => $po_totals,
            "ppbje_processes"   => $ppbje_processes,
            "ppbje_finishes"    => $ppbje_finishes,
            "ppbje_approving"   => $ppbje_approving,
            "po_approving"      => $po_approving,
            "thisYear"          => $thisYear,
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
