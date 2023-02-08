<?php

namespace App\Exports;

use App\Models\Deworming;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class DewormingExport implements FromView
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
            return view('admin.deworming.excel', [
                'dewormings' => Deworming::where($this->farm,'=',$this->farm_id)->get()
            ]);
        } else {
            return view('admin.deworming.excel', [
                'dewormings' => Deworming::where('user_id', auth()->user()->id)->get()
            ]);
        }
    }
}
