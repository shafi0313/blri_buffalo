<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Community;
use App\Models\AnimalInfo;
use App\Models\CommunityCat;
use App\Models\Distribution;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Exports\DistributionExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DistributionController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new DistributionExport(), 'distribution.xlsx');
    }

    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $distributions = Distribution::whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $distributions = Distribution::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }
        $pdf = PDF::loadView('admin.distribution.pdf', compact('distributions'));
        return $pdf->download('distribution.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $distributions = Distribution::whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $distributions = Distribution::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }
        return view('admin.distribution.index', compact('distributions'));
    }

    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.distribution.create', compact('farms', 'communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.distribution.create', compact('communities'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'dis_type' => 'required',
            'dis_to' => 'required',
            'org_name' => 'required',
            'dis_date' => 'required',
        ]);

        $data = [
            'user_id' => Auth::user()->id,
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            'dis_type' => $request->dis_type,
            'dis_to' => $request->dis_to,
            'org_name' => $request->org_name,
            'dis_date' => $request->dis_date,
            'straw' => $request->straw,
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

        // return $data;

        DB::beginTransaction();

        try {
            Distribution::create($data);
            if ($request->dis_type=='Semen') {
                AnimalInfo::whereId($request->animal_info_id ?? $request->tattoo_no)->first()->update([
                    'status' => 2, // Distribution
                ]);
            }
            DB::commit();
            toast('Success', 'success');
            return redirect()->route('distribution.index');
        } catch(\Exception $ex) {
            // return $ex->getMessage();
            DB::rollBack();
            toast('Error'. $ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            $data = Distribution::find($id);
            return view('admin.distribution.edit', compact('farms', 'communityCats', 'data'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            $data = Distribution::find($id);
            return view('admin.distribution.edit', compact('communities', 'data'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'dis_type' => 'required',
            'dis_to' => 'required',
            'org_name' => 'required',
            'dis_date' => 'required',
        ]);

        $data = [
            'user_id' => Auth::user()->id,
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            'dis_type' => $request->dis_type,
            'dis_to' => $request->dis_to,
            'org_name' => $request->org_name,
            'dis_date' => $request->dis_date,
            'straw' => $request->straw,
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

        // return $data;

        DB::beginTransaction();

        try {
            Distribution::find($id)->update($data);
            if ($request->dis_type=='Semen') {
                AnimalInfo::whereId($request->animal_info_id)->first()->update([
                    'status' => 2, // Distribution
                ]);
            }
            DB::commit();
            toast('Success', 'success');
            return redirect()->route('distribution.index');
        } catch(\Exception $ex) {
            // return $ex->getMessage();
            DB::rollBack();
            toast('Error'. $ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        Distribution::find($id)->delete();
        toast('Successfully Deleted', 'success');
        return redirect()->back();
    }
}
