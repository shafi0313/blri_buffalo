<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Farm;
use App\Models\Community;
use App\Models\BodyWeight;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Exports\BodyWeightExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BodyWeightController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new BodyWeightExport(), 'Calves Body Weight.xlsx');
    }

    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $productionRecords = BodyWeight::whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $productionRecords = BodyWeight::where('user_id', user()->id)->whereNotIn('animal_info_id', isCulling())->get();
        }

        $pdf = PDF::loadView('admin.body_weight.pdf', compact('productionRecords'))->setPaper('a4', 'landscape');
        return $pdf->download('Calves Body Weight.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $productionRecords = BodyWeight::with('animalInfo')->whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $productionRecords = BodyWeight::with('animalInfo')->where('user_id', user()->id)->whereNotIn('animal_info_id', isCulling())->get();
        }

        return view('admin.body_weight.index', compact('productionRecords'));
    }

    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.body_weight.create', compact('farms', 'communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.body_weight.create', compact('communities'));
        }
    }

    public function store(Request $request)
    {
        // $productionRecord = $query->validated();

        $birth_wt = $request->birth_wt;
        $animal_info_id = $request->animal_info_id;
        $data = [
            'user_id' => Auth::user()->id,
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            'day_0' => $request->day_0,
            'date_d_0' => $request->date_d_0,
            'day_15' => $request->day_15,
            'month_1' => $request->month_1,
            'month_2' => $request->month_2,
            'month_3' => $request->month_3,
            'month_6' => $request->month_6,
            'month_12' => $request->month_12,
            'month_18' => $request->month_18,
            'month_24' => $request->month_24,
            'month_30' => $request->month_30,
            'month_36' => $request->month_36,
            'month_42' => $request->month_42,
            'month_48' => $request->month_48,
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
            BodyWeight::where('animal_info_id', $animal_info_id)->update($data) || BodyWeight::create($data);
            DB::commit();
            toast('Success', 'success');
            return redirect()->route('body-weight.index');
        } catch(\Exception $ex) {
            return $ex->getMessage();
            DB::rollBack();
            toast($ex->getMessage(), 'Error', 'error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            $data = BodyWeight::find($id);
            return view('admin.body_weight.edit', compact('farms', 'communityCats', 'data'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            $data = BodyWeight::find($id);
            return view('admin.body_weight.edit', compact('communities', 'data'));
        }
    }

    public function update(Request $request, $id)
    {
        // $productionRecord = $query->validated();

        $birth_wt = $request->birth_wt;
        $animal_info_id = $request->animal_info_id;
        $data = [
            'user_id' => Auth::user()->id,
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            'day_0' => $request->day_0,
            'date_d_0' => $request->date_d_0,
            'day_15' => $request->day_15,
            'month_1' => $request->month_1,
            'month_2' => $request->month_2,
            'month_3' => $request->month_3,
            'month_6' => $request->month_6,
            'month_12' => $request->month_12,
            'month_18' => $request->month_18,
            'month_24' => $request->month_24,
            'month_30' => $request->month_30,
            'month_36' => $request->month_36,
            'month_42' => $request->month_42,
            'month_48' => $request->month_48,
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
            BodyWeight::where('animal_info_id', $animal_info_id)->update($data);
            DB::commit();
            toast('Success', 'success');
            return redirect()->route('body-weight.index');
        } catch(\Exception $ex) {
            return $ex->getMessage();
            DB::rollBack();
            toast($ex->getMessage(), 'Error', 'error');
            return redirect()->back();
        }
    }

    public function getBodyWeight(Request $request)
    {
        $animalInfoId = $request->animalInfoId;
        $bodyWeights = BodyWeight::where('animal_info_id', $animalInfoId)->get();
        if ($bodyWeights->count()>0) {
            foreach ($bodyWeights as $bodyWeight) {
                $day_0 = $bodyWeight->day_0;
                $date_d_0 = $bodyWeight->date_d_0;
                $day_15 = $bodyWeight->day_15;
                $month_1 = $bodyWeight->month_1;
                $month_2 = $bodyWeight->month_2;
                $month_3 = $bodyWeight->month_3;
                $month_6 = $bodyWeight->month_6;
                $month_12 = $bodyWeight->month_12;
                $month_18 = $bodyWeight->month_18;
                $month_24 = $bodyWeight->month_24;
                $month_30 = $bodyWeight->month_30;
                $month_36 = $bodyWeight->month_36;
                $month_42 = $bodyWeight->month_42;
                $month_48 = $bodyWeight->month_48;
                return json_encode(['day_0'=>$day_0, 'date_d_0'=>$date_d_0, 'day_15'=>$day_15, 'month_1'=>$month_1, 'month_2'=>$month_2, 'month_3'=>$month_3, 'month_6'=>$month_6, 'month_12'=>$month_12, 'month_18'=>$month_18,'month_24'=>$month_24, 'month_30'=>$month_30, 'month_36'=>$month_36, 'month_42'=>$month_42, 'month_48'=>$month_48 ]);
            }
        } else {
            return json_encode(['day_0'=>'', 'date_d_0'=>'', 'day_15'=>'', 'month_1'=>'', 'month_2'=>'', 'month_3'=>'', 'month_6'=>'', 'month_12'=>'', 'month_18'=>'', 'month_24'=>'', 'month_30'=>'', 'month_36'=>'', 'month_42'=>'', 'month_48'=>'' ]);
        }
    }
}
