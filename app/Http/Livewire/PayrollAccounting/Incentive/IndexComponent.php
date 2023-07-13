<?php

namespace App\Http\Livewire\PayrollAccounting\Incentive;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Employee;
use App\Models\Payroll\Incentive;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IndexComponent extends Component
{
    // use IncentiveRules;
    use Actions;
    use WithSortingTrait;
    use WithPagination;
    use PaginateTrait;

    public Incentive $incentive;
    public $list_comment;
    public $list_employee;
    public $list_type;
    public $list_frequency;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->incentive = new Incentive;
        $this->list_comment = Incentive::COLUMN_COMMENTS;
        $this->list_employee = Employee::list_employee();
        $this->list_type = Incentive::list_type();
        $this->list_frequency = Incentive::list_frecuency();
    }
    public function render()
    {
        $search = $this->search;
        $incentives = Incentive::select('incentives.*', 'employees.name as employee_name')->join('employees', 'employees.id', '=', 'incentives.employee_id');

        $incentives = (!empty($search)) ? $incentives->Where(
            function ($query) use ($search) {
                $query->orWhere('incentives.type', 'like', '%' . $search . '%');
                $query->orWhere('incentives.description', 'like', '%' . $search . '%');
                $query->orWhere('incentives.amount', 'like', '%' . $search . '%');
                $query->orWhere('incentives.frequency', 'like', '%' . $search . '%');
                $query->orWhere('incentives.date', 'like', '%' . $search . '%');
                $query->orWhere('employees.name', 'like', '%' . $search . '%');
                $query->orWhere('employees.id', 'like', '%' . $search . '%');
            }
        )
            : $incentives;

        $incentives = ($this->sortBy && $this->sortDirection) ? $incentives->orderBy($this->sortBy, $this->sortDirection) : $incentives;

        $incentives = $incentives->paginate($this->paginate);
        return view('livewire.payroll-accounting.incentive.index-component', ['incentives' => $incentives]);
    }

    public function openModal(string $mode)
    {
        $this->showModal = true;
        $this->modeCreate = ($mode == 'create') ? true : false;
        $this->modeEdit = ($mode == 'edit') ? true : false;
        $this->modeShow = ($mode == 'show') ? true : false;
    }

    public function show($id)
    {
        $this->incentive = Incentive::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->incentive->save();
        $this->incentive = new Incentive;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->incentive = Incentive::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $incentive = Incentive::findOrFail($id);

        $incentive->delete();
        $this->incentive = new Incentive;

        $this->notification([
            'title'       => 'Felicitaciones!!!',
            'description' => 'Operación realizada',
            'icon'        => 'success'
        ]);
    }

    public function cancel()
    {
        $this->notification([
            'title'       => 'Has cancelado!',
            'description' => 'Ningún cambio realizado',
            'icon'        => 'info'
        ]);
        $this->incentive = new Incentive;
    }

    public function deleteQuestion($id)
    {
        $this->incentive = Incentive::findOrFail($id);

        if ($this->incentive->status_delete) {
            $this->notification()->confirm([
                'title'       => 'Estas seguro que desea realizar esta operación?',
                'description' => 'Eliminar registro?',
                'icon'        => 'question',
                'closeButton'        => true,
                'accept'      => [
                    'label'  => 'Aceptar',
                    'method' => 'delete',
                    'params' => $id,
                ],
                'reject' => [
                    'label'  => 'No, cancelar',
                    'method' => 'cancel',
                ],
            ]);
        } else {
            $this->notification()->error(
                $title = 'Error!, Esta operación no se puede realizar.',
                $description = 'Este registro tiene asociado otros, en caso de borrar, se pierde también los registro asociados.'
            );
        }
    }
}
