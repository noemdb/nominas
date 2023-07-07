<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'currency_id','currency_referential_id','date','ammount','source','status_official','observations'
    ];
    protected $dates = ['date'];

    const COLUMN_COMMENTS = [
        'currency_id'=>'Moneda',
        'currency_referential_id'=>'Moneda Referencial',
        'date'=>'Fecha de la tasa de cambio',
        'ammount'=>'Monto de la tasa de cambio',
        'source'=>'Fuente de Información',
        'status_official'=>'Fuente Oficial',
        'observations'=>'Observaciones',
    ];

    public static function list_rate_type() /* usada para llenar los objetos de formularios select*/
    {
        // return ['Cuenta corriente','Cuenta de ahorros'];
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }

    public function currency_referential()
    {
        return $this->belongsTo(Currency::class,'currency_referential_id');
    }

    public static function list_currencies() /* usada para llenar los objetos de formularios select*/
    {
        return ExchangeRate::pluck('name', 'id');
    }
}
/*

'currency_id','currency_referential_id','date','ammount','source','status_official','observations'

currency_id
currency_referential_id
date
ammount
source
status_official
observations

*/
