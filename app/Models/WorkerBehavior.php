<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class WorkerBehavior extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'date',
        'attendance_days',
        'absences',
        'permissions',
        'delays',
        'labor_hours',
        'administrative_hours',
        'medical_rest_days',
        'medical_rest_hours',
        'paid_permission_days',
        'paid_permission_hours',
        'unpaid_permission_days',
        'unpaid_permission_hours',
        'unjustified_absence_days',
        'unjustified_absence_hours',
        'observations',
        'bonus',
        'discount',
        'status',
        'approved_by',
        'approved_at'
    ];

    protected $casts = [
        'date' => 'date',
        'attendance_days' => 'integer',
        'absences' => 'integer',
        'permissions' => 'integer',
        'delays' => 'integer',
        'labor_hours' => 'decimal:2',
        'administrative_hours' => 'decimal:2',
        'medical_rest_days' => 'integer',
        'medical_rest_hours' => 'decimal:2',
        'paid_permission_days' => 'integer',
        'paid_permission_hours' => 'decimal:2',
        'unpaid_permission_days' => 'integer',
        'unpaid_permission_hours' => 'decimal:2',
        'unjustified_absence_days' => 'integer',
        'unjustified_absence_hours' => 'decimal:2',
        'bonus' => 'decimal:2',
        'discount' => 'decimal:2',
        'approved_at' => 'datetime'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Antes de guardar, formatear las observaciones
        static::saving(function ($behavior) {
            $behavior->formatObservations();
        });
    }

    /**
     * Scope para obtener la nómina activa asociada
     */
    public function scopeWithActivePayroll($query)
    {
        return $query->whereHas('payrolls', function ($query) {
            $query->where('status_active', true);
        })->with(['payrolls' => function ($query) {
            $query->where('status_active', true);
        }]);
    }

    /**
     * Obtiene el número de días del período desde la nómina activa
     */
    public function getPeriodDaysAttribute(): int
    {
        if (!$this->exists) {
            return $this->calculateTotalDays();
        }

        return $this->payrolls()
            ->where('status_active', true)
            ->value('num_days') ?? $this->calculateTotalDays();
    }

    /**
     * Calcula el total de días asignados
     */
    protected function calculateTotalDays(): int
    {
        return $this->attendance_days +
            $this->medical_rest_days +
            $this->paid_permission_days +
            $this->unpaid_permission_days +
            $this->unjustified_absence_days;
    }

    /**
     * Formatea las observaciones siguiendo el formato estándar
     */
    protected function formatObservations(): void
    {
        try {
            $totalDays = $this->calculateTotalDays();
            $numDays = $this->period_days;

            // Formatear las observaciones
            $this->observations = sprintf(
                "Días del período: %d.\n" .
                    "Días trabajados (cumplimiento efectivo): %d.\n" .
                    "Días de reposo médico: %d.\n" .
                    "Días de permiso pagado: %d.\n" .
                    "Días de permiso no pagado: %d.\n" .
                    "Días de ausencia injustificada: %d.\n" .
                    "Total días asignados: %d.",
                $numDays,
                $this->attendance_days,
                $this->medical_rest_days,
                $this->paid_permission_days,
                $this->unpaid_permission_days,
                $this->unjustified_absence_days,
                $totalDays
            );

            // Registrar en el log si hay discrepancia en los totales
            if ($totalDays !== $numDays) {
                $this->logDaysDiscrepancy($numDays, $totalDays);
            }
        } catch (\Exception $e) {
            $this->handleFormatError($e, $totalDays ?? 0);
        }
    }

    /**
     * Registra la discrepancia de días en el log
     */
    protected function logDaysDiscrepancy(int $numDays, int $totalDays): void
    {
        Log::warning('Discrepancia en total de días en WorkerBehavior', [
            'worker_id' => $this->worker_id,
            'behavior_id' => $this->id,
            'num_days' => $numDays,
            'total_days' => $totalDays,
            'attendance_days' => $this->attendance_days,
            'medical_rest_days' => $this->medical_rest_days,
            'paid_permission_days' => $this->paid_permission_days,
            'unpaid_permission_days' => $this->unpaid_permission_days,
            'unjustified_absence_days' => $this->unjustified_absence_days
        ]);
    }

    /**
     * Maneja los errores durante el formateo de observaciones
     */
    protected function handleFormatError(\Exception $e, int $totalDays): void
    {
        Log::error('Error al formatear observaciones en WorkerBehavior', [
            'worker_id' => $this->worker_id,
            'behavior_id' => $this->id,
            'error' => $e->getMessage(),
            'total_days' => $totalDays
        ]);

        $this->observations = sprintf(
            "Días del período: %d.\n" .
                "Días trabajados (cumplimiento efectivo): %d.\n" .
                "Días de reposo médico: %d.\n" .
                "Días de permiso pagado: %d.\n" .
                "Días de permiso no pagado: %d.\n" .
                "Días de ausencia injustificada: %d.\n" .
                "Total días asignados: %d.",
            $totalDays,
            $this->attendance_days ?? 0,
            $this->medical_rest_days ?? 0,
            $this->paid_permission_days ?? 0,
            $this->unpaid_permission_days ?? 0,
            $this->unjustified_absence_days ?? 0,
            $totalDays
        );
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function histories()
    {
        return $this->hasMany(WorkerBehaviorHistory::class);
    }

    /**
     * Las nóminas asociadas a este comportamiento
     */
    public function payrolls()
    {
        return $this->belongsToMany(Payroll::class, 'payroll_worker_behavior')
            ->withPivot(['bonus_amount', 'discount_amount', 'status_active'])
            ->withTimestamps();
    }

    /**
     * Check if the behavior is used in any payroll.
     */
    public function isUsedInPayroll()
    {
        return $this->payrolls()->exists();
    }

    /**
     * Calcula el salario base por hora del trabajador
     * Basado en el salario mensual y las horas mensuales estimadas
     *
     * @return float|null Salario por hora o null si no hay datos suficientes
     */
    public function calculateHourlyRate(): ?float
    {
        try {
            // Obtener la posición actual del trabajador
            $position = $this->worker->current_position;

            if (!$position) {
                return null;
            }

            // Obtener el salario base de la posición
            $monthlySalary = $position->base_salary;

            // Obtener las horas semanales planificadas
            $weeklyHours = $position->weeklySchedule()
                ->where('is_active', true)
                ->sum('planned_hours');

            if ($weeklyHours <= 0) {
                return null;
            }

            // Calcular horas mensuales estimadas (semanas * 4.33)
            $monthlyHours = $weeklyHours * 4.33;

            // Calcular salario por hora
            $hourlyRate = $monthlySalary / $monthlyHours;

            return round($hourlyRate, 2);
        } catch (\Exception $e) {
            Log::error('Error al calcular salario por hora: ' . $e->getMessage(), [
                'worker_id' => $this->worker_id,
                'behavior_id' => $this->id,
                'exception' => $e
            ]);
            return null;
        }
    }

    /**
     * Obtiene las horas mensuales estimadas del trabajador
     *
     * @return float|null Horas mensuales estimadas o null si no hay datos
     */
    public function getEstimatedMonthlyHours(): ?float
    {
        try {
            $position = $this->worker->current_position;

            if (!$position) {
                return null;
            }

            $weeklyHours = $position->weeklySchedule()
                ->where('is_active', true)
                ->sum('planned_hours');

            if ($weeklyHours <= 0) {
                return null;
            }

            // Calcular horas mensuales (semanas * 4.33)
            return round($weeklyHours * 4.33, 2);
        } catch (\Exception $e) {
            Log::error('Error al calcular horas mensuales: ' . $e->getMessage(), [
                'worker_id' => $this->worker_id,
                'behavior_id' => $this->id,
                'exception' => $e
            ]);
            return null;
        }
    }

    /**
     * Calcula el descuento por inasistencia injustificada
     *
     * @return float|null Monto del descuento o null si no hay datos suficientes
     */
    public function calculateAbsenceDiscount(): ?float
    {
        try {
            $hourlyRate = $this->calculateHourlyRate();

            if (!$hourlyRate || $this->absences <= 0) {
                return null;
            }

            // Obtener las horas no trabajadas por inasistencia
            $position = $this->worker->current_position;
            if (!$position) {
                return null;
            }

            // Obtener el horario del día de la inasistencia
            $schedule = $position->weeklySchedule()
                ->where('is_active', true)
                ->where('day_of_week', $this->date->format('l'))
                ->first();

            if (!$schedule) {
                return null;
            }

            // Calcular el descuento (horas no trabajadas * salario por hora)
            $hoursNotWorked = $schedule->planned_hours * $this->absences;
            $discount = $hoursNotWorked * $hourlyRate;

            return round($discount, 2);
        } catch (\Exception $e) {
            Log::error('Error al calcular descuento por inasistencia: ' . $e->getMessage(), [
                'worker_id' => $this->worker_id,
                'behavior_id' => $this->id,
                'exception' => $e
            ]);
            return null;
        }
    }
}
