<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public static function getSelectOptions()
    {
        return self::all()->map(fn($area) => [
            'label' => $area->name,
            'value' => $area->id
        ]);
    }
}
