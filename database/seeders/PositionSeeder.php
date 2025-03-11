<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Position;
use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\Worker;

class PositionSeeder extends Seeder
{
    // database/seeders/PositionSeeder.php
    public function run()
    {
        // // Crear datos relacionados primero
        // Area::factory(5)->create();
        // Rol::factory(5)->create();
        // Worker::factory(20)->create(); // Trabajadores iniciales

        // Crear posiciones asignando trabajadores sin posición
        $workersWithoutPosition = Worker::whereDoesntHave('positions')->get();

        foreach ($workersWithoutPosition as $worker) {
            Position::factory()->create(['worker_id' => $worker->id]);
        }

        // Crear posiciones adicionales (creará nuevos trabajadores si es necesario)
        $remaining = 100 - $workersWithoutPosition->count();
        if ($remaining > 0) {
            Position::factory($remaining)->create();
        }

        // Crear posiciones sin trabajador
        Position::factory(5)->withoutWorker()->create();
    }
}