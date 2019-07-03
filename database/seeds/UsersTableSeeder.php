<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role_id' => 1,
                'username' => 'admin',
                'password' => bcrypt('password'),
                'full_name' => 'DradTech',
                'designation' => 'Developer',
                'is_active' => '1',
                'image_icon' => null,
                'remember_token' => str_random(60),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_id' => 2,
                'username' => 'school-project',
                'password' => bcrypt('schoolproject'),
                'full_name' => 'School Project',
                'designation' => 'Admin',
                'is_active' => '1',
                'image_icon' => null,
                'remember_token' => str_random(60),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
