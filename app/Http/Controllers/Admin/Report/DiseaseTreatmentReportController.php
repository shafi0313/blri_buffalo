<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Models\DiseaseTreatment;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DiseaseTreatmentExport;

class DiseaseTreatmentReportController extends Controller
{
    public function select(Request $request)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.report.disease_treatment.select', compact('farms', 'communityCats'));
        } else {
            $diseaseTreatments = DiseaseTreatment::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
            return view('admin.disease_treatment.index', compact('diseaseTreatments'));
        }
    }

    public function report(Request $request)
    {
        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        if (Auth::user()->permission == 1) {
            if ($fOrC == 'f') {
                $diseaseTreatments = DiseaseTreatment::with(['animalInfo','diseaseSign','diseaseSigns'])->whereFarm_id($farmOrComId)->whereNotIn('animal_info_id', isCulling())->get();
            } else {
                $diseaseTreatments = DiseaseTreatment::with(['animalInfo','diseaseSign','diseaseSigns'])->whereCommunity_cat_id($farmOrComId)->whereNotIn('animal_info_id', isCullingUser())->get();
            }
        }
        return view('admin.disease_treatment.index', compact('diseaseTreatments'));
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
        return Excel::download(new DiseaseTreatmentExport($farm, $farm_id), 'Disease-treatment.xlsx');
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
            $diseaseTreatments = DiseaseTreatment::where($farm, '=', $farm_id)->whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $diseaseTreatments = DiseaseTreatment::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.disease_treatment.pdf', compact('diseaseTreatments'));
        return $pdf->download('Disease-treatment.pdf');
    }
}
