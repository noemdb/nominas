<?php

namespace App\Livewire\DataManagement;

use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class WorkersManager extends Component
{
    use WithPagination;
    use WireUiActions;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'first_name';
    public $sortDirection = 'asc';
    
    public $showModal = false;
    public $isEdit = false;
    public $workerId = null;
    
    public $worker = [
        'first_name' => '',
        'last_name' => '',
        'identification' => '',
        'email' => '',
        'phone' => '',
        'birth_date' => '',
        'gender' => 'male',
        'marital_status' => 'single',
        'nationality' => '',
        'hire_date' => '',
        'base_salary' => 0,
        'contract_type' => 'full-time',
        'payment_method' => 'bank_transfer',
        'bank_name' => '',
        'bank_account_number' => '',
        'tax_identification_number' => '',
        'social_security_number' => '',
        'pension_fund' => '',
        'is_active' => true
    ];
    
    public $confirmingDelete = false;
    public $deleteId = null;
    
    protected function rules()
    {
        return [
            'worker.first_name' => 'required|string|max:255',
            'worker.last_name' => 'required|string|max:255',
            'worker.identification' => 'required|string|max:20|unique:workers,identification,' . ($this->workerId ?? ''),
            'worker.email' => 'required|email|max:255|unique:workers,email,' . ($this->workerId ?? ''),
            'worker.phone' => 'required|string|max:20',
            'worker.birth_date' => 'required|date',
            'worker.gender' => 'required|in:Masculino,Femenino,Otro',
            'worker.marital_status' => 'required',
            'worker.nationality' => 'required|string|max:100',
            'worker.hire_date' => 'required|date',
            'worker.base_salary' => 'required|numeric|min:0',
            'worker.contract_type' => 'required',
            'worker.payment_method' => 'required',
            'worker.bank_name' => 'nullable|required_if:payment_method,bank_transfer|string|max:255',
            'worker.bank_account_number' => 'nullable|required_if:payment_method,bank_transfer|string|max:50',
            'worker.tax_identification_number' => 'required|string|max:50',
            'worker.social_security_number' => 'required|string|max:50',
            'worker.pension_fund' => 'nullable|string|max:255',
            'worker.is_active' => 'boolean',
        ];
    }    
    
    
    public function create()
    {
        $this->reset(['worker', 'workerId', 'isEdit']);
        $this->worker = [
            'first_name' => '',
            'last_name' => '',
            'identification' => '',
            'email' => '',
            'phone' => '',
            'birth_date' => '',
            'gender' => 'male',
            'marital_status' => 'single',
            'nationality' => '',
            'hire_date' => '',
            'base_salary' => 0,
            'contract_type' => 'full-time',
            'payment_method' => 'bank_transfer',
            'bank_name' => '',
            'bank_account_number' => '',
            'tax_identification_number' => '',
            'social_security_number' => '',
            'pension_fund' => '',
            'is_active' => true
        ];
        $this->isEdit = false;
        $this->showModal = true;
    }
    
    public function edit($id)
    {
        $this->workerId = $id;
        $this->isEdit = true;
        
        $workerModel = Worker::findOrFail($id);
        $this->worker = [
            'first_name' => $workerModel->first_name,
            'last_name' => $workerModel->last_name,
            'identification' => $workerModel->identification,
            'email' => $workerModel->email,
            'phone' => $workerModel->phone,
            'birth_date' => $workerModel->birth_date ? $workerModel->birth_date->format('Y-m-d') : '',
            'gender' => $workerModel->gender,
            'marital_status' => $workerModel->marital_status,
            'nationality' => $workerModel->nationality,
            'hire_date' => $workerModel->hire_date ? $workerModel->hire_date->format('Y-m-d') : '',
            'base_salary' => $workerModel->base_salary,
            'contract_type' => $workerModel->contract_type,
            'payment_method' => $workerModel->payment_method,
            'bank_name' => $workerModel->bank_name,
            'bank_account_number' => $workerModel->bank_account_number,
            'tax_identification_number' => $workerModel->tax_identification_number,
            'social_security_number' => $workerModel->social_security_number,
            'pension_fund' => $workerModel->pension_fund,
            'is_active' => $workerModel->is_active
        ];
        
        $this->showModal = true;
    }
    
    public function save()
    {
        //dd($this->worker);
        $this->validate();
        
        if ($this->isEdit) {
            $workerModel = Worker::findOrFail($this->workerId);
        } else {
            $workerModel = new Worker();
        }
        
        // Asignar todos los campos del formulario al modelo
        $workerModel->first_name = $this->worker['first_name'];
        $workerModel->last_name = $this->worker['last_name'];
        $workerModel->identification = $this->worker['identification'];
        $workerModel->email = $this->worker['email'];
        $workerModel->phone = $this->worker['phone'];
        $workerModel->birth_date = $this->worker['birth_date'];
        $workerModel->gender = $this->worker['gender'];
        $workerModel->marital_status = $this->worker['marital_status'];
        $workerModel->nationality = $this->worker['nationality'];
        $workerModel->hire_date = $this->worker['hire_date'];
        $workerModel->base_salary = $this->worker['base_salary'];
        $workerModel->contract_type = $this->worker['contract_type'];
        $workerModel->payment_method = $this->worker['payment_method'];
        
        // Campos bancarios (solo si el método de pago es transferencia bancaria)
        if ($this->worker['payment_method'] === 'bank_transfer') {
            $workerModel->bank_name = $this->worker['bank_name'];
            $workerModel->bank_account_number = $this->worker['bank_account_number'];
        } else {
            $workerModel->bank_name = null;
            $workerModel->bank_account_number = null;
        }
        
        $workerModel->tax_identification_number = $this->worker['tax_identification_number'];
        $workerModel->social_security_number = $this->worker['social_security_number'];
        $workerModel->pension_fund = $this->worker['pension_fund'];
        $workerModel->is_active = $this->worker['is_active'];
        
        $workerModel->save();
        
        $this->showModal = false;
        $this->successNotification();
    }
    
    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->deleteId = $id;
    }
    
    public function deleteWorker()
    {
        $worker = Worker::findOrFail($this->deleteId);
        $worker->delete();
        
        $this->confirmingDelete = false;
        $this->deleteId = null;
        
        session()->flash('message', 'Trabajador eliminado correctamente.');
        $this->successNotification();
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->confirmingDelete = false;
    }

    public function render()
    {
        return view('livewire.data-management.workers-manager', [
            'workers' => Worker::where('first_name', 'like', "%{$this->search}%")
                ->orWhere('identification', 'like', "%{$this->search}%")
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }

    public function successNotification(): void
    {
        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Realizado!',
            'description' => 'Accion ejecutada.',
        ]);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
}

