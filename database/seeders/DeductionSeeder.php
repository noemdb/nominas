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
            'name' => 'Seguro Social (IVSS)',
            'description' => 'Deducción legal obligatoria para el IVSS.',
            'institution_id' => 1,
            'type' => 'fijo',
            'amount' => 100.00,
            'amount' => null,
            'status_exchange' => false,
        ]);

        Deduction::create([
            'name' => 'Fondo de Ahorro Habitacional (FAOV)',
            'description' => 'Aporte mensual al fondo habitacional.',
            'institution_id' => 1,
            'type' => 'fijo',
            'amount' => 100.00,
            'status_exchange' => false,
        ]);

        Deduction::create([
            'name' => 'Fondo para la reserva y seguridad industrial',
            'description' => 'Aporte mensual al reserva.',
            'rol_id' => 10,
            'type' => 'fijo',
            'amount' => 100.00,
            'status_exchange' => false,
        ]);
    }
}
