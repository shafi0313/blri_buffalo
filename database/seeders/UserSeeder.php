<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'Admin',
            'email' => 'dev.admin@shafi95.com',
            'permission' => 1,
            'password' => bcrypt('##Zxc1234'),
        ];
        User::insert($user);
    }
}
