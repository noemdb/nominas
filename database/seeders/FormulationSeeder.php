<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');
        $latexs = ['\frac{a+b+c}{d}', '\frac{a}{b}\cdot c+12', '\frac{a+d}{b+c}', '\frac{123}{abc}'];

        for ($i = 0; $i < 25; $i++) {
            DB::table('formulations')->insert([
                'institution_id' => $faker->numberBetween(1, 25),
                'name' => $faker->name,
                'description' => $faker->paragraphs(3, true),
                'latex' => $faker->randomElement($latexs),
            ]);
        }
    }
}
