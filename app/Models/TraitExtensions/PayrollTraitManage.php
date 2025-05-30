<?php

namespace App\Models\TraitExtensions;

use App\Models\Worker;
use App\Models\WorkerBehavior;
use App\Models\Discount;
use App\Models\Deduction;
use App\Models\Bonus;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

trait PayrollTraitManage
{
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
        // Consulta base para deducciones y bonificaciones (sin validación de fechas)
        $baseQuery = function ($query) {
            $query->where('status_active', true)
                ->where('status_exchange', $this->status_exchange);
        };

        // Consulta específica para descuentos (incluye validación de fechas)
        $discountQuery = function ($query) {
            $query->where('status_active', true)
                ->where('status_exchange', $this->status_exchange)
                ->where(function ($q) {
                    // Descuentos sin fecha definida (vigentes indefinidamente)
                    $q->whereNull('start_date')
                        ->whereNull('end_date')
                        // O descuentos vigentes en la fecha de la nómina
                        ->orWhere(function ($q) {
                            $q->where('start_date', '<=', $this->date_end)
                                ->where(function ($q) {
                                    $q->whereNull('end_date')
                                        ->orWhere('end_date', '>=', $this->date_start);
                                });
                        });
                });
        };

        // Obtener conceptos usando las consultas específicas
        $discounts = Discount::where($discountQuery)->get();
        $deductions = Deduction::where($baseQuery)->get();
        $bonuses = Bonus::where($baseQuery)->get();

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
                        'status' => 'Pendiente',
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

    /**
     * Elimina los registros de conceptos (descuentos, deducciones, bonificaciones) asociados a la nómina
     *
     * @return array Resultado del proceso
     */
    public function clearPayrollConcepts()
    {
        try {
            DB::beginTransaction();

            // Eliminar las relaciones de conceptos
            $this->discounts()->detach();
            $this->deductions()->detach();
            $this->bonuses()->detach();

            DB::commit();
            return [
                'success' => true,
                'message' => 'Conceptos de la nómina eliminados correctamente'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Error al eliminar los conceptos de la nómina: ' . $e->getMessage()
            ];
        }
    }
}
