<?php

namespace App\Exports;

use App\Models\BodyWeight;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class BodyWeightExport implements FromView
{
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.body_weight.excel', [
                'productionRecords' => BodyWeight::whereNotIn('animal_info_id',isCulling())->get()
            ]);
        } else {
            return view('admin.body_weight.excel', [
                'productionRecords' => BodyWeight::where('user_id', auth()->user()->id)->whereNotIn('animal_info_id',isCulling())->get()
            ]);
        }
    }
}
