<?php

namespace App\Models\Institution;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'institution_id','name','acronym','branch','account_number','account_type','routing_number','swift_code','iban','contact_person','phone_number','email','address'
    ];

    use HasFactory;

    const COLUMN_COMMENTS = [
        'institution_id'=>'Institución',
        'name'=>'Nombre completo',
        'acronym'=>'Acrónimo',
        'branch'=>'Sucursal, si es aplicable',
        'account_number'=>'Número de cuenta',
        'account_type'=>'Tipo de cuenta bancaria',
        'routing_number'=>'Número de tránsitoo',
        'swift_code'=>'SWIFT',
        'iban'=>'International Bank Account Number',
        'contact_person'=>'Persona de Contacto',
        'phone_number'=>'Teléfono',
        'email'=>'Dirección de correo electrónico',
        'address'=>'Dirección física',
    ];

    public static function list_account_type() /* usada para llenar los objetos de formularios select*/
    {
        return ['Cuenta corriente','Cuenta de ahorros'];
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public static function list_institution() /* usada para llenar los objetos de formularios select*/
    {
        return Institution::pluck('name', 'id');
    }
}

/*
institution_id
name
acronym
branch
account_number
account_type
routing_number
swift_code
iban
contact_person
phone_number
email
address

'institution_id','name','acronym','branch','account_number','account_type','routing_number','swift_code','iban','contact_person','phone_number','email','address'

Institución
Nombre completo
Acrónimo
Sucursal, si es aplicable
Número de cuenta
Tipo de cuenta bancaria
Número de tránsitoo
SWIFT
International Bank Account Number
Persona de Contacto
Teléfono
la dirección de correo electrónico
la dirección física

*/
