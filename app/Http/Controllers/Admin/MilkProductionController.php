<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Farm;
use App\Models\Community;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Models\MilkProduction;
use App\Models\MilkComposition;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MilkProductionExport;
use RealRashid\SweetAlert\Facades\Alert;

class MilkProductionController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new MilkProductionExport(), 'milk_production.xlsx');
    }
    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $milkProductions = MilkProduction::latest()->orderBy('created_at')->whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $milkProductions = MilkProduction::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.milk_production.pdf', compact('milkProductions'));
        return $pdf->download('milk_production.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $milkProductions = MilkProduction::latest()->orderBy('created_at')->whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $milkProductions = MilkProduction::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }
        return view('admin.milk_production.index', compact('milkProductions'));
    }

    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.milk_production.create', compact('farms', 'communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.milk_production.create', compact('communities'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'date_of_milking' => 'required|date',
            'milk_production' => 'required',
        ]);

        $data = [
            'user_id' => Auth::user()->id,
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            'date_of_milking' => $request->date_of_milking,
            'milk_production' => $request->milk_production,
            'lactation_length' => MilkProduction::whereAnimal_info_id($request->animal_info_id)->wherePeriod_count(0)->count()+1,
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
            MilkProduction::create($data);
            if ($request->draining_date != null) {
                $dataUpdate['draining_date'] = $request->draining_date;
                $dataUpdate['period_count'] = MilkProduction::whereAnimal_info_id($request->animal_info_id)->max('period_count')+1;
                MilkProduction::whereAnimal_info_id($request->animal_info_id)->wherePeriod_count(0)->update($dataUpdate);
                // milk composition period update
                $comDataUpdate['period_count'] = MilkComposition::whereAnimal_info_id($request->animal_info_id)->max('period_count')+1;
                MilkComposition::whereAnimal_info_id($request->animal_info_id)->wherePeriod_count(0)->update($comDataUpdate);
            }
            DB::commit();
            toast('Success', 'success');
            // return redirect()->route('milk-production.index');
            return back();
        } catch(\Exception $ex) {
            // // return $ex->getMessage();
            DB::rollBack();
            toast('Error'. $ex->getMessage(), 'error');
            return back();
        }
    }

    public function show($id)
    {
        $milkProductions = MilkProduction::where('animal_info_id', $id)->get();
        return view('admin.milk_production.report', compact('milkProductions'));
    }

    public function edit($id)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            $data = MilkProduction::find($id);
            return view('admin.milk_production.edit', compact('farms', 'communityCats', 'data'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            $data = MilkProduction::find($id);
            return view('admin.milk_production.edit', compact('communities', 'data'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'date_of_milking' => 'required',
            'milk_production' => 'required',
        ]);

        $data = [
            'user_id' => Auth::user()->id,
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            'date_of_milking' => $request->date_of_milking,
            'milk_production' => $request->milk_production,
            'lactation_length' => MilkProduction::whereAnimal_info_id($request->animal_info_id)->wherePeriod_count(0)->count()+1,
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
            $milkProduction = MilkProduction::find($id);
            $milkProduction->update($data);
            if ($milkProduction->draining_date!=null && $request->draining_date != null) {
                $dataUpdate['draining_date'] = $request->draining_date;
                $dataUpdate['period_count'] = MilkProduction::whereAnimal_info_id($request->animal_info_id)->max('period_count')+1;
                MilkProduction::whereAnimal_info_id($request->animal_info_id)->wherePeriod_count(0)->update($dataUpdate);
                // milk composition period update
                $comDataUpdate['period_count'] = MilkComposition::whereAnimal_info_id($request->animal_info_id)->max('period_count')+1;
                MilkComposition::whereAnimal_info_id($request->animal_info_id)->wherePeriod_count(0)->update($comDataUpdate);
            }
            DB::commit();
            toast('Success', 'success');
            return redirect()->route('milk-production.index');
        } catch(\Exception $ex) {
            // return $ex->getMessage();
            DB::rollBack();
            toast('Error'. $ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $check = MilkProduction::whereAnimal_info_id(MilkProduction::find($id)->animal_info_id)->count();
        try {
            if ($check > 1) {
                MilkProduction::find($id)->delete();
                Alert::success('Success', 'Successfully Deleted');
                return back();
            } else {
                MilkProduction::find($id)->delete();
                Alert::success('Success', 'Successfully Deleted');
                return redirect()->route('milk-composition.index');
            }
        } catch (\Exception $ex) {
            Alert::error('Oops...', 'Delete Failed');
            return back();
        }
    }

    public function destroyGroup($id)
    {
        try {
            MilkProduction::whereAnimal_info_id($id)->delete();
            Alert::success('Success', 'Successfully Deleted');
            return back();
        } catch (\Exception $ex) {
            Alert::error('Oops...', 'Delete Failed');
            return back();
        }
    }
}
