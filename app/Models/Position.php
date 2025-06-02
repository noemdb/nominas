<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'observations',
        'is_active',
        'area_id',
        'rol_id',
        'worker_id',
        'base_salary',
        'status_exchange',
        'status_active',
    ];

    protected $casts = [
        // 'start_date' => 'date',
        // 'end_date' => 'date',
        'is_active' => 'boolean',
        'status_exchange' => 'boolean',
        'status_active' => 'boolean',
        'base_salary' => 'decimal:2',
    ];

    /**
     * Mutator para start_date - Asegura que se almacene solo la fecha sin tiempo
     *
     * @param mixed $value
     * @return void
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    /**
     * Mutator para end_date - Asegura que se almacene solo la fecha sin tiempo
     *
     * @param mixed $value
     * @return void
     */
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function weeklySchedule()
    {
        return $this->hasMany(WeeklyWorkSchedule::class);
    }

    /**
     * Obtiene el salario base del trabajador asociado a esta posición
     *
     * @return float|null El salario base del trabajador o null si no hay trabajador asociado
     */
    public function getBaseSalaryPosAttribute(): ?float
    {
        if (!$this->worker) {
            return null;
        }

        // Si la posición tiene un salario base específico, usarlo
        $positionBaseSalary = $this->getAttribute('base_salary');
        if ($positionBaseSalary > 0) {
            return (float) $positionBaseSalary;
        }

        // Si no, usar el salario base del trabajador
        return (float) $this->worker->base_salary;
    }

    /**
     * Calcula el valor por hora basado en el salario base y las horas mensuales estimadas
     *
     * @return float|null El valor por hora o null si no hay salario base o horas mensuales
     */
    public function getHourlyRateAttribute(): ?float
    {
        if (!$this->base_salary) {
            return null;
        }

        // Obtener las horas mensuales estimadas usando el modelo WeeklyWorkSchedule
        $monthlyHours = \App\Models\WeeklyWorkSchedule::getMonthlyEstimatedHours($this->id);

        if ($monthlyHours <= 0) {
            return null;
        }

        // Calcular el valor por hora (salario base / horas mensuales)
        return round($this->base_salary / $monthlyHours, 2);
    }

    public function getFullNameAttribute()
    {
        return trim(($this->area?->name ?? '') . ' ' . ($this->rol?->name ?? ''));
    }

    public function getFullName2Attribute()
    {
        return trim(($this->area?->name ?? '') . ' [' . ($this->rol?->name ?? '') . ']');
    }

    public static function boot()
    {
        parent::boot();

        // Validar que no exista solapamiento de fechas para el mismo trabajador
        static::creating(function ($position) {
            if ($position->worker_id) {
                $exists = self::where('worker_id', $position->worker_id)
                    ->where('is_active', true)
                    ->where(function ($query) use ($position) {
                        $query->where(function ($q) use ($position) {
                            // La nueva posición comienza durante una posición existente
                            $q->where('start_date', '<=', $position->start_date)
                                ->where(function ($q) use ($position) {
                                    $q->whereNull('end_date')
                                        ->orWhere('end_date', '>=', $position->start_date);
                                });
                        })->orWhere(function ($q) use ($position) {
                            // La nueva posición termina durante una posición existente
                            $q->where('start_date', '<=', $position->end_date)
                                ->where(function ($q) use ($position) {
                                    $q->whereNull('end_date')
                                        ->orWhere('end_date', '>=', $position->end_date);
                                });
                        })->orWhere(function ($q) use ($position) {
                            // La nueva posición contiene completamente una posición existente
                            $q->where('start_date', '>=', $position->start_date)
                                ->where(function ($q) use ($position) {
                                    $q->whereNull('end_date')
                                        ->orWhere('end_date', '<=', $position->end_date);
                                });
                        });
                    })
                    ->exists();

                if ($exists) {
                    throw new \Exception('El trabajador ya tiene una posición activa que se solapa con el período especificado. Por favor, verifique las fechas.');
                }
            }
        });

        // También validar al actualizar
        static::updating(function ($position) {
            if ($position->worker_id) {
                $exists = self::where('worker_id', $position->worker_id)
                    ->where('is_active', true)
                    ->where('id', '!=', $position->id) // Excluir la posición actual
                    ->where(function ($query) use ($position) {
                        $query->where(function ($q) use ($position) {
                            // La posición actualizada comienza durante una posición existente
                            $q->where('start_date', '<=', $position->start_date)
                                ->where(function ($q) use ($position) {
                                    $q->whereNull('end_date')
                                        ->orWhere('end_date', '>=', $position->start_date);
                                });
                        })->orWhere(function ($q) use ($position) {
                            // La posición actualizada termina durante una posición existente
                            $q->where('start_date', '<=', $position->end_date)
                                ->where(function ($q) use ($position) {
                                    $q->whereNull('end_date')
                                        ->orWhere('end_date', '>=', $position->end_date);
                                });
                        })->orWhere(function ($q) use ($position) {
                            // La posición actualizada contiene completamente una posición existente
                            $q->where('start_date', '>=', $position->start_date)
                                ->where(function ($q) use ($position) {
                                    $q->whereNull('end_date')
                                        ->orWhere('end_date', '<=', $position->end_date);
                                });
                        });
                    })
                    ->exists();

                if ($exists) {
                    throw new \Exception('El trabajador ya tiene una posición activa que se solapa con el período especificado. Por favor, verifique las fechas.');
                }
            }
        });
    }

    public function isCurrent()
    {
        $now = now();
        return $now->greaterThanOrEqualTo($this->start_date) && $now->lessThanOrEqualTo($this->end_date);
    }

    /**
     * Get the options for select components
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getSelectOptions()
    {
        return self::where('is_active', true)
            ->with(['area', 'rol', 'worker'])
            ->get()
            ->map(function ($position) {
                $label = $position->worker ? trim($position->worker->first_name . ' ' . $position->worker->last_name) : 'N/A';
                return [
                    'value' => $position->id,
                    'label' => $label,
                    'description' => sprintf(
                        'Área: %s | Rol: %s | Trabajador: %s | Período: %s',
                        $position->area?->name ?? 'N/A',
                        $position->rol?->name ?? 'N/A',
                        $position->full_name2,
                        $position->start_date . ' - ' . $position->end_date ?? 'N/A',
                    )
                ];
            });
    }
}
