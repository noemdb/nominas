<?php

namespace App\Livewire\DataManagement;

use App\Models\Worker;
use Livewire\Component;

class DeleteWorker extends Component
{
    public $workerId;
    public $showModal = false;
    public $workerName;

    protected $listeners = ['confirmDelete'];

    public function confirmDelete($workerId)
    {
        $this->workerId = $workerId;
        $worker = Worker::findOrFail($workerId);
        $this->workerName = $worker->fullname;
        $this->showModal = true;
    }

    public function delete()
    {
        $worker = Worker::findOrFail($this->workerId);
        $worker->delete();
        
        $this->dispatch('workerDeleted');
        $this->showModal = false;
        
        session()->flash('message', 'Trabajador eliminado correctamente.');
    }

    public function cancel()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.data-management.delete-worker');
    }
}

