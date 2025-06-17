<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'super-admin'], [
            'guard_name' => 'web',
            'description' => 'Super Administrator Role',
        ]);

        Role::firstOrCreate(['name' => 'admin'], [
            'guard_name' => 'web',
            'description' => 'Administrator Role',
        ]);

        Role::firstOrCreate(['name' => 'guest'], [
            'guard_name' => 'web',
            'description' => 'Guest Role',
        ]);
    }
}
