<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialSecuritySeeder extends Seeder
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
            DB::table('social_securities')->insert([
                'employee_id' => $faker->numberBetween(1,25),
                'number' => $faker->randomNumber(8),
                'card_number' => $faker->randomNumber(8),
                'card_issue_date' =>$faker->dateTimeThisCentury->format('Y-m-d'),
                'card_expiration_date' =>$faker->dateTimeThisCentury->format('Y-m-d'),
                'benefits_eligibility' =>$faker->numberBetween(0,1),
                'benefits_payment_amount' =>$faker->numberBetween(0,20),
                'benefits_payment_start_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'benefits_payment_end_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            ]);
        }
    }
}
