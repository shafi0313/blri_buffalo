<?php

namespace App\Exports\Export\AllReport;

use App\Models\AnimalInfo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnimalInfoExport implements FromView
{
    public function __construct($farm,$farm_id)
    {
        $this->farm = $farm;
        $this->farm_id = $farm_id;
        // $this->community_id = $community_id;
    }

    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.animal_info.excel', [
                // 'animalInfos' => AnimalInfo::whereIs_culling(0)->get()
                // 'animalInfos' => AnimalInfo::where($this->farm,'=',$this->farm_id)->whereCommunity_id($this->community_id)->get()
                'animalInfos' => AnimalInfo::where($this->farm,'=',$this->farm_id)->whereIs_culling(0)->get()
            ]);
        } else {
            return view('admin.animal_info.excel', [
                'animalInfos' => AnimalInfo::where('user_id', auth()->user()->id)->whereIs_culling(0)->get()
            ]);
        }
    }
}
