<?php

namespace App\Livewire\DataManagement;

use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;

class WorkersList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'first_name';
    public $sortDirection = 'asc';
    
    protected $listeners = ['workerSaved' => '$refresh', 'workerDeleted' => '$refresh'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingperPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.data-management.workers-list', [
            'workers' => Worker::where('first_name', 'like', "%{$this->search}%")
                ->orWhere('last_name', 'like', "%{$this->search}%")
                ->orWhere('identification', 'like', "%{$this->search}%")
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
