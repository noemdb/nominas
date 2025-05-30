<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

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
        // return $this->hasOne(Position::class);
        return $this->hasMany(Position::class);
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
        return self::all()->map(fn($worker) => [
            'label' => $worker->full_name,
            'value' => $worker->id
        ]);
    }
}
