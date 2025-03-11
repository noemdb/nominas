<?php

namespace App\Livewire\DataManagement;

use App\Models\Worker;
use Livewire\Component;

class WorkerForm extends Component
{
    public Worker $worker;
    public $isEdit = false;

    protected function rules()
    {
        return [
            'worker.fullname' => 'required|string|max:255',
            'worker.identification' => 'required|string|max:20|unique:workers,identification,' . ($this->worker->id ?? ''),
            'worker.current_position_info' => 'required|string|max:255',
            'worker.base_salary' => 'required|numeric|min:0',
            'worker.is_active' => 'boolean',
            'worker.status_positions' => 'boolean',
        ];
    }

    public function mount($workerId = null)
    {
        if ($workerId) {
            $this->worker = Worker::findOrFail($workerId);
            $this->isEdit = true;
        } else {
            $this->worker = new Worker();
            $this->worker->is_active = true;
            $this->worker->status_positions = true;
        }
    }

    public function save()
    {
        $this->validate();
        
        $this->worker->save();
        
        $this->dispatch('workerSaved');
        
        session()->flash('message', $this->isEdit ? 
            'Trabajador actualizado correctamente.' : 
            'Trabajador registrado correctamente.');
            
        return redirect()->route('workers.index');
    }

    public function render()
    {
        return view('livewire.data-management.worker-form');
    }
}

