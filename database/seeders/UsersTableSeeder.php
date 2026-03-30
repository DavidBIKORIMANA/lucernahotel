<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('11223344'),
                'status' => 'active',
            ]
        );
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }

        // User
        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'password' => bcrypt('11223344'),
                'status' => 'active',
            ]
        );
        if (!$user->hasRole('user')) {
            $user->assignRole($userRole);
        }
    }
}
