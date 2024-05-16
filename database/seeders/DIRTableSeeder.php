<?php

namespace Database\Seeders;

use App\Models\DIR;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DIRTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DIR::factory()->count(37)->create();
    }
}
