<?php

namespace App\Http\Controllers\Admin;

use App\Models\AnimalInfo;
use App\Models\VisitorInfo;
use App\Models\MilkProduction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->permission == 1) {
            $animalInfos = AnimalInfo::with([
                'getFarmInfo:id,name,upazila_id',
                'getCommunityInfo:id,user_id,district_id,upazila_id,name',
                'getCommunityInfo.district:id,division_id,name',
                'milkYields' => function ($query) {
                    $query->select('id', 'user_id', 'animal_info_id', 'milk_production')
                        ->where('milk_production', '>=', 4);
                }
            ])->select('id', 'user_id', 'farm_id', 'community_cat_id', 'community_id', 'animal_cat_id', 'animal_sub_cat_id', 'sex')
                ->where('is_culling', 0)
                ->get();

            $milkProduction = MilkProduction::select(DB::raw('count(animal_info_id) as num'))
                ->whereNotIn('animal_info_id', isCulling())
                ->where('milk_production', '>=', 4)
                ->groupBy('animal_info_id')
                ->get()
                ->count();
        } else {
            $animalInfos = AnimalInfo::with([
                'getFarmInfo:id,name,upazila_id',
                'getCommunityInfo:id,user_id,district_id,upazila_id,name',
                'getCommunityInfo.district:id,division_id,name',
                'milkYields' => function ($query) {
                    $query->select('id', 'user_id', 'animal_info_id', 'milk_production')
                        ->where('milk_production', '>=', 4);
                }
            ])->select('id', 'user_id', 'farm_id', 'community_cat_id', 'community_id', 'animal_cat_id', 'animal_sub_cat_id', 'sex')
                ->whereIs_culling(0)
                ->whereUser_id(Auth::user()->id)
                ->get();

            $milkProduction = MilkProduction::whereUser_id(auth::user()->id)
                ->whereNotIn('animal_info_id', isCullingUser())
                ->where('milk_production', '>=', 4)
                ->groupBy('animal_info_id')
                ->count();
        }
        return view('admin.dashboard', compact('animalInfos', 'milkProduction'));
    }

    public function VisitorInfo()
    {
        $visitors = VisitorInfo::all();
        return view('admin.visitor_info.index', compact('visitors'));
    }
}
