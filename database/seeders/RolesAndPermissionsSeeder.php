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
        $permissionsData = [
            ['name' => 'edit', 'guard_name' => 'web'],
            ['name' => 'view', 'guard_name' => 'web'],
            ['name' => 'delete', 'guard_name' => 'web'],
            // Add more permissions as needed
        ];

        foreach ($permissionsData as $permissionData) {
            $permission = Permission::findOrCreate(
                $permissionData['name'],
                $permissionData['guard_name']
            );
            $permission->save();
        }


        $rolesData = [
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'user', 'guard_name' => 'web'],
            ['name' => 'captain', 'guard_name' => 'web'],
        ];
        foreach ($rolesData as $rolesDatum) {
            $roles = Role::findOrCreate(
                $rolesDatum['name'],
                $rolesDatum['guard_name']
            );
            $roles->save();
        }
    }
}
