<?php

namespace App\Exports;

use App\Models\Morphometric;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MorphometricExport implements FromView
{

    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.morphometric.excel', [
                'morphometrics' => Morphometric::all()
            ]);
        } else {
            return view('admin.morphometric.excel', [
                'morphometrics' => Morphometric::where('user_id', auth()->user()->id)->get()
            ]);
        }
    }
}
