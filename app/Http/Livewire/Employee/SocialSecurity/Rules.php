<?php

namespace App\Http\Livewire\Employee\SocialSecurity;

trait Rules
{
    protected $rules = [
        'social_security.employee_id' => 'required|integer',
        'social_security.number' => 'required|integer',
        'social_security.card_number' => 'required|integer',
        'social_security.card_issue_date' => 'required|date',
        'social_security.card_expiration_date' => 'required|date',
        'social_security.benefits_eligibility' => 'nullable|boolean',
        'social_security.benefits_payment_amount' => 'nullable|integer',
        'social_security.benefits_payment_start_date' => 'nullable|date',
        'social_security.benefits_payment_end_date' => 'nullable|date',
    ];

    protected function validationAttributes()
    {
        return [
            'social_security.employee_id' => $this->list_comment['employee_id'],
            'social_security.number' => $this->list_comment['number'],
            'social_security.card_number' => $this->list_comment['card_number'],
            'social_security.card_issue_date' => $this->list_comment['card_issue_date'],
            'social_security.card_expiration_date' => $this->list_comment['card_expiration_date'],
            'social_security.benefits_eligibility' => $this->list_comment['benefits_eligibility'],
            'social_security.benefits_payment_amount' => $this->list_comment['benefits_payment_amount'],
            'social_security.benefits_payment_start_date' => $this->list_comment['benefits_payment_start_date'],
            'social_security.benefits_payment_end_date' => $this->list_comment['benefits_payment_end_date'],
        ];
    }
}

?>


