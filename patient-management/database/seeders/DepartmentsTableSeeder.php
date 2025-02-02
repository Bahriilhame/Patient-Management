<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('departments')->insert([
            ['name' => 'Cardiology', 'description' => 'Heart-related issues'],
            ['name' => 'Orthopedics', 'description' => 'Bone and joint issues'],
            ['name' => 'Neurology', 'description' => 'Nervous system disorders'],
        ]);
    }
}
