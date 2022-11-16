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
        if (Auth::user()->permission == 1) {
            $animalInfos = AnimalInfo::with(['getFarmInfo','getCommunityInfo','milkYields' => function($q){
                    $q->where('milk_production', '>=', 4);
                }])->whereIs_culling(0)->get();
            $milkProduction = MilkProduction::whereNotIn('animal_info_id',isCulling())->where('milk_production', '>=', 4)->count();
        } else {
            $animalInfos = AnimalInfo::with(['getFarmInfo','getCommunityInfo','milkYields' => function($q){
                $q->where('milk_production', '>=', 4);
            }])->whereIs_culling(0)->whereUser_id(Auth::user()->id)->get();
            $milkProduction = MilkProduction::whereUser_id(auth::user()->id)->whereNotIn('animal_info_id',isCullingUser())->where('milk_production', '>=', 4)->count();
        }
        return view('admin.dashboard', compact('animalInfos','milkProduction'));
    }

    public function VisitorInfo()
    {
        $visitors = VisitorInfo::all();
        return view('admin.visitor_info.index', compact('visitors'));
    }
}

