<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Rick Okkersen',
            'email' => 'rickokkersen@gmail.com',
            'password' => Hash::make('Test')
        ]);

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'students.*']);
        Permission::create(['name' => 'students.view']);
        Permission::create(['name' => 'students.edit']);
        Permission::create(['name' => 'students.viewown']);
        Permission::create(['name' => 'students.delete']);

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
        Permission::create(['name' => 'answers.publish']);
        Permission::create(['name' => 'answers.delete']);

        Permission::create(['name' => 'schedule.view']);

        Permission::create(['name' => 'absencerequest.view']);

        // create roles and assign created permissions
        Role::create(['name' => 'docent'])
            ->givePermissionTo([
                'students.view',
                'students.edit',
                'buddies.view',
                'buddies.edit',
                'questions.view',
                'questions.delete',
                'answers.add',
                'answers.publish',
                'answers.delete',
                'absencerequest.view'
            ]);

        Role::create(['name' => 'buddie'])
            ->givePermissionTo([
                'students.viewown',
                'questions.view',
                'questions.add',
                'answers.add',
                'schedule.view'
            ]);

        Role::create(['name' => 'leerling'])
            ->givePermissionTo([
                'questions.viewown',
                'questions.add',
                'schedule.view'
            ]);
        
        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        $user = User::find(1);
        $user->assignRole('docent');
    }
}
