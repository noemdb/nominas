<?php

namespace App\Models;

use App\Models\Institution\Authority;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'name','type','acronym','address','phone_number','email','website','foundation_date','legal_status','tax_id','registration_number','logo',
        'accrual_rate','maximum_days','use_period_start_date','use_period_end_date','carryover_allowed','carryover_maximum_days',
        'payout_allowed','payout_formulation_id',
    ];

    use HasFactory;

    const COLUMN_COMMENTS = [
        'name'=>'Nombre',
        'type'=>'Tipo',
        'acronym'=>'Acrónimo o sigla, si lo tiene',
        'address'=>'Dirección física',
        'phone_number'=>'Núm. de teléf.',
        'email'=>'Dirección de correo electrónico',
        'website'=>'Dirección del sitio web de la institución, si lo tiene',
        'foundation_date'=>'Fecha de fundación de la institución, si se conoce',
        'legal_status'=>'Estado legal de la institución',
        'tax_id'=>'Número de identificación fiscal de la institución, si se conoce',
        'registration_number'=>'Núm. de registro',
        'logo'=>'Imagen del logo de la institución, almacenada como un archivo en la base de datos o en un servidor de archivos externo',

        'accrual_rate'=>'La tasa a la que se acumulan los días de vacaciones',
        'maximum_days'=>'El número máximo de días de vacaciones que puede acumular un empleado',
        'use_period_start_date'=>'La fecha en que comienza el período en que el empleado puede usar los días de vacaciones acumulados',
        'use_period_end_date'=>'La fecha en que finaliza el período en que el empleado puede usar los días de vacaciones acumulados',
        'carryover_allowed'=>'Un indicador de si se permite que el empleado lleve días de vacaciones no utilizados de un período a otro',
        'carryover_maximum_days'=>'El número máximo de días de vacaciones que el empleado puede llevar de un período a otro, si se permite el carryover',
        'payout_allowed'=>'Un indicador de si se permite que el empleado reciba un pago en efectivo por días de vacaciones no utilizados al final del año fiscal o al final del empleo',
        'payout_formulation_id'=>'La fórmula utilizada para calcular el valor del pago en efectivo por días de vacaciones no utilizados, si se permite el pago',

    ];

    public static function list_type() /* usada para llenar los objetos de formularios select*/
    {
        return ['Pública','Privada'];
    }
    public static function list_legal_status() /* usada para llenar los objetos de formularios select*/
    {
        return ['Empresa','Organización sin fines de lucro','Fundación','Asociación'];
    }

    public function authorities()
    {
        return $this->hasMany(Authority::class);
    }

    public function getStatusDeleteAttribute()
    {
        return $this->authorities->isEmpty();
    }

    public static function list_institution() /* usada para llenar los objetos de formularios select*/
    {
        return Institution::pluck('name', 'id');
    }

}

/*

'name','type','acronym','address','phone_number','email','website','foundation_date','legal_status','tax_id','registration_number','logo'

name
type
acronym
address
phone_number
email
website
foundation_date
legal_status
tax_id
registration_number
logo

*/
