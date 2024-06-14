<?php

namespace Database\Seeders;

use App\Models\PCO;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PcoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'pco', 'guard_name' => 'pco']);
        $permissionNames = Permission::pluck('name');
        foreach ($permissionNames as $permissionName) {
            $permission = Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'pco'
            ]);
            $role->givePermissionTo($permission);
        }
        for ($i = 1; $i <= 10; $i++) {
            PCO::create([
                'name' => 'PCO' . $i,
                'username' => rand(10000, 99999),
                'email' => 'admin' . $i . '@pco.com',
                'password' => Hash::make('12345678'),
            ])->assignRole($role);
        }
    }
}
