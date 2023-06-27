<?php

namespace App\Http\Livewire\Employee\Personal;

// 'employee_id','address','city','state','zip_code','country','phone_number','home_phone','emergency_contact_name','emergency_contact_relationship','emergency_contact_phone','emergency_contact_email','other_details',

trait Rules
{
    protected $rules = [
        'personal.employee_id' => 'required|integer',
        'personal.address' => 'required|string',
        'personal.city' => 'required|string',
        'personal.state' => 'required|string',
        'personal.zip_code' => 'required|string',
        'personal.country' => 'required|string',
        'personal.phone_number' => 'required|string',
        'personal.home_phone' => 'required|string',
        'personal.emergency_contact_name' => 'required|string',
        'personal.emergency_contact_relationship' => 'required|string',
        'personal.emergency_contact_phone' => 'required|string',
        'personal.emergency_contact_email' => 'required|email',
        'personal.other_details' => 'required|string',
    ];

    protected function validationAttributes()
    {
        return [
            'personal.employee_id' => $this->list_comment['employee_id'],
            'personal.address' => $this->list_comment['address'],
            'personal.city' => $this->list_comment['city'],
            'personal.state' => $this->list_comment['state'],
            'personal.zip_code' => $this->list_comment['zip_code'],
            'personal.country' => $this->list_comment['country'],
            'personal.phone_number' => $this->list_comment['phone_number'],
            'personal.home_phone' => $this->list_comment['home_phone'],
            'personal.emergency_contact_name' => $this->list_comment['emergency_contact_name'],
            'personal.emergency_contact_relationship' => $this->list_comment['emergency_contact_relationship'],
            'personal.emergency_contact_phone' => $this->list_comment['emergency_contact_phone'],
            'personal.emergency_contact_email' => $this->list_comment['emergency_contact_email'],
            'personal.other_details' => $this->list_comment['other_details'],
        ];
    }
}

?>
