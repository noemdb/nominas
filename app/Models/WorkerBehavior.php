<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        'observations',
        'bonus',
        'discount',
        'status',
        'approved_by',
        'approved_at',
        'labor_hours'
    ];

    protected $casts = [
        'date' => 'date',
        'attendance_days' => 'integer',
        'absences' => 'integer',
        'permissions' => 'integer',
        'delays' => 'integer',
        'bonus' => 'decimal:2',
        'discount' => 'decimal:2',
        'approved_at' => 'datetime',
        'labor_hours' => 'decimal:2'
    ];

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
