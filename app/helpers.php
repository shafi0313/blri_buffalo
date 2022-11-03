<?php

use Carbon\Carbon;
use App\Models\AnimalInfo;
use App\Models\DeadCulled;

if(!function_exists('UKDate'))
{
    function UKDate($UKDate)
    {
        return \Carbon\Carbon::parse($UKDate)->format('d/m/Y');
    }
}

if(!function_exists('bdDate'))
{
    function bdDate($bdDate)
    {
        if(!is_null($bdDate)){
            return \Carbon\Carbon::parse($bdDate)->format('d/m/Y');
        }else{
            return '';
        }

    }
}

if(!function_exists('nextDate'))
{
    function nextDate($date,$add)
    {
        return \Carbon\Carbon::parse($date)->addDays($add)->format('d/m/Y');
    }
}

if (!function_exists('animalKid')) {
    function animalKid($to_date)
    {
        $getAnimalDOBs = AnimalInfo::all();
        $animalDOB =[];
        foreach ($getAnimalDOBs as $key =>  $getAnimalDOB) {
            $data = \Carbon\Carbon::parse($getAnimalDOB->d_o_b)->diff($to_date)->format('%y%m');
            if ($data < 4) {
               $animalDOB[] += $getAnimalDOB->id;
            }
        }
        return $animalDOB;
    }
}

if (!function_exists('animalGrowing')) {
    function animalGrowing($to_date)
    {
        $getAnimalDOBs = AnimalInfo::all();
        $animalDOB =[];
        foreach ($getAnimalDOBs as $key =>  $getAnimalDOB) {
            $data = \Carbon\Carbon::parse($getAnimalDOB->d_o_b)->diff($to_date)->format('%y%m');
            if ($data > 3 && $data < 8) {
               $animalDOB[] += $getAnimalDOB->id;
            }
        }
        return $animalDOB;
    }
}

if (!function_exists('animalAdult')) {
    function animalAdult($to_date)
    {
        $getAnimalDOBs = AnimalInfo::all();
        $animalDOB =[];
        foreach ($getAnimalDOBs as $key =>  $getAnimalDOB) {
            $data = \Carbon\Carbon::parse($getAnimalDOB->d_o_b)->diff($to_date)->format('%y%m');
            if ($data > 7) {
               $animalDOB[] += $getAnimalDOB->id;
            }
        }
        return $animalDOB;
    }
}

if (!function_exists('user')) {
    function user()
    {
        return auth()->user();
    }
}

if (!function_exists('calvingInterval')) {
    function calvingInterval($date, $date2)
    {
        return Carbon::parse($date)->diffInDays(Carbon::parse($date2));
    }
}

if (!function_exists('carbon')) {
    function carbon()
    {
        return Carbon::parse();
    }
}

if (!function_exists('activeSubNav')) {
    function activeSubNav($route)
    {
        if (is_array($route)) {
            $rt = '';
            foreach ($route as $rut) {
                $rt .= request()->routeIs($rut) || '';
            }
            return $rt ? ' activeSub ' : '';
        }
        return request()->routeIs($route) ? ' activeSub ' : '';
    }
}

if (!function_exists('activeNav')) {
    function activeNav($route)
    {
        if (is_array($route)) {
            $rt = '';
            foreach ($route as $rut) {
                $rt .= request()->routeIs($rut) || '';
            }
            return $rt ? ' active ' : '';
        }
        return request()->routeIs($route) ? ' active ' : '';
    }
}

if (!function_exists('openNav')) {
    function openNav(array $routes)
    {
        $rt = '';
        foreach ($routes as $route) {
            $rt .= request()->routeIs($route) || '';
        }
        return $rt ? ' show ' : '';
    }
}

if (!function_exists('isCulling')) {
    function isCulling()
    {
        return DeadCulled::all(['animal_info_id']);
    }
}

if (!function_exists('isCullingUser')) {
    function isCullingUser()
    {
        return DeadCulled::whereUser_id(auth()->user()->id)->get(['animal_info_id']);
    }
}


