<?php

namespace App\Exports;

use App\Models\AnimalInfo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

// class AnimalInfoExport implements FromCollection, WithHeadings
// {
//     public function headings():array{
//         return [
//             'Animal Tag',
//             'Type',
//             'Sire',
//             'Dam',
//             'Color',
//             'Sex',
//             'Birth Weight',
//             'Litter Size',
//             'Generation',
//             'Paity',
//             'Dam Milk',
//             'Date of Birth',
//             'Season Date of Birth',
//             'Death Date',
//             'Remark',
//         ];
//     }
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return collect(AnimalInfo::getAnimalInfo());
//     }
// }

class AnimalInfoExport implements FromView
{
    // public function __construct($farm,$farmOrComId,$community_id)
    // {
    //     $this->farm = $farm;
    //     $this->farmOrComId = $farmOrComId;
    //     $this->community_id = $community_id;
    // }
    public function view(): View
    {
        if (auth()->user()->permission == 1) {
            return view('admin.animal_info.excel', [
                'animalInfos' => AnimalInfo::whereIs_culling(0)->get()
                // 'animalInfos' => AnimalInfo::where( $this->farm,'=',$this->farmOrComId)->whereCommunity_id($this->community_id)->get()
            ]);
        } else {
            return view('admin.animal_info.excel', [
                'animalInfos' => AnimalInfo::where('user_id', auth()->user()->id)->whereIs_culling(0)->get()
            ]);
        }
    }
}
