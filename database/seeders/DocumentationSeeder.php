<?php

namespace Database\Seeders;

use App\Models\Employee\Documentation;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');
        $arr = Documentation::list_type();
        for ($i=0; $i < 25; $i++) {
            DB::table('documentations')->insert([
                'employee_id' => $faker->numberBetween(1,25),
                'description' =>$faker->paragraphs(3, true),
                'type' =>$faker->randomElement($arr),
                'number' => $faker->randomNumber(8),
                'expiration_date' =>$faker->dateTimeThisCentury->format('Y-m-d'),
                'issue_date' =>$faker->dateTimeThisCentury->format('Y-m-d'),
                'country' => $faker->country,
                'file' => $faker->url,
                'comments' =>$faker->randomNumber(8),
            ]);
        }
    }
}
