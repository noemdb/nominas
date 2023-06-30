<?php

namespace App\Models\Calculation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id','latex','name','description',
    ];

    // protected $dates = ['finicial','ffinal'];

    use HasFactory;

    const COLUMN_COMMENTS = [
        'institution_id'=>'Institución',
        'latex'=>'String contentivo de la fómula',
        'name'=>'Nombre',
        'description'=>'Descripción',
    ];

    public static function list_position() /* usada para llenar los objetos de formularios select*/
    {
        return ['Director','Administrador','Gerente','Coordinador'];
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public static function list_formulation() /* usada para llenar los objetos de formularios select*/
    {
        return Formulation::pluck('name', 'id');
    }
}


/*

'institution_id','latex','name','description',

institution_id
latex
name
description


*/
