<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'identification', 'email', 'phone', 
        'birth_date', 'gender', 'marital_status', 'nationality', 
        'hire_date', 'base_salary', 'contract_type', 'payment_method',
        'bank_name', 'bank_account_number', 'tax_identification_number', 
        'social_security_number', 'pension_fund', 'is_active'
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
}
