<?php

namespace App\Http\Livewire\Employee;

trait Rules
{
    protected $rules = [
        'employee.institution_id' => 'required|integer',
        'employee.name' => 'required|string',
        'employee.ci' => 'required|integer',
        'employee.hire_date' => 'required|string|max:192',
        'employee.termination_date' => 'nullable|date',
        'employee.status' => 'required|string',
        'employee.email' => 'required|email',
    ];

    protected function validationAttributes()
    {
        return [
            'employee.institution_id' => $this->list_comment['institution_id'],
            'employee.name' => $this->list_comment['name'],
            'employee.ci' => $this->list_comment['ci'],
            'employee.hire_date' => $this->list_comment['hire_date'],
            'employee.termination_date' => $this->list_comment['termination_date'],
            'employee.status' => $this->list_comment['status'],
            'employee.email' => $this->list_comment['email'],
        ];
    }
}

?>
