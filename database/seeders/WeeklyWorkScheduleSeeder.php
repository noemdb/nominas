<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\WeeklyWorkSchedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeeklyWorkScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las posiciones activas con trabajadores activos
        $positions = Position::where('is_active', true)
            ->whereHas('worker', function ($query) {
                $query->where('is_active', true);
            })
            ->get();

        // Días laborables (Lunes a Viernes)
        $workDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        // Desactivar las restricciones de clave foránea temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Limpiar horarios existentes
        WeeklyWorkSchedule::truncate();

        // Generar horarios para cada posición
        foreach ($positions as $position) {
            foreach ($workDays as $day) {
                // Generar horas aleatorias entre 1 y 8
                $plannedHours = rand(1, 8);

                WeeklyWorkSchedule::create([
                    'position_id' => $position->id,
                    'day_of_week' => $day,
                    'planned_hours' => $plannedHours,
                    'is_active' => true,
                    'observations' => 'Horario generado automáticamente por el seeder',
                ]);
            }
        }

        // Reactivar las restricciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->command->info('Horarios semanales generados exitosamente.');
    }
}
