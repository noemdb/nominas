<?php

namespace App\Http\Livewire\PayrollAccounting;

use Livewire\Component;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class IndexComponent extends Component
{
    public function render()
    {
        $process = new Process(array('ls', '-lsa'));
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        dd($process->getOutput());

        return view('livewire.payroll-accounting.index-component');
    }
}
