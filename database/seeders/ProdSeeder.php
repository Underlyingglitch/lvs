<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class ProdSeeder extends Seeder
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

        \App\Models\SchoolYear::create([
            'name' => '22-23',
            'start' => '2022-01-01'
        ]);
    }
}
