<?php

namespace Database\Seeders;

use App\Models\Bonus;
use App\Models\Deduction;
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
            'description' => '5% del salario base por cada año trabajado.',
            'institution_id' => 1,
            'type' => 'variable',
            'percentage' => 5.00,
            'amount' => 0.00,
            'name_function' => 'seniority_bonus',
            'status_exchange' => false,
            'status_active' => true,
        ]);

        Bonus::create([
            'name' => 'Prima de jerarquía',
            'description' => '10% del salario base por nivel jerárquico.',
            'institution_id' => 1,
            'type' => 'variable',
            'percentage' => 10.00,
            'amount' => 0.00,
            'name_function' => 'hierarchy_bonus', // debes crear esta función en Bonus::FUNCTIONS y en calculateAmount()
            'status_exchange' => true,
            'status_active' => true,
        ]);

        Bonus::create([
            'name' => 'Prima por estudios',
            'description' => '8% del salario base por estudios de cuarto nivel.',
            'institution_id' => 1,
            'type' => 'variable',
            'percentage' => 8.00,
            'amount' => 0.00,
            'name_function' => 'education_bonus',
            'status_exchange' => false,
            'status_active' => true,
        ]);
    }
}
