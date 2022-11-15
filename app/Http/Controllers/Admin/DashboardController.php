<?php

namespace App\Http\Controllers\Admin;

use App\Models\AnimalInfo;
use App\Models\VisitorInfo;
use App\Models\MilkProduction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
         toast('Success','success');
        //  return back();
        if (Auth::user()->permission == 1) {

            $animalInfos = AnimalInfo::with(['getFarmInfo','getCommunityInfo','milkYields' => function($q){
                    $q->where('milk_production', '>=', 4);
                }])->whereIs_culling(0)->get();
            $milkProduction = MilkProduction::whereNotIn('animal_info_id',isCulling())->where('milk_production', '>=', 4)->count();
            // $milkProductions = MilkProduction::where('milk_production', '>=', 4)->count() ;
            // $communitys = Community::with('animals')->get();
            // return$animalInfos = AnimalInfo::withCount('milkYields')->whereNotNull('community_cat_id')->whereIs_culling(0)->get()->groupBy('community_cat_id');
            // $animalInfos = AnimalInfo::with(['getFarmInfo','getCommunityInfo'])->get();
            // $pregnants = Service::whereIs_pregnant(1)->get();
            // $milkProductions = MilkProduction::get()->groupBy('animal_tag');
            // $semenAnalysis = SemenAnalysis::whereFarm_id(1)->orderBy('straw_prepared')->get()->groupBy('animal_tag')->first();
            // $crossbreds = AnimalInfo::whereAnimal_cat_id(2)->whereAge_distribution(1)->get();
            // $calvesAvgBWts = BodyWeight::get()->groupBy('animal_tag')->first();
        } else {
            $animalInfos = AnimalInfo::with(['getFarmInfo','getCommunityInfo','milkYields' => function($q){
                $q->where('milk_production', '>=', 4);
            }])->whereIs_culling(0)->whereUser_id(Auth::user()->id)->get();
            $milkProduction = MilkProduction::whereUser_id(auth::user()->id)->whereNotIn('animal_info_id',isCullingUser())->where('milk_production', '>=', 4)->count();
            // $milkProductions = MilkProduction::whereUser_id(Auth::user()->id)->where('milk_production', '>=', 4)->count() ;
            // $animalInfos = AnimalInfo::with(['getFarmInfo','getCommunityInfo'])->whereUser_id(Auth::user()->id)->get();
            // $pregnants = Service::whereIs_pregnant(1)->whereUser_id(Auth::user()->id)->get();
            // $milkProductions = MilkProduction::whereUser_id(Auth::user()->id)->get()->groupBy('animal_tag');
            // $semenAnalysis = SemenAnalysis::whereFarm_id(1)->whereUser_id(Auth::user()->id)->orderBy('straw_prepared')->get()->groupBy('animal_tag')->first();
            // $crossbreds = AnimalInfo::whereAnimal_cat_id(2)->whereUser_id(Auth::user()->id)->whereAge_distribution(1)->get();
            // $calvesAvgBWts = BodyWeight::get()->groupBy('animal_tag')->first();
        }
        return view('admin.dashboard', compact('animalInfos','milkProduction'));
    }

    public function VisitorInfo()
    {
        $visitors = VisitorInfo::all();
        return view('admin.visitor_info.index', compact('visitors'));
    }
}

