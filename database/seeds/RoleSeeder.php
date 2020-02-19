<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'edit images']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);
    }
}
