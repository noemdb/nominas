<?php

namespace App\Http\Livewire\PayrollAccounting\Incentive;

trait IncentiveRules
{
    protected $rules = [
        'incentive.employee_id' => 'required|numeric',
        'incentive.type' => 'required|string',
        'incentive.description' => 'nullable|string',
        'incentive.amount' => 'required|numeric',
        'incentive.frequency' => 'required|string',
        'incentive.date' => 'required|string',
    ];

    protected function validationAttributes()
    {
        return [
            'incentive.employee_id' => $this->list_comment['employee_id'],
            'incentive.type' => $this->list_comment['type'],
            'incentive.description' => $this->list_comment['description'],
            'incentive.amount' => $this->list_comment['amount'],
            'incentive.frequency' => $this->list_comment['frequency'],
            'incentive.date' => $this->list_comment['date'],
        ];
    }
}

?>
