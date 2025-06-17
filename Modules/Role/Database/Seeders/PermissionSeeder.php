<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'can_create_data'], [
            'guard_name' => 'web',
            'description' => 'Permission to create data',
        ]);

        Permission::firstOrCreate(['name' => 'can_update_data'], [
            'guard_name' => 'web',
            'description' => 'Permission to update data',
        ]);

        Permission::firstOrCreate(['name' => 'can_delete_data'], [
            'guard_name' => 'web',
            'description' => 'Permission to delete data',
        ]);

        Permission::firstOrCreate(['name' => 'can_conditional_delete_data'], [
            'guard_name' => 'web',
            'description' => 'Permission to conditional delete data',
        ]);
    }
}
