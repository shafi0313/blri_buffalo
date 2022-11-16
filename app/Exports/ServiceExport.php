<?php

namespace App\Exports;

use App\Models\Service;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ServiceExport implements FromView
{
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.service.excel', [
                'services' => Service::whereNotIn('animal_info_id',isCulling())->get()
            ]);
        } else {
            return view('admin.service.excel', [
                'services' => Service::where('user_id', auth()->user()->id)->whereNotIn('animal_info_id',isCullingUser())->get()
            ]);
        }
    }
}
