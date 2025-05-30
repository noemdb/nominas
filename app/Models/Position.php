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
        'worker_id', // Asegúrate de incluir worker_id aquí
    ];

    protected $casts = [
        // 'start_date' => 'datetime',
        // 'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

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

        // Evita duplicados de worker_id
        static::creating(function ($position) {
            if ($position->worker_id) {
                $exists = self::where('worker_id', $position->worker_id)
                    ->where('end_date', '>', now())
                    ->where('is_active', true)
                    ->exists();

                if ($exists) {
                    throw new \Exception('Este trabajador ya tiene un cargo activo');
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
