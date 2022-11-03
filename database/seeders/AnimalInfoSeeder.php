<?php

namespace Database\Seeders;

use App\Models\AnimalInfo;
use Illuminate\Database\Seeder;

class AnimalInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'user_id' => 1,
                'farm_id' => 1,
                'community_cat_id' => null,
                'community_id' => null,
                'animal_cat_id' => 7,
                'animal_sub_cat_id' => null,
                'animal_tag' => 4001,
                'm_type' => 1,
                'sire' => 104,
                'dam' => 3579,
                'color' => null,
                'sex' => 'F',
                'birth_wt' => 1.3,
                'litter_size' => 'single',
                'generation' => 2,
                'paity' => null,
                'dam_milk' => null,
                'd_o_b' => '2017-06-20',
                'season_o_birth' => 'Summer',
                'death_date' => null,
                'remark' => 'Dead',
            ],

        ];
        AnimalInfo::insert($user);
    }
}
