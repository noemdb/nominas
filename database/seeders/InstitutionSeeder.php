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
            $acronimo = strtoupper(substr($faker->lexify('??'), 0, 5));
            DB::table('institutions')->insert([
                'name' => $faker->company,
                'type' => $faker->word,
                'acronym' => $acronimo,
                'address' => $faker->address(),
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->email,
                'website' => $faker->url,
                'foundation_date' => $faker->dateTimeThisCentury()->format('Y-m-d'),
                'legal_status' => $faker->word,
                'tax_id' => $faker->randomNumber(4),
                'registration_number' => $faker->randomNumber(6),
            ]);
        }
    }
}
