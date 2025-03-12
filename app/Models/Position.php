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
}
