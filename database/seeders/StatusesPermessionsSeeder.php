<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StatusesPermessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_statuses               = DB::table('form_status')->get();
        foreach ($all_statuses as $one_status) {
            DB::table('admin_permissions')->insertGetId([
                'name'                      => 'Case ' . $one_status->name_en,
                'slug'                      => str_replace(' ', '-', strtolower($one_status->name_en)),
                'http_path'                 => '*'
            ]);
        }

        DB::table('admin_role_permissions')->insert([
            ['role_id' => '2', 'permission_id' => '9'],
            ['role_id' => '2', 'permission_id' => '10'],
            ['role_id' => '2', 'permission_id' => '11'],
            ['role_id' => '2', 'permission_id' => '16'],
            ['role_id' => '2', 'permission_id' => '17'],
            ['role_id' => '2', 'permission_id' => '18'],
            ['role_id' => '2', 'permission_id' => '20'],
        ]);

        DB::table('admin_role_permissions')->insert([
            ['role_id' => '3', 'permission_id' => '12'],
            ['role_id' => '3', 'permission_id' => '13'],
            ['role_id' => '3', 'permission_id' => '19'],
        ]);

        DB::table('admin_role_permissions')->insert([
            ['role_id' => '4', 'permission_id' => '14'],
            ['role_id' => '4', 'permission_id' => '5'],
        ]);
    }
}
