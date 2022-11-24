<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Browser;
use App\Models\Farm;
use App\Models\Location;
use App\Models\AnimalCat;
use App\Models\Community;
use App\Models\AnimalInfo;
use App\Models\BodyWeight;
use App\Models\CommunityCat;
use App\Models\Reproduction;
use Illuminate\Http\Request;
use App\Exports\AnimalInfoExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AnimalInfoController extends Controller
{
    public function downloadSelect()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.animal_info.download_select', compact('farms', 'communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.animal_info.download_select', compact('communities'));
        }
    }

    public function exportIntoExcel()
    {
        return Excel::download(new AnimalInfoExport(), 'animal_information.xlsx');
        // return Excel::download(new AnimalInfoExport($farm,$farmOrComId,$community_id), 'animal_information.xlsx');
    }

    // public function exportIntoExcel(Request $request)
    // {
    //     $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
    //     $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
    //     $community_id = $request->community_id;
    //     if($fOrC=='f')
    //     {
    //         $farm = 'farm_id';
    //     }else{
    //         $farm = 'community_cat_id';
    //     }

    //     // return $farmOrComId;

    //     return Excel::download(new AnimalInfoExport, 'animal_information.xlsx');
    //     // return Excel::download(new AnimalInfoExport($farm,$farmOrComId,$community_id), 'animal_information.xlsx');
    // }

    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $animalInfos = AnimalInfo::all();
        } else {
            $animalInfos = AnimalInfo::where('user_id', Auth::user()->id)->get();
        }

        // return view('admin.animal_info.pdf', compact('animalInfos'));
        $pdf = PDF::loadView('admin.animal_info.pdf', compact('animalInfos'))->setPaper('a4', 'landscape');
        return $pdf->download('animal_information.pdf');
    }

    public function area()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.animal_info.area', compact('farms', 'communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.animal_info.area', compact('communities'));
        }
    }

    public function index()
    {
        // $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        // $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        // if (Auth::user()->permission == 1) {
        //     if($fOrC == 'f'){
        //         $animalInfos = AnimalInfo::whereFarm_id($farmOrComId)->get();
        //     }else{
        //         $animalInfos = AnimalInfo::whereCommunity_cat_id($farmOrComId)->get();
        //     }
        // } else {
        //     $animalInfos = AnimalInfo::where('user_id', Auth::user()->id)->get();
        // }

        if (Auth::user()->permission == 1) {
            $animalInfos = AnimalInfo::with(['location.getLocation','animalCat'])->get();
        } else {
            $animalInfos = AnimalInfo::with(['location.getLocation','animalCat'])->where('user_id', Auth::user()->id)->get();
        }
        return view('admin.animal_info.index', compact('animalInfos'));
    }

    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all();
            $communityCats = CommunityCat::all();
            $goatCats = AnimalCat::where('type', 1)->where('parent_id', 0)->get();
            $isAndroid = Browser::isAndroid();
            return view('admin.animal_info.create', compact('farms', 'communityCats', 'goatCats', 'isAndroid'));
        } else {
            $isAndroid = Browser::isAndroid();
            $goatCats = AnimalCat::where('type', 1)->where('parent_id', 0)->get();
            $communitys = Community::whereCommunity_cat_id(CommunityCat::where('user_id', Auth::user()->id)->first()->id)->get();
            $post = CommunityCat::where('user_id', Auth::user()->id)->first('post')->post;
            return view('admin.animal_info.create_com', compact('goatCats', 'isAndroid', 'communitys', 'post'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'animal_tag' => 'nullable|max:50',
            'ear_tag' => 'nullable|max:50',
            'sire' => 'nullable|max:64',
            'dam' => 'nullable|max:64',
            'color' => 'nullable|max:50',
            'sex' => 'required',
            'birth_wt' => 'required',
            'generation' => 'required',
            'paity' => 'nullable|integer',
            'dam_milk' => 'nullable|numeric',
            'd_o_b' => 'required|date',
            'death_date' => 'nullable|date',
            'remark' => 'nullable|max:100',
        ]);

        $animal_sub_cat_id = $request->animal_sub_cat_id;
        if ($animal_sub_cat_id==0) {
            $animal_sub_cat_id = null;
        } else {
            $animal_sub_cat_id = $request->animal_sub_cat_id;
        }
        DB::beginTransaction();
        $animalSl = AnimalInfo::max('animal_sl') + 1;
        $data = [
            'user_id' => auth()->user()->id,
            'animal_cat_id' => $request->animal_cat_id,
            'animal_sub_cat_id' => $animal_sub_cat_id,
            'sire' => $request->sire,
            'dam' => $request->dam,
            'type' => $request->type,
            'identification_no' => $request->identification_no,
            'buffalo_id' => $request->buffalo_id,
            'tattoo_no' => $request->tattoo_no,
            'animal_sl' => $animalSl,
            'color' => $request->color,
            'age_distribution' => $request->age_distribution,
            'sex' => $request->sex,
            'birth_wt' => $request->birth_wt,
            'generation' => $request->generation,
            'paity' => $request->paity,
            'dam_milk' => $request->dam_milk,
            'd_o_b' => $request->d_o_b,
            'season_o_birth' => $request->season_o_birth,
            'death_date' => $request->death_date,
            'age_distribution' => $request->age_distribution,
            'remark' => $request->remark,
        ];

        if (Auth::user()->permission != 1) {
            $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();
            $community = Community::whereId($request->community_id)->first()->no;
            $getAnimal_tag = AnimalInfo::where('community_cat_id', $communityCat->id)->where('community_id', $request->community_id)->count() + 1;
            $animal_tag = substr($communityCat->name, 0, 1).$community.$getAnimal_tag;
        }

        if (Auth::user()->permission == 1) {
            $data['farm_id'] = $request->farm_id;
            $data['community_cat_id'] = $request->community_cat_id;
            // $data['community_id'] = $request->community_id;
            $data['animal_tag'] = $request->animal_tag;
        } else {
            $data['community_cat_id'] = $communityCat->id;
            $data['community_id'] = $request->community_id;
            $data['animal_tag'] = $request->ear_tag;
            $data['ear_tag'] = $request->ear_tag;
        }
        $animalInfo = AnimalInfo::create($data);
        // Reproduction kidding date create or update
        // $dbGetAnimalInfo = AnimalInfo::select(['id','dam','d_o_b'])->where('dam', $request->dam)->first();
        // if (!empty($dbGetAnimalInfo)) {
        //     $dbGetReproduction = Reproduction::where('animal_info_id', $dbGetAnimalInfo->id)->first();
        //     // $data = \Carbon\Carbon::parse($dbGetAnimalInfo->d_o_b)->diff( $request->d_o_b)->format('%y years %m months');
        //     if ($dbGetReproduction==null || $dbGetReproduction->count() < 1) {
        //         $reproduction = [
        //         'user_id' => auth()->user()->id,
        //         'animal_info_id' => $dbGetAnimalInfo->id,
        //         'calving_1st_date' => $request->d_o_b,
        //     ];
        //     if (Auth::user()->permission == 1) {
        //         $reproduction['farm_id'] = $request->farm_id;
        //         $reproduction['community_cat_id'] = $request->community_cat_id;
        //         // $reproduction['community_id'] = $request->community_id;
        //         // $reproduction['animal_tag'] = $request->animal_tag;
        //     } else {
        //         $reproduction['community_cat_id'] = $communityCat->id;
        //         $reproduction['community_id'] = $request->community_id;
        //         // $reproduction['animal_tag'] = $animal_tag;
        //         // $reproduction['ear_tag'] = $request->ear_tag;
        //     }
        //         Reproduction::create($reproduction);
        //     } else {
        //         if ($dbGetReproduction->calving_1st_date == null) {
        //             $reproduction['calving_1st_date'] = $request->d_o_b;
        //         // $reproduction['litter_size_1st_kidding'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_2nd_date == null) {
        //             $reproduction['calving_2nd_date'] = $request->d_o_b;
        //         // $reproduction['calving_2nd_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_3rd_date == null) {
        //             $reproduction['calving_3rd_date'] = $request->d_o_b;
        //         // $reproduction['calving_3rd_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_4th_date == null) {
        //             $reproduction['calving_4th_date'] = $request->d_o_b;
        //         // $reproduction['calving_4th_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_5th_date == null) {
        //             $reproduction['calving_5th_date'] = $request->d_o_b;
        //         // $reproduction['calving_5th_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_6th_date == null) {
        //             $reproduction['calving_6th_date'] = $request->d_o_b;
        //         // $reproduction['calving_6th_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_7th_date == null) {
        //             $reproduction['calving_7th_date'] = $request->d_o_b;
        //         // $reproduction['calving_7th_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_8th_date == null) {
        //             $reproduction['calving_8th_date'] = $request->d_o_b;
        //         // $reproduction['calving_8th_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_9th_date == null) {
        //             $reproduction['calving_9th_date'] = $request->d_o_b;
        //         // $reproduction['calving_9th_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_10th_date == null) {
        //             $reproduction['calving_10th_date'] = $request->d_o_b;
        //             // $reproduction['calving_10th_liter'] = $request->litter_size;
        //         }
        //         if (Auth::user()->permission == 1) {
        //             $reproduction['farm_id'] = $request->farm_id;
        //             $reproduction['community_cat_id'] = $request->community_cat_id;
        //             // $reproduction['community_id'] = $request->community_id;
        //             // $reproduction['animal_tag'] = $request->animal_tag;
        //         } else {
        //             $reproduction['community_cat_id'] = $communityCat->id;
        //             $reproduction['community_id'] = $request->community_id;
        //             // $reproduction['animal_tag'] = $animal_tag;
        //             // $reproduction['ear_tag'] = $request->ear_tag;
        //         }
        //         Reproduction::where('id', $dbGetReproduction->id)->update($reproduction);
        //     }
        // }

        if (!is_null($request->birth_wt)) {
            $bodyWt = [
                'user_id'        => Auth::user()->id,
                'animal_info_id' => $animalInfo->id,
                'day_0'          => $request->birth_wt,
            ];
            if (Auth::user()->permission == 1) {
                $bodyWt['farm_id']          = $request->farm_id;
                $bodyWt['community_cat_id'] = $request->community_cat_id;
            // $bodyWt['community_id'] = $request->community_id;
            } else {
                $bodyWt['community_cat_id'] = $communityCat->id;
                $bodyWt['community_id']     = $request->community_id;
                $bodyWt['animal_tag']       = $animal_tag;
                $bodyWt['ear_tag']          = $request->ear_tag;
            }
            BodyWeight::create($bodyWt);
        }

        // For location
        $district_id = DB::table("districts")
            ->select("id", DB::raw("6371 * acos(cos(radians(" . $request->lat . "))
                * cos(radians(lat))
                * cos(radians(lon) - radians(" . $request->lon . "))
                + sin(radians(" .$request->lat. "))
                * sin(radians(lat))) AS distance"))
                // ->groupBy("id")
                ->orderBy("distance")
                ->whereNotNull('lat')
                ->first();

        if (!empty($district_id)) {
            $district_id = $district_id;
        } else {
            $district_id = '';
        }

        $locationData = [
            'animal_info_id' => $animalInfo->id,
            'district_id' => $district_id->id,
            'lat' => $request->lat,
            'lon' => $request->lon,
        ];
        Location::create($locationData);

        // $animalInfo = $animalInfoStoreRequest->validated();
        try {
            DB::commit();
            toast('Success', 'success');
            return redirect()->route('animal-info.index');
        } catch (\Exception $ex) {
            // // return $ex->getMessage();
            DB::rollBack();
            toast('Error'. $ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all();
            $communityCats = CommunityCat::all();
            $goatCats = AnimalCat::where('type', 1)->where('parent_id', 0)->get();
            $isAndroid = Browser::isAndroid();
            $animalInfo = AnimalInfo::find($id);
            return view('admin.animal_info.edit', compact('farms', 'communityCats', 'goatCats', 'isAndroid', 'animalInfo'));
        } else {
            $isAndroid = Browser::isAndroid();
            $goatCats = AnimalCat::where('type', 1)->where('parent_id', 0)->get();
            // $communityCat = ;
            // return CommunityCat::where('user_id', Auth::user()->id)->first()->id;
            $communitys = Community::whereCommunity_cat_id(CommunityCat::where('user_id', Auth::user()->id)->first()->id)->get();
            $animalInfo = AnimalInfo::find($id);
            $post = CommunityCat::where('user_id', Auth::user()->id)->first('post')->post;
            return view('admin.animal_info.edit_com', compact('goatCats', 'isAndroid', 'communitys', 'animalInfo', 'post'));
        }
    }

    public function update($id, Request $request)
    {
        $animal_sub_cat_id = $request->animal_sub_cat_id;
        if ($animal_sub_cat_id==0) {
            $animal_sub_cat_id = null;
        } else {
            $animal_sub_cat_id = $request->animal_sub_cat_id;
        }

        $animalType = AnimalCat::find($request->animal_cat_id)->type;
        DB::beginTransaction();

        $animalSl = AnimalInfo::max('animal_sl') +1;

        $data = [
            'user_id' => auth()->user()->id,
            // 'animal_cat_id' => $request->animal_cat_id,
            // 'animal_sub_cat_id' => $animal_sub_cat_id,
            'sire'              => $request->sire,
            'dam'               => $request->dam,
            'type'              => $request->type,
            'identification_no' => $request->identification_no,
            'buffalo_id'        => $request->buffalo_id,
            'tattoo_no'         => $request->tattoo_no,
            'animal_sl'         => $animalSl,
            'color'             => $request->color,
            'age_distribution'  => $request->age_distribution,
            'sex'               => $request->sex,
            'birth_wt'          => $request->birth_wt,
            'generation'        => $request->generation,
            'paity'             => $request->paity,
            'dam_milk'          => $request->dam_milk,
            'd_o_b'             => $request->d_o_b,
            'season_o_birth'    => $request->season_o_birth,
            'death_date'        => $request->death_date,
            'age_distribution'  => $request->age_distribution,
            'remark'            => $request->remark,
        ];

        if (!empty($request->animal_cat_id)) {
            $data['animal_cat_id'] = $request->animal_cat_id;
        }
        if (!empty($request->animal_sub_cat_id)) {
            $data['animal_sub_cat_id'] = $request->animal_sub_cat_id;
        }


        if (Auth::user()->permission != 1) {
            $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();
            $community = Community::whereId($request->community_id)->first()->no;
            $getAnimal_tag = AnimalInfo::where('community_cat_id', $communityCat->id)->where('community_id', $request->community_id)->count() + 1;
            $animal_tag = substr($communityCat->name, 0, 1).$community.$getAnimal_tag;
        }


        if (Auth::user()->permission == 1) {
            $request->farm_id!='' ? $data['farm_id'] = $request->farm_id : false;
            $request->community_cat_id!='' ? $data['community_cat_id'] = $request->community_cat_id : false;
            $request->community_id != 0 ? $data['community_id'] = $request->community_id : false;
            $request->animal_tag !='' ? $data['animal_tag'] = $request->animal_tag : false;
        } else {
            $communityCat->id!='' ? $data['community_cat_id'] = $communityCat->id : false;
            $request->community_id != 0 ? $data['community_id'] = $request->community_id : false;
            if ($request->if_farm_change==1) {
                $animal_tag!='' ? $data['animal_tag'] = $animal_tag : false;
            }

            $request->ear_tag!='' ? $data['ear_tag'] = $request->ear_tag : false;
        }

        $animalInfo = AnimalInfo::whereId($id)->update($data);

        // Reproduction kidding date create or update

        // $dbGetAnimalInfo = AnimalInfo::select(['id','dam','d_o_b'])->where('dam', $request->dam)->first();
        // if (!empty($dbGetAnimalInfo)) {
        //     $dbGetReproduction = Reproduction::where('animal_info_id', $dbGetAnimalInfo->id)->first();
        //     if ($dbGetReproduction==null || $dbGetReproduction->count() < 1) {
        //         $reproduction = [
        //         'user_id' => auth()->user()->id,
        //         'animal_info_id' => $dbGetAnimalInfo->id,
        //         'calving_1st_date' => $request->d_o_b,
        //     ];
        //         Reproduction::create($reproduction);
        //     } else {
        //         if ($dbGetReproduction->calving_1st_date == null) {
        //             $reproduction['calving_1st_date'] = $request->d_o_b;
        //             $reproduction['litter_size_1st_kidding'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_2nd_date == null) {
        //             $reproduction['calving_2nd_date'] = $request->d_o_b;
        //             $reproduction['calving_2nd_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_3rd_date == null) {
        //             $reproduction['calving_3rd_date'] = $request->d_o_b;
        //             $reproduction['calving_3rd_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_4th_date == null) {
        //             $reproduction['calving_4th_date'] = $request->d_o_b;
        //             $reproduction['calving_4th_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_5th_date == null) {
        //             $reproduction['calving_5th_date'] = $request->d_o_b;
        //             $reproduction['calving_5th_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_6th_date == null) {
        //             $reproduction['calving_6th_date'] = $request->d_o_b;
        //             $reproduction['calving_6th_liter'] = $request->litter_size;
        //         } elseif ($dbGetReproduction->calving_7th_date == null) {
        //             $reproduction['calving_7th_date'] = $request->d_o_b;
        //             $reproduction['calving_7th_liter'] = $request->litter_size;
        //         }elseif ($dbGetReproduction->calving_8th_date == null) {
        //             $reproduction['calving_8th_date'] = $request->d_o_b;
        //             $reproduction['calving_8th_liter'] = $request->litter_size;
        //         }elseif ($dbGetReproduction->calving_9th_date == null) {
        //             $reproduction['calving_9th_date'] = $request->d_o_b;
        //             $reproduction['calving_9th_liter'] = $request->litter_size;
        //         }elseif ($dbGetReproduction->calving_10th_date == null) {
        //             $reproduction['calving_10th_date'] = $request->d_o_b;
        //             $reproduction['calving_10th_liter'] = $request->litter_size;
        //         }
        //         Reproduction::where('id', $dbGetReproduction->id)->update($reproduction);
        //     }
        // }

        // For location
        // $district_id = DB::table("districts")
        //     ->select("id", DB::raw("6371 * acos(cos(radians(" . $request->lat . "))
        //         * cos(radians(lat))
        //         * cos(radians(lon) - radians(" . $request->lon . "))
        //         + sin(radians(" .$request->lat. "))
        //         * sin(radians(lat))) AS distance"))
        //         ->groupBy("id")
        //         ->orderBy("distance")
        //         ->whereNotNull('lat')
        //         ->first();

        // if (!empty($district_id)) {
        //     $district_id = $district_id;
        // } else {
        //     $district_id = '';
        // }

        // $locationData = [
        //     'animal_info_id' => $animalInfo->id,
        //     'district_id' => $district_id->id,
        //     'lat' => $request->lat,
        //     'lon' => $request->lon,
        // ];
        // Location::create($locationData);

        // $animalInfo = $animalInfoStoreRequest->validated();
        try {
            DB::commit();
            toast('Success', 'success');
            return redirect()->route('animal-info.index');
        } catch (\Exception $ex) {
            // return $ex->getMessage();
            DB::rollBack();
            toast('Error'. $ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        AnimalInfo::find($id)->delete();
        Reproduction::whereAnimal_info_id($id)->delete() || false;
        toast('Successfully Deleted', 'success');
        return redirect()->back();
    }

    public function getFarm(Request $request)
    {
        $farms = Community::where('farm_id', $request->farm_id)->get();
        $farmName = '<option value="">Select</option>';
        foreach ($farms as $farm) {
            $s = $farm->id == $request->get_farm_id ? 'selected' : '';
            $farmName .= "<option value='$farm->id' $s>".str_pad($farm->no, 3, 0, STR_PAD_LEFT)."</option>";
        }
        return json_encode(['farmName' => $farmName]);
    }

    public function getCommunity(Request $request)
    {
        $Communities = Community::where('community_cat_id', $request->community_cat)->get();
        $comName = '<option value="">Select</option>';
        foreach ($Communities as $community) {
            $s = $community->id == $request->get_community_id ? 'selected' : '';
            $comName .= "<option value='$community->id' $s>$community->no</option>";
        }
        return json_encode(['comName'=>$comName]);
    }

    public function getAnimalCat(Request $request)
    {
        $animalCats = AnimalCat::where('parent_id', $request->animalCatId)->get();
        $animal = '<option value="">Select</option>';
        foreach ($animalCats as $animalCat) {
            $s = $animalCat->id == $request->animal_sub_cat_id ? 'selected' : '';
            $animal .= "<option value='$animalCat->id' $s>$animalCat->name</option>";
        }
        return json_encode(['animal'=>$animal]);
    }

    public function getAnimalFarm(Request $request)
    {
        $animalId = AnimalInfo::select('animal_tag', 'farm_id')->where('farm_id', $request->farmSelect)->count() + 1;
        return json_encode(['animalId'=>$animalId]);
    }

    public function getAnimalCommunity(Request $request)
    {
        $animalId = AnimalInfo::select('animal_tag', 'community_cat_id')->where('community_cat_id', $request->farmCommunity)->count() + 1;
        return json_encode(['animalId'=>$animalId]);
    }

    public function identificationNoFarm(Request $request)
    {
        if ($request->ajax()) {
            $identificationNo = Farm::find($request->id);
            return response()->json(['identificationNo'=>$identificationNo,'status'=>200]);
        }
    }
    public function identificationNoCom(Request $request)
    {
        if ($request->ajax()) {
            $identificationNo = CommunityCat::find($request->id);
            return response()->json(['identificationNo'=>$identificationNo,'status'=>200]);
        }
    }
    public function buffaloIdResearch(Request $request)
    {
        if ($request->ajax()) {
            $buffaloId = str_pad(AnimalInfo::whereFarm_id($request->id)->max('buffalo_id') + 1, 5, 0, STR_PAD_LEFT);
            return response()->json(['buffaloId'=>$buffaloId,'status'=>200]);
        }
    }
    public function buffaloId(Request $request)
    {
        if ($request->ajax()) {
            $buffaloId = str_pad(AnimalInfo::whereCommunity_id($request->id)->max('buffalo_id') + 1, 5, 0, STR_PAD_LEFT);
            return response()->json(['buffaloId'=>$buffaloId,'status'=>200]);
        }
    }
    public function buffaloIdUser(Request $request)
    {
        if ($request->ajax()) {
            $buffaloId = str_pad(AnimalInfo::whereUser_id(auth()->user()->id)->whereCommunity_id($request->id)->max('buffalo_id') + 1, 5, 0, STR_PAD_LEFT);
            return response()->json(['buffaloId'=>$buffaloId,'status'=>200]);
        }
    }
}
