<?php

namespace App\Http\Livewire\Employee\Training;

// 'employee_id','address','city','state','zip_code','country','phone_number','home_phone','emergency_contact_name','emergency_contact_relationship','emergency_contact_phone','emergency_contact_email','other_details',

trait Rules
{
    protected $rules = [
        'training.employee_id' => 'required|integer',
        'training.name' => 'required|string',
        'training.description' => 'required|string',
        'training.provider' => 'required|string',
        'training.start' => 'required|string',
        'training.end' => 'required|string',
        'training.location' => 'nullable|string',
        'training.duration_hours' => 'nullable|integer',
        'training.certificate_number' => 'nullable|string',
        'training.certificate_issue' => 'nullable|string',
        'training.certificate_expiration' => 'nullable|string',

    ];

    protected function validationAttributes()
    {
        return [
            'training.employee_id' => $this->list_comment['employee_id'],
            'training.name' => $this->list_comment['name'],
            'training.description' => $this->list_comment['description'],
            'training.provider' => $this->list_comment['provider'],
            'training.start' => $this->list_comment['start'],
            'training.end' => $this->list_comment['end'],
            'training.location' => $this->list_comment['location'],
            'training.duration_hours' => $this->list_comment['duration_hours'],
            'training.certificate_number' => $this->list_comment['certificate_number'],
            'training.certificate_issue' => $this->list_comment['certificate_issue'],
            'training.certificate_expiration' => $this->list_comment['certificate_expiration'],
        ];
    }
}

?>
