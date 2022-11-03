<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\AnimalCat;
use App\Models\AnimalInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class DeathController extends Controller
{
    public function selectDate()
    {
        $animalCats = AnimalCat::where('parent_id',0)->get();
        return view('admin.report.death.select_date', compact('animalCats'));
    }

    public function report(Request $request)
    {
        $form_date = $request->get('form_date');
        $to_date = $request->get('to_date');
        $animal_cat_id = $request->get('animal_cat_id');
        $animal_sub_cat_id = $request->get('animal_sub_cat_id');

        if(!$animal_cat_id){
            $animalCatDb = 'animal_cat_id';
            $animalCat = AnimalCat::select('id')->get()->pluck('id');
        }else if($animal_sub_cat_id==0){
            $getAnimalCat = $animal_cat_id;
            $animalCat = explode(',', $getAnimalCat);
            $animalCatDb = 'animal_cat_id';
        }else{
            $getAnimalCat = $animal_sub_cat_id;
            $animalCat = explode(',', $getAnimalCat);
            $animalCatDb = 'animal_sub_cat_id';
        }

        if($request->season_o_birth){
            $get_season_o_birth = $request->season_o_birth;
            $season_o_birth = explode(',', $get_season_o_birth);
        }else{
            $get_season_o_birth = 'Rainy,Winter,Summer';
            $season_o_birth = explode(',', $get_season_o_birth);
        }

        if(AnimalInfo::whereIn($animalCatDb, $animalCat)->count() < 1){
            Alert::error('Data Not Found');
            return back();
        }

        // $allAnimal = animalKid($to_date).animalGrowing($to_date).animalAdult($to_date);
        $deaths = AnimalInfo::whereIn($animalCatDb, $animalCat)
                ->whereBetween('d_o_b', [$form_date,$to_date])
                // ->whereIn('season_o_birth', $season_o_birth)
                // ->whereIn('id', animalKid($to_date))
                // ->orWhereIn('id', animalGrowing($to_date))
                // ->orWhereIn('id', animalAdult($to_date))
                ->where('remark','Dead')
                ->get();

        if($deaths->count() < 1){
            Alert::error('Data Not Found');
            return back();
        }

        $animals = AnimalInfo::whereIn($animalCatDb, $animalCat)
                ->whereBetween('d_o_b', [$form_date,$to_date])
                ->where('remark','!=','Dead')
                ->get();

        return view('admin.report.death.report', compact('deaths','form_date','to_date','animals'));
    }
}
