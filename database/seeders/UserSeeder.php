<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User; // Update this with the actual User model namespace

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        $captainRole = Role::where('name', 'captain')->first();

        // Create and assign roles and permissions to users
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'mobile' => 8128273972,
            'password' => bcrypt('password'), // Hashed password
        ]);
        $adminUser->assignRole($adminRole); // Assign admin role

        $regularUser = User::create([
            'name' => 'User1',
            'email' => null,
            'mobile' => 8128273971,
            'password' => bcrypt('password'), // Hashed password
        ]);
        $regularUser->assignRole($userRole); // Assign user role

        $captainUser = User::create([
            'name' => 'Captain User',
            'email' => 'captain@example.com',
            'mobile' => 8128273973,
            'password' => bcrypt('password'), // Hashed password
        ]);
        $captainUser->assignRole($captainRole); // Assign user role
    }
}
