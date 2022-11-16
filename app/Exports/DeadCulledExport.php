<?php

namespace App\Exports;

use App\Models\DeadCulled;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DeadCulledExport implements FromView
{
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.dead_culled.excel', [
                'deadCulleds' => DeadCulled::all()
            ]);
        } else {
            return view('admin.dead_culled.excel', [
                'deadCulleds' => DeadCulled::where('user_id', auth()->user()->id)->get()
            ]);
        }
    }
}
