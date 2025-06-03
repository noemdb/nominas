<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PayrollWorkerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_id',
        'worker_id',
        'position_id',
        'worked_days',
        'academic_hours',
        'administrative_hours',
        'medical_rest_days',
        'medical_rest_hours',
        'paid_permission_days',
        'paid_permission_hours',
        'unpaid_permission_days',
        'unpaid_permission_hours',
        'unjustified_absence_days',
        'unjustified_absence_hours',
        'total_non_worked_days',
        'total_non_worked_hours',
        'base_salary_period',
        'total_assignments',
        'total_deductions',
        'net_pay',
        'observations',
        'status_active'
    ];

    protected $casts = [
        'worked_days' => 'integer',
        'academic_hours' => 'decimal:2',
        'administrative_hours' => 'decimal:2',
        'medical_rest_days' => 'integer',
        'medical_rest_hours' => 'decimal:2',
        'paid_permission_days' => 'integer',
        'paid_permission_hours' => 'decimal:2',
        'unpaid_permission_days' => 'integer',
        'unpaid_permission_hours' => 'decimal:2',
        'unjustified_absence_days' => 'integer',
        'unjustified_absence_hours' => 'decimal:2',
        'total_non_worked_days' => 'decimal:2',
        'total_non_worked_hours' => 'decimal:2',
        'base_salary_period' => 'decimal:2',
        'total_assignments' => 'decimal:2',
        'total_deductions' => 'decimal:2',
        'net_pay' => 'decimal:2',
        'status_active' => 'boolean'
    ];

    /**
     * Get the payroll that owns the detail.
     */
    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }

    /**
     * Get the worker that owns the detail.
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    /**
     * Get the position that owns the detail.
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get the bonuses for this detail.
     */
    public function bonuses()
    {
        return $this->hasMany(PayrollWorkerBonus::class);
    }

    /**
     * Get the deductions for this detail.
     */
    public function deductions()
    {
        return $this->hasMany(PayrollWorkerDeduction::class);
    }

    /**
     * Get the discounts for this detail.
     */
    public function discounts()
    {
        return $this->hasMany(PayrollWorkerDiscount::class);
    }

    public function workerDetails()
    {
        return $this->hasMany(PayrollWorkerDetail::class);
    }

    public function activeWorkerDetails()
    {
        return $this->workerDetails()->where('status_active', true);
    }

    /**
     * Scope a query to only include active details.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status_active', true);
    }

    /**
     * Scope a query to only include inactive details.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('status_active', false);
    }

    /**
     * Scope a query to filter by worker.
     */
    public function scopeByWorker(Builder $query, int $workerId): Builder
    {
        return $query->where('worker_id', $workerId);
    }

    /**
     * Scope a query to filter by position.
     */
    public function scopeByPosition(Builder $query, int $positionId): Builder
    {
        return $query->where('position_id', $positionId);
    }

    /**
     * Scope a query to filter by payroll.
     */
    public function scopeByPayroll(Builder $query, int $payrollId): Builder
    {
        return $query->where('payroll_id', $payrollId);
    }

    /**
     * Scope a query to filter by date range.
     */
    public function scopeByDateRange(Builder $query, Carbon $startDate, Carbon $endDate): Builder
    {
        return $query->whereHas('payroll', function ($q) use ($startDate, $endDate) {
            $q->whereBetween('date_start', [$startDate, $endDate])
                ->orWhereBetween('date_end', [$startDate, $endDate]);
        });
    }

    /**
     * Scope a query to filter by net pay range.
     */
    public function scopeNetPayBetween(Builder $query, float $min, float $max): Builder
    {
        return $query->whereBetween('net_pay', [$min, $max]);
    }

    /**
     * Get the total worked hours.
     */
    public function getTotalWorkedHoursAttribute(): float
    {
        return $this->academic_hours + $this->administrative_hours;
    }

    /**
     * Get the total non-worked hours.
     */
    public function getTotalNonWorkedHoursAttribute(): float
    {
        return $this->medical_rest_hours +
            $this->paid_permission_hours +
            $this->unpaid_permission_hours +
            $this->unjustified_absence_hours;
    }

    /**
     * Get the total days.
     */
    public function getTotalDaysAttribute(): int
    {
        return $this->worked_days +
            $this->medical_rest_days +
            $this->paid_permission_days +
            $this->unpaid_permission_days +
            $this->unjustified_absence_days;
    }

    /**
     * Get the formatted base salary.
     */
    public function getFormattedBaseSalaryAttribute(): string
    {
        return '$' . number_format($this->base_salary_period, 2);
    }

    /**
     * Get the formatted total assignments.
     */
    public function getFormattedTotalAssignmentsAttribute(): string
    {
        return '$' . number_format($this->total_assignments, 2);
    }

    /**
     * Get the formatted total deductions.
     */
    public function getFormattedTotalDeductionsAttribute(): string
    {
        return '$' . number_format($this->total_deductions, 2);
    }

    /**
     * Get the formatted net pay.
     */
    public function getFormattedNetPayAttribute(): string
    {
        return '$' . number_format($this->net_pay, 2);
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status_active ? 'Activo' : 'Inactivo';
    }

    /**
     * Get the status color for UI display.
     */
    public function getStatusColorAttribute(): string
    {
        return $this->status_active ? 'green' : 'red';
    }

    /**
     * Calculate and update all totals for the detail.
     */
    public function calculateTotals(): void
    {
        try {
            DB::beginTransaction();

            // Calculate total non-worked days and hours
            $this->total_non_worked_days = $this->medical_rest_days +
                $this->paid_permission_days +
                $this->unpaid_permission_days +
                $this->unjustified_absence_days;

            $this->total_non_worked_hours = $this->medical_rest_hours +
                $this->paid_permission_hours +
                $this->unpaid_permission_hours +
                $this->unjustified_absence_hours;

            // Calculate total assignments (base salary + bonuses)
            $this->total_assignments = $this->base_salary_period +
                $this->bonuses()->where('status_active', true)->sum('amount');

            // Calculate total deductions (deductions + discounts)
            $this->total_deductions = $this->deductions()->where('status_active', true)->sum('amount') +
                $this->discounts()->where('status_active', true)->sum('amount');

            // Calculate net pay
            $this->net_pay = $this->total_assignments - $this->total_deductions;

            $this->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get all details for a specific payroll with their relationships.
     */
    public static function getDetailsForPayroll(int $payrollId): \Illuminate\Database\Eloquent\Collection
    {
        return self::with([
            'worker',
            'position',
            'bonuses' => function ($query) {
                $query->where('status_active', true)
                    ->with('bonus');
            },
            'deductions' => function ($query) {
                $query->where('status_active', true)
                    ->with('deduction');
            },
            'discounts' => function ($query) {
                $query->where('status_active', true)
                    ->with('discount');
            }
        ])
            ->where('payroll_id', $payrollId)
            ->get();
    }

    /**
     * Get all details for a specific worker with their relationships.
     */
    public static function getDetailsForWorker(int $workerId): \Illuminate\Database\Eloquent\Collection
    {
        return self::with([
            'payroll',
            'position',
            'bonuses' => function ($query) {
                $query->where('status_active', true)
                    ->with('bonus');
            },
            'deductions' => function ($query) {
                $query->where('status_active', true)
                    ->with('deduction');
            },
            'discounts' => function ($query) {
                $query->where('status_active', true)
                    ->with('discount');
            }
        ])
            ->where('worker_id', $workerId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get summary statistics for a specific payroll.
     */
    public static function getPayrollSummary(int $payrollId): array
    {
        $details = self::where('payroll_id', $payrollId)
            ->where('status_active', true)
            ->get();

        return [
            'total_workers' => $details->count(),
            'total_worked_days' => $details->sum('worked_days'),
            'total_worked_hours' => $details->sum('academic_hours') + $details->sum('administrative_hours'),
            'total_base_salary' => $details->sum('base_salary_period'),
            'total_assignments' => $details->sum('total_assignments'),
            'total_deductions' => $details->sum('total_deductions'),
            'total_net_pay' => $details->sum('net_pay'),
            'average_net_pay' => $details->avg('net_pay'),
            'min_net_pay' => $details->min('net_pay'),
            'max_net_pay' => $details->max('net_pay')
        ];
    }

    /**
     * Get summary statistics for a specific worker.
     */
    public static function getWorkerSummary(int $workerId): array
    {
        $details = self::where('worker_id', $workerId)
            ->where('status_active', true)
            ->get();

        return [
            'total_payrolls' => $details->count(),
            'total_worked_days' => $details->sum('worked_days'),
            'total_worked_hours' => $details->sum('academic_hours') + $details->sum('administrative_hours'),
            'total_base_salary' => $details->sum('base_salary_period'),
            'total_assignments' => $details->sum('total_assignments'),
            'total_deductions' => $details->sum('total_deductions'),
            'total_net_pay' => $details->sum('net_pay'),
            'average_net_pay' => $details->avg('net_pay'),
            'min_net_pay' => $details->min('net_pay'),
            'max_net_pay' => $details->max('net_pay')
        ];
    }

    /**
     * Create or update a detail with all its relationships.
     */
    public static function createOrUpdateDetail(array $data, array $bonuses = [], array $deductions = [], array $discounts = []): self
    {

        // dd(
        //     $data,
        //     $bonuses,
        //     $deductions,
        //     $discounts
        // );
        try {
            DB::beginTransaction();

            // Create or update the detail
            $detail = self::updateOrCreate(
                [
                    'payroll_id' => $data['payroll_id'],
                    'worker_id' => $data['worker_id']
                ],
                $data
            );


            // Handle bonuses
            if (!empty($bonuses)) {
                foreach ($bonuses as $bonus) {
                    $detail->bonuses()->updateOrCreate(
                        [
                            'bonus_id' => $bonus['bonus_id']
                        ],
                        $bonus
                    );
                }
            }


            // Handle deductions
            if (!empty($deductions)) {
                foreach ($deductions as $deduction) {
                    $detail->deductions()->updateOrCreate(
                        [
                            'deduction_id' => $deduction['deduction_id']
                        ],
                        $deduction
                    );
                }
            }

            // Handle discounts
            if (!empty($discounts)) {
                foreach ($discounts as $discount) {
                    $detail->discounts()->updateOrCreate(
                        [
                            'discount_id' => $discount['discount_id']
                        ],
                        $discount
                    );
                }
            }

            // dd($detail, $bonuses, $deductions, $discounts);

            // Calculate totals
            $detail->calculateTotals();

            DB::commit();
            return $detail;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Deactivate a detail and all its relationships.
     */
    public function deactivate(): void
    {
        try {
            DB::beginTransaction();

            $this->status_active = false;
            $this->save();

            // Deactivate all related records
            $this->bonuses()->update(['status_active' => false]);
            $this->deductions()->update(['status_active' => false]);
            $this->discounts()->update(['status_active' => false]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Boot the model.
     */
    // protected static function boot()
    // {
    //     parent::boot();

    //     // Validate before saving
    //     static::saving(function ($detail) {
    //         // Validate required relationships
    //         if (!$detail->payroll_id || !$detail->worker_id || !$detail->position_id) {
    //             throw new \Exception('El detalle debe estar asociado a una nómina, trabajador y posición.');
    //         }

    //         // Validate that the worker belongs to the payroll's institution
    //         $workerInstitution = $detail->worker->position->area->institution_id ?? null;
    //         $payrollInstitution = $detail->payroll->institution_id ?? null;

    //         if ($workerInstitution && $payrollInstitution && $workerInstitution !== $payrollInstitution) {
    //             throw new \Exception('El trabajador no pertenece a la institución de la nómina.');
    //         }

    //         // Validate that the position belongs to the worker
    //         if ($detail->position_id !== ($detail->worker->current_position->id ?? null)) {
    //             throw new \Exception('La posición no corresponde al trabajador actual.');
    //         }

    //         // Validate dates and periods
    //         if ($detail->payroll) {
    //             $payrollStart = Carbon::parse($detail->payroll->date_start);
    //             $payrollEnd = Carbon::parse($detail->payroll->date_end);
    //             $periodDays = $payrollStart->diffInDays($payrollEnd) + 1;

    //             // Validate total days don't exceed period days
    //             $totalDays = $detail->worked_days +
    //                 $detail->medical_rest_days +
    //                 $detail->paid_permission_days +
    //                 $detail->unpaid_permission_days +
    //                 $detail->unjustified_absence_days;

    //             if ($totalDays > $periodDays) {
    //                 throw new \Exception("El total de días ({$totalDays}) excede los días del período ({$periodDays}).");
    //             }

    //             // Validate hours are within reasonable limits
    //             $maxHoursPerDay = 24;
    //             $maxHoursPerPeriod = $periodDays * $maxHoursPerDay;

    //             $totalHours = $detail->academic_hours +
    //                 $detail->administrative_hours +
    //                 $detail->medical_rest_hours +
    //                 $detail->paid_permission_hours +
    //                 $detail->unpaid_permission_hours +
    //                 $detail->unjustified_absence_hours;

    //             if ($totalHours > $maxHoursPerPeriod) {
    //                 throw new \Exception("El total de horas ({$totalHours}) excede el máximo permitido para el período ({$maxHoursPerPeriod}).");
    //             }
    //         }

    //         // Validate amounts
    //         if ($detail->base_salary_period < 0) {
    //             throw new \Exception('El salario base no puede ser negativo.');
    //         }

    //         if ($detail->total_assignments < 0) {
    //             throw new \Exception('El total de asignaciones no puede ser negativo.');
    //         }

    //         if ($detail->total_deductions < 0) {
    //             throw new \Exception('El total de deducciones no puede ser negativo.');
    //         }

    //         if ($detail->net_pay < 0) {
    //             throw new \Exception('El neto a pagar no puede ser negativo.');
    //         }

    //         // Validate that net pay is correctly calculated
    //         $calculatedNetPay = $detail->total_assignments - $detail->total_deductions;
    //         if (abs($detail->net_pay - $calculatedNetPay) > 0.01) { // Allow for small floating point differences
    //             throw new \Exception('El neto a pagar no coincide con el cálculo (asignaciones - deducciones).');
    //         }

    //         // Validate that the worker is active
    //         if (!$detail->worker->is_active) {
    //             throw new \Exception('No se puede crear un detalle para un trabajador inactivo.');
    //         }

    //         // Validate that the payroll is in a valid state
    //         if (!$detail->payroll->status_active) {
    //             throw new \Exception('No se puede crear un detalle en una nómina inactiva.');
    //         }

    //         if ($detail->payroll->status_approved) {
    //             throw new \Exception('No se puede modificar un detalle de una nómina aprobada.');
    //         }

    //         // Log validation success
    //         Log::info('Detalle de nómina validado exitosamente', [
    //             'payroll_id' => $detail->payroll_id,
    //             'worker_id' => $detail->worker_id,
    //             'position_id' => $detail->position_id
    //         ]);
    //     });

    //     // Validate before deleting
    //     static::deleting(function ($detail) {
    //         // Prevent deletion if payroll is approved
    //         if ($detail->payroll->status_approved) {
    //             throw new \Exception('No se puede eliminar un detalle de una nómina aprobada.');
    //         }

    //         // Log deletion attempt
    //         Log::info('Intento de eliminación de detalle de nómina', [
    //             'payroll_id' => $detail->payroll_id,
    //             'worker_id' => $detail->worker_id,
    //             'position_id' => $detail->position_id
    //         ]);
    //     });

    //     // After saving, ensure related records are in sync
    //     static::saved(function ($detail) {
    //         try {
    //             // Recalculate totals to ensure consistency
    //             $detail->calculateTotals();

    //             // Update payroll totals if needed
    //             if ($detail->payroll) {
    //                 $detail->payroll->calculateTotals();
    //             }

    //             // Log successful save
    //             Log::info('Detalle de nómina guardado exitosamente', [
    //                 'payroll_id' => $detail->payroll_id,
    //                 'worker_id' => $detail->worker_id,
    //                 'position_id' => $detail->position_id,
    //                 'net_pay' => $detail->net_pay
    //             ]);
    //         } catch (\Exception $e) {
    //             Log::error('Error al sincronizar datos después de guardar', [
    //                 'detail_id' => $detail->id,
    //                 'error' => $e->getMessage()
    //             ]);
    //             throw $e;
    //         }
    //     });
    // }
}
