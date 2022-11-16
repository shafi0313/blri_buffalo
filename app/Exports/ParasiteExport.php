<?php

namespace App\Exports;

use App\Models\Parasite;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ParasiteExport implements FromView
{
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.parasite.excel', [
                'parasites' => Parasite::all()
            ]);
        } else {
            return view('admin.parasite.excel', [
                'parasites' => Parasite::where('user_id', auth()->user()->id)->get()
            ]);
        }
    }
}
