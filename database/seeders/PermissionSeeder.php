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

        Permission::create(['name' => 'questions.view']);
        Permission::create(['name' => 'questions.viewown']);
        Permission::create(['name' => 'questions.add']);
        Permission::create(['name' => 'questions.delete']);

        Permission::create(['name' => 'answers.add']);
        Permission::create(['name' => 'answers.delete']);

        // create roles and assign created permissions
        Role::create(['name' => 'docent'])
            ->givePermissionTo([
                'leerlingen.view',
                'leerlingen.edit',
                'buddies.view',
                'buddies.edit',
                'questions.view',
                'questions.delete',
                'answers.add',
                'answers.delete'
            ]);

        Role::create(['name' => 'buddie'])
            ->givePermissionTo([
                'leerlingen.viewown',
                'questions.view',
                'questions.add',
                'answers.add'
            ]);

        Role::create(['name' => 'leerling'])->givePermissionTo([
            'questions.viewown',
            'questions.add'
        ]);
        
        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());
    }
}
