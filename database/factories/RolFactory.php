<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RolFactory extends Factory
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
                'Dirección General',
                'Concejo Directivo',
                'Dirección Académica',
                'Dirección Administrativa',
                'Subdirecciones',
                'Coordinadores',
                'Jefes de Área',
                'Jefes de Año (Profesores Guía)',
                'Docentes de Aula',
                'Docentes por Hora',
                'Docentes Suplentes',
                'Asistentes Administrativos',
                'Auxiliares Administrativos',
                'Obrero',
                'Chofer',
                'Jardinero',
                'Limpieza'
            ]),
            'description' => $this->faker->sentence(8), // Descripción breve del rol
        ];
    }
}
