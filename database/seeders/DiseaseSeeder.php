<?php

namespace Database\Seeders;

use App\Models\Disease;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disease = [
            ['name' => 'Pneumonia', 'created_at' => Carbon::now()],
            ['name' => 'Fever', 'created_at' => Carbon::now()],
            ['name' => 'Blot', 'created_at' => Carbon::now()],
        ];
        Disease::insert($disease);
    }
}
