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
        $permissions = Permission::where('guard_name', 'pco')->get();
        $role = Role::firstOrCreate(['name' => 'pco', 'guard_name' => 'pco']);
        $role->givePermissionTo($permissions);
        for ($i = 1; $i <= 10; $i++) {
            PCO::create([
                'name' => 'PCO'.$i,
                'username' => 'admin'.$i.'@pco.com',
                'email' => 'admin'.$i.'@pco.com',
                'password' => Hash::make('12345678'),
            ])->assignRole($role);
        }
    }
}
