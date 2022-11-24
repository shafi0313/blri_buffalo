<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Community;
use App\Models\Deworming;
use App\Models\AnimalInfo;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Exports\DewormingExport;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class DewormingController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new DewormingExport(), 'deworming.xlsx');
    }

    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $dewormings = Deworming::all();
        } else {
            $dewormings = Deworming::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.deworming.pdf', compact('dewormings'));
        return $pdf->download('deworming.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $dewormings = Deworming::whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $dewormings = Deworming::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        return view('admin.deworming.index', compact('dewormings'));
    }


    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.deworming.create', compact('farms', 'communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.deworming.create', compact('communities'));
        }
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'medicine_name'  => 'required|max:100',
            'deworming_date'  => 'required|date',
            'dose'  => 'required|max:100',
        ]);

        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();

        $getGroup = Deworming::max('group') + 1;
        if ($request->dew_type == 'single') {
            $data = [
                'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
                'user_id' => Auth::user()->id,
                'group' => $getGroup,
                'medicine_name' => $request->medicine_name,
                'deworming_date' => $request->deworming_date,
                'dose' => $request->dose,
                // 'total_vaccinated' => 1,
            ];
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
            Deworming::create($data);
        } else {
            if (Auth::user()->permission == 1) {
                if ($fOrC=='f') {
                    $animals = AnimalInfo::where('farm_id', $farmOrComId)->whereNull('community_cat_id')->get()->pluck('id');
                } else {
                    $animals = AnimalInfo::where('community_cat_id', $farmOrComId)->whereNull('farm_id')->whereCommunity_id($request->community_id)->get()->pluck('id');
                }
            } else {
                $animals = AnimalInfo::where('community_cat_id', $communityCat->id)->whereCommunity_id($request->community_id)->get()->pluck('id');
            }

            foreach ($animals as $key => $value) {
                $data = [
                    'animal_info_id' => $animals[$key],
                    'user_id' => Auth::user()->id,
                    'group' => $getGroup,
                    'medicine_name' => $request->medicine_name,
                    'deworming_date' => $request->deworming_date,
                    'dose' => $request->dose,
                ];
                // $data['total_vaccinated'] = count($animals);
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
                Deworming::create($data);
            }
        }



        // if (!empty($request->single) && empty($request->to)) {
        //     $data = [
        //         'animal_info_id' => $request->single,
        //         'user_id' => Auth::user()->id,
        //         'medicine_name' => $request->medicine_name,
        //         'deworming_date' => $request->deworming_date,
        //         'dose' => $request->dose,
        //     ];
        //     Deworming::create($data);
        // }else{
        //     $animals = AnimalInfo::whereBetween('id',[$request->to, $request->from])->get()->pluck('id');
        //     foreach($animals as $key => $value){
        //         $data = [
        //             'animal_info_id' => $animals[$key],
        //             'user_id' => Auth::user()->id,
        //             'medicine_name' => $request->medicine_name,
        //             'deworming_date' => $request->deworming_date,
        //             'dose' => $request->dose,
        //         ];
        //         Deworming::create($data);
        //     }
        // }

        try {
            // Deworming::create($data);
            toast('Success', 'success');
            // return redirect()->route('deworming.index');
            return back();
        } catch(\Exception $ex) {
            toast('Failed', 'error');
            return redirect()->back();
        }
    }

    public function show($group)
    {
        $dewormings = Deworming::whereGroup($group)->get();
        return view('admin.deworming.report', compact('dewormings'));
    }

    public function destroy($id)
    {
        Deworming::find($id)->delete();
        toast('Success', 'success');
        return redirect()->back();
    }
}
