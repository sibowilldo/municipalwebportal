<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
        app()['cache']->forget('spatie.role.cache');

        // create roles
        Permission::create(['guard_name' => 'web', 'name' => 'create role']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit role']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete role']);
        Permission::create(['guard_name' => 'web', 'name' => 'list roles']);
        //permissions
        Permission::create(['guard_name' => 'web', 'name' => 'create permission']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit permission']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete permission']);
        Permission::create(['guard_name' => 'web', 'name' => 'list permissions']);
        //users
        Permission::create(['guard_name' => 'web', 'name' => 'create user']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit user']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete user']);
        Permission::create(['guard_name' => 'web', 'name' => 'list users']);
        //faults
        Permission::create(['guard_name' => 'web', 'name' => 'create fault']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit fault']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete fault']);
        Permission::create(['guard_name' => 'web', 'name' => 'list faults']);

        $role = Role::create(['guard_name' => 'web', 'name' => 'user']);
        $role->givePermissionTo(['create fault', 'edit fault', 'list faults']);

        $role = Role::create(['guard_name' => 'web', 'name' => 'administrator']);
        $role->givePermissionTo(['create user', 'create fault', 'edit user', 'edit fault', 'delete user', 'delete fault', 'list users', 'list faults']);

        $role = Role::create(['guard_name' => 'web', 'name' => 'super-administrator']);
        $role->givePermissionTo(Permission::all());


        //users with API Guard
        Permission::create(['guard_name' => 'api', 'name' => 'create user']);
        Permission::create(['guard_name' => 'api', 'name' => 'edit user']);
        Permission::create(['guard_name' => 'api', 'name' => 'list users']);
        //faults with API Guard
        Permission::create(['guard_name' => 'api', 'name' => 'create fault']);
        Permission::create(['guard_name' => 'api', 'name' => 'edit fault']);
        Permission::create(['guard_name' => 'api', 'name' => 'delete fault']);
        Permission::create(['guard_name' => 'api', 'name' => 'list faults']);

        // create roles and assign created permissions

        $role = Role::create(['guard_name' => 'api', 'name' => 'user']);
        $role->givePermissionTo(['create fault', 'edit fault', 'list faults']);

        $role = Role::create(['guard_name' => 'api', 'name' => 'administrator']);
        $role->givePermissionTo(['create user', 'create fault', 'edit user', 'edit fault', 'delete fault', 'list users', 'list faults']);
    }
}
