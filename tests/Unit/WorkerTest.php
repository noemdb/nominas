<?php

namespace Tests\Unit;

use App\Models\Worker;
use App\Models\User;
use App\Models\Position;
use App\Models\Area;
use App\Models\Rol;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_full_name()
    {
        $worker = Worker::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);

        $this->assertEquals('John Doe', $worker->full_name);
    }

    /** @test */
    public function it_can_get_current_position()
    {
        $worker = Worker::factory()->create();
        $area = Area::factory()->create();
        $rol = Rol::factory()->create();

        $position = Position::factory()->create([
            'worker_id' => $worker->id,
            'area_id' => $area->id,
            'rol_id' => $rol->id,
            'is_active' => true,
            'start_date' => now()->subDays(5)
        ]);

        $this->assertTrue($worker->current_position->is($position));
    }

    /** @test */
    public function it_can_get_last_position_info()
    {
        $worker = Worker::factory()->create();
        $area = Area::factory()->create(['name' => 'IT']);
        $rol = Rol::factory()->create(['name' => 'Developer']);

        Position::factory()->create([
            'worker_id' => $worker->id,
            'area_id' => $area->id,
            'rol_id' => $rol->id,
            'is_active' => true,
            'start_date' => now()->subDays(5)
        ]);

        $this->assertEquals('IT - Developer', $worker->last_position_name);
    }

    /** @test */
    public function it_can_check_if_worker_is_active()
    {
        $worker = Worker::factory()->create(['is_active' => true]);
        $this->assertTrue($worker->is_active);

        $worker->is_active = false;
        $worker->save();
        $this->assertFalse($worker->is_active);
    }

    /** @test */
    public function it_can_create_user_account()
    {
        $worker = Worker::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com'
        ]);

        $user = User::factory()->create([
            'name' => $worker->full_name,
            'email' => $worker->email
        ]);

        $worker->user_id = $user->id;
        $worker->save();

        $this->assertTrue($worker->user->is($user));
    }

    /** @test */
    public function it_can_format_salary()
    {
        $worker = Worker::factory()->create(['base_salary' => 1000.50]);
        $this->assertEquals('1.000,50', number_format($worker->base_salary, 2, ',', '.'));
    }
}
