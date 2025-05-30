<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Worker;

class WorkerBehaviorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Obtener todos los trabajadores activos
        $workers = Worker::where('is_active', true)->get();

        // Fecha base para los registros (último día del mes actual)
        $baseDate = Carbon::now()->endOfMonth();

        foreach ($workers as $worker) {
            // Crear un registro de comportamiento para cada trabajador
            DB::table('worker_behaviors')->insert([
                'worker_id' => $worker->id,
                'date' => $baseDate->format('Y-m-d'),
                'attendance_days' => 15, // Días laborables típicos en una quincena
                'absences' => 0,
                'permissions' => 0,
                'delays' => 0,
                'labor_hours' => 120.00, // 8 horas por día * 15 días
                'observations' => 'Registro inicial generado por el sistema',
                'bonus' => 0.00,
                'discount' => 0.00,
                'status' => 'pending',
                'approved_by' => 1, // ID del usuario administrador
                'approved_at' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
