<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
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
            // 'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'identification' => fake()->unique()->numberBetween(10000000, 99999999),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => '+58 ' . $this->faker->randomElement(['412', '414', '416', '426']) . '-' . $this->faker->randomNumber(7, true),
            'birth_date' => $this->faker->date('Y-m-d', '2005-01-01'),
            'gender' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'marital_status' => $this->faker->randomElement(['Soltero', 'Casado', 'Divorciado', 'Viudo']),
            'nationality' => 'Venezolano',
            'hire_date' => $this->faker->date('Y-m-d', '2022-01-01'),
            'base_salary' => $this->faker->randomFloat(2, 500, 2000),
            'contract_type' => $this->faker->randomElement(['Fijo', 'Temporal', 'Contratado']),
            'payment_method' => $this->faker->randomElement(['Transferencia', 'Cheque', 'Efectivo']),
            'bank_name' => $this->faker->randomElement(['Banco de Venezuela', 'Banesco', 'Mercantil', 'Bicentenario']),
            'bank_account_number' => $this->faker->bankAccountNumber,
            'tax_identification_number' => 'J-' . $this->faker->randomNumber(9, true),
            'social_security_number' => fake()->unique()->numberBetween(10000000, 99999999),
            'pension_fund' => $this->faker->randomElement(['IVSS', 'Fondo de Jubilaciones', null]),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
