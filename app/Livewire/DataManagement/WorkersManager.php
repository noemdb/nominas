<?php

namespace App\Livewire\DataManagement;

use App\Models\Payroll;
use App\Models\Worker;
use App\Models\Area;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;
use App\Traits\Loggable;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class WorkersManager extends Component
{
    use WithPagination;
    use WireUiActions;
    use Loggable;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'first_name';
    public $sortDirection = 'asc';
    public $payrollOptions = [];
    public $areaOptions = [];
    public $selectedArea = '';

    public $showModal = false;
    public $isEdit = false;
    public $isEditPosition = false;
    public $showModalPosition = false;
    public $showDetailsModal = false;
    public $selectedWorker = null;
    public $workerId = null;
    public $userId = null;

    public $confirmingDelete = false;
    public $deleteId = null;

    public $isLoaded = false;

    public $first_name = '';
    public $last_name = '';
    public $identification = '';
    public $email = '';
    public $phone = '';
    public $birth_date = '';
    public $gender = 'male';
    public $marital_status = 'single';
    public $nationality = '';
    public $hire_date = '';
    public $base_salary = 0;
    public $contract_type = 'full-time';
    public $payment_method = 'bank_transfer';
    public $bank_name = '';
    public $bank_account_number = '';
    public $tax_identification_number = '';
    public $social_security_number = '';
    public $pension_fund = '';
    public $is_active = true;
    public $username;
    public $password;

    protected function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'identification' => [
                'required',
                'min:7',
                'max:13',
                Rule::unique('workers', 'identification')->ignore($this->workerId),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('workers', 'email')->ignore($this->workerId),
            ],
            'phone' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'nationality' => 'required',
            'hire_date' => 'required|date',
            'base_salary' => 'required|numeric|min:0',
            'contract_type' => 'required',
            'payment_method' => 'required',
            'bank_name' => 'required_if:payment_method,bank_transfer',
            'bank_account_number' => 'required_if:payment_method,bank_transfer',
            'tax_identification_number' => 'nullable',
            'social_security_number' => 'nullable',
            'pension_fund' => 'nullable',
            'is_active' => 'boolean',
            'username' => [
                'required',
                'min:3',
                'max:50',
                Rule::unique('users', 'username')->ignore($this->userId),
            ],
            'password' => $this->isEdit ? 'nullable|min:6' : 'required|min:6',
        ];
    }

    protected $messages = [
        'first_name.required' => 'El nombre es obligatorio',
        'last_name.required' => 'El apellido es obligatorio',
        'identification.required' => 'La cédula de identidad es obligatoria',
        'identification.min' => 'La cédula de identidad debe contener al menos :min caracteres',
        'identification.max' => 'La cédula de identidad debe contener máximo :max caracteres',
        'identification.unique' => 'Esta identificación ya está registrada',
        'email.required' => 'El correo electrónico es obligatorio',
        'email.email' => 'El correo electrónico debe ser válido',
        'email.unique' => 'Este correo electrónico ya está registrado',
        'phone.required' => 'El teléfono es obligatorio',
        'birth_date.required' => 'La fecha de nacimiento es obligatoria',
        'gender.required' => 'El género es obligatorio',
        'marital_status.required' => 'El estado civil es obligatorio',
        'nationality.required' => 'La nacionalidad es obligatoria',
        'hire_date.required' => 'La fecha de contratación es obligatoria',
        'base_salary.required' => 'El salario base es obligatorio',
        'contract_type.required' => 'El tipo de contrato es obligatorio',
        'payment_method.required' => 'El método de pago es obligatorio',
        'bank_name.required_if' => 'El nombre del banco es obligatorio cuando el método de pago es transferencia bancaria',
        'bank_account_number.required_if' => 'El número de cuenta es obligatorio cuando el método de pago es transferencia bancaria',
        'tax_identification_number.required' => 'El número de identificación fiscal es obligatorio',
        'social_security_number.required' => 'El número de seguridad social es obligatorio',
        'pension_fund.required' => 'El fondo de pensiones es obligatorio',
        'is_active.boolean' => 'El estado del trabajador debe ser booleano',
        'username.required' => 'El nombre de usuario es obligatorio',
        'username.unique' => 'Este nombre de usuario ya está registrado',
        'password.required' => 'La contraseña es obligatoria',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres',
    ];

    protected $validationAttributes = [
        'first_name' => 'nombre',
        'last_name' => 'apellido',
        'identification' => 'cédula de identidad',
        'email' => 'correo electrónico',
        'phone' => 'teléfono',
        'birth_date' => 'fecha de nacimiento',
        'gender' => 'género',
        'marital_status' => 'estado civil',
        'nationality' => 'nacionalidad',
        'hire_date' => 'fecha de contratación',
        'base_salary' => 'salario base',
        'contract_type' => 'tipo de contrato',
        'payment_method' => 'método de pago',
        'bank_name' => 'nombre del banco',
        'bank_account_number' => 'número de cuenta',
        'tax_identification_number' => 'RIF',
        'social_security_number' => 'número de seguridad social',
        'pension_fund' => 'fondo de pensiones',
        'is_active' => 'estado activo',
        'user.username' => 'nombre de usuario',
    ];

    public function create()
    {
        $this->resetValidation();
        $this->reset([
            'workerId',
            'userId',
            'username',
            'password',
            'first_name',
            'last_name',
            'identification',
            'email',
            'phone',
            'birth_date',
            'gender',
            'marital_status',
            'nationality',
            'hire_date',
            'base_salary',
            'contract_type',
            'payment_method',
            'bank_name',
            'bank_account_number',
            'tax_identification_number',
            'social_security_number',
            'pension_fund',
            'is_active'
        ]);
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $worker = Worker::findOrFail($id);
        $this->userId = $worker->user_id;
        $user = User::findOrFail($this->userId);

        $this->username = $user->username;

        $this->workerId = $worker->id;
        $this->first_name = $worker->first_name;
        $this->last_name = $worker->last_name;
        $this->identification = $worker->identification;
        $this->email = $worker->email;
        $this->phone = $worker->phone;
        $this->birth_date = $worker->birth_date;
        $this->gender = $worker->gender;
        $this->marital_status = $worker->marital_status;
        $this->nationality = $worker->nationality;
        $this->hire_date = $worker->hire_date;
        $this->base_salary = $worker->base_salary;
        $this->contract_type = $worker->contract_type;
        $this->payment_method = $worker->payment_method;
        $this->bank_name = $worker->bank_name;
        $this->bank_account_number = $worker->bank_account_number;
        $this->tax_identification_number = $worker->tax_identification_number;
        $this->social_security_number = $worker->social_security_number;
        $this->pension_fund = $worker->pension_fund;
        $this->is_active = $worker->is_active;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save()
    {
        $data = $this->validate();

        try {
            $workerData = [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'identification' => $this->identification,
                'email' => $this->email,
                'phone' => $this->phone,
                'birth_date' => $this->birth_date,
                'gender' => $this->gender,
                'marital_status' => $this->marital_status,
                'nationality' => $this->nationality,
                'hire_date' => $this->hire_date,
                'base_salary' => $this->base_salary,
                'contract_type' => $this->contract_type,
                'payment_method' => $this->payment_method,
                'bank_name' => $this->bank_name,
                'bank_account_number' => $this->bank_account_number,
                'tax_identification_number' => $this->tax_identification_number,
                'social_security_number' => $this->social_security_number,
                'pension_fund' => $this->pension_fund,
                'is_active' => $this->is_active
            ];

            DB::beginTransaction();

            if ($this->isEdit) {
                $worker = Worker::findOrFail($this->workerId);
                $worker->update($workerData);
                $this->notification()->success(
                    'Trabajador actualizado',
                    'El trabajador ha sido actualizado exitosamente'
                );
            } else {
                Worker::create($workerData);
                $this->notification()->success(
                    'Trabajador registrado',
                    'El trabajador ha sido registrado exitosamente'
                );
            }

            DB::commit();
            $this->closeModal();
            $this->reset([
                'workerId',
                'first_name',
                'last_name',
                'identification',
                'email',
                'phone',
                'birth_date',
                'gender',
                'marital_status',
                'nationality',
                'hire_date',
                'base_salary',
                'contract_type',
                'payment_method',
                'bank_name',
                'bank_account_number',
                'tax_identification_number',
                'social_security_number',
                'pension_fund',
                'is_active'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logError('Error al guardar trabajador: ' . $e->getMessage());
            $this->notification()->error(
                'Error',
                'Ha ocurrido un error al guardar el trabajador'
            );
        }
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->deleteId = $id;
    }

    public function deleteWorker()
    {
        try {
            $worker = Worker::findOrFail($this->deleteId);
            $workerData = $worker->toArray();
            $worker->delete();

            $this->logDeletion($workerData);
            $this->confirmingDelete = false;
            $this->deleteId = null;
            $this->clearModels();
            $this->successNotification();
        } catch (\Exception $e) {
            $this->logError('Error al eliminar trabajador: ' . $e->getMessage(), [
                'worker_id' => $this->deleteId
            ]);
            throw $e;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showModalPosition = false;
        $this->showDetailsModal = false;
        $this->confirmingDelete = false;
        $this->isEditPosition = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        $query = Worker::with(['positions' => function ($query) {
            $query->with(['area', 'rol'])
                ->where('is_active', true)
                ->latest('start_date');
        }])
            ->when($this->search, function ($query) {
                $searchTerms = explode(' ', $this->search);
                $query->where(function ($q) use ($searchTerms) {
                    foreach ($searchTerms as $term) {
                        $q->where(function ($subQuery) use ($term) {
                            // Búsqueda usando LIKE como fallback
                            $subQuery->where('first_name', 'like', "%{$term}%")
                                ->orWhere('last_name', 'like', "%{$term}%")
                                ->orWhere('identification', 'like', "%{$term}%")
                                ->orWhere('email', 'like', "%{$term}%")
                                ->orWhereHas('positions.area', function ($q) use ($term) {
                                    $q->where('name', 'like', "%{$term}%");
                                });
                        });
                    }
                });
            })
            ->when($this->selectedArea, function ($query) {
                $query->whereHas('positions', function ($q) {
                    $q->where('area_id', $this->selectedArea)
                        ->where('is_active', true);
                });
            });

        // Aplicar ordenamiento
        if ($this->sortField === 'current_position_info') {
            $query->orderByRaw("(
                SELECT CONCAT(areas.name, ' - ', rols.name)
                FROM positions
                JOIN areas ON positions.area_id = areas.id
                JOIN rols ON positions.rol_id = rols.id
                WHERE positions.worker_id = workers.id
                AND positions.is_active = true
                ORDER BY positions.start_date DESC
                LIMIT 1
            ) {$this->sortDirection}");
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        return view('livewire.data-management.workers-manager', [
            'workers' => $query->paginate($this->perPage),
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

    public function updatingSelectedArea()
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

    public function clearSearch()
    {
        $this->search = '';
    }

    public function clearAreaFilter()
    {
        $this->selectedArea = '';
        $this->resetPage();
    }

    public function clearModels()
    {
        $this->reset([
            'workerId',
            'userId',
            'username',
            'password',
            'first_name',
            'last_name',
            'identification',
            'email',
            'phone',
            'birth_date',
            'gender',
            'marital_status',
            'nationality',
            'hire_date',
            'base_salary',
            'contract_type',
            'payment_method',
            'bank_name',
            'bank_account_number',
            'tax_identification_number',
            'social_security_number',
            'pension_fund',
            'is_active'
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

    public function mount()
    {
        $this->payrollOptions = Payroll::getSelectOptions();
        $this->areaOptions = Area::getSelectOptions();
        $this->setLoaded();
    }

    public function getWorkerSeniorityProperty()
    {
        if (empty($this->hire_date)) {
            return [
                'years' => 0,
                'months' => 0,
                'days' => 0,
                'formatted' => 'Sin fecha de ingreso'
            ];
        }

        $hireDate = \Carbon\Carbon::parse($this->hire_date);
        $now = \Carbon\Carbon::now();

        // Si la fecha de ingreso es en el futuro, retornar 0
        if ($hireDate->isFuture()) {
            return [
                'years' => 0,
                'months' => 0,
                'days' => 0,
                'formatted' => 'Fecha de ingreso futura'
            ];
        }

        $years = $now->diffInYears($hireDate);
        $months = $now->copy()->subYears($years)->diffInMonths($hireDate);
        $days = $now->copy()->subYears($years)->subMonths($months)->diffInDays($hireDate);

        // Formatear la antigüedad en español
        $parts = [];
        if ($years > 0) {
            $parts[] = $years . ' ' . ($years === 1 ? 'año' : 'años');
        }
        if ($months > 0) {
            $parts[] = $months . ' ' . ($months === 1 ? 'mes' : 'meses');
        }
        if ($days > 0) {
            $parts[] = $days . ' ' . ($days === 1 ? 'día' : 'días');
        }

        return [
            'years' => $years,
            'months' => $months,
            'days' => $days,
            'formatted' => !empty($parts) ? implode(', ', $parts) : '0 días'
        ];
    }

    public function setLoaded()
    {
        $this->isLoaded = true;
        $this->dispatch('component-loaded');
    }

    public function setModePosition($id)
    {
        $this->closeModal();

        $worker = Worker::findOrFail($id);
        $this->workerId = $worker->id;
        $this->userId = $worker->user_id;
        $this->isEditPosition = true;
        $this->showModalPosition = true;
        $this->resetErrorBag();
    }

    public function showWorkerDetails($id)
    {
        $this->selectedWorker = Worker::getWorkerWithDetails($id);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedWorker = null;
    }
}
