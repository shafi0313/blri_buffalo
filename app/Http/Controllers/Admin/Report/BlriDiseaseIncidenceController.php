<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use App\Models\Disease;
use App\Models\AnimalCat;
use App\Models\AnimalInfo;
use Illuminate\Http\Request;
use App\Models\DiseaseTreatment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class BlriDiseaseIncidenceController extends Controller
{
    public function selectDate()
    {
        $animalCats = AnimalCat::where('parent_id',0)->get();
        $diseases = Disease::all();
        $researchFarms = Farm::all();
        return view('admin.report.blri.disease_incidence.select_date', compact('animalCats','diseases','researchFarms'));
    }

    public function report(Request $request)
    {
        $form_date = $request->get('form_date');
        $to_date = $request->get('to_date');
        $animal_cat_id = $request->get('animal_cat_id');
        $animal_sub_cat_id = $request->get('animal_sub_cat_id');
        $farm_id = $request->get('farm_id');

        if(!$animal_cat_id){
            $animalCatDb = 'animal_cat_id';
            $animalCat = AnimalCat::select('id')->get()->pluck('id');
        }
        else if($animal_sub_cat_id==0){
            $getAnimalCat = $animal_cat_id;
            $animalCat = explode(',', $getAnimalCat);
            $animalCatDb = 'animal_cat_id';
        }else{
            $getAnimalCat = $animal_sub_cat_id;
            $animalCat = explode(',', $getAnimalCat);
            $animalCatDb = 'animal_sub_cat_id';
        }

        if($request->disease_season){
            $get_disease_season = $request->disease_season;
            $disease_season = explode(',', $get_disease_season);

        }else{
            $get_disease_season = 'Rainy,Winter,Summer';
            $disease_season = explode(',', $get_disease_season);
        }

        if($request->disease_id){
            $getDisease = $request->disease_id;
            $disease = [explode(',', $getDisease)];

        }else{
            $disease = Disease::select('id')->get()->pluck('id');
        }

        if(AnimalInfo::whereIn($animalCatDb, $animalCat)->count() < 1){
            Alert::error('Data Not Found');
            return back();
        }

        $diseaseTreatments = DiseaseTreatment::with(['animalInfo' => function($q)use($animalCatDb, $animalCat, $farm_id) {
                    $q->whereIn($animalCatDb, $animalCat)
                      ->where('farm_id', $farm_id);
                }])
                ->whereIn('disease_season', $disease_season)
                ->whereIn('disease_id', $disease)
                ->whereBetween('disease_date', [$form_date,$to_date])
                ->get();

        if($diseaseTreatments->count() < 1){
            Alert::error('Data Not Found');
            return back();
        }

        $animals = AnimalInfo::whereIn($animalCatDb, $animalCat)
                ->get();

        return view('admin.report.blri.disease_incidence.report', compact('diseaseTreatments','animals','form_date','to_date'));
    }
}
