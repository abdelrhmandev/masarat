<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
                'name'                => 'development',
                'slug'                  => 'department.development',
                'http_path'         => '/development*' . PHP_EOL . '/'
            ],
            [
                'name'                => 'partners',
                'slug'                  => 'department.partners',
                'http_path'         => '/partners*' . PHP_EOL . '/'
            ],
            [
                'name'                => 'operation',
                'slug'                  => 'department.operation',
                'http_path'         => '/operation*' . PHP_EOL . '/'
            ],
            [
                'name'                => 'director',
                'slug'                  => 'department.director',
                'http_path'         => '/director*' . PHP_EOL . '/'
            ],
                // الأيتام
            [
                'name'                => 'orphan',
                'slug'                  => 'department.orphan',
                'http_path'         => '/orphan*' . PHP_EOL . '/'
            ]
        ];
        DB::table('admin_permissions')->insert($insertions);
        ///////////////////////////////////////////////////////////////////////////////////////
        $insertions                 = [
            [
                'name'                => 'development',
                'slug'                  => 'development'
            ],
            [
                'name'                => 'partners',
                'slug'                  => 'partners'
            ],
            [
                'name'               => 'operation',
                'slug'                 => 'operation'
            ],
            [
                'name'               => 'director',
                'slug'                 => 'director'
            ],
            [
                'name'               => 'orphan',
                'slug'                 => 'orphan'
            ]
        ];
        DB::table('admin_roles')->insert($insertions);
        //////////////////////////////////////////////////////////////////////////

        $insertions                 = [
            [
                'role_id'               => '2',
                'permission_id'    => '6'
            ],
            [
                'role_id'               => '3',
                'permission_id'    => '7'
            ],
            [
                'role_id'               => '4',
                'permission_id'    => '8'
            ],
            [
                'role_id'               => '5',
                'permission_id'    => '9'
            ],
            [
                'role_id'               => '6',
                'permission_id'    => '10'
            ],
        ];
        DB::table('admin_role_permissions')->insert($insertions);
        ////////////////////////////////////////////////////////////////////////////////
        $insertions                  = [
            [
                'username'          => 'development',
                'password'          => Hash::make('development'),
                'name'                => 'مدير الإدارة التنموية',
                'department_ar'                => 'الإدارة التنموية',
                'email'                => 'development@masarat.com',
                'department'      => 'development',
                'phone'              => '0510000000',
            ],
            [
                'username'          => 'partners',
                'password'          => Hash::make('partners'),
                'name'                => 'مدير إدارة الشراكات',
                'department_ar'                => 'إدارة الشراكات',
                'email'                => 'partners@masarat.com',
                'department'      => 'partners',
                'phone'              => '0520000000',
            ],
            [
                'username'          => 'operation',
                'password'          => Hash::make('operation'),
                'name'                => 'مدير إدارة العمليات',
                'department_ar'                 => 'إدارة العمليات',
                'email'                => 'operation@masarat.com',
                'department'      => 'operation',
                'phone'              => '0530000000',
            ],
            [
                'username'          => 'director',
                'password'          => Hash::make('director'),
                'name'                => 'مدير الإدارة التنفيذية',
                'department_ar'                 => 'الإدارة التنفيذية',
                'email'                => 'director@masarat.com',
                'department'      => 'director',
                'phone'              => '0540000000',
            ],

            // مستخدمين خاصصين بالأيتام
            [
                'username'          => 'orphans_sports',
                'password'          => Hash::make('orphans_sports'),
                'name'              => 'مدير المسار الرياضي',
                'department_ar'     => 'إدارة الأيتام',
                'email'             => 'orphans_sports@masarat.com',
                'department'        => 'orphan',
                'phone'              => '0550000000',
            ],
            [
                'username'          => 'orphans_creative',
                'password'          => Hash::make('orphans_creative'),
                'name'              => 'مدير المسار الإبداعي',
                'department_ar'     => 'إدارة الأيتام',
                'email'             => 'orphans_creative@masarat.com',
                'department'        => 'orphan',
                'phone'              => '0560000000',
            ],
            [
                'username'          => 'orphans_career_guidance',
                'password'          => Hash::make('orphans_career_guidance'),
                'name'              => 'مدير مسار التوجيه المهني',
                'department_ar'     => 'إدارة الأيتام',
                'email'             => 'orphans_career_guidance@masarat.com',
                'department'        => 'orphan',
                'phone'              => '0570000000',
            ], 
            [
                'username'          => 'orphans_personal_social',
                'password'          => Hash::make('orphans_personal_social'),
                'name'              => 'مدير مسار الشخصي و الإجتماعي',
                'department_ar'     => 'إدارة الأيتام',
                'email'             => 'orphans_personal_social@masarat.com',
                'department'        => 'orphan',
                'phone'              => '0580000000',
            ], 
            [
                'username'          => 'orphans_educational',
                'password'          => Hash::make('orphans_educational'),
                'name'              => 'مدير المسار التعليمي',
                'department_ar'     => 'إدارة الأيتام',
                'email'             => 'orphans_educational@masarat.com',
                'department'        => 'orphan',
                'phone'              => '0590000000',
            ],                           
        ];
        DB::table('admin_users')->insert($insertions);
        ////////////////////////////////////////////////////////////////////////////////////
        $insertions                 = [
            [
                'role_id'              => 2,
                'user_id'              => 2
            ],
            [
                'role_id'              => 3,
                'user_id'              => 3
            ],
            [
                'role_id'              => 4,
                'user_id'              => 4
            ],
            [
                'role_id'              => 5,
                'user_id'              => 5
            ],
            // مستخدمين الأيتام
            [
                'role_id'              => 6,
                'user_id'              => 6
            ],
            [
                'role_id'              => 6,
                'user_id'              => 7
            ],
            [
                'role_id'              => 6,
                'user_id'              => 8
            ],
            [
                'role_id'              => 6,
                'user_id'              => 9
            ],
            [
                'role_id'              => 6,
                'user_id'              => 10
            ],
            
        ];
        DB::table('admin_role_users')->insert($insertions);
    }
}
