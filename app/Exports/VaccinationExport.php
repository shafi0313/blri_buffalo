<?php

namespace App\Exports;

use App\Models\Vaccination;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VaccinationExport implements FromView
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
            return view('admin.vaccination.excel', [
                'vaccinations' => Vaccination::where($this->farm,'=',$this->farm_id)->get()
            ]);
        } else {
            return view('admin.vaccination.excel', [
                'vaccinations' => Vaccination::where('user_id', auth()->user()->id)->get()
            ]);
        }
    }
}
