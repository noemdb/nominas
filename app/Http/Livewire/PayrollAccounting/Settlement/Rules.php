<?php

namespace App\Http\Livewire\PayrollAccounting\Settlement;

trait Rules
{
    protected $rules = [
        'settlement.employee_id' => 'required|integer',
        'settlement.date' => 'required|date',
        'settlement.gross_salary' => 'required|numeric',
        'settlement.net_salary' => 'required|numeric',
        'settlement.tax_deductions' => 'required|numeric',
        'settlement.other_deductions' => 'required|numeric',
        'settlement.total_deductions' => 'required|numeric',
        'settlement.total_additions' => 'required|numeric',
        'settlement.total_pay' => 'required|numeric',
    ];

    protected function validationAttributes()
    {
        return [
            'settlement.employee_id' => $this->list_comment['employee_id'],
            'settlement.date' => $this->list_comment['date'],
            'settlement.gross_salary' => $this->list_comment['gross_salary'],
            'settlement.net_salary' => $this->list_comment['net_salary'],
            'settlement.tax_deductions' => $this->list_comment['tax_deductions'],
            'settlement.other_deductions' => $this->list_comment['other_deductions'],
            'settlement.total_deductions' => $this->list_comment['total_deductions'],
            'settlement.total_additions' => $this->list_comment['total_additions'],
            'settlement.total_pay' => $this->list_comment['total_pay'],
        ];
    }
}

?>
