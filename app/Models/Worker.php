<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'identification',
        'email',
        'phone',
        'birth_date',
        'gender',
        'marital_status',
        'nationality',
        'hire_date',
        'base_salary',
        'contract_type',
        'payment_method',
        'bank_name',
        'bank_account_number',
        'tax_identification_number',
        'social_security_number',
        'pension_fund',
        'is_active'
    ];

    protected $casts = [
        'birth_date' => 'datetime',
        'hire_date' => 'datetime',
        'is_active' => 'boolean',
        'status_positions' => 'boolean',
        'base_salary' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function weeklySchedule()
    {
        return $this->hasManyThrough(
            WeeklyWorkSchedule::class,
            Position::class,
            'worker_id', // Foreign key on positions table
            'position_id', // Foreign key on weekly_work_schedules table
            'id', // Local key on workers table
            'id' // Local key on positions table
        );
    }

    public function behaviorHistory()
    {
        return $this->hasManyThrough(
            WorkerBehaviorHistory::class,
            WorkerBehavior::class,
            'worker_id', // Foreign key on worker_behaviors table
            'worker_behavior_id', // Foreign key on worker_behavior_histories table
            'id', // Local key on workers table
            'id' // Local key on worker_behaviors table
        );
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }

    // Relación con Position
    public function position()
    {
        return $this->hasOne(Position::class);
    }

    public function getCurrentPositionAttribute()
    {
        return
            $this->position()
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            })
            ->latest('start_date')
            ->first();
    }

    public function getCurrentPositionInfoAttribute(): string
    {
        // Buscamos la posición activa más reciente
        $position = $this->current_position;

        // Formateamos la información
        return $position
            ? "{$position->area->name} - {$position->rol->name}"
            : 'N/A';
    }

    public function getLastPositionAttribute()
    {
        return
            $this->position()
            ->latest('start_date')
            ->first();
    }

    public function getLastPositionNameAttribute(): string
    {
        // Buscamos la posición activa más reciente
        $position = $this->last_position;

        // Formateamos la información
        return $position
            ? "{$position->area->name} - {$position->rol->name}"
            : 'N/A';
    }

    public function getLastPositionRangeAttribute(): string
    {
        // Buscamos la posición activa más reciente
        $position = $this->last_position;

        // Formateamos la información
        return $position
            ? "{$position->start_date} - {$position->end_date}"
            : 'N/A';
    }

    /**
     * Calcula la antigüedad del trabajador desde su fecha de ingreso
     *
     * @return array Array con los años, meses y días de antigüedad
     */
    public function getSeniorityAttribute(): array
    {
        if (!$this->hire_date) {
            return [
                'years' => 0,
                'months' => 0,
                'days' => 0,
                'formatted' => 'Sin fecha de ingreso'
            ];
        }

        $hireDate = Carbon::parse($this->hire_date);
        $now = Carbon::now();

        // Si la fecha de ingreso es en el futuro, retornar 0
        if ($hireDate->isFuture()) {
            return [
                'years' => 0,
                'months' => 0,
                'days' => 0,
                'formatted' => 'Fecha de ingreso futura'
            ];
        }

        $years = $now->diffInYears($hireDate);
        $months = $now->copy()->subYears($years)->diffInMonths($hireDate);
        $days = $now->copy()->subYears($years)->subMonths($months)->diffInDays($hireDate);

        // Formatear la antigüedad en español
        $parts = [];
        if ($years > 0) {
            $parts[] = $years . ' ' . ($years === 1 ? 'año' : 'años');
        }
        if ($months > 0) {
            $parts[] = $months . ' ' . ($months === 1 ? 'mes' : 'meses');
        }
        if ($days > 0) {
            $parts[] = $days . ' ' . ($days === 1 ? 'día' : 'días');
        }

        return [
            'years' => $years,
            'months' => $months,
            'days' => $days,
            'formatted' => !empty($parts) ? implode(', ', $parts) : '0 días'
        ];
    }

    /**
     * Obtiene la antigüedad formateada del trabajador
     *
     * @return string Antigüedad formateada (ej: "2 años, 3 meses, 15 días")
     */
    public function getFormattedSeniorityAttribute(): string
    {
        return $this->seniority['formatted'];
    }

    public function getStatusPositionsAttribute()
    {
        return ($this->current_position) ? true : false;
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function currentPositionInfo(): Attribute
    {
        return Attribute::get(function () {
            $position = $this->positions()->where('is_active', true)->latest()->first();
            if ($position && $position->area && $position->rol) {
                return "{$position->area->name} - {$position->rol->name}";
            }
            return 'Sin posición actual';
        });
    }

    public static function getSelectOptions()
    {
        return self::where('is_active', true)
            ->with(['positions' => function ($query) {
                $query->with(['area'])
                    ->where('is_active', true)
                    ->latest('start_date');
            }])
            ->get()
            ->map(function ($worker) {
                $currentPosition = $worker->positions->first();
                $positionInfo = $currentPosition
                    ? sprintf(
                        'Área: %s | Período: %s',
                        $currentPosition->area?->name ?? 'N/A',
                        $currentPosition->start_date . ' - ' . ($currentPosition->end_date ?? 'Actual')
                    )
                    : 'Sin posición actual';

                return [
                    'value' => $worker->id,
                    'label' => trim($worker->first_name . ' ' . $worker->last_name),
                    'description' => sprintf(
                        'Cédula: %s | %s',
                        $worker->identification,
                        $positionInfo
                    )
                ];
            });
    }

    /**
     * Obtiene un trabajador con sus detalles básicos para mostrar en vistas
     *
     * Este método carga las relaciones esenciales del trabajador de forma segura:
     * - Usuario asociado
     * - Posición actual con área y rol
     * - Historial de comportamiento reciente
     *
     * @param int $id ID del trabajador
     * @return \App\Models\Worker|null El trabajador con sus datos básicos o null si no se encuentra
     */
    public static function getWorkerWithDetails(int $id): ?Worker
    {
        try {
            return self::query()
                ->with([
                    'user:id,name,email,username',
                    'positions' => function ($query) {
                        $query->with(['area:id,name', 'rol:id,name'])
                            ->where('is_active', true)
                            ->where('start_date', '<=', now())
                            ->where(function ($q) {
                                $q->whereNull('end_date')
                                    ->orWhere('end_date', '>=', now());
                            })
                            ->latest('start_date');
                    },
                    'behaviorHistory' => function ($query) {
                        $query->with(['behavior' => function ($q) {
                            $q->select('id', 'date', 'status', 'approved_by');
                        }])
                            ->latest('created_at')
                            ->limit(5);
                    }
                ])
                ->find($id);
        } catch (\Exception $e) {
            Log::error('Error al obtener detalles del trabajador: ' . $e->getMessage(), [
                'worker_id' => $id,
                'exception' => $e
            ]);
            return null;
        }
    }

    /**
     * Obtiene el historial completo de comportamiento del trabajador
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBehaviorHistory()
    {
        return $this->behaviorHistory()
            ->with(['behavior' => function ($query) {
                $query->with('approver');
            }])
            ->latest('created_at')
            ->get();
    }

    /**
     * Obtiene los horarios semanales activos del trabajador
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveSchedules()
    {
        $currentPosition = $this->positions()
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            })
            ->latest('start_date')
            ->first();

        return $currentPosition
            ? $currentPosition->weeklySchedule()
            ->where('is_active', true)
            ->get()
            : collect();
    }

    /**
     * Obtiene los descuentos y bonificaciones recientes
     *
     * @return array
     */
    public function getRecentPayrollAdjustments()
    {
        return [
            'discounts' => $this->discounts()
                ->latest()
                ->limit(5)
                ->get(),
            'bonuses' => $this->bonuses()
                ->latest()
                ->limit(5)
                ->get()
        ];
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
            $position = $this->current_position;

            if (!$position) {
                return null;
            }

            // Obtener el salario base de la posición
            $monthlySalary = $position->base_salary_pos;

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
                'worker_id' => $this->id,
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
            $position = $this->current_position;

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
                'worker_id' => $this->id,
                'exception' => $e
            ]);
            return null;
        }
    }

    /**
     * Calcula el descuento por inasistencia injustificada para un período específico
     *
     * @param \Carbon\Carbon $date Fecha de la inasistencia
     * @param int $absences Número de inasistencias
     * @return float|null Monto del descuento o null si no hay datos suficientes
     */
    public function calculateAbsenceDiscount(Carbon $date, int $absences): ?float
    {
        try {
            $hourlyRate = $this->calculateHourlyRate();

            if (!$hourlyRate || $absences <= 0) {
                return null;
            }

            // Obtener las horas no trabajadas por inasistencia
            $position = $this->current_position;
            if (!$position) {
                return null;
            }

            // Obtener el horario del día de la inasistencia
            $schedule = $position->weeklySchedule()
                ->where('is_active', true)
                ->where('day_of_week', $date->format('l'))
                ->first();

            if (!$schedule) {
                return null;
            }

            // Calcular el descuento (horas no trabajadas * salario por hora)
            $hoursNotWorked = $schedule->planned_hours * $absences;
            $discount = $hoursNotWorked * $hourlyRate;

            return round($discount, 2);
        } catch (\Exception $e) {
            Log::error('Error al calcular descuento por inasistencia: ' . $e->getMessage(), [
                'worker_id' => $this->id,
                'date' => $date,
                'absences' => $absences,
                'exception' => $e
            ]);
            return null;
        }
    }

    /**
     * Calcula el salario devengado para un período específico
     *
     * @param float $hoursWorked Horas trabajadas en el período
     * @return float|null Salario devengado o null si no hay datos suficientes
     */
    public function calculateEarnedSalary(float $hoursWorked): ?float
    {
        try {
            $hourlyRate = $this->calculateHourlyRate();

            if (!$hourlyRate || $hoursWorked <= 0) {
                return null;
            }

            $earnedSalary = $hoursWorked * $hourlyRate;
            return round($earnedSalary, 2);
        } catch (\Exception $e) {
            Log::error('Error al calcular salario devengado: ' . $e->getMessage(), [
                'worker_id' => $this->id,
                'hours_worked' => $hoursWorked,
                'exception' => $e
            ]);
            return null;
        }
    }

    /**
     * Calcula el salario semanal del trabajador
     * Basado en el salario por hora y las horas semanales planificadas
     *
     * @return float|null Salario semanal o null si no hay datos suficientes
     */
    public function calculateWeeklySalary(): ?float
    {
        try {
            $position = $this->current_position;

            if (!$position) {
                return null;
            }

            // Obtener las horas semanales planificadas
            $weeklyHours = $position->weeklySchedule()
                ->where('is_active', true)
                ->sum('planned_hours');

            if ($weeklyHours <= 0) {
                return null;
            }

            // Calcular usando el salario por hora
            $hourlyRate = $this->calculateHourlyRate();
            if (!$hourlyRate) {
                return null;
            }

            $weeklySalary = $weeklyHours * $hourlyRate;
            return round($weeklySalary, 2);
        } catch (\Exception $e) {
            Log::error('Error al calcular salario semanal: ' . $e->getMessage(), [
                'worker_id' => $this->id,
                'exception' => $e
            ]);
            return null;
        }
    }

    /**
     * Calcula el salario quincenal del trabajador
     * Basado en el salario semanal (semanal * 2)
     *
     * @return float|null Salario quincenal o null si no hay datos suficientes
     */
    public function calculateBiweeklySalary(): ?float
    {
        try {
            $weeklySalary = $this->calculateWeeklySalary();

            if (!$weeklySalary) {
                return null;
            }

            // El salario quincenal es el doble del semanal
            $biweeklySalary = $weeklySalary * 2;
            return round($biweeklySalary, 2);
        } catch (\Exception $e) {
            Log::error('Error al calcular salario quincenal: ' . $e->getMessage(), [
                'worker_id' => $this->id,
                'exception' => $e
            ]);
            return null;
        }
    }
}
