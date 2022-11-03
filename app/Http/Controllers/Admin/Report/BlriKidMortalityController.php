<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Farm;
use App\Models\AnimalCat;
use App\Models\AnimalInfo;
use Illuminate\Http\Request;
use App\Models\DiseaseTreatment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class BlriKidMortalityController extends Controller
{
    public function selectDate()
    {
        $animalCats = AnimalCat::where('parent_id',0)->get();
        $researchFarms = Farm::all();
        return view('admin.report.blri.kid_mortality.select_date', compact('animalCats','researchFarms'));
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

        if (AnimalInfo::whereIn($animalCatDb, $animalCat)->count() < 1) {
            Alert::error('Data Not Found');
            return back();
        }

        $deaths = DB::table('animal_infos')
                ->join('dead_culleds', 'dead_culleds.animal_info_id', '=', 'animal_infos.id')
                ->join('animal_cats', 'animal_cats.id', '=', 'animal_infos.animal_cat_id')
                // ->select('animal_infos.id','animal_infos.d_o_b','animal_infos.animal_cat_id','dead_culleds.animal_info_id','dead_culleds.dead_culled','animal_cats.name')
                // ->select('animal_infos.*','dead_culleds.*','animal_cats.*')
                ->where('reason', 'Death')
                ->whereIn($animalCatDb, $animalCat)
                ->whereIn('animal_info_id', animalKid($to_date))
                ->whereBetween('date_dead_culled', [$form_date,$to_date]);
                // ->get();

        if ($deaths->count() < 1) {
            Alert::error('Data Not Found');
            return back();
        }

        $animals = AnimalInfo::whereIn($animalCatDb, $animalCat)
                // ->whereBetween('d_o_b', [$form_date,$to_date])
                ->whereIn('id', animalKid($to_date))
                ->where('farm_id', $farm_id)
                // ->whereStatus(1)
                ->get();
        return view('admin.report.blri.kid_mortality.report', compact('deaths','animals','form_date','to_date'));
    }
}
