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
        ])->assignRole('super-admin');

        User::firstOrCreate([
            'email' => 'admin@surgun.com',
        ], [
            'name' => 'Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ])->assignRole('admin');

        User::firstOrCreate([
            'email' => 'guest@surgun.com',
        ], [
            'name' => 'Guest',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ])->assignRole('guest');
    }
}
