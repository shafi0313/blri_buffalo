<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Community;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Models\SemenAnalysis;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Exports\SemenAnalysisExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SemenAnalysisController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new SemenAnalysisExport(), 'semen_analysis.xlsx');
    }
    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $semenAnalyses = SemenAnalysis::whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $semenAnalyses = SemenAnalysis::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.semen_analysis.pdf', compact('semenAnalyses'));
        return $pdf->download('semen_analysis.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $semenAnalyses = SemenAnalysis::whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $semenAnalyses = SemenAnalysis::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }
        return view('admin.semen_analysis.index', compact('semenAnalyses'));
    }

    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.semen_analysis.create', compact('farms', 'communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.semen_analysis.create', compact('communities'));
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // 'animal_info_id'        => 'required_if:tattoo_no,==,NULL',
            'date'                  => 'required',
            'volume'                => 'required',
            'semen_color'           => 'required',
            'semen_type'            => 'required',
            'total_mortality'       => 'required',
            'progressive_mortality' => 'required',
            'sperm_concentration'   => 'required',
            'straw_prepared'        => 'required',
        ]);
        $data['animal_info_id'] = $request->animal_info_id ?? $request->tattoo_no;
        $data['user_id'] = Auth::user()->id;

        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();

        if (Auth::user()->permission == 1) {
            if ($fOrC=='f') {
                $data['farm_id']      = $farmOrComId;
                $data['community_id'] = $request->community_id;
            } else {
                $data['community_cat_id'] = $farmOrComId;
                $data['community_id']     = $request->community_id;
            }
        } else {
            $data['community_cat_id'] = $communityCat->id;       // for community
            $data['community_id']     = $request->community_id;
        }

        DB::beginTransaction();
        try {
            SemenAnalysis::create($data);
            DB::commit();
            toast('Success', 'success');
            return redirect()->route('semen-analysis.index');
        } catch(\Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
            toast('Error', 'error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            $data = SemenAnalysis::find($id);
            return view('admin.semen_analysis.edit', compact('farms', 'communityCats', 'data'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            $data = SemenAnalysis::find($id);
            return view('admin.semen_analysis.edit', compact('communities', 'data'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'date' => 'required',
            'volume' => 'required',
            'semen_color' => 'required',
            'semen_type' => 'required',
        ]);

        $data = [
            'user_id' => Auth::user()->id,
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            'date' => $request->date,
            'volume' => $request->volume,
            'semen_type' => $request->semen_type,
            'semen_color' => $request->semen_color,
            'straw_prepared' => $request->straw_prepared,
        ];

        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();

        if (Auth::user()->permission == 1) {
            if ($fOrC=='f') {
                $data['farm_id'] = $farmOrComId;
                $data['community_id'] = $request->community_id;
            } else {
                $data['community_cat_id'] = $farmOrComId;
                $data['community_id'] = $request->community_id;
            }
        } else {
            $data['community_cat_id'] = $communityCat->id; // for community
            $data['community_id'] = $request->community_id;
        }

        DB::beginTransaction();
        try {
            SemenAnalysis::find($id)->update($data);
            DB::commit();
            toast('Success', 'success');
            return redirect()->route('semen-analysis.index');
        } catch(\Exception $ex) {
            DB::rollBack();
            toast('Error', 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        SemenAnalysis::find($id)->delete();
        toast('Successfully Deleted', 'success');
        return redirect()->back();
    }
}
