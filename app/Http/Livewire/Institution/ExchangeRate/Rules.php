<?php

namespace App\Http\Livewire\Institution\ExchangeRate;

trait Rules
{
  protected $rules = [
    'exchange_rate.currency_id' => 'required|integer',
    'exchange_rate.currency_referential_id' => 'required|string',
    'exchange_rate.date' => 'required|string',
    'exchange_rate.amount' => 'nullable|string',
    'exchange_rate.source' => 'nullable|string',
    'exchange_rate.status_official' => 'nullable|string',
    'exchange_rate.observations' => 'nullable|string'
  ];

  protected function validationAttributes()
  {
    return [
      'exchange_rate.currency_id' => $this->list_comment['currency_id'],
      'exchange_rate.currency_referential_id' => $this->list_comment['currency_referential_id'],
      'exchange_rate.date' => $this->list_comment['date'],
      'exchange_rate.amount' => $this->list_comment['amount'],
      'exchange_rate.source' => $this->list_comment['source'],
      'exchange_rate.status_official' => $this->list_comment['status_official'],
      'exchange_rate.observations' => $this->list_comment['observations']
    ];
  }
}
