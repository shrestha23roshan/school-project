<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'site_name' => 'School Project',
                'site_email' => 'info@schoolproject.com',
                'site_phone' => '0123456789',
                'site_address' => 'Dhobighat',
                'site_description' => 'schoolproject des',
                'site_logo' => null,
                'site_favicon' => null,
                'site_copyright' => 'Copyright © School Project 2018. All Rights Reserved',
                'facebook_url'=> 'url',
                'linkedin_url'=> 'url',
                'twitter_url'=> 'url',
                'google_plus_url'=> 'url',
                'youtube_url'=> 'url',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
