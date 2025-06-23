<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Auth\App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'superadmin@surgun.com',
        ], [
            'name' => 'Super Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => 1,
        ])->assignRole('super-admin')->givePermissionTo(['can_create_data', 'can_update_data', 'can_delete_data']);

        User::firstOrCreate([
            'email' => 'admin@surgun.com',
        ], [
            'name' => 'Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => 2,
        ])->assignRole('admin')->givePermissionTo(['can_create_data', 'can_update_data', 'can_conditional_delete_data']);

        User::firstOrCreate([
            'email' => 'guest@surgun.com',
        ], [
            'name' => 'Guest',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => 3,
        ])->assignRole('guest')->givePermissionTo(['can_create_data', 'can_update_data', 'can_conditional_delete_data']);
    }
}
