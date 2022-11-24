<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Farm;
use App\Models\Service;
use App\Models\Community;
use App\Models\AnimalInfo;
use App\Models\CommunityCat;
use App\Models\Reproduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ReproductionExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReproductionController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new ReproductionExport, 'reproduction.xlsx');
    }
    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $reproductions = Reproduction::whereNotIn('animal_info_id',isCulling())->get();
        } else {
            $reproductions = Reproduction::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id',isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.reproduction.pdf', compact('reproductions'))->setPaper('a4', 'landscape');
        return $pdf->download('reproduction.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $reproductions = Reproduction::whereNotIn('animal_info_id',isCulling())->get();
        } else {
            $reproductions = Reproduction::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id',isCullingUser())->get();
        }
        return view('admin.reproduction.index', compact('reproductions'));
    }

    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.reproduction.create', compact('farms','communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.reproduction.create', compact('communities'));
        }
    }

    public function store(Request $request)
    {
        $animal_info_id = $request->animal_info_id;
        $getReproduction = Reproduction::whereAnimal_info_id($request->animal_info_id)->first();

        DB::beginTransaction();

        $data['animal_info_id'] = $request->animal_info_id ?? $request->tattoo_no;
        $data['puberty_age'] = $request->puberty_age;
        $data['user_id'] = Auth::user()->id;
        if ($getReproduction != null) {
            if ($getReproduction->calving_1st_date == null) {
                $data['calving_1st_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_2nd_date == null) {
                $data['calving_2nd_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_3rd_date == null) {
                $data['calving_3rd_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_4th_date == null) {
                $data['calving_4th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_5th_date == null) {
                $data['calving_5th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_6th_date == null) {
                $data['calving_6th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_7th_date == null) {
                $data['calving_7th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_8th_date == null) {
                $data['calving_8th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_9th_date == null) {
                $data['calving_9th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_10th_date == null) {
                $data['calving_10th_date'] = $request->calving_date;
            }
        }else{
            $data['calving_1st_date'] = $request->calving_date;
        }

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

        $reproductions = Reproduction::whereAnimal_info_id($request->animal_info_id)->first();
        if(!empty($reproductions)){
            Reproduction::whereId($reproductions->id)->update($data);
        }else{
            Reproduction::create($data);
        }

        Service::whereAnimal_info_id($request->animal_info_id)->update(['is_pregnant' => 0]);

        try{
            DB::commit();
            toast('Success','success');
            return redirect()->route('reproduction-record.index');
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
            $data = Reproduction::find($id);
            return view('admin.reproduction.edit', compact('farms','communityCats','data'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            $data = Reproduction::find($id);
            return view('admin.reproduction.edit', compact('communities','data'));
        }
    }

    public function update(Request $request, $id)
    {
        $animal_info_id = $request->animal_info_id;
        $getReproduction = Reproduction::whereAnimal_info_id($request->animal_info_id)->first();

        DB::beginTransaction();

        $data['animal_info_id'] = $request->animal_info_id ?? $request->tattoo_no;
        $data['puberty_age'] = $request->puberty_age;
        $data['user_id'] = Auth::user()->id;
        if ($getReproduction != null) {
            if ($getReproduction->calving_1st_date == null) {
                $data['calving_1st_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_2nd_date == null) {
                $data['calving_2nd_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_3rd_date == null) {
                $data['calving_3rd_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_4th_date == null) {
                $data['calving_4th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_5th_date == null) {
                $data['calving_5th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_6th_date == null) {
                $data['calving_6th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_7th_date == null) {
                $data['calving_7th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_8th_date == null) {
                $data['calving_8th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_9th_date == null) {
                $data['calving_9th_date'] = $request->calving_date;
            } elseif ($getReproduction->calving_10th_date == null) {
                $data['calving_10th_date'] = $request->calving_date;
            }
        }else{
            $data['calving_1st_date'] = $request->calving_date;
        }

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


        Reproduction::find($id)->update($data);

        // Service::whereAnimal_info_id($request->animal_info_id)->update(['is_pregnant' => 0]);

        try{
            DB::commit();
            toast('Success','success');
            return redirect()->route('reproduction-record.index');
        }catch(\Exception $ex){
            // return $ex->getMessage();
            DB::rollBack();
            toast('Error'. $ex->getMessage(), 'error');
            return redirect()->back();
        }
    }


    public function getAnimalInfo(Request $request)
    {
        $animalInfoId = $request->animalInfoId;
        $animalInfos = AnimalInfo::where('id', $animalInfoId)->get();
        foreach($animalInfos as $animalInfo){
            $sex = $animalInfo->sex;
            $color = $animalInfo->color;
            $birth_wt = $animalInfo->birth_wt;
            $type = $animalInfo->type;
            $d_o_b = $animalInfo->d_o_b;
        }
        return json_encode(['sex'=>$sex, 'color'=>$color, 'birth_wt'=>$birth_wt, 'type'=>$type, 'd_o_b'=>$d_o_b]);
    }
}
