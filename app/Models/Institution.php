<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'website',
        'director_name',
        'founded_year'
    ];

    public static function getSelectOptions()
    {
        return self::all()->map(fn($institution) => [
            'label' => $institution->name,
            'value' => $institution->id
        ]);
    }
}
