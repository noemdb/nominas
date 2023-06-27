<?php

namespace App\Http\Livewire\Institution\Bank;

trait BankRules
{
    protected $rules = [
        'bank.institution_id' => 'required|string',
        'bank.name' => 'required|string',
        'bank.acronym' => 'string',
        'bank.branch' => 'string',
        'bank.account_number' => 'required|string',
        'bank.account_type' => 'required|string',
        'bank.routing_number' => 'required|string',
        'bank.swift_code' => 'required|string',
        'bank.iban' => 'required|string',
        'bank.contact_person' => 'required|string',
        'bank.phone_number' => 'required|string',
        'bank.email' => 'required|string|email',
        'bank.address' => 'required|string',
    ];

    protected function validationAttributes()
    {
        return [
            'bank.institution_id' => $this->list_comment['institution_id'],
            'bank.name' => $this->list_comment['name'],
            'bank.acronym' => $this->list_comment['name'],
            'bank.branch' => $this->list_comment['name'],
            'bank.account_number' => $this->list_comment['name'],
            'bank.account_type' => $this->list_comment['name'],
            'bank.routing_number' => $this->list_comment['name'],
            'bank.swift_code' => $this->list_comment['name'],
            'bank.iban' => $this->list_comment['name'],
            'bank.contact_person' => $this->list_comment['name'],
            'bank.phone_number' => $this->list_comment['phone_number'],
            'bank.email' => $this->list_comment['email'],
            'bank.address' => $this->list_comment['address'],
        ];
    }
}
