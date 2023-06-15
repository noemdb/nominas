<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'weekday','start_time','end_time','schedule_type','area_id','rol_id','notes'
    ];

    const COLUMN_COMMENTS = [
        'weekday'=>'Día de la semana',
        'start_time'=>'Hora de inicio',
        'end_time'=>'Hora de finalización',
        'schedule_type'=>'Tipo de horario(Diurno/Nocturno)',
        'area_id'=>'Área',
        'rol_id'=>'Rol',
        'notes'=>'Notas',
    ];

    public static function list_type() /* usada para llenar los objetos de formularios select*/
    {
        return ['Diurno','Nocturno','Diurno/Nocturno'];
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public static function list_area() /* usada para llenar los objetos de formularios select*/
    {
        return Area::pluck('name', 'id');
    }
}


/* 'weekday','start_time','end_time','schedule_type','area_id','rol_id','notes'


weekday
start_time
end_time
schedule_type
area_id
rol_id
notes


*/
