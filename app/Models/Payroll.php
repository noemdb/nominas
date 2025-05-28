<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'num_days',
        'description',
        'observations',
        'status_exchange',
        'status_active',
        'status_public',
        'status_approved',
    ];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
        'status_exchange' => 'boolean',
        'status_active' => 'boolean',
        'status_public' => 'boolean',
        'status_approved' => 'boolean',
    ];

    /**
     * Los descuentos asociados a la nómina
     */
    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'payroll_discount')
            ->withPivot(['amount', 'status_active'])
            ->withTimestamps();
    }

    /**
     * Las deducciones asociadas a la nómina
     */
    public function deductions()
    {
        return $this->belongsToMany(Deduction::class, 'payroll_deduction')
            ->withPivot(['amount', 'status_active'])
            ->withTimestamps();
    }

    /**
     * Las bonificaciones asociadas a la nómina
     */
    public function bonuses()
    {
        return $this->belongsToMany(Bonus::class, 'payroll_bonus')
            ->withPivot(['amount', 'status_active'])
            ->withTimestamps();
    }

    /**
     * Los comportamientos de trabajadores asociados a la nómina
     */
    public function workerBehaviors()
    {
        return $this->belongsToMany(WorkerBehavior::class, 'payroll_worker_behavior')
            ->withPivot(['bonus_amount', 'discount_amount', 'status_active'])
            ->withTimestamps();
    }

    /**
     * Obtiene los descuentos activos de la nómina
     */
    public function activeDiscounts()
    {
        return $this->discounts()->wherePivot('status_active', true);
    }

    /**
     * Obtiene las deducciones activas de la nómina
     */
    public function activeDeductions()
    {
        return $this->deductions()->wherePivot('status_active', true);
    }

    /**
     * Obtiene las bonificaciones activas de la nómina
     */
    public function activeBonuses()
    {
        return $this->bonuses()->wherePivot('status_active', true);
    }

    /**
     * Obtiene los comportamientos de trabajadores activos de la nómina
     */
    public function activeWorkerBehaviors()
    {
        return $this->workerBehaviors()->wherePivot('status_active', true);
    }

    /**
     * Obtiene los descuentos por institución
     */
    public function institutionDiscounts()
    {
        return $this->discounts()->whereNotNull('institution_id');
    }

    /**
     * Obtiene las deducciones por institución
     */
    public function institutionDeductions()
    {
        return $this->deductions()->whereNotNull('institution_id');
    }

    /**
     * Obtiene las bonificaciones por institución
     */
    public function institutionBonuses()
    {
        return $this->bonuses()->whereNotNull('institution_id');
    }

    /**
     * Obtiene los comportamientos de trabajadores por institución
     */
    public function institutionWorkerBehaviors()
    {
        return $this->workerBehaviors()->whereHas('worker', function ($query) {
            $query->whereNotNull('institution_id');
        });
    }

    /**
     * Obtiene los descuentos por área
     */
    public function areaDiscounts()
    {
        return $this->discounts()->whereNotNull('area_id');
    }

    /**
     * Obtiene las deducciones por área
     */
    public function areaDeductions()
    {
        return $this->deductions()->whereNotNull('area_id');
    }

    /**
     * Obtiene las bonificaciones por área
     */
    public function areaBonuses()
    {
        return $this->bonuses()->whereNotNull('area_id');
    }

    /**
     * Obtiene los comportamientos de trabajadores por área
     */
    public function areaWorkerBehaviors()
    {
        return $this->workerBehaviors()->whereHas('worker', function ($query) {
            $query->whereNotNull('area_id');
        });
    }

    /**
     * Obtiene los descuentos por rol
     */
    public function rolDiscounts()
    {
        return $this->discounts()->whereNotNull('rol_id');
    }

    /**
     * Obtiene las deducciones por rol
     */
    public function rolDeductions()
    {
        return $this->deductions()->whereNotNull('rol_id');
    }

    /**
     * Obtiene las bonificaciones por rol
     */
    public function rolBonuses()
    {
        return $this->bonuses()->whereNotNull('rol_id');
    }

    /**
     * Obtiene los comportamientos de trabajadores por rol
     */
    public function rolWorkerBehaviors()
    {
        return $this->workerBehaviors()->whereHas('worker', function ($query) {
            $query->whereNotNull('rol_id');
        });
    }

    /**
     * Obtiene los descuentos por trabajador
     */
    public function workerDiscounts()
    {
        return $this->discounts()->whereNotNull('worker_id');
    }

    /**
     * Obtiene las deducciones por trabajador
     */
    public function workerDeductions()
    {
        return $this->deductions()->whereNotNull('worker_id');
    }

    /**
     * Obtiene las bonificaciones por trabajador
     */
    public function workerBonuses()
    {
        return $this->bonuses()->whereNotNull('worker_id');
    }

    /**
     * Obtiene los comportamientos de trabajadores por trabajador específico
     */
    public function workerBehaviorsByWorker($workerId)
    {
        return $this->workerBehaviors()->where('worker_id', $workerId);
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('observations', 'like', '%' . $search . '%');
        });
    }

    /**
     * Genera la estructura de datos para la nómina
     *
     * @return array Resultado del proceso
     */
    public function generateDataStructure()
    {
        try {
            DB::beginTransaction();

            // 1. Generar registros en payroll_discount, payroll_deduction, payroll_bonus
            $this->generatePayrollConcepts();

            // 2. Generar registros en worker_behaviors
            $workerBehaviors = $this->generateWorkerBehaviors();

            // 3. Generar registros en payroll_worker_behavior
            $this->generatePayrollWorkerBehaviors($workerBehaviors);

            DB::commit();
            return [
                'success' => true,
                'message' => 'Estructura de datos generada correctamente'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Error al generar la estructura de datos: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Genera los registros de conceptos (descuentos, deducciones, bonificaciones)
     */
    protected function generatePayrollConcepts()
    {
        // Obtener todos los conceptos activos
        $discounts = Discount::where('status_active', true)->get();
        $deductions = Deduction::where('status_active', true)->get();
        $bonuses = Bonus::where('status_active', true)->get();

        // Preparar los datos para syncWithoutDetaching
        $discountData = $discounts->mapWithKeys(function ($discount) {
            return [$discount->id => ['amount' => null, 'status_active' => true]];
        })->all();

        $deductionData = $deductions->mapWithKeys(function ($deduction) {
            return [$deduction->id => ['amount' => null, 'status_active' => true]];
        })->all();

        $bonusData = $bonuses->mapWithKeys(function ($bonus) {
            return [$bonus->id => ['amount' => null, 'status_active' => true]];
        })->all();

        // Usar syncWithoutDetaching para evitar duplicados
        $this->discounts()->syncWithoutDetaching($discountData);
        $this->deductions()->syncWithoutDetaching($deductionData);
        $this->bonuses()->syncWithoutDetaching($bonusData);
    }

    /**
     * Genera los registros de comportamientos de trabajadores
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function generateWorkerBehaviors()
    {
        $workerBehaviors = collect();
        $workers = Worker::where('is_active', true)->get();

        // Asegurarnos de tener un ID de usuario válido
        $userId = 1; // ID por defecto
        if (auth()->check()) {
            $authId = auth()->id();
            if (is_numeric($authId)) {
                $userId = (int) $authId;
            }
        }

        foreach ($workers as $worker) {
            // Verificar si ya existe un comportamiento para este trabajador en esta nómina
            $existingBehavior = WorkerBehavior::where('worker_id', $worker->id)
                ->whereHas('payrolls', function ($query) {
                    $query->where('payrolls.id', $this->id);
                })
                ->first();

            if (!$existingBehavior) {
                // Verificar si existe un comportamiento para este trabajador en esta fecha
                $existingBehaviorByDate = WorkerBehavior::where('worker_id', $worker->id)
                    ->where('date', $this->date_end->format('Y-m-d'))
                    ->first();

                if (!$existingBehaviorByDate) {
                    $behavior = WorkerBehavior::create([
                        'worker_id' => $worker->id,
                        'date' => $this->date_end->format('Y-m-d'),
                        'attendance_days' => $this->num_days,
                        'absences' => 0,
                        'permissions' => 0,
                        'delays' => 0,
                        'observations' => 'Generado automáticamente al crear la estructura de la nómina',
                        'bonus' => 0,
                        'discount' => 0,
                        'status' => 'approved',
                        'approved_by' => $userId,
                        'approved_at' => Carbon::now()
                    ]);

                    $workerBehaviors->push($behavior);
                } else {
                    // Si existe por fecha pero no está asociado a esta nómina, lo usamos
                    $workerBehaviors->push($existingBehaviorByDate);
                }
            } else {
                // Si ya existe un comportamiento asociado a esta nómina, lo usamos
                $workerBehaviors->push($existingBehavior);
            }
        }

        return $workerBehaviors;
    }

    /**
     * Genera los registros en payroll_worker_behavior
     *
     * @param \Illuminate\Database\Eloquent\Collection $workerBehaviors
     */
    protected function generatePayrollWorkerBehaviors($workerBehaviors)
    {
        // Preparar los datos para syncWithoutDetaching
        $behaviorData = $workerBehaviors->mapWithKeys(function ($behavior) {
            return [$behavior->id => [
                'bonus_amount' => 0,
                'discount_amount' => 0,
                'status_active' => true
            ]];
        })->all();

        // Usar syncWithoutDetaching para evitar duplicados
        $this->workerBehaviors()->syncWithoutDetaching($behaviorData);
    }
}
