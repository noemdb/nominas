<?php

namespace App\Models\Employee;

use App\Models\Employee;
use App\Models\Institution\Area;
use App\Models\Institution\Rol;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','area_id','rol_id','name','description','start','end'
    ];

    protected $dates = ['start','end'];

    const COLUMN_COMMENTS = [
        'employee_id'=>'Empleado',
        'area_id'=>'Área',
        'rol_id'=>'Rol',
        'name'=>'Nombre',
        'description'=>'Descripción',
        'start'=>'Fecha de inicio',
        'end'=>'Fecha de finalización',
        'status'=>'Activo/Inactivo',
        //--------------------------------------------
        'lapse'=>'Lapso',
        'employee_name'=>'Empleado',
        'area_name'=>'Área',
        'rol_name'=>'Rol',
    ];
    ////////////////////////////////////////////////////////////////////////////////////////

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
    ////////////////////////////////////////////////////////////////////////////////////////

    public function getEmployeeNameAttribute()
    {
        return ($this->employee) ? $this->employee->name : null ;
    }
    public function getEmployeeCiAttribute()
    {
        return ($this->employee) ? $this->employee->ci : null ;
    }
    public function getEmployeeFullNameAttribute()
    {
        return ($this->employee) ? $this->employee->ci.' - '.$this->employee->name : null ;
    }
    public function getAreaNameAttribute()
    {
        return ($this->area) ? $this->area->name : null ;
    }
    public function getRolNameAttribute()
    {
        return ($this->rol) ? $this->rol->name : null ;
    }
    public function getLapseAttribute()
    {
        $start = ($this->start) ? $this->start->format('d-m-Y'): null;
        $end = ($this->end) ? $this->start->format('d-m-Y'): null;
        return $start .' | '. $end ;
    }
    ////////////////////////////////////////////////////////////////////////////////////////


    public function getStatusDeleteAttribute()
    {
        return true;
    }


}


/*

'employee_id','area_id','rol_id','name','description','start','end'

employee_id
area_id
rol_id
name
description
start
end

*/