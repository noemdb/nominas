<?php

namespace Database\Seeders;

use App\Models\Payroll\Bonification;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BonificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('es_VE');
        $arr_type = Bonification::list_type();
        $arr_frecuency = Bonification::list_frecuency();
        for ($i=0; $i < 25; $i++) {
            DB::table('bonifications')->insert([
                'employee_id' => $faker->numberBetween(1,25),
                'type' =>$faker->randomElement($arr_type),
                'description' =>$faker->paragraphs(3, true),
                'amount' =>$faker->randomFloat(2, 0, 100),
                'frequency' =>$faker->randomElement($arr_frecuency),
                'date' =>$faker->dateTimeThisCentury->format('Y-m-d'),
            ]);
        }
    }
}

/*

'employee_id','type','description','amount','frequency','date'

*/
