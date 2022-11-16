<?php

namespace App\Exports;

use App\Models\Distribution;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DistributionExport implements FromView
{
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.distribution.excel', [
                'distributions' => Distribution::whereNotIn('animal_info_id',isCulling())->get()
            ]);
        } else {
            return view('admin.distribution.excel', [
                'distributions' => Distribution::where('user_id', auth()->user()->id)->whereNotIn('animal_info_id',isCullingUser())->get()
            ]);
        }
    }
}
