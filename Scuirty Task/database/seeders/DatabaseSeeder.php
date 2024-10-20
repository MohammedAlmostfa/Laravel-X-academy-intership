<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $role_admin = Role::create([
            'role_name' => 'admin',
            'description' => 'يحق له ما لاى يحق لغيره'
        ]);

        $role_user = Role::create([
            'role_name' => 'user',
            'description' => 'يحق له بعض الشغلات'
        ]);

        // Create users with hashed passwords
        $person_admin = User::create([
            'name' => 'Mohammed ALmostfa',
            'email' => 'mohammedalmostfa36@gmail.com',
            'password' => Hash::make('123456789'),
            'role_id' => $role_admin->id,
        ]);

        $person_user = User::create([
            'name' => 'Ali ALmostfa',
            'email' => 'alialmostfa36@gmail.com',
            'password' => Hash::make('123456789'),
            'role_id' => $role_user->id,
        ]);
    }
}
