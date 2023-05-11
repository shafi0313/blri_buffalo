<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Models\MilkComposition;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MilkCompositionExport;

class MilkCompositionReportController extends Controller
{
    public function select(Request $request)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.report.milk_composition.select', compact('farms', 'communityCats'));
        } else {
            $milkCompositions = MilkComposition::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
            return view('admin.milk_composition.index', compact('milkCompositions'));
        }
    }

    public function report(Request $request)
    {
        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        if (Auth::user()->permission == 1) {
            if ($fOrC == 'f') {
                $milkCompositions = MilkComposition::with(['animalInfo'])->whereFarm_id($farmOrComId)->whereNotIn('animal_info_id', isCulling())->get();
            } else {
                $milkCompositions = MilkComposition::with(['animalInfo'])->whereCommunity_cat_id($farmOrComId)->whereNotIn('animal_info_id', isCullingUser())->get();
            }
        }
        return view('admin.milk_composition.index', compact('milkCompositions'));
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
        return Excel::download(new MilkCompositionExport($farm, $farm_id), 'Milk-composition.xlsx');
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
            $milkCompositions = MilkComposition::with(['animalInfo'])->where($farm, '=', $farm_id)->whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $milkCompositions = MilkComposition::with(['animalInfo'])->where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.milk_composition.pdf', compact('milkCompositions'));
        return $pdf->download('Milk-composition.pdf');
    }
}
