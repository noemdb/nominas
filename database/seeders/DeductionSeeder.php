<?php

namespace Database\Seeders;

use App\Models\Deduction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Deduction::create([
            'name' => 'S.S.O (Seguro Social Obligatorio)',
            'description' => 'Aporte del trabajador al sistema de seguridad social. Equivale al 4% del salario base.',
            'institution_id' => 1,
            'type' => 'fijo',
            'percentage' => 4.00,
            'name_function' => 'deduccion_sso',
            'status_exchange' => false,
        ]);

        Deduction::create([
            'name' => 'Rég. Prest. de Empleo (Paro Forzoso)',
            'description' => 'Contribución al régimen de desempleo. 1% del salario base.',
            'institution_id' => 1,
            'type' => 'fijo',
            'percentage' => 1.00,
            'name_function' => 'deduccion_paro_forzoso',
            'status_exchange' => false,
        ]);

        Deduction::create([
            'name' => 'FAOV (Ley de Política Habitacional)',
            'description' => 'Aporte obligatorio del trabajador para vivienda. 1% del salario base.',
            'institution_id' => 1,
            'type' => 'fijo',
            'percentage' => 1.00,
            'name_function' => 'deduccion_faov',
            'status_exchange' => false,
        ]);
    }
}
