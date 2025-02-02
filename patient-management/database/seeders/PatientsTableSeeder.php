<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PatientsTableSeeder extends Seeder
{
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

            DB::table('patients')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'gender' => $faker->randomElement(['Male', 'Female', 'Other']),
                'contact_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'profile_image' => $filename,
            ]);
        }
    }
}
