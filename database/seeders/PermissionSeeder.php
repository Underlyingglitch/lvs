<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'leerlingen.*']);
        Permission::create(['name' => 'leerlingen.view']);
        Permission::create(['name' => 'leerlingen.edit']);
        Permission::create(['name' => 'leerlingen.viewown']);
        Permission::create(['name' => 'leerlingen.delete']);

        Permission::create(['name' => 'buddies.*']);
        Permission::create(['name' => 'buddies.view']);
        Permission::create(['name' => 'buddies.edit']);
        Permission::create(['name' => 'buddies.viewown']);
        Permission::create(['name' => 'buddies.delete']);

        Permission::create(['name' => 'users.*']);
        Permission::create(['name' => 'users.view']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.viewown']);
        Permission::create(['name' => 'users.delete']);

        // create roles and assign created permissions
        Role::create(['name' => 'docent'])
            ->givePermissionTo([
                'leerlingen.view',
                'leerlingen.edit',
                'buddies.view',
                'buddies.edit'
            ]);

        Role::create(['name' => 'buddie'])
            ->givePermissionTo([
                'leerlingen.viewown'
            ]);

        Role::create(['name' => 'leerling']);
        
        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());
    }
}
