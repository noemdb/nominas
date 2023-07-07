<?php

namespace App\Http\Livewire\Payroll;

use Livewire\Component;
use Symfony\Component\Process\Process;

class IndexComponent extends Component
{
    public function render()
    {
        return view('livewire.payroll.index-component');
    }
}
