<?php

namespace App\Exports;

use App\Models\Vaccination;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VaccinationExport implements FromView
{
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.vaccination.excel', [
                'vaccinations' => Vaccination::whereNotIn('animal_info_id',isCulling())->get()
            ]);
        } else {
            return view('admin.vaccination.excel', [
                'vaccinations' => Vaccination::where('user_id', auth()->user()->id)->whereNotIn('animal_info_id',isCullingUser())->get()
            ]);
        }
    }
}
