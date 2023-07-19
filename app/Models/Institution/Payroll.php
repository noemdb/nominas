<?php

namespace App\Models\Institution;

// 'institution_id','level_id','frequency','name','description',

use App\Models\Institution;
use App\Models\Payroll\Level;
use App\Models\Payroll\Settlement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution_id','level_id','frequency','name','description','status',
    ];

    // protected $dates = ['finicial','ffinal'];

    use HasFactory;

    const COLUMN_COMMENTS = [
        'institution_id'=>'Institución',
        'level_id'=>'Nivel',
        'frequency'=>'Frecuencia de liquidación',
        'name'=>'Nombre',
        'description'=>'Descripción',
        'status'=>'Estado',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public static function list_frequency() /* usada para llenar los objetos de formularios select*/
    {
        return ['Mensual','Quincenal','Trimestral','Cuatrimestral','Semestral', 'Semanal'];
    }

    public function getStatusDeleteAttribute()
    {
        return $this->settlements->empty() ? true : false;
    }
}


/*
institution_id
level_id
frequency
name
description
*/
