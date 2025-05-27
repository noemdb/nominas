<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'num_days',
        'description',
        'observations',
        'status_exchange',
        'status_active',
        'status_public',
        'status_approved',
    ];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
        'status_exchange' => 'boolean',
        'status_active' => 'boolean',
        'status_public' => 'boolean',
        'status_approved' => 'boolean',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('observations', 'like', '%' . $search . '%');
        });
    }
}
