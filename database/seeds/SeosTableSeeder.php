<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seos')->insert([
            [
                'page' => 'home',
                'meta_title' => 'Home',
                'meta_tags' => 'meta tags',
                'meta_description' => 'meta description',
                'created_by' => null,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'page' => 'news and event',
                'meta_title' => 'News ',
                'meta_tags' => 'meta tags',
                'meta_description' => 'meta description',
                'created_by' => null,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'page' => 'album',
                'meta_title' => 'Album',
                'meta_tags' => 'meta tags',
                'meta_description' => 'meta description',
                'created_by' => null,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'page' => 'our team',
                'meta_title' => 'OurTeam',
                'meta_tags' => 'meta tags',
                'meta_description' => 'meta description',
                'created_by' => null,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'page' => 'about-us',
                'meta_title' => 'About Us',
                'meta_tags' => 'meta tags',
                'meta_description' => 'meta description',
                'created_by' => null,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
