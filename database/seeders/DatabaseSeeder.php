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

        User::factory()->create([
            'name' => 'Rick Okkersen',
            'email' => 'rickokkersen@gmail.com',
            'password' => Hash::make('Test'),
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Test Buddy',
            'email' => 'teacher@test.com',
            'password' => Hash::make('Test'),
            'role' => 'teacher'
        ]);

        User::factory()->create([
            'name' => 'Test Buddy',
            'email' => 'buddie@test.com',
            'password' => Hash::make('Test'),
            'role' => 'buddie'
        ]);

        User::factory()->create([
            'name' => 'Test Leerling',
            'email' => 'student@test.com',
            'password' => Hash::make('Test'),
            'buddie_id' => 2,
            'role' => 'student'
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
    }
}
