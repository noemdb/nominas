<?php

namespace App\Http\Livewire\PayrollAccounting;

use Livewire\Component;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class IndexComponent extends Component
{
    public function render()
    {
        return view('livewire.payroll-accounting.index-component');
    }
}
