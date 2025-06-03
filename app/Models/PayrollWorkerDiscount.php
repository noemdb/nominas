<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class PayrollWorkerDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_worker_detail_id',
        'discount_id',
        'amount',
        'status_active',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'status_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    /**
     * Get the payroll worker detail that owns the discount.
     */
    public function payrollWorkerDetail()
    {
        return $this->belongsTo(PayrollWorkerDetail::class);
    }

    /**
     * Get the discount that owns the payroll worker discount.
     */
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    /**
     * Scope a query to only include active discounts.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status_active', true);
    }

    /**
     * Scope a query to only include inactive discounts.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('status_active', false);
    }

    /**
     * Scope a query to filter by discount type.
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->whereHas('discount', function ($q) use ($type) {
            $q->where('type', $type);
        });
    }

    /**
     * Scope a query to filter by discount function.
     */
    public function scopeOfFunction(Builder $query, string $function): Builder
    {
        return $query->whereHas('discount', function ($q) use ($function) {
            $q->where('name_function', $function);
        });
    }

    /**
     * Scope a query to filter by discount amount range.
     */
    public function scopeAmountBetween(Builder $query, float $min, float $max): Builder
    {
        return $query->whereBetween('amount', [$min, $max]);
    }

    /**
     * Scope a query to only include currently valid discounts.
     */
    public function scopeCurrentlyValid(Builder $query): Builder
    {
        $now = Carbon::now();
        return $query->where(function ($q) use ($now) {
            $q->whereNull('start_date')
                ->whereNull('end_date')
                ->orWhere(function ($q) use ($now) {
                    $q->where('start_date', '<=', $now)
                        ->where(function ($q) use ($now) {
                            $q->whereNull('end_date')
                                ->orWhere('end_date', '>=', $now);
                        });
                });
        });
    }

    /**
     * Get the worker associated with this discount through the payroll worker detail.
     */
    public function worker()
    {
        return $this->hasOneThrough(
            Worker::class,
            PayrollWorkerDetail::class,
            'id', // Foreign key on payroll_worker_details table
            'id', // Foreign key on workers table
            'payroll_worker_detail_id', // Local key on payroll_worker_discounts table
            'worker_id' // Local key on payroll_worker_details table
        );
    }

    /**
     * Get the payroll associated with this discount through the payroll worker detail.
     */
    public function payroll()
    {
        return $this->hasOneThrough(
            Payroll::class,
            PayrollWorkerDetail::class,
            'id', // Foreign key on payroll_worker_details table
            'id', // Foreign key on payrolls table
            'payroll_worker_detail_id', // Local key on payroll_worker_discounts table
            'payroll_id' // Local key on payroll_worker_details table
        );
    }

    /**
     * Get the discount name.
     */
    public function getDiscountNameAttribute(): ?string
    {
        return $this->discount?->name;
    }

    /**
     * Get the discount type.
     */
    public function getDiscountTypeAttribute(): ?string
    {
        return $this->discount?->type;
    }

    /**
     * Get the discount function name.
     */
    public function getDiscountFunctionAttribute(): ?string
    {
        return $this->discount?->name_function;
    }

    /**
     * Get the worker name.
     */
    public function getWorkerNameAttribute(): ?string
    {
        return $this->worker?->full_name;
    }

    /**
     * Get the payroll name.
     */
    public function getPayrollNameAttribute(): ?string
    {
        return $this->payroll?->name;
    }

    /**
     * Get the formatted amount with currency symbol.
     */
    public function getFormattedAmountAttribute(): string
    {
        return '$' . number_format($this->amount, 2);
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
     * Get the validity period of the discount.
     */
    public function getValidityPeriodAttribute(): string
    {
        if (!$this->start_date && !$this->end_date) {
            return 'Vigente indefinidamente';
        }

        $start = $this->start_date ? Carbon::parse($this->start_date)->format('d/m/Y') : 'Indefinido';
        $end = $this->end_date ? Carbon::parse($this->end_date)->format('d/m/Y') : 'Indefinido';

        return "{$start} - {$end}";
    }

    /**
     * Check if the discount is currently valid.
     */
    public function getIsCurrentlyValidAttribute(): bool
    {
        $now = Carbon::now();

        if (!$this->start_date && !$this->end_date) {
            return true;
        }

        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }

        if ($this->end_date && $now->gt($this->end_date)) {
            return false;
        }

        return true;
    }

    /**
     * Get all active discounts for a specific payroll worker detail.
     */
    public static function getActiveDiscountsForDetail(int $payrollWorkerDetailId): \Illuminate\Database\Eloquent\Collection
    {
        return self::with(['discount', 'worker'])
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->where('status_active', true)
            ->get();
    }

    /**
     * Get the total amount of active discounts for a specific payroll worker detail.
     */
    public static function getTotalActiveDiscountsForDetail(int $payrollWorkerDetailId): float
    {
        return self::where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->where('status_active', true)
            ->sum('amount');
    }

    /**
     * Get all discounts grouped by type for a specific payroll worker detail.
     */
    public static function getDiscountsByTypeForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with('discount')
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->discount->type ?? 'unknown';
            });
    }

    /**
     * Get all discounts grouped by function for a specific payroll worker detail.
     */
    public static function getDiscountsByFunctionForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with('discount')
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->discount->name_function ?? 'unknown';
            });
    }

    /**
     * Get discounts by institution for a specific payroll worker detail.
     */
    public static function getDiscountsByInstitutionForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with(['discount' => function ($query) {
            $query->with('institution');
        }])
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->discount->institution->name ?? 'Sin institución';
            });
    }

    /**
     * Get discounts by area for a specific payroll worker detail.
     */
    public static function getDiscountsByAreaForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with(['discount' => function ($query) {
            $query->with('area');
        }])
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->discount->area->name ?? 'Sin área';
            });
    }

    /**
     * Get discounts by worker for a specific payroll worker detail.
     */
    public static function getDiscountsByWorkerForDetail(int $payrollWorkerDetailId): \Illuminate\Support\Collection
    {
        return self::with(['discount' => function ($query) {
            $query->with('worker');
        }])
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->get()
            ->groupBy(function ($item) {
                return $item->discount->worker->full_name ?? 'Sin trabajador';
            });
    }

    /**
     * Get currently valid discounts for a specific payroll worker detail.
     */
    public static function getCurrentlyValidDiscountsForDetail(int $payrollWorkerDetailId): \Illuminate\Database\Eloquent\Collection
    {
        $now = Carbon::now();
        return self::with(['discount', 'worker'])
            ->where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->where('status_active', true)
            ->where(function ($query) use ($now) {
                $query->whereNull('start_date')
                    ->whereNull('end_date')
                    ->orWhere(function ($query) use ($now) {
                        $query->where('start_date', '<=', $now)
                            ->where(function ($query) use ($now) {
                                $query->whereNull('end_date')
                                    ->orWhere('end_date', '>=', $now);
                            });
                    });
            })
            ->get();
    }

    /**
     * Get the total amount of currently valid discounts for a specific payroll worker detail.
     */
    public static function getTotalCurrentlyValidDiscountsForDetail(int $payrollWorkerDetailId): float
    {
        $now = Carbon::now();
        return self::where('payroll_worker_detail_id', $payrollWorkerDetailId)
            ->where('status_active', true)
            ->where(function ($query) use ($now) {
                $query->whereNull('start_date')
                    ->whereNull('end_date')
                    ->orWhere(function ($query) use ($now) {
                        $query->where('start_date', '<=', $now)
                            ->where(function ($query) use ($now) {
                                $query->whereNull('end_date')
                                    ->orWhere('end_date', '>=', $now);
                            });
                    });
            })
            ->sum('amount');
    }
}
