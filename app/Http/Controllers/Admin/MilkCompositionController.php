<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Farm;
use App\Models\Community;
use App\Models\AnimalInfo;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Models\MilkComposition;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MilkCompositionExport;
use RealRashid\SweetAlert\Facades\Alert;

class MilkCompositionController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new MilkCompositionExport(), 'milk_composition.xlsx');
    }
    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $milkCompositions = MilkComposition::whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $milkCompositions = MilkComposition::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.milk_composition.pdf', compact('milkCompositions'));
        return $pdf->download('milk_composition.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $milkCompositions = MilkComposition::with('animalInfo')->whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $milkCompositions = MilkComposition::with('animalInfo')->where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }
        return view('admin.milk_composition.index', compact('milkCompositions'));
    }

    public function select()
    {
        if (Auth::user()->permission == 1) {
            $animalInfos = AnimalInfo::whereSex('F')->get();
            $farms = Farm::all();
            return view('admin.milk_composition.select', compact('animalInfos', 'farms'));
        } else {
            $animalInfos = AnimalInfo::where('user_id', Auth::user()->id)->whereSex('F')->get();
            return view('admin.milk_composition.select_com', compact('animalInfos'));
        }
    }

    public function create()
    {
        if (Auth::user()->permission == 1) {
            $animalInfos = AnimalInfo::all();
            $milkCompositions = MilkComposition::where('user_id', Auth::user()->id)->latest()->get();
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.milk_composition.create', compact('milkCompositions', 'animalInfos', 'farms', 'communityCats'));
        } else {
            $milkCompositions = MilkComposition::where('user_id', Auth::user()->id)->latest()->get();
            $milkData = MilkComposition::where('user_id', Auth::user()->id)->wherePeriod_count(0)->latest()->first();
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.milk_composition.create_com', compact('milkCompositions', 'milkData', 'communities'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'date' => 'required',
            'production' => 'required',
            'fat' => 'required',
            'density' => 'required',
            'lactose' => 'required',
            'snf' => 'required',
            'protein' => 'required',
            'water' => 'required',
            'temperature' => 'required',
            'freezing_point' => 'required',
            'salt' => 'required',
        ]);
        $milkComposition = MilkComposition::where('animal_info_id', $request->animal_info_id)->latest();


        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();

        if ($request->milk_type == 'ind' || Auth::user()->permission == 2) {
            $data = [
                'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
                'user_id' => Auth::user()->id,
                'date' => $request->date,
                'production' => $request->production,
                'fat' => $request->fat,
                'density' => $request->density,
                'lactose' => $request->lactose,
                'snf' => $request->snf,
                'protein' => $request->protein,
                'water' => $request->water,
                'temperature' => $request->temperature,
                'freezing_point' => $request->freezing_point,
                'salt' => $request->salt,
                'remark' => $request->remark,
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


            if ($milkComposition->count() > 0) {
                $data['calving_date'] = $milkComposition->first()->calving_date;
            } else {
                $data['calving_date'] = $request->calving_date;
            }

            if (Auth::user()->permission == 1) {
                $data['type'] = 1;
                $data['day_count'] = $milkComposition->count() + 1;
            } else {
                $data['type'] = 2;
                $data['day_count'] = $request->day_count;
            }

            MilkComposition::create($data);
        } else {
            $animalInfos = AnimalInfo::whereFarm_id($request->farm_id)->get()->pluck('id');
            foreach ($animalInfos as $key => $value) {
                $data = [
                    'animal_info_id' => $value,
                    'user_id' => Auth::user()->id,
                    'date' => $request->date,
                    'production' => $request->production,
                    'fat' => $request->fat,
                    'density' => $request->density,
                    'lactose' => $request->lactose,
                    'snf' => $request->snf,
                    'protein' => $request->protein,
                    'water' => $request->water,
                    'temperature' => $request->temperature,
                    'freezing_point' => $request->freezing_point,
                    'salt' => $request->salt,
                    'type' => 2,
                    'remark' => $request->remark,
                ];
                if ($fOrC=='f') {
                    $data['farm_id'] = $farmOrComId;
                // $data['community_id'] = $request->community_id;
                } else {
                    $data['community_cat_id'] = $farmOrComId;
                    // $data['community_id'] = $request->community_id;
                }
                MilkComposition::create($data);
            }
        }



        // return $milkComposition->first()->calving_date;

        DB::beginTransaction();
        try {
            DB::commit();
            toast('Success', 'success');
            return redirect()->route('milk-composition.index');
        } catch(\Exception $ex) {
            return $ex->getMessage();
            DB::rollBack();
            toast('Error', 'error');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $milkCompositions = MilkComposition::with('animalInfo')->where('animal_info_id', $id)->whereNotIn('animal_info_id', isCulling())->get();
        return view('admin.milk_composition.show', compact('milkCompositions'));
    }

    public function getMilkComposition(Request $request)
    {
        $animalInfoId = $request->animalInfoId;
        $milkCompositions = MilkComposition::where('animal_info_id', $animalInfoId)->get();
        $milkCount = $milkCompositions->count();
        if ($milkCompositions->count()>0) {
            foreach ($milkCompositions as $milkComposition) {
                $calving_date = $milkComposition->calving_date;
                return json_encode(['calving_date'=>$calving_date, 'milkCount'=>$milkCount]);
            }
        } else {
            return json_encode(['calving_date'=>'', 'milkCount' => '']);
        }
    }

    public function destroy($id)
    {
        $check = MilkComposition::whereAnimal_info_id(MilkComposition::find($id)->animal_info_id)->count();
        try {
            if ($check > 1) {
                MilkComposition::find($id)->delete();
                Alert::success('Success', 'Successfully Deleted');
                return back();
            } else {
                MilkComposition::find($id)->delete();
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
            MilkComposition::whereAnimal_info_id($id)->delete();
            Alert::success('Success', 'Successfully Deleted');
            return back();
        } catch (\Exception $ex) {
            Alert::error('Oops...', 'Delete Failed');
            return back();
        }
    }
}
