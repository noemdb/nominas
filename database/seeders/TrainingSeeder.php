<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');
        for ($i=0; $i < 25; $i++) {
            DB::table('trainings')->insert([
                'employee_id' => $faker->numberBetween(1,25),
                'name' => $faker->name,
                'description' =>$faker->paragraphs(3, true),
                'provider' =>$faker->company,
                'start' =>$faker->dateTimeThisCentury->format('Y-m-d'),
                'end' =>$faker->dateTimeThisCentury->format('Y-m-d'),
                'location' => $faker->address,
                'duration_hours' => $faker->numberBetween(1,100),
                'certificate_number' => $faker->randomNumber(8),
                'certificate_issue' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'certificate_expiration' => $faker->dateTimeThisCentury->format('Y-m-d'),
            ]);
        }
    }
}
