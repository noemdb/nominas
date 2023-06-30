<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreviousWorkSeeder extends Seeder
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
            DB::table('previous_works')->insert([
                'employee_id' => $faker->numberBetween(1,25),
                'company_name' => $faker->company,
                'position' => $faker->jobTitle,
                'start_date' =>Carbon::today()->addDays(rand(1, 180))->format('Y-m-d'),
                'end_date' =>Carbon::today()->addDays(rand(180, 356))->format('Y-m-d'),
                'reason_for_leaving' =>$faker->paragraphs(3, true),
                'references' =>$faker->paragraphs(3, true),
            ]);
        }
    }
}
