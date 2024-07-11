<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PatientsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('patients')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'gender' => $faker->randomElement(['Male', 'Female', 'Other']),
                'contact_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
            ]);
        }
    }
}
