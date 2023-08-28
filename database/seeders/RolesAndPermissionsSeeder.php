<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create permissions
        Permission::create(['name' => 'edit','guard_name'=> 'web']);
        Permission::create(['name' => 'delete','guard_name'=> 'web']);

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin','guard_name'=> 'web']);
        $userRole = Role::create(['name' => 'user','guard_name'=> 'web']);
        $captainRole = Role::create(['name' => 'captain','guard_name'=> 'web']);
    }
}
