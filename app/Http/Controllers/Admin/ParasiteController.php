<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Parasite;
use App\Models\Community;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Exports\ParasiteExport;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ParasiteController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new ParasiteExport(), 'parasite.xlsx');
    }

    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $parasites = Parasite::all();
        } else {
            $parasites = Parasite::where('user_id', Auth::user()->id)->get();
        }

        $pdf = PDF::loadView('admin.parasite.pdf', compact('parasites'));
        return $pdf->download('parasite.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $parasites = Parasite::all();
        } else {
            $parasites = Parasite::where('user_id', Auth::user()->id)->get();
        }
        return view('admin.parasite.index', compact('parasites'));
    }


    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.parasite.create', compact('farms', 'communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.parasite.create', compact('communities'));
        }
    }


    public function store(Request $request)
    {
        $data = $this->validate($request, [
            // 'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'feces_collection_date'  => 'required|date',
            'fecal_egg_count'  => 'required',
            'season'  => 'required|max:100',
            'parasite_name'  => 'required|max:100',
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
            Parasite::create($data);
            toast('Success', 'success');
            // return redirect()->route('parasite.index');
            return back();
        } catch(\Exception $ex) {
            // return $ex->getMessage();
            toast('Failed', 'error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            $data = Parasite::find($id);
            return view('admin.parasite.edit', compact('farms', 'communityCats', 'data'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            $data = Parasite::find($id);
            return view('admin.parasite.edit', compact('communities', 'data'));
        }
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'feces_collection_date'  => 'required|date',
            'fecal_egg_count'  => 'required',
            'season'  => 'required|max:100',
            'parasite_name'  => 'required|max:100',
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
            Parasite::find($id)->update($data);
            toast('Success', 'success');
            return redirect()->route('parasite.index');
        } catch(\Exception $ex) {
            // return $ex->getMessage();
            toast('Failed', 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        Parasite::find($id)->delete();
        toast('Success', 'success');
        return redirect()->back();
    }
}
