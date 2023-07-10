<?php

namespace App\Http\Livewire\PayrollAccounting;

use Livewire\Component;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class IndexComponent extends Component
{
    public function render()
    {
        chdir(base_path());
        $latex = '\frac{a+b+c}{d}';
        $process = new Process(['node', 'latex-cli.js', '-l', $latex, '-v', 'a=1', 'b=2', 'c=3', 'd=4']);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $result = $process->getOutput();
        dd($result);

        return view('livewire.payroll-accounting.index-component');
    }
}
