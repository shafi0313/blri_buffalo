<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Models\SemenAnalysis;
use PDF;
use App\Exports\SemenAnalysisExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SemenAnalysisReportController extends Controller
{
    public function select(Request $request)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.report.semen_analysis.select', compact('farms', 'communityCats'));
        } else {
            $semenAnalyses = SemenAnalysis::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
            return view('admin.semen_analysis.index', compact('semenAnalyses'));
        }
    }

    public function report(Request $request)
    {
        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        if (Auth::user()->permission == 1) {
            if ($fOrC == 'f') {
                $semenAnalyses = SemenAnalysis::with(['animalInfo'])->whereFarm_id($farmOrComId)->whereNotIn('animal_info_id', isCulling())->get();
            } else {
                $semenAnalyses = SemenAnalysis::with(['animalInfo'])->whereCommunity_cat_id($farmOrComId)->whereNotIn('animal_info_id', isCullingUser())->get();
            }
        }
        return view('admin.semen_analysis.index', compact('semenAnalyses'));
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
        return Excel::download(new SemenAnalysisExport($farm, $farm_id), 'Semen-analysis.xlsx');
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
            $semenAnalyses = SemenAnalysis::with(['animalInfo'])->where($farm, '=', $farm_id)->whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $semenAnalyses = SemenAnalysis::with(['animalInfo'])->where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.semen_analysis.pdf', compact('semenAnalyses'));
        return $pdf->download('Semen-analysis.pdf');
    }
}
