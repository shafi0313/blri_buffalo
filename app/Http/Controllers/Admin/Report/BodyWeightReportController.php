<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use App\Models\BodyWeight;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Exports\BodyWeightExport;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BodyWeightReportController extends Controller
{
    public function select(Request $request)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.report.body_weight.select', compact('farms', 'communityCats'));
        } else {
            $productionRecords = BodyWeight::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
            return view('admin.report.body_weight.report', compact('productionRecords'));
        }
        // return view('admin.report.animal_info_select', compact('productionRecords'));
    }

    public function report(Request $request)
    {
        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        if (Auth::user()->permission == 1) {
            if ($fOrC == 'f') {
                $productionRecords = BodyWeight::with(['animalInfo'])->whereFarm_id($farmOrComId)->whereNotIn('animal_info_id', isCulling())->get();
            } else {
                $productionRecords = BodyWeight::with(['animalInfo'])->whereCommunity_cat_id($farmOrComId)->whereNotIn('animal_info_id', isCullingUser())->get();
            }
        }
        return view('admin.report.body_weight.report', compact('productionRecords'));
    }

    public function excel($farmId, $communityCatId)
    {
        if ($farmId != 0) {
            $farm = 'farm_id';
            $farm_id = $farmId;
        } else {
            $farm = 'community_cat_id';
            $farm_id = $communityCatId;
        }
        return Excel::download(new BodyWeightExport($farm, $farm_id), 'Body-weight.xlsx');
    }

    public function pdf($farmId, $communityCatId)
    {
        if ($farmId != 0) {
            $farm = 'farm_id';
            $farm_id = $farmId;
        } else {
            $farm = 'community_cat_id';
            $farm_id = $communityCatId;
        }

        if (Auth::user()->permission == 1) {
            $productionRecords = BodyWeight::with(['animalInfo'])->where($farm, '=', $farm_id)->whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $productionRecords = BodyWeight::with(['animalInfo'])->where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.body_weight.pdf', compact('productionRecords'));
        return $pdf->download('Body-weight.pdf');
    }
}
