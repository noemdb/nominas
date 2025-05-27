<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public static function getSelectOptions()
    {
        return self::all()->map(fn($rol) => [
            'label' => $rol->name,
            'value' => $rol->id
        ]);
    }
}
