<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use App\Models\AnimalCat;
use App\Models\AnimalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class BlriDeathController extends Controller
{
    public function selectDate()
    {
        $animalCats = AnimalCat::where('parent_id',0)->get();
        $researchFarms = Farm::all();
        return view('admin.report.blri.death.select_date', compact('animalCats','researchFarms'));
    }

    public function report(Request $request)
    {
        $form_date = $request->get('form_date');
        $to_date = $request->get('to_date');
        $animal_cat_id = $request->get('animal_cat_id');
        $animal_sub_cat_id = $request->get('animal_sub_cat_id');
        $farm_id = $request->get('farm_id');

        if (!$animal_cat_id) {
            $animalCatDb = 'animal_cat_id';
            $animalCat = AnimalCat::select('id')->get()->pluck('id');
        } elseif ($animal_sub_cat_id==0) {
            $getAnimalCat = $animal_cat_id;
            $animalCat = explode(',', $getAnimalCat);
            $animalCatDb = 'animal_cat_id';
        } else {
            $getAnimalCat = $animal_sub_cat_id;
            $animalCat = explode(',', $getAnimalCat);
            $animalCatDb = 'animal_sub_cat_id';
        }

        if ($request->season_o_birth) {
            $get_season_o_birth = $request->season_o_birth;
            $season_o_birth = explode(',', $get_season_o_birth);
        } else {
            $get_season_o_birth = 'Rainy,Winter,Summer';
            $season_o_birth = explode(',', $get_season_o_birth);
        }

        if (AnimalInfo::whereIn($animalCatDb, $animalCat)->count() < 1) {
            Alert::error('Data Not Found');
            return back();
        }

        // $allAnimal = animalKid($to_date).animalGrowing($to_date).animalAdult($to_date);
        // $deaths = AnimalInfo::with(['death' => function ($q) use ($form_date, $to_date) {
        //     $q->where('dead_culled', 'Death')
        //     ->whereBetween('date_dead_culled', [$form_date,$to_date])->count();
        // }])->whereIn($animalCatDb, $animalCat)
        // ->get();

        // return$deaths = DeadCulled::with(['animalInfo' => function($q) use ($animalCatDb, $animalCat){
        //     $q->whereIn($animalCatDb, $animalCat);
        // }])
        // ->where('dead_culled', 'Death')
        // ->whereBetween('date_dead_culled', [$form_date,$to_date])
        // ->get();




        $deaths = DB::table('animal_infos')
                ->join('dead_culleds', 'dead_culleds.animal_info_id', '=', 'animal_infos.id')
                ->join('animal_cats', 'animal_cats.id', '=', 'animal_infos.animal_cat_id')
                // ->select('animal_infos.id','animal_infos.d_o_b','animal_infos.animal_cat_id','dead_culleds.animal_info_id','dead_culleds.dead_culled','animal_cats.name')
                // ->select('animal_infos.*','dead_culleds.*','animal_cats.*')
                ->where('reason', 'Death')
                ->whereIn($animalCatDb, $animalCat)
                ->whereBetween('date_dead_culled', [$form_date,$to_date]);
                // ->get();



        if ($deaths->count() < 1) {
            Alert::error('Data Not Found');
            return back();
        }

        $animals = AnimalInfo::whereIn($animalCatDb, $animalCat)
                ->where('farm_id', $farm_id)
                // ->whereBetween('d_o_b', [$form_date,$to_date])
                // ->where('status','!=',1)
                ->get();

        return view('admin.report.blri.death.report', compact('deaths','form_date','to_date','animals'));
    }
}
