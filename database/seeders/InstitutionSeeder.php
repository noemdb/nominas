<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Faker\Factory as Factory;

class InstitutionSeeder extends Seeder
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
            DB::table('institutions')->insert([
                // 'name' => Str::random(10),
                'name' => $faker->name,
                'type' => Str::random(10),
                'acronym' => Str::random(5),
                'address' => $faker->address(),
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->email,
                'website' => $faker->url,
                'foundation_date' => Carbon::today()->addDays(rand(1, 365))->format('Y-m-d'),
                'legal_status' => Str::random(50),
                'tax_id' => $faker->randomNumber(4),
                'registration_number' => $faker->randomNumber(6),
            ]);
        }
    }
}
