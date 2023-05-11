<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use App\Models\DeadCulled;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Exports\DeadCulledExport;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DeadCulledReportController extends Controller
{
    public function select(Request $request)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.report.dead_culled.select', compact('farms', 'communityCats'));
        } else {
            $deadCulleds = DeadCulled::where('user_id', Auth::user()->id)->get();
            return view('admin.dead_culled.index', compact('deadCulleds'));
        }
    }

    public function report(Request $request)
    {
        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        if (Auth::user()->permission == 1) {
            if ($fOrC == 'f') {
                $deadCulleds = DeadCulled::with(['animalInfo'])->whereFarm_id($farmOrComId)->get();
            } else {
                $deadCulleds = DeadCulled::with(['animalInfo'])->whereCommunity_cat_id($farmOrComId)->get();
            }
        }
        return view('admin.dead_culled.index', compact('deadCulleds'));
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
        return Excel::download(new DeadCulledExport($farm, $farm_id), 'Dead-culled.xlsx');
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
            $deadCulleds = DeadCulled::with(['animalInfo'])->where($farm, '=', $farm_id)->get();
        } else {
            $deadCulleds = DeadCulled::with(['animalInfo'])->where('user_id', Auth::user()->id)->get();
        }

        $pdf = PDF::loadView('admin.dead_culled.pdf', compact('deadCulleds'));
        return $pdf->download('Dead-culled.pdf');
    }
}
