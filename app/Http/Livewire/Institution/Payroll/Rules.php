<?php

namespace App\Http\Livewire\Institution\Payroll;

trait Rules
{
    protected $rules = [
        'payroll.institution_id' => 'required|integer',
        'payroll.level_id' => 'required|integer',
        'payroll.frequency' => 'required|string',
        'payroll.name' => 'required|string',
        'payroll.description' => 'nullable|string',
        'payroll.status' => 'required|boolean',
    ];

    protected function validationAttributes()
    {
        return [
            'payroll.institution_id' => $this->list_comment['institution_id'],
            'payroll.level_id' => $this->list_comment['level_id'],
            'payroll.frequency' => $this->list_comment['frequency'],
            'payroll.name' => $this->list_comment['name'],
            'payroll.description' => $this->list_comment['description'],
            'payroll.status' => $this->list_comment['status'],
        ];
    }
}
