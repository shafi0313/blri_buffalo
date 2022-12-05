<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Upazila;
use App\Models\AnimalCat;
use App\Models\Community;
use App\Models\AnimalInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GlobalController extends Controller
{
    public function upazila(Request $request)
    {
        $district_id = $request->district_id;
        $districts = Upazila::where('district_id', $district_id)->get();
        $dis = '';
        $dis .= '<option value="">Select</option>';
        foreach ($districts as $district) {
            $dis .= '<option value="' . $district->id . '">' . $district->name . '</option>';
        }
        return json_encode(['dis' => $dis]);
    }

    public function getAnimalInfo(Request $request)
    {
        $animalInfoId = $request->animalInfoId;
        $animalInfos = AnimalInfo::where('id', $animalInfoId)->get();
        foreach ($animalInfos as $animalInfo) {
            $animal_cat_id = $animalInfo->animal_cat_id;
            $animal_sub_cat_id = $animalInfo->animal_sub_cat_id;
            $sex = $animalInfo->sex;
            $color = $animalInfo->color;
            $birth_wt = $animalInfo->birth_wt;
            // $type = $animalInfo->type;
            $d_o_b = Carbon::parse($animalInfo->d_o_b)->format('Y-m-d');
            // $paity = $animalInfo->paity;
            // $litter_size = $animalInfo->litter_size;
            // $breed = $animalInfo->breed;
            $animal_sl = $animalInfo->animal_sl;
        }
        return json_encode(['sex' => $sex, 'color' => $color, 'birth_wt' => $birth_wt, 'd_o_b' => $d_o_b, 'animal_cat_id' => $animal_cat_id, 'animal_sub_cat_id' => $animal_sub_cat_id, 'animal_sl' => $animal_sl]);
    }



    public function animalSubCat(Request $request)
    {
        $p_id = $request->animal_cat_id;
        $animalCats = AnimalCat::where('parent_id', $p_id)->get();
        $name = '';
        $name .= '<option value="">Select</option>';
        foreach ($animalCats as $animalCat) {
            $name .= '<option value="' . $animalCat->id . '">' . $animalCat->name . '</option>';
        }
        return json_encode(['name' => $name]);
    }

    // For research
    public function tagNoResearch(Request $request)
    {
        $animals = AnimalInfo::where('farm_id',  $request->farm_id)->whereIs_culling(0)->get();
        $name = '<option value="">Select</option>';
        foreach ($animals as $animal) {
            $select = $request->animal_info_id == $animal->id ? 'selected' : '';
            $name .= "<option value='$animal->id'  $select>$animal->animal_tag</option>";
        }
        return json_encode(['name' => $name]);
    }
    public function tagNoResearchF(Request $request)
    {
        $animals = AnimalInfo::where('farm_id',  $request->farm_id)->whereSex('F')->whereIs_culling(0)->get();
        $name = '<option value="">Select</option>';
        foreach ($animals as $animal) {
            $select = $request->animal_info_id == $animal->id ? 'selected' : '';
            $name .= "<option value='$animal->id'  $select>$animal->animal_tag</option>";
        }
        return json_encode(['name' => $name]);
    }

    public function tattooNoResearch(Request $request)
    {
        $animals = AnimalInfo::where('farm_id',  $request->farm_id)->whereIs_culling(0)->get();
        $tattooNo = '<option value="">Select</option>';
        foreach ($animals as $animal) {
            $select = $request->animal_info_id == $animal->id ? 'selected' : '';
            $tattooNo .= "<option value='$animal->id' $select>$animal->tattoo_no</option>";
        }
        return json_encode(['tattooNo' => $tattooNo]);
    }
    public function tattooNoResearchF(Request $request)
    {
        $animals = AnimalInfo::where('farm_id',  $request->farm_id)->whereSex('F')->whereIs_culling(0)->get();
        $tattooNo = '<option value="">Select</option>';
        foreach ($animals as $animal) {
            $select = $request->animal_info_id == $animal->id ? 'selected' : '';
            $tattooNo .= "<option value='$animal->id' $select>$animal->tattoo_no</option>";
        }
        return json_encode(['tattooNo' => $tattooNo]);
    }

    // For community
    public function tagNo(Request $request)
    {
        $animals = AnimalInfo::where('community_id',  $request->community_id)->whereIs_culling(0)->get();
        $name = '<option value="">Select</option>';
        foreach ($animals as $animal) {
            $select = $request->animal_info_id == $animal->id ? 'selected' : '';
            $name .= "<option value='$animal->id'  $select>$animal->ear_tag</option>";
        }
        return json_encode(['name' => $name]);
    }
    public function tagNoF(Request $request)
    {
        $animals = AnimalInfo::where('community_id',  $request->community_id)->whereSex('F')->whereIs_culling(0)->get();
        $name = '<option value="">Select</option>';
        foreach ($animals as $animal) {
            $select = $request->animal_info_id == $animal->id ? 'selected' : '';
            $name .= "<option value='$animal->id'  $select>$animal->ear_tag</option>";
        }
        return json_encode(['name' => $name]);
    }

    public function tattooNo(Request $request)
    {
        $animals = AnimalInfo::where('community_id',  $request->community_id)->whereIs_culling(0)->get();
        $tattooNo = '<option value="">Select</option>';
        foreach ($animals as $animal) {
            $select = $request->animal_info_id == $animal->id ? 'selected' : '';
            $tattooNo .= "<option value='$animal->id' $select>$animal->tattoo_no</option>";
        }
        return json_encode(['tattooNo' => $tattooNo]);
    }
    public function tattooNoF(Request $request)
    {
        $animals = AnimalInfo::where('community_id',  $request->community_id)->whereSex('F')->whereIs_culling(0)->get();
        $tattooNo = '<option value="">Select</option>';
        foreach ($animals as $animal) {
            $select = $request->animal_info_id == $animal->id ? 'selected' : '';
            $tattooNo .= "<option value='$animal->id' $select>$animal->tattoo_no</option>";
        }
        return json_encode(['tattooNo' => $tattooNo]);
    }

    public function animalFemale(Request $request)
    {
        if ($request->filled('community_id')) {
            $animals = AnimalInfo::where('community_id',  $request->community_id)->whereSex('F')->whereIs_culling(0)->get();
        } else {
            $animals = AnimalInfo::where('farm_id',  $request->farm_id)->whereSex('F')->whereIs_culling(0)->get();
        }
        $name = '<option value="">Select</option>';
        foreach ($animals as $animal) {
            $select = $request->animal_info_id == $animal->id ? 'selected' : '';
            $tag = $animal->farm_id != "" ? $animal->animal_tag : $animal->ear_tag;
            $name .= "<option value='$animal->id'  $select>$tag</option>";
        }
        return json_encode(['name' => $name]);
    }

    public function animalMale(Request $request)
    {
        if ($request->filled('community_id')) {
            $animals = AnimalInfo::where('community_id',  $request->community_id)->whereSex('M')->whereIs_culling(0)->get();
        } else {
            $animals = AnimalInfo::where('farm_id',  $request->farm_id)->whereSex('M')->whereIs_culling(0)->get();
        }

        $name = '<option value="">Select</option>';
        foreach ($animals as $animal) {
            $select = $request->get_bull_id == $animal->id ? 'selected' : '';
            $name .= "<option value='$animal->id'  $select>$animal->animal_tag</option>";
        }
        return json_encode(['name' => $name]);
    }



    public function community(Request $request)
    {
        $animalCats = Community::where('community_cat_id', $request->farmOrComId)->get();
        $name = '';
        $name .= '<option value="">Select</option>';
        foreach ($animalCats as $animalCat) {
            $name .= '<option value="' . $animalCat->id . '">' . $animalCat->no . '-' . $animalCat->name . '</option>';
        }
        return json_encode(['name' => $name]);
    }

    public function subFarm(Request $request)
    {
        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrComId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrComId);
        if ($fOrC == 'f') {
            $subFarms = Community::where('farm_id', $farmOrComId)->get();
            $select = $request->farm_id;
        } else {
            $subFarms = Community::where('community_cat_id', $farmOrComId)->get();
            $select = $request->community_cat_id;
        }
        $name = '<option value="">Select</option>';
        foreach ($subFarms as $subFarm) {
            $selects = $request->get_community_id == $subFarm->id ? "selected" : '';
            $name .= "<option value='$subFarm->id'  $selects>$subFarm->no</option>";
        }
        return json_encode(['name' => $name]);
    }
}
