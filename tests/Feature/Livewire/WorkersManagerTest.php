<?php

namespace Tests\Feature\Livewire;

use App\Livewire\DataManagement\WorkersManager;
use App\Models\Worker;
use App\Models\User;
use App\Models\Position;
use App\Models\Area;
use App\Models\Rol;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkersManagerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_render_component()
    {
        $component = Livewire::test(WorkersManager::class);
        $component->assertStatus(200);
    }

    /** @test */
    public function it_can_list_workers()
    {
        $workers = Worker::factory()->count(3)->create();

        $component = Livewire::test(WorkersManager::class)
            ->assertViewHas('workers', function ($paginatedWorkers) use ($workers) {
                return $paginatedWorkers->count() === 3;
            });
    }

    /** @test */
    public function it_can_search_workers()
    {
        $worker1 = Worker::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);
        $worker2 = Worker::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Smith'
        ]);

        Livewire::test(WorkersManager::class)
            ->set('search', 'John')
            ->assertViewHas('workers', function ($workers) {
                return $workers->count() === 1 && $workers->first()->first_name === 'John';
            });
    }

    /** @test */
    public function it_can_sort_workers()
    {
        $worker1 = Worker::factory()->create(['first_name' => 'Zack']);
        $worker2 = Worker::factory()->create(['first_name' => 'Alice']);

        Livewire::test(WorkersManager::class)
            ->set('sortField', 'first_name')
            ->set('sortDirection', 'asc')
            ->assertViewHas('workers', function ($workers) {
                return $workers->first()->first_name === 'Alice';
            });
    }

    /** @test */
    public function it_can_create_worker()
    {
        $user = User::factory()->create();

        Livewire::test(WorkersManager::class)
            ->set('worker', [
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
            ])
            ->set('user', [
                'username' => 'johndoe',
                'password' => 'password'
            ])
            ->call('save')
            ->assertSet('showModal', false);

        $this->assertDatabaseHas('workers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'identification' => '123456789'
        ]);
    }

    /** @test */
    public function it_can_edit_worker()
    {
        $worker = Worker::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);

        $component = Livewire::test(WorkersManager::class)
            ->call('edit', $worker->id)
            ->assertSet('workerId', $worker->id)
            ->assertSet('isEdit', true)
            ->assertSet('showModal', true);

        $component->set('worker.first_name', 'Johnny')
            ->call('save')
            ->assertSet('showModal', false);

        $this->assertDatabaseHas('workers', [
            'id' => $worker->id,
            'first_name' => 'Johnny'
        ]);
    }

    /** @test */
    public function it_can_delete_worker()
    {
        $worker = Worker::factory()->create();

        Livewire::test(WorkersManager::class)
            ->call('confirmDelete', $worker->id)
            ->assertSet('confirmingDelete', true)
            ->assertSet('deleteId', $worker->id)
            ->call('deleteWorker')
            ->assertSet('confirmingDelete', false);

        $this->assertDatabaseMissing('workers', [
            'id' => $worker->id
        ]);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        Livewire::test(WorkersManager::class)
            ->set('worker', [
                'first_name' => '',
                'last_name' => '',
                'identification' => ''
            ])
            ->call('save')
            ->assertHasErrors([
                'worker.first_name',
                'worker.last_name',
                'worker.identification'
            ]);
    }
}
