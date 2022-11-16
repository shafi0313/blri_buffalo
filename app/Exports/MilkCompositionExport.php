<?php

namespace App\Exports;

use App\Models\MilkComposition;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MilkCompositionExport implements FromView
{
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.milk_composition.excel', [
                'milkCompositions' => MilkComposition::whereNotIn('animal_info_id',isCulling())->get()
            ]);
        } else {
            return view('admin.milk_composition.excel', [
                'milkCompositions' => MilkComposition::where('user_id', auth()->user()->id)->whereNotIn('animal_info_id',isCullingUser())->get()
            ]);
        }
    }
}
