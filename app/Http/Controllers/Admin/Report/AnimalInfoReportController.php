<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use PDF;
use App\Models\Community;
use App\Models\AnimalInfo;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export\AllReport\AnimalInfoExport;

class AnimalInfoReportController extends Controller
{
    public function select(Request $request)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.report.animal_info.select', compact('farms', 'communityCats'));
        } else {
            $animalInfos = AnimalInfo::with(['location.getLocation','animalCat'])->where('user_id', Auth::user()->id)->get();
            return view('admin.report.animal_info.report', compact('animalInfos'));
        }
        // return view('admin.report.animal_info_select', compact('animalInfos'));
    }

    public function report(Request $request)
    {
        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        if (Auth::user()->permission == 1) {
            if ($fOrC == 'f') {
                $animalInfos = AnimalInfo::with('getCommunity','animalCat','location.getLocation')->whereFarm_id($farmOrComId)->whereIs_culling(0)->get();
            } else {
                $animalInfos = AnimalInfo::with('getCommunity','animalCat','location.getLocation')->whereCommunity_cat_id($farmOrComId)->whereIs_culling(0)->get();
            }
        }
        return view('admin.report.animal_info.report', compact('animalInfos'));
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

        // return Excel::download(new AnimalInfoExport, 'animal_information.xlsx');
        return Excel::download(new AnimalInfoExport($farm, $farm_id), 'animal_information.xlsx');
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
            $animalInfos = AnimalInfo::with('getCommunity','animalCat','location.getLocation')->where($farm, '=', $farm_id)->whereIs_culling(0)->get();
        } else {
            $animalInfos = AnimalInfo::with('getCommunity','animalCat','location.getLocation')->where('user_id', Auth::user()->id)->whereIs_culling(0)->get();
        }

        $pdf = PDF::loadView('admin.animal_info.pdf', compact('animalInfos'))->setPaper('a4', 'landscape');
        return $pdf->download('animal_information.pdf');
    }
}
