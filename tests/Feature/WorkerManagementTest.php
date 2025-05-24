<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Worker;
use App\Models\Position;
use App\Models\Area;
use App\Models\Rol;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkerManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function user_can_view_workers_list()
    {
        $this->actingAs($this->user)
            ->get(route('data-management'))
            ->assertStatus(200)
            ->assertViewIs('data_management')
            ->assertViewHas('workers');
    }

    /** @test */
    public function user_can_create_new_worker()
    {
        $workerData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'identification' => '123456789',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'birth_date' => '1990-01-01',
            'gender' => 'male',
            'marital_status' => 'single',
            'nationality' => 'Venezolano',
            'hire_date' => now()->format('Y-m-d'),
            'base_salary' => 1000,
            'contract_type' => 'full-time',
            'payment_method' => 'bank_transfer',
            'bank_name' => 'Test Bank',
            'bank_account_number' => '1234567890',
            'tax_identification_number' => 'J-123456789',
            'social_security_number' => '123456789',
            'pension_fund' => 'Test Fund',
            'is_active' => true
        ];

        $this->actingAs($this->user)
            ->post(route('workers.store'), $workerData)
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('workers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'identification' => '123456789'
        ]);
    }

    /** @test */
    public function user_can_edit_existing_worker()
    {
        $worker = Worker::factory()->create();

        $updateData = [
            'first_name' => 'Johnny',
            'last_name' => 'Doe',
            'identification' => $worker->identification,
            'email' => $worker->email,
            'phone' => '9876543210',
            'birth_date' => $worker->birth_date,
            'gender' => $worker->gender,
            'marital_status' => $worker->marital_status,
            'nationality' => $worker->nationality,
            'hire_date' => $worker->hire_date,
            'base_salary' => 1500,
            'contract_type' => $worker->contract_type,
            'payment_method' => $worker->payment_method,
            'bank_name' => 'New Bank',
            'bank_account_number' => '0987654321',
            'tax_identification_number' => $worker->tax_identification_number,
            'social_security_number' => $worker->social_security_number,
            'pension_fund' => $worker->pension_fund,
            'is_active' => true
        ];

        $this->actingAs($this->user)
            ->put(route('workers.update', $worker), $updateData)
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('workers', [
            'id' => $worker->id,
            'first_name' => 'Johnny',
            'base_salary' => 1500
        ]);
    }

    /** @test */
    public function user_can_delete_worker()
    {
        $worker = Worker::factory()->create();

        $this->actingAs($this->user)
            ->delete(route('workers.destroy', $worker))
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('workers', [
            'id' => $worker->id
        ]);
    }

    /** @test */
    public function user_can_assign_position_to_worker()
    {
        $worker = Worker::factory()->create();
        $area = Area::factory()->create();
        $rol = Rol::factory()->create();

        $positionData = [
            'worker_id' => $worker->id,
            'area_id' => $area->id,
            'rol_id' => $rol->id,
            'start_date' => now()->format('Y-m-d'),
            'is_active' => true
        ];

        $this->actingAs($this->user)
            ->post(route('positions.store'), $positionData)
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('positions', [
            'worker_id' => $worker->id,
            'area_id' => $area->id,
            'rol_id' => $rol->id
        ]);
    }

    /** @test */
    public function user_cannot_create_worker_with_duplicate_identification()
    {
        $existingWorker = Worker::factory()->create([
            'identification' => '123456789'
        ]);

        $workerData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'identification' => '123456789', // Duplicado
            'email' => 'john@example.com',
            // ... otros campos requeridos
        ];

        $this->actingAs($this->user)
            ->post(route('workers.store'), $workerData)
            ->assertSessionHasErrors('identification');
    }

    /** @test */
    public function user_can_search_workers()
    {
        $worker1 = Worker::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);
        $worker2 = Worker::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Smith'
        ]);

        $this->actingAs($this->user)
            ->get(route('data-management', ['search' => 'John']))
            ->assertStatus(200)
            ->assertViewHas('workers', function ($workers) {
                return $workers->count() === 1 && $workers->first()->first_name === 'John';
            });
    }
}