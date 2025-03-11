<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker = \Faker\Factory::create('es_VE'); // Configurar Faker en español (Venezuela)

        return [
            'name' => $this->faker->unique()->randomElement([
                'Dirección', 'Subdirección', 'Coordinación', 'Jefatura',
                'Docente','Especialista', 'Asistencia', 'Obrero','Jardinería'
            ]),
            'description' => $this->faker->sentence(10), // Genera una descripción corta
        ];
    }
}
