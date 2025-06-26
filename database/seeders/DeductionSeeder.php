<?php

namespace Database\Seeders;

use App\Models\Deduction;
use Illuminate\Database\Seeder;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // Usar la constante FUNCTIONS del modelo Deduction
        $name_function = Deduction::FUNCTIONS;
        $values = array_column($name_function, 'value');

        Deduction::create([
            'name' => 'S.S.O (Seguro Social Obligatorio)',
            'description' => 'Aporte del trabajador al sistema de seguridad social. Equivale al 4% del salario base.',
            'institution_id' => 1,
            'type' => 'variable',
            'percentage' => 4.00,
            'amount' => 4.00,
            'name_function' => $values[0],
            'status_exchange' => false,
        ]);

        Deduction::create([
            'name' => 'Rég. Prest. de Empleo (Paro Forzoso)',
            'description' => 'Contribución al régimen de desempleo. 1% del salario base.',
            'institution_id' => 1,
            'type' => 'variable',
            'percentage' => 1.00,
            'amount' => 1.00,
            'name_function' => $values[1],
            'status_exchange' => false,
        ]);

        Deduction::create([
            'name' => 'FAOV (Ley de Política Habitacional)',
            'description' => 'Aporte obligatorio del trabajador para vivienda. 1% del salario base.',
            'institution_id' => 1,
            'type' => 'variable',
            'percentage' => 1.00,
            'amount' => 1.00,
            'name_function' => $values[2],
            'status_exchange' => false,
        ]);
    }
}
