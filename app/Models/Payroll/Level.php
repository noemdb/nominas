<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public static function list_level() /* usada para llenar los objetos de formularios select*/
    {
        return Level::pluck('name', 'id');
    }
}
