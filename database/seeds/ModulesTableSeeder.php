<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('modules')->insert([
            [
                'parent_id' => '0',
                'module_name' => 'User Management',
                'slug' => 'admin.privilege',
                'menu-class' => 'privilege',
                'icon' => 'fa fa-cog',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '1',
                'module_name' => 'Role',
                'slug' => 'admin.privilege.role',
                'menu-class' => 'role',
                'icon' => 'fa fa-users',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '1',
                'module_name' => 'User',
                'slug' => 'admin.privilege.user',
                'menu-class' => 'user',
                'icon' => 'fa fa-user',
                'order_position' => 2,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'Content Management',
                'slug' => 'admin.content-management',
                'menu-class' => 'content-management',
                'icon' => 'fa fa-file-text',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '4',
                'module_name' => 'Chairman Message',
                'slug' => 'admin.content-management.message',
                'menu-class' => 'message',
                'icon' => 'fa fa-envelope',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '4',
                'module_name' => 'Banner',
                'slug' => 'admin.content-management.banner',
                'menu-class' => 'banner',
                'icon' => 'fa fa-image',
                'order_position' => 2,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '4',
                'module_name' => 'Notices',
                'slug' => 'admin.content-management.notice',
                'menu-class' => 'notice',
                'icon' => 'fa fa-bell',
                'order_position' => 3,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '4',
                'module_name' => 'Faculty',
                'slug'=> 'admin.content-management.faculty',
                'menu-class' => 'faculty',
                'icon' => 'fa fa-users',
                'order_position' => 4,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '4',
                'module_name' => 'Pages',
                'slug'=> 'admin.content-management.page',
                'menu-class' => 'page',
                'icon' => 'fa fa-file',
                'order_position' => 5,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '4',
                'module_name' => 'About Us',
                'slug' => 'admin.content-management.aboutus',
                'menu-class' => 'aboutus',
                'icon' => 'fa fa-info-circle',
                'order_position' => 6,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '4',
                'module_name' => 'Download',
                'slug' => 'admin.content-management.download',
                'menu-class' => 'download',
                'icon' => 'fa fa-download',
                'order_position' => 7,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'Media',
                'slug' => 'admin.media',
                'menu-class' => 'media',
                'icon' => 'fa fa-image',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '12',
                'module_name' => 'Album',
                'slug' => 'admin.media.album',
                'menu-class' => 'album',
                'icon' => 'fa fa-image',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'News And Event',
                'slug' => 'admin.newsandevent',
                'menu-class' => 'newsandevent',
                'icon' => 'fa fa-newspaper-o',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'Testimonial',
                'slug' => 'admin.testimonial',
                'menu-class' => 'testimonial',
                'icon' => 'fa fa-user',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'School Management',
                'slug' => 'admin.school-management',
                'menu-class' => 'school-management',
                'icon' => 'fa fa-graduation-cap',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '16',
                'module_name' => 'Alumni',
                'slug' => 'admin.school-management.alumni',
                'menu-class' => 'alumni',
                'icon' => 'fa fa-users',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '16',
                'module_name' => 'Result',
                'slug' => 'admin.school-management.result',
                'menu-class' => 'result',
                'icon' => 'fa fa-file',
                'order_position' => 2,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'Others',
                'slug' => 'admin.other',
                'menu-class' => 'other',
                'icon' => 'fa fa-object-group',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '19',
                'module_name' => 'Subscribers',
                'slug' => 'admin.other.subscribers',
                'menu-class' => 'subscribers',
                'icon' => 'fa fa-users',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '19',
                'module_name' => 'Feedback',
                'slug' => 'admin.other.feedback',
                'menu-class' => 'feedback',
                'icon' => 'fa fa-feed',
                'order_position' => 2,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'SEO',
                'slug' => 'admin.seo',
                'menu-class' => 'seo',
                'icon' => 'fa fa-search',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'parent_id' => '0',
                'module_name' => 'Settings',
                'slug' => 'admin.settings',
                'menu-class' => 'settings',
                'icon' => 'fa fa-gears',
                'order_position' => 1,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            
        ]);
    }
}
