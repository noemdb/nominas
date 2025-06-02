<?php

namespace App\Models\TraitExtensions;

use App\Models\Worker;
use App\Models\WorkerBehavior;
use App\Models\Discount;
use App\Models\Deduction;
use App\Models\Bonus;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\WeeklyWorkSchedule;
use App\Models\WorkerBehaviorHistory;
use Illuminate\Support\Facades\Auth;

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

        // Calcular el número de semanas completas y días adicionales
        $startDate = Carbon::parse($this->date_start);
        $endDate = Carbon::parse($this->date_end);
        $totalDays = $startDate->diffInDays($endDate) + 1;
        $weeks = floor($totalDays / 7);
        $remainingDays = $totalDays % 7;

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
                    // Calcular horas laboradas según el horario semanal
                    $position = $worker->position;
                    $weeklyHours = 0;
                    $remainingHours = 0;

                    if ($position) {
                        // Obtener el horario semanal del cargo
                        $weeklySchedule = WeeklyWorkSchedule::where('position_id', $position->id)
                            ->where('is_active', true)
                            ->get();

                        // Calcular horas semanales totales
                        $weeklyHours = $weeklySchedule->sum('planned_hours');

                        // Calcular horas para los días restantes
                        if ($remainingDays > 0) {
                            $remainingStartDate = $endDate->copy()->subDays($remainingDays - 1);
                            for ($i = 0; $i < $remainingDays; $i++) {
                                $currentDate = $remainingStartDate->copy()->addDays($i);
                                $dayOfWeek = $currentDate->format('l'); // Obtiene el nombre del día en inglés

                                $dayHours = $weeklySchedule->where('day_of_week', $dayOfWeek)
                                    ->sum('planned_hours');

                                $remainingHours += $dayHours;
                            }
                        }
                    }

                    // Calcular el total de horas laboradas
                    $totalLaborHours = ($weeklyHours * $weeks) + $remainingHours;
                    // dd($weeklyHours, $weeks, $totalLaborHours);

                    $behavior = WorkerBehavior::create([
                        'worker_id' => $worker->id,
                        'date' => $this->date_end->format('Y-m-d'),
                        'attendance_days' => $this->num_days,
                        'labor_hours' => $totalLaborHours,
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

    /**
     * Elimina los registros de conceptos (descuentos, deducciones, bonificaciones) asociados a la nómina
     *
     * @return array Resultado del proceso
     */
    public function clearPayrollConcepts()
    {
        try {
            DB::beginTransaction();

            // Obtener los comportamientos asociados a esta nómina
            $behaviors = $this->workerBehaviors;

            // Eliminar registros de historial de comportamientos
            if ($behaviors->isNotEmpty()) {
                WorkerBehaviorHistory::whereIn('worker_behavior_id', $behaviors->pluck('id'))
                    ->delete();
            }

            // Eliminar los comportamientos de trabajadores
            if ($behaviors->isNotEmpty()) {
                WorkerBehavior::whereIn('id', $behaviors->pluck('id'))
                    ->delete();
            }

            // Eliminar las relaciones de conceptos
            $this->discounts()->detach();
            $this->deductions()->detach();
            $this->bonuses()->detach();

            DB::commit();
            return [
                'success' => true,
                'message' => 'Estructura de datos de la nómina eliminada correctamente'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Error al eliminar la estructura de datos de la nómina: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Clona una nómina y toda su estructura de datos
     *
     * @return array Resultado del proceso
     */
    public function clonePayrollStructure()
    {
        try {
            DB::beginTransaction();

            $userId = auth()->id() ?? 1;

            // 1. Crear la nueva nómina basada en la existente
            $newPayroll = $this->replicate();
            $newPayroll->name = $this->name . ' (Copia)';
            $newPayroll->status_active = true;
            $newPayroll->status_public = false;
            $newPayroll->status_approved = false;
            $newPayroll->save();

            // 2. Clonar los conceptos (descuentos, deducciones, bonificaciones)
            // Obtener los conceptos actuales con sus datos pivot
            $discounts = $this->discounts()->withPivot(['amount', 'status_active'])->get();
            $deductions = $this->deductions()->withPivot(['amount', 'status_active'])->get();
            $bonuses = $this->bonuses()->withPivot(['amount', 'status_active'])->get();

            // Preparar los datos para la nueva nómina
            $discountData = $discounts->mapWithKeys(function ($discount) {
                return [$discount->id => [
                    'amount' => $discount->pivot->amount,
                    'status_active' => $discount->pivot->status_active
                ]];
            })->all();

            $deductionData = $deductions->mapWithKeys(function ($deduction) {
                return [$deduction->id => [
                    'amount' => $deduction->pivot->amount,
                    'status_active' => $deduction->pivot->status_active
                ]];
            })->all();

            $bonusData = $bonuses->mapWithKeys(function ($bonus) {
                return [$bonus->id => [
                    'amount' => $bonus->pivot->amount,
                    'status_active' => $bonus->pivot->status_active
                ]];
            })->all();

            // Sincronizar los conceptos con la nueva nómina
            $newPayroll->discounts()->sync($discountData);
            $newPayroll->deductions()->sync($deductionData);
            $newPayroll->bonuses()->sync($bonusData);

            // 3. Clonar los comportamientos de trabajadores
            $behaviors = $this->workerBehaviors()->withPivot(['bonus_amount', 'discount_amount', 'status_active'])->get();

            foreach ($behaviors as $behavior) {
                // Crear nuevo comportamiento
                $newBehavior = $behavior->replicate();
                $newBehavior->date = $newPayroll->date_end;
                $newBehavior->observations = 'Clonado de la nómina: ' . $this->name;
                $newBehavior->status = 'Pendiente';
                $newBehavior->approved_by = $userId; // Forzar conversión a entero
                $newBehavior->approved_at = now();
                $newBehavior->save();

                // Asociar el nuevo comportamiento con la nueva nómina
                $newPayroll->workerBehaviors()->attach($newBehavior->id, [
                    'bonus_amount' => $behavior->pivot->bonus_amount,
                    'discount_amount' => $behavior->pivot->discount_amount,
                    'status_active' => $behavior->pivot->status_active
                ]);

                // Clonar el historial del comportamiento si existe
                $histories = $behavior->histories;
                if ($histories->isNotEmpty()) {
                    foreach ($histories as $history) {
                        $newHistory = $history->replicate();
                        $newHistory->worker_behavior_id = $newBehavior->id;
                        $newHistory->approved_by = $userId; // Forzar conversión a entero
                        $newHistory->save();
                    }
                }
            }

            DB::commit();
            return [
                'success' => true,
                'message' => 'Nómina clonada correctamente con toda su estructura',
                'payroll' => $newPayroll
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Error al clonar la nómina: ' . $e->getMessage()
            ];
        }
    }
}
