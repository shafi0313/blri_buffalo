<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Community;
use App\Models\AnimalInfo;
use App\Models\DeadCulled;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Exports\DeadCulledExport;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DeadCulledController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new DeadCulledExport(), 'dead_culled.xlsx');
    }

    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $deadCulleds = DeadCulled::all();
        } else {
            $deadCulleds = DeadCulled::where('user_id', Auth::user()->id)->get();
        }

        $pdf = PDF::loadView('admin.dead_culled.pdf', compact('deadCulleds'));
        return $pdf->download('dead_culled.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $deadCulleds = DeadCulled::all();
        } else {
            $deadCulleds = DeadCulled::where('user_id', Auth::user()->id)->get();
        }
        return view('admin.dead_culled.index', compact('deadCulleds'));
    }


    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.dead_culled.create', compact('farms', 'communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.dead_culled.create', compact('communities'));
        }
    }


    public function store(Request $request)
    {
        $data = $this->validate($request, [
            // 'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'reason'  => 'required|max:196',
            'date_dead_culled'  => 'required|date',
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['animal_info_id'] = $request->animal_info_id ?? $request->tattoo_no;

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

        try {
            DeadCulled::create($data);
            $status = match ($request->reason) {
                'Death' => '1',
                'Sell' => '3',
                'Not suitable for research' => '4',
                'Breeding' => '5',
            };
            AnimalInfo::whereId($request->animal_info_id ?? $request->tattoo_no)->first()->update([
                'status' => $status,
                'is_culling' => 1,
            ]);
            toast('Success', 'success');
            return redirect()->route('dead-culled.index');
        } catch(\Exception $ex) {
            return $ex->getMessage();
            toast('Failed', 'error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            $data = DeadCulled::find($id);
            return view('admin.dead_culled.edit', compact('farms', 'communityCats', 'data'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            $data = DeadCulled::find($id);
            return view('admin.dead_culled.edit', compact('communities', 'data'));
        }
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'reason'  => 'required|max:196',
            'date_dead_culled'  => 'required|date',
        ]);
        $data['user_id'] = Auth::user()->id;

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

        try {
            DeadCulled::find($id)->update($data);
            $status = match ($request->reason) {
                'Death' => '1',
                'Sell' => '3',
                'Not suitable for research' => '4',
                'Breeding' => '5',
            };
            AnimalInfo::whereId($request->animal_info_id)->first()->update([
                'status' => $status,
                'is_culling' => 1,
            ]);
            toast('Success', 'success');
            return redirect()->route('dead-culled.index');
        } catch(\Exception $ex) {
            return $ex->getMessage();
            toast('Failed', 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        AnimalInfo::whereId(DeadCulled::find($id)->animal_info_id)->first()->update([
            'is_culling' => 0,
        ]);
        DeadCulled::find($id)->delete();
        toast('Success', 'success');
        return redirect()->back();
    }
}
