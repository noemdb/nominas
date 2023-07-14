<?php

namespace App\Http\Livewire\PayrollAccounting\Salary;

trait Rules
{
    protected $rules = [
        'salary.employee_id' => 'required|integer',
        // 'salary.currency_id' => 'required|integer',
        'salary.frequency' => 'required|string',
        'salary.amount' => 'required|numeric',
        // 'salary.payment_status' => 'nullable|string',
    ];

    protected function validationAttributes()
    {
        return [
            'salary.employee_id' => $this->list_comment['employee_id'],
            // 'salary.currency_id' => $this->list_comment['currency_id'],
            'salary.frequency' => $this->list_comment['frequency'],
            'salary.amount' => $this->list_comment['amount'],
            // 'salary.payment_status' => $this->list_comment['payment_status'],
        ];
    }
}

?>
