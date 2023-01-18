<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Farm;
use App\Models\Community;
use App\Models\CommunityCat;
use App\Models\Morphometric;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Exports\MorphometricExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MorphometricController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new MorphometricExport, 'morphometric.xlsx');
    }
    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $morphometrics = Morphometric::all();
        } else {
            $morphometrics = Morphometric::where('user_id', Auth::user()->id)->get();
        }

        $pdf = PDF::loadView('admin.morphometric.pdf', compact('morphometrics'));
        return $pdf->download('morphometric.pdf');
    }
    public function index()
    {
        if (Auth::user()->permission == 1) {
            $morphometrics = Morphometric::all();
        } else {
            $morphometrics = Morphometric::where('user_id', Auth::user()->id)->get();
        }
        return view('admin.morphometric.index', compact('morphometrics'));
    }

    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.morphometric.create', compact('farms','communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.morphometric.create', compact('communities'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
        ]);

        DB::beginTransaction();
        $data = [
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            'user_id' => Auth::user()->id,
            'age' => $request->age,
            'body_lenght' => $request->body_lenght,
            'heart_girth' => $request->heart_girth,
        ];

        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();

        if (Auth::user()->permission == 1) {
            if($fOrC=='f'){
                $data['farm_id'] = $farmOrComId;
                $data['community_id'] = $request->community_id;
            }else{
                $data['community_cat_id'] = $farmOrComId;
                $data['community_id'] = $request->community_id;
            }
        } else {
            $data['community_cat_id'] = $communityCat->id; // for community
            $data['community_id'] = $request->community_id;
        }

        try{
            Morphometric::create($data);
            DB::commit();
            toast('Success','success');
            // return redirect()->route('morphometric.index');
            return back();
        }catch(\Exception $ex){
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
            $data = Morphometric::find($id);
            return view('admin.morphometric.edit', compact('farms','communityCats','data'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            $data = Morphometric::find($id);
            return view('admin.morphometric.edit', compact('communities','data'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
        ]);

        DB::beginTransaction();
        $data = [
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            'user_id' => Auth::user()->id,
            'age' => $request->age,
            'body_lenght' => $request->body_lenght,
            'heart_girth' => $request->heart_girth,
        ];

        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();

        if (Auth::user()->permission == 1) {
            if($fOrC=='f'){
                $data['farm_id'] = $farmOrComId;
                $data['community_id'] = $request->community_id;
            }else{
                $data['community_cat_id'] = $farmOrComId;
                $data['community_id'] = $request->community_id;
            }
        } else {
            $data['community_cat_id'] = $communityCat->id; // for community
            $data['community_id'] = $request->community_id;
        }


        try{
            Morphometric::find($id)->update($data);
            DB::commit();
            toast('Success','success');
            return redirect()->route('morphometric.index');
        }catch(\Exception $ex){
            // return $ex->getMessage();
            DB::rollBack();
            toast('Error'. $ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        Morphometric::find($id)->delete();
        toast('Successfully Deleted','success');
        return redirect()->back();
    }
}
