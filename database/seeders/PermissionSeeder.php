<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups     = ['Pages', 'Files', 'Users', 'Roles', 'Permissions', 'Events','Categories','Sites','Logs'];
        $actions    = ['index', 'view', 'create', 'update', 'delete'];
        foreach ($groups as $group) {
            foreach ($actions as $action) {
                DB::table('permissions')->insert([
                    'guard_name' => 'web',
                    'name' => $group . '-' . $action,

                ]);
            }
        }
        $groups     = ['Single Site'];
        $actions    = ['index', 'view', 'create', 'update', 'delete', 'sync', 'shippings'];
        foreach ($groups as $group) {
            foreach ($actions as $action) {
                DB::table('permissions')->insert([
                    'guard_name' => 'web',
                    'name' => $group . '-' . $action,

                ]);
            }
        }
    }
}
