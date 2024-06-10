<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OrphanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insertions                 = [
            [
                'title'              => ' المسار الرياضي',
                'image'         => 'img/pathes/sports_path.svg',
                'active'         => 1,
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),            
            ],
            [
                'title'              => ' المسار الإبداعي',
                'image'         => 'img/pathes/creative_path.svg',
                'active'         => 1,
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),            
            ],
            [
                'title'              => ' مسار التوجيه المهني',
                'image'         => 'img/pathes/career_guidance_path.svg',
                'active'         => 1,
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),            

            ],
            [
                'title'              => 'مسار الشخصي والإجتماعي',
                'image'         => 'img/pathes/personal-and-social-guidance-path.svg',
                'active'         => 1,
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),            
            ],
            [
                'title'              => ' المسار التعليمي',
                'image'         => 'img/pathes/education_path.svg',
                'active'         => 1,
                'created_at'                        => date('Y-m-d H:i:s'),
                'updated_at'                        => date('Y-m-d H:i:s'),            

            ]
        ];
        DB::table('pathes')->insert($insertions);
    }
}
