<?php

namespace Database\Seeders;

use App\Models\Supervisor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'supervisor', 'guard_name' => 'supervisor']);
        $permissionNames = Permission::pluck('name');
        foreach ($permissionNames as $permissionName) {
            $permission = Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'supervisor'
            ]);
            $role->givePermissionTo($permission);
        }
        for ($i = 1; $i <= 10; $i++) {
            $supervisor = Supervisor::create([
                'name' => 'Supervisor' . $i,
                'username' => rand(10000, 99999),
                'email' => 'admin' . $i . '@supervisor.com',
                'password' => Hash::make('12345678'),
            ]);

            // Assign the role to the newly created supervisor
            $supervisor->assignRole($role);
        }
    }
}
