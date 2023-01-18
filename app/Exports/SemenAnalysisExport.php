<?php

namespace App\Exports;

use App\Models\SemenAnalysis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SemenAnalysisExport implements FromView
{
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.semen_analysis.excel', [
                'semenAnalyses' => SemenAnalysis::all()
            ]);
        } else {
            return view('admin.semen_analysis.excel', [
                'semenAnalyses' => SemenAnalysis::where('user_id', auth()->user()->id)->get()
            ]);
        }
    }
}
