<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $imageUrls = [
            'https://via.placeholder.com/150?text=Image+1',
            'https://via.placeholder.com/150?text=Image+2',
            'https://via.placeholder.com/150?text=Image+3',
            'https://via.placeholder.com/150?text=Image+4',
            'https://via.placeholder.com/150?text=Image+5',
            'https://via.placeholder.com/150?text=Image+6',
            'https://via.placeholder.com/150?text=Image+7',
            'https://via.placeholder.com/150?text=Image+8',
            'https://via.placeholder.com/150?text=Image+9',
            'https://via.placeholder.com/150?text=Image+10',
        ];

        foreach (range(1, 10) as $index) {
            $imageUrl = $faker->randomElement($imageUrls);

            $filename = $imageUrl;

        // Assuming departments already exist
        $departmentIds = DB::table('departments')->pluck('id');

        foreach (range(1, 10) as $index) {
            DB::table('doctors')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'contact_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'department_id' => $faker->randomElement($departmentIds),
                'profile_image' => $filename,
            ]);
        }
    }
    }
}
