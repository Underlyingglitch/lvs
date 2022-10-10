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

        \App\Models\SomTodayiCalAccount::create([
            'user_id' => 1,
            'ical_url' => "https://elo.somtoday.nl/services/webdav/calendarfeed/99f5d02e-c928-47af-ba6a-1f72e364d753/121c780b-038f-49d6-9204-9c10c8d08eeb"
        ]);

        \App\Models\SchoolYear::create([
            'name' => '21-22',
            'start' => '2021-01-01',
            'end' => '2021-12-31'
        ]);
        \App\Models\SchoolYear::create([
            'name' => '22-23',
            'start' => '2022-01-01'
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
        Permission::create(['name' => 'questions.publish']);

        Permission::create(['name' => 'answers.add']);
        Permission::create(['name' => 'answers.delete']);

        Permission::create(['name' => 'schedule.view']);

        Permission::create(['name' => 'absencerequest.view']);
        Permission::create(['name' => 'absencerequest.add']);

        Permission::create(['name' => 'projects.owns']);
        Permission::create(['name' => 'projects.viewown']);
        Permission::create(['name' => 'projects.view']);
        Permission::create(['name' => 'projects.edit']);
        Permission::create(['name' => 'projects.delete']);

        // create roles and assign created permissions
        Role::create(['name' => 'docent'])
            ->givePermissionTo([
                'students.view',
                'students.edit',
                'buddies.view',
                'buddies.edit',
                'questions.view',
                'questions.delete',
                'questions.publish',
                'answers.add',
                'answers.delete',
                'absencerequest.view',
                'projects.view',
                'projects.edit',
                'projects.delete'
            ]);

        Role::create(['name' => 'buddie'])
            ->givePermissionTo([
                'students.viewown',
                'questions.view',
                'questions.add',
                'answers.add',
                'schedule.view',
                'absencerequest.add',
                'projects.viewown',
                'projects.edit'
            ]);

        Role::create(['name' => 'leerling'])
            ->givePermissionTo([
                'questions.viewown',
                'questions.add',
                'schedule.view',
                'absencerequest.add',
                'projects.owns'
            ]);
        
        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        $user = User::find(1);
        $user->assignRole('leerling');
    }
}
