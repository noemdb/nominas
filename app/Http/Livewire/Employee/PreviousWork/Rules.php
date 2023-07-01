<?php

namespace App\Http\Livewire\Employee\PreviousWork;

trait Rules
{
    protected $rules = [
        'previous_work.employee_id' => 'required|integer',
        'previous_work.company_name' => 'required|string',
        'previous_work.position' => 'required|string',
        'previous_work.start_date' => 'required|date',
        'previous_work.end_date' => 'required|date',
        'previous_work.reason_for_leaving' => 'required|string',
        'previous_work.references' => 'string',
    ];

    protected function validationAttributes()
    {
        return [
            'previous_work.employee_id' => $this->list_comment['employee_id'],
            'previous_work.company_name' => $this->list_comment['company_name'],
            'previous_work.position' => $this->list_comment['position'],
            'previous_work.start_date' => $this->list_comment['start_date'],
            'previous_work.end_date' => $this->list_comment['end_date'],
            'previous_work.reason_for_leaving' => $this->list_comment['reason_for_leaving'],
            'previous_work.references' => $this->list_comment['references'],
        ];
    }
}

?>
