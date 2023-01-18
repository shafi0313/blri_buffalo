<?php

namespace App\Exports;

use App\Models\Reproduction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReproductionExport implements FromView
{
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.reproduction.excel', [
                'reproductions' => Reproduction::all()
            ]);
        } else {
            return view('admin.reproduction.excel', [
                'reproductions' => Reproduction::where('user_id', auth()->user()->id)->get()
            ]);
        }
    }
}
