<?php

namespace App\Exports;

use App\Models\DiseaseTreatment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DiseaseTreatmentExport implements FromView
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
            return view('admin.disease_treatment.excel', [
                'diseaseTreatments' => DiseaseTreatment::where($this->farm,'=',$this->farm_id)->get()
            ]);
        } else {
            return view('admin.disease_treatment.excel', [
                'diseaseTreatments' => DiseaseTreatment::where('user_id', auth()->user()->id)->get()
            ]);
        }
    }
}
