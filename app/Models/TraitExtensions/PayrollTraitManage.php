<?php

namespace App\Models\TraitExtensions;

use App\Models\Worker;
use App\Models\WorkerBehavior;
use App\Models\Discount;
use App\Models\Deduction;
use App\Models\Bonus;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\WeeklyWorkSchedule;
use App\Models\WorkerBehaviorHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\PayrollWorkerDetail;
use Illuminate\Support\Facades\Log;

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

                    // Calcular días disponibles para distribuir
                    $availableDays = $this->num_days;

                    // Primero asignamos los días de ausencia y permisos
                    $medicalRestDays = min(rand(1, 2), $availableDays);
                    $availableDays -= $medicalRestDays;

                    $paidPermissionDays = min(rand(1, 2), $availableDays);
                    $availableDays -= $paidPermissionDays;

                    $unpaidPermissionDays = min(rand(1, 2), $availableDays);
                    $availableDays -= $unpaidPermissionDays;

                    $unjustifiedAbsenceDays = min(rand(1, 2), $availableDays);
                    $availableDays -= $unjustifiedAbsenceDays;

                    // Los días trabajados son los días en que el trabajador cumplió efectivamente su función
                    // Esto significa que no estuvo en reposo médico, no tuvo permisos ni ausencias
                    $attendanceDays = $this->num_days - ($medicalRestDays + $paidPermissionDays + $unpaidPermissionDays + $unjustifiedAbsenceDays);

                    // Calcular horas basadas en los días asignados
                    $medicalRestHours = round($medicalRestDays * 8, 2);
                    $paidPermissionHours = round($paidPermissionDays * 8, 2);
                    $unpaidPermissionHours = round($unpaidPermissionDays * 8, 2);
                    $unjustifiedAbsenceHours = round($unjustifiedAbsenceDays * 8, 2);

                    // Verificar que el total de días sea correcto
                    $totalDays = $attendanceDays + $medicalRestDays + $paidPermissionDays + $unpaidPermissionDays + $unjustifiedAbsenceDays;

                    if ($totalDays !== $this->num_days) {
                        Log::warning('Ajuste de días en WorkerBehavior', [
                            'worker_id' => $worker->id,
                            'payroll_id' => $this->id,
                            'num_days' => $this->num_days,
                            'total_days' => $totalDays,
                            'attendance_days' => $attendanceDays,
                            'medical_rest_days' => $medicalRestDays,
                            'paid_permission_days' => $paidPermissionDays,
                            'unpaid_permission_days' => $unpaidPermissionDays,
                            'unjustified_absence_days' => $unjustifiedAbsenceDays
                        ]);
                    }

                    $behavior = WorkerBehavior::create([
                        'worker_id' => $worker->id,
                        'date' => $this->date_end->format('Y-m-d'),
                        'attendance_days' => $attendanceDays,
                        'labor_hours' => $totalLaborHours,
                        'absences' => $unjustifiedAbsenceDays,
                        'administrative_hours' => round($totalLaborHours * 0.4, 2),
                        'medical_rest_days' => $medicalRestDays,
                        'medical_rest_hours' => $medicalRestHours,
                        'paid_permission_days' => $paidPermissionDays,
                        'paid_permission_hours' => $paidPermissionHours,
                        'unpaid_permission_days' => $unpaidPermissionDays,
                        'unpaid_permission_hours' => $unpaidPermissionHours,
                        'unjustified_absence_days' => $unjustifiedAbsenceDays,
                        'unjustified_absence_hours' => $unjustifiedAbsenceHours,
                        'permissions' => $paidPermissionDays + $unpaidPermissionDays,
                        'delays' => 0,
                        'observations' => sprintf(
                            "Días del período: %d.\n" .
                                "Días trabajados (cumplimiento efectivo): %d.\n" .
                                "Días de reposo médico: %d.\n" .
                                "Días de permiso pagado: %d.\n" .
                                "Días de permiso no pagado: %d.\n" .
                                "Días de ausencia injustificada: %d.\n" .
                                "Total días asignados: %d.",
                            $this->num_days,
                            $attendanceDays,
                            $medicalRestDays,
                            $paidPermissionDays,
                            $unpaidPermissionDays,
                            $unjustifiedAbsenceDays,
                            $totalDays
                        ),
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

            // Obtener el ID del usuario usando el método estático
            $userId = User::getAuthUserId();

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
                $newBehavior->observations = $this->name;
                $newBehavior->status = 'approved';
                $newBehavior->approved_by = $userId;
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
                        $newHistory->approved_by = $userId;
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

    /**
     * Registra la información del período laboral para cada trabajador en la nómina
     *
     * @return array Resultado del proceso
     */
    public function registerWorkerPeriodDetails()
    {
        try {
            DB::beginTransaction();

            // Obtener todos los trabajadores activos
            $workers = Worker::where('is_active', true)->get();

            $registeredDetails = collect();

            foreach ($workers as $worker) {
                // Obtener la posición actual del trabajador
                $currentPosition = $worker->current_position;

                if (!$currentPosition) {
                    continue; // Saltar trabajadores sin posición actual
                }

                // Calcular días y horas del período
                $startDate = Carbon::parse($this->date_start);
                $endDate = Carbon::parse($this->date_end);
                $totalDays = $startDate->diffInDays($endDate) + 1;


                // Obtener el comportamiento del trabajador para este período
                $behavior = $this->workerBehaviors()
                    ->whereHas('worker', function ($query) use ($worker) {
                        $query->where('workers.id', $worker->id);
                    })
                    ->first();

                if (!$behavior) {
                    continue; // Saltar trabajadores sin comportamiento registrado
                }

                // Calcular días trabajados y no trabajados
                $workedDays = $behavior->attendance_days;
                $absences = $behavior->absences;
                $permissions = $behavior->permissions;

                // Calcular horas laboradas
                $laborHours = $behavior->labor_hours;
                $academicHours = $behavior->academic_hours ?? round($laborHours * 0.6, 2); // 60% horas académicas
                $administrativeHours = $behavior->administrative_hours ?? round($laborHours * 0.4, 2); // 40% horas administrativas

                // Calcular días y horas especiales
                $medicalRestDays = $behavior->medical_rest_days ?? 0;
                $medicalRestHours = $behavior->medical_rest_hours ?? round($medicalRestDays * 8, 2); // 8 horas por día

                $paidPermissionDays = $behavior->paid_permission_days ?? 0;
                $paidPermissionHours = $behavior->paid_permission_hours ?? round($paidPermissionDays * 8, 2); // 8 horas por día

                $unpaidPermissionDays = $behavior->unpaid_permission_days ?? 0;
                $unpaidPermissionHours = $behavior->unpaid_permission_hours ?? round($unpaidPermissionDays * 8, 2); // 8 horas por día

                $unjustifiedAbsenceDays = $behavior->unjustified_absence_days ?? 0;
                $unjustifiedAbsenceHours = $behavior->unjustified_absence_hours ?? round($unjustifiedAbsenceDays * 8, 2); // 8 horas por día

                // Calcular totales de días y horas no trabajadas
                $totalNonWorkedDays = $medicalRestDays + $paidPermissionDays + $unpaidPermissionDays + $unjustifiedAbsenceDays;
                $totalNonWorkedHours = round($medicalRestHours + $paidPermissionHours + $unpaidPermissionHours + $unjustifiedAbsenceHours, 2);

                // Calcular salario base del período
                $baseSalaryPeriod = $currentPosition->base_salary_pos / 2; // Salario quincenal

                // Calcular totales de inactividad para resúmenes
                $totalInactiveDays = $medicalRestDays + $paidPermissionDays + $unpaidPermissionDays + $unjustifiedAbsenceDays;
                $totalInactiveHours = round($medicalRestHours + $paidPermissionHours + $unpaidPermissionHours + $unjustifiedAbsenceHours, 2);

                // Calcular porcentajes de inactividad
                $totalPeriodDays = $startDate->diffInDays($endDate) + 1;
                $inactivityPercentage = $totalPeriodDays > 0 ? round(($totalInactiveDays / $totalPeriodDays) * 100, 2) : 0;

                // Calcular impacto en el salario por inactividad
                $dailySalaryRate = $baseSalaryPeriod / $totalPeriodDays;
                $salaryImpact = round($dailySalaryRate * $totalInactiveDays, 2);

                // Cálculos del salario base
                $monthlyBaseSalary = $currentPosition->base_salary_pos;
                $dailyBaseSalary = $monthlyBaseSalary / 30; // Salario diario (30 días)
                $hourlyBaseSalary = $dailyBaseSalary / 8; // Salario por hora (8 horas)

                // Calcular salario base del período
                $baseSalaryPeriod = round($monthlyBaseSalary / 2, 2); // Salario quincenal base

                // Ajustar salario por días trabajados
                $workedDaysSalary = round($dailyBaseSalary * $workedDays, 2);

                // Ajustar salario por horas académicas y administrativas
                $academicHoursSalary = round($hourlyBaseSalary * $academicHours, 2);
                $administrativeHoursSalary = round($hourlyBaseSalary * $administrativeHours, 2);

                // Calcular total de horas trabajadas
                $totalWorkedHours = $academicHours + $administrativeHours;
                $totalWorkedHoursSalary = round($hourlyBaseSalary * $totalWorkedHours, 2);

                // Calcular salario base ajustado por inactividad
                $adjustedBaseSalary = round($baseSalaryPeriod - $salaryImpact, 2);

                // Obtener la moneda de la nómina
                $currency = $this->getCurrencyAttribute();

                // Calcular totales consolidados
                // 1. Total de asignaciones (salario base + bonificaciones)
                $bonuses = $this->getApplicableBonusesForWorker($worker);
                $totalBonuses = $this->calculateTotalBonusesForWorker($worker, $adjustedBaseSalary, $workedDays);
                $totalAssignments = round($adjustedBaseSalary + $totalBonuses, 2);

                // 2. Total de deducciones
                $deductions = $this->getApplicableDeductionsForWorker($worker);
                $totalDeductions = $this->calculateTotalDeductionsForWorker($worker, $adjustedBaseSalary, $workedDays, $unjustifiedAbsenceDays);

                // 3. Total de descuentos
                $discounts = $this->getApplicableDiscountsForWorker($worker);
                $totalDiscounts = $this->calculateTotalDiscountsForWorker($worker, $adjustedBaseSalary, $workedDays, $unjustifiedAbsenceDays);

                // 4. Calcular neto a pagar
                $netPay = round($totalAssignments - $totalDeductions, 2);

                // Preparar los datos para createOrUpdateDetail
                $detailData = [
                    'payroll_id' => $this->id,
                    'worker_id' => $worker->id,
                    'position_id' => $currentPosition->id,
                    'worked_days' => $workedDays,
                    'academic_hours' => $academicHours,
                    'administrative_hours' => $administrativeHours,
                    'medical_rest_days' => $medicalRestDays,
                    'medical_rest_hours' => $medicalRestHours,
                    'paid_permission_days' => $paidPermissionDays,
                    'paid_permission_hours' => $paidPermissionHours,
                    'unpaid_permission_days' => $unpaidPermissionDays,
                    'unpaid_permission_hours' => $unpaidPermissionHours,
                    'unjustified_absence_days' => $unjustifiedAbsenceDays,
                    'unjustified_absence_hours' => $unjustifiedAbsenceHours,
                    'total_non_worked_days' => $totalInactiveDays,
                    'total_non_worked_hours' => $totalInactiveHours,
                    'base_salary_period' => $adjustedBaseSalary,
                    'total_assignments' => $totalAssignments,
                    'total_deductions' => $totalDeductions,
                    'net_pay' => $netPay,
                    'status_active' => true,
                    'observations' => sprintf(
                        "Detalle salarial (%s):\n" .
                            "- Salario base mensual: %s %.2f\n" .
                            "- Salario base quincenal: %s %.2f\n" .
                            "- Salario por días trabajados: %s %.2f\n" .
                            "- Salario por horas académicas: %s %.2f\n" .
                            "- Salario por horas administrativas: %s %.2f\n" .
                            "- Total horas trabajadas: %.2f (%s %.2f)\n" .
                            "- Impacto por inactividad: %s %.2f\n" .
                            "- Salario base ajustado: %s %.2f\n\n" .
                            "Totales consolidados:\n" .
                            "- Total bonificaciones: %s %.2f\n" .
                            "- Total asignaciones: %s %.2f\n" .
                            "- Total deducciones: %s %.2f\n" .
                            "- Total descuentos: %s %.2f\n" .
                            "- Neto a pagar: %s %.2f",
                        $currency,
                        $currency,
                        $monthlyBaseSalary,
                        $currency,
                        $baseSalaryPeriod,
                        $currency,
                        $workedDaysSalary,
                        $currency,
                        $academicHoursSalary,
                        $currency,
                        $administrativeHoursSalary,
                        $totalWorkedHours,
                        $currency,
                        $totalWorkedHoursSalary,
                        $currency,
                        $salaryImpact,
                        $currency,
                        $adjustedBaseSalary,
                        $currency,
                        $totalBonuses,
                        $currency,
                        $totalAssignments,
                        $currency,
                        $totalDeductions,
                        $currency,
                        $totalDiscounts,
                        $currency,
                        $netPay
                    )
                ];

                // Preparar los datos de bonificaciones, deducciones y descuentos
                $bonusesData = $bonuses->map(function ($bonus) {
                    return [
                        'bonus_id' => $bonus->id,
                        'amount' => $bonus->amount,
                        'status_active' => true
                    ];
                })->toArray();

                $deductionsData = $deductions->map(function ($deduction) {
                    return [
                        'deduction_id' => $deduction->id,
                        'amount' => $deduction->amount,
                        'status_active' => true
                    ];
                })->toArray();

                $discountsData = $discounts->map(function ($discount) {
                    return [
                        'discount_id' => $discount->id,
                        'amount' => $discount->amount,
                        'status_active' => true
                    ];
                })->toArray();

                // Crear o actualizar el detalle usando createOrUpdateDetail
                $detail = PayrollWorkerDetail::createOrUpdateDetail(
                    $detailData,
                    $bonusesData,
                    $deductionsData,
                    $discountsData
                );

                // Registrar los totales consolidados en el log
                Log::info('Totales consolidados registrados', [
                    'worker_id' => $worker->id,
                    'payroll_id' => $this->id,
                    'currency' => $currency,
                    'base_salary' => $adjustedBaseSalary,
                    'total_bonuses' => $totalBonuses,
                    'total_assignments' => $totalAssignments,
                    'total_deductions' => $totalDeductions,
                    'total_discounts' => $totalDiscounts,
                    'net_pay' => $netPay,
                    'bonuses_detail' => $bonuses->map(function ($bonus) {
                        return [
                            'id' => $bonus->id,
                            'name' => $bonus->name,
                            'type' => $bonus->type,
                            'amount' => $bonus->amount
                        ];
                    }),
                    'deductions_detail' => $deductions->map(function ($deduction) {
                        return [
                            'id' => $deduction->id,
                            'name' => $deduction->name,
                            'type' => $deduction->type,
                            'amount' => $deduction->amount
                        ];
                    }),
                    'discounts_detail' => $discounts->map(function ($discount) {
                        return [
                            'id' => $discount->id,
                            'name' => $discount->name,
                            'type' => $discount->type,
                            'amount' => $discount->amount
                        ];
                    })
                ]);

                $registeredDetails->push($detail);
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Se registraron ' . $registeredDetails->count() . ' detalles de período laboral',
                'details' => $registeredDetails
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Error al registrar detalles del período laboral: ' . $e->getMessage()
            ];
        }
    }
}
