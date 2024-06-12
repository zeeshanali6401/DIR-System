<?php

namespace Database\Seeders;

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PCO;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('12345678'),
            ]
        );
        // Supervisor::create(
        //     [
        //         'name' => 'Supervisor',
        //         'username' => 'admin@supervisor.com',
        //         'email' => 'admin@supervisor.com',
        //         'password' => Hash::make('12345678'),
        //     ]
        // );
        // PCO::create(
        //     [
        //         'name' => 'PCO',
        //         'username' => 'admin@pco.com',
        //         'email' => 'admin@pco.com',
        //         'password' => Hash::make('12345678'),
        //     ]
        // );
        // $this->call([DIRTableSeeder::class]);
    }
}
