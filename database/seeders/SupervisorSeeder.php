<?php

namespace Database\Seeders;

use App\Models\Supervisor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'supervisor', 'guard_name' => 'supervisor']);
        for ($i = 1; $i <= 10; $i++) {
            Supervisor::create([
                'name' => 'Supervisor'.$i,
                'username' => 'admin'.$i.'@supervisor.com',
                'email' => 'admin'.$i.'@supervisor.com',
                'password' => Hash::make('12345678'),
            ])->assignRole($role);
        }
    }
}
