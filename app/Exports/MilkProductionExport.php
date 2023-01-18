<?php

namespace App\Exports;

use App\Models\MilkProduction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MilkProductionExport implements FromView
{
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.milk_production.excel', [
                'milkProductions' => MilkProduction::all()
            ]);
        } else {
            return view('admin.milk_production.excel', [
                'milkProductions' => MilkProduction::where('user_id', auth()->user()->id)->get()
            ]);
        }
    }
}
