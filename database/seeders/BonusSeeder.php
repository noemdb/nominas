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
            'name' => 'Bono de alimentación',
            'description' => 'Asignación mensual para cubrir alimentación.',
            'institution_id' => 1,
            'type' => 'fijo',
            'amount' => 100.00,
            'percentage' => null,
            'status_exchange' => false,
        ]);

        Bonus::create([
            'name' => 'Bono de productividad',
            'description' => 'Bono variable según rendimiento mensual.',
            'institution_id' => 1,
            'type' => 'fijo',
            'amount' => 100.00,
            'status_exchange' => false,
        ]);

        Bonus::create([
            'name' => 'Bono de productividad. Dirección y Coordinaciones Académicas',
            'description' => 'Bono variable según rendimiento mensual.',
            'area_id' => 4,
            'type' => 'fijo',
            'amount' => 100.00,
            'status_exchange' => false,
        ]);
    }
}
