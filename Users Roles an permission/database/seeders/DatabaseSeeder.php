<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a user
        $user = User::create([
            'name' => 'Mohammed',
            'email' => 'mohmed@gmaiel.com',
            'password' =>'123456789',
        ]);

        // Create a role
        $role = Role::create([
            'name' => 'Admin',
            'description' => 'بجق له ما لا يحق لغيره',
        ]);

        // Assign the role to the user
        $user->roles()->attach($role->id);
    }
}
