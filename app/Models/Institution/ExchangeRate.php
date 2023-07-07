<?php

namespace App\Models\Institution;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'currency_id','currency_referential_id','date','amount','source','status_official','observations'
    ];
    protected $dates = ['date'];

    const COLUMN_COMMENTS = [
        'currency_id'=>'Moneda',
        'currency_referential_id'=>'Moneda Referencial',
        'date'=>'Fecha de la tasa de cambio',
        'amount'=>'Monto de la tasa de cambio',
        'source'=>'Fuente de Información',
        'status_official'=>'Fuente Oficial',
        'observations'=>'Observaciones',
        /////////////////////////////////
        'currency_name'=>'Moneda',
        'currency_referential_name'=>'Moneda Referencial',
    ];

    public function getCurrencyNameAttribute()
    {
        return ($this->currency) ? $this->currency->name : null ;
    }

    public function getCurrencyReferentialNameAttribute()
    {
        return ($this->currency_referential) ? $this->currency_referential->name : null ;
    }

    public static function list_rate_type() /* usada para llenar los objetos de formularios select*/
    {
        // return ['Cuenta corriente','Cuenta de ahorros'];
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }

    public function getCurrencyReferentialAttribute()
    {
        //$currency = Currency::where('id',$this->currency_referential_id)->first(); //dd($currency);

        return Currency::where('id',$this->currency_referential_id)->first();
        // return $this->belongsTo(Currency::class,'currency_referential_id');
    }

    public static function list_currencies() /* usada para llenar los objetos de formularios select*/
    {
        return ExchangeRate::pluck('name', 'id');
    }
}
/*

'currency_id','currency_referential_id','date','amount','source','status_official','observations'

currency_id
currency_referential_id
date
amount
source
status_official
observations

*/
