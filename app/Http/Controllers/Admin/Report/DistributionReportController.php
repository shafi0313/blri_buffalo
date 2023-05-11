<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use App\Models\CommunityCat;
use App\Models\Distribution;
use Illuminate\Http\Request;
use PDF;
use App\Exports\DistributionExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DistributionReportController extends Controller
{
    public function select(Request $request)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.report.distribution.select', compact('farms', 'communityCats'));
        } else {
            $distributions = Distribution::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
            return view('admin.distribution.index', compact('distributions'));
        }
    }

    public function report(Request $request)
    {
        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        if (Auth::user()->permission == 1) {
            if ($fOrC == 'f') {
                $distributions = Distribution::with(['animalInfo'])->whereFarm_id($farmOrComId)->whereNotIn('animal_info_id', isCulling())->get();
            } else {
                $distributions = Distribution::with(['animalInfo'])->whereCommunity_cat_id($farmOrComId)->whereNotIn('animal_info_id', isCullingUser())->get();
            }
        }
        return view('admin.distribution.index', compact('distributions'));
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
        return Excel::download(new DistributionExport($farm, $farm_id), 'Distribution.xlsx');
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
            $distributions = Distribution::with(['animalInfo'])->where($farm, '=', $farm_id)->whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $distributions = Distribution::with(['animalInfo'])->where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.distribution.pdf', compact('distributions'));
        return $pdf->download('Distribution.pdf');
    }
}
