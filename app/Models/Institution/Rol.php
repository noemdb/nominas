<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id', 'name', 'description'
    ];

    const COLUMN_COMMENTS = [
        'area_id'=>'Área',
        'name'=>'Nombre',
        'description'=>'Descripción',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public static function list_rol() /* usada para llenar los objetos de formularios select*/
    {
        return Rol::pluck('name', 'id');
    }
}
