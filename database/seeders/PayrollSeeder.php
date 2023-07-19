<?php

namespace Database\Seeders;

use App\Models\Institution\Payroll;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');
        $arr = Payroll::list_frequency();
        for ($i=0; $i < 25; $i++) {
            DB::table('payrolls')->insert([
                'institution_id' => $faker->numberBetween(1,10), //Institución
                'level_id' => $faker->numberBetween(1,4), //Institución
                'frequency' => $faker->randomElement($arr),
                'name' => $faker->name,
                'description' =>$faker->paragraphs(3, true),
            ]);
        }
    }
}


/*
institution_id
level_id
frequency
name
description
*/
