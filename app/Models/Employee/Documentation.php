<?php

namespace App\Models\Employee;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Documentation extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id','description','type','number','expiration_date','issue_date','country','file','comments'
    ];

    const COLUMN_COMMENTS = [
        'employee_id'=>'Empleado',
        'description'=>'Descripción',
        'type'=>'Tipo de documento',
        'number'=>'Número de documento',
        'expiration_date'=>'Fecha de caducidad del documento, si es aplicable',
        'issue_date'=>'Fecha de emisión del documento, si es aplicable',
        'country'=>'País que emitió el documento, si es aplicable',
        'file'=>'Archivo adjunto',
        'comments'=>'Cualquier comentario adicional sobre la documentación',
    ];

    /* 'employee_name','employee_ci','address','other_details' */

    public function getEmployeeNameAttribute()
    {
        return ($this->employee) ? $this->employee->name : null ;
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getStatusDeleteAttribute()
    {
        return true;
    }

    public static function list_type() /* usada para llenar los objetos de formularios select*/
    {
        return ['Partida','Documento de Identidad','Certificaciones','Constancia','Comprobante','Comunicaciones y/o notificaciones','Otro documento que se considere relevante'];
    }

    public function getFileExistAttribute()
    {
        return Storage::disk('employees')->exists($this->file);
    }

    public function getFileUrlAttribute()
    {
        return ($this->file_exist) ? asset('storage/employees/'.$this->file) : null;
    }
}


/*

'employee_id','description','type','number','expiration_date','issue_date','country','file','comments'


employee_id
description
type
number
expiration_date
issue_date
country
file
comments

*/
