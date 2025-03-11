<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Area;
use App\Models\Rol;
use App\Models\Worker;

class PositionFactory extends Factory
{
    public function definition()
    {
        // Buscar trabajadores sin posición asignada
        $workersWithoutPosition = Worker::whereDoesntHave('positions')->get();
        if ($workersWithoutPosition->isNoTEmpty()) {
            $worker = $workersWithoutPosition->random();
        }

        return [
            'start_date' => $startDate = $this->faker->dateTimeBetween('-1 year'),
            'end_date' => $this->faker->dateTimeBetween($startDate, '+1 year'),
            'observations' => $this->faker->optional()->sentence(10),
            'is_active' => $this->faker->boolean(90),
            'area_id' => Area::inRandomOrder()->first()->id ,
            'rol_id' => Rol::inRandomOrder()->first()->id ,
            'worker_id' => $worker->id ?? null,
        ];
        
    }

    /**
     * Estado para posiciones sin trabajador asignado
     */
    public function withoutWorker()
    {
        return $this->state(function (array $attributes) {
            return [
                'worker_id' => null,
            ];
        });
    }
}