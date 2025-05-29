<?php

namespace Database\Seeders;

use App\Models\Bonus;
use App\Models\Deduction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Bonus::create([
            'name' => 'Prima de antigüedad',
            'description' => 'Beneficio adicional por años de servicio en la institución. 5% del salario base por cada año trabajado.',
            'institution_id' => 1,
            'type' => 'fijo',
            'percentage' => 5.00,
            'name_function' => 'prima_antiguedad',
            'status_exchange' => false,
        ]);

        Bonus::create([
            'name' => 'Prima de jerarquía',
            'description' => 'Compensación económica por el cargo o nivel jerárquico (coordinador, director, etc). 10% del salario base.',
            'institution_id' => 1,
            'type' => 'fijo',
            'percentage' => 10.00,
            'name_function' => 'prima_jerarquia',
            'status_exchange' => false,
        ]);

        Bonus::create([
            'name' => 'Prima por estudios',
            'description' => 'Incentivo mensual por estudios de cuarto nivel (especialización, maestría, doctorado). 8% del salario base.',
            'institution_id' => 1,
            'type' => 'fijo',
            'percentage' => 8.00,
            'name_function' => 'prima_estudios',
            'status_exchange' => false,
        ]);
    }
}
