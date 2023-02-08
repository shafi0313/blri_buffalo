<?php

namespace App\Exports;

use App\Models\BodyWeight;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class BodyWeightExport implements FromView
{
    public $farm;
    public $farm_id;
    public function __construct($farm,$farm_id)
    {
        $this->farm = $farm;
        $this->farm_id = $farm_id;
    }
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.body_weight.excel', [
                'productionRecords' => BodyWeight::where($this->farm,'=',$this->farm_id)->get()
            ]);
        } else {
            return view('admin.body_weight.excel', [
                'productionRecords' => BodyWeight::where('user_id', auth()->user()->id)->get()
                // 'productionRecords' => BodyWeight::where('user_id', auth()->user()->id)->whereNotIn('animal_info_id',isCulling())->get()
            ]);
        }
    }
}
