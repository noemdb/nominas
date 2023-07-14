<?php

namespace App\Http\Livewire\PayrollAccounting\Salary;
//livewire.payroll-accounting.salary.index-component
use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Employee;
use App\Models\Institution\Currency;
use App\Models\Payroll\Salary;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IndexComponent extends Component
{
    use Rules;
    use Actions;
    use WithSortingTrait;
    use WithPagination;
    use PaginateTrait;

    public Salary $salary;
    public $list_comment;
    public $list_employee,$list_currency,$list_frequency;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->salary = new Salary();
        $this->list_comment = Salary::COLUMN_COMMENTS;
        $this->list_employee = Employee::list_employee();
        $this->list_currency = Currency::list_currency();
        $this->list_frequency = Salary::list_frequency();
    }

    public function render()
    {
        $search = $this->search;
        $salaries = Salary::select('salaries.*')
        ->join('employees', 'employees.id', '=', 'salaries.employee_id')
        // ->join('institutions', 'institutions.id', '=', 'employees.institution_id')
        ;

        $salaries = (!empty($search)) ? $salaries->Where(
            function ($query) use ($search) {
                $query->orWhere('employees.ci', 'like', '%' . $search . '%');
                $query->orWhere('employees.name', 'like', '%' . $search . '%');
                // $query->orWhere('institutions.company_name', 'like', '%' . $search . '%');
                // $query->orWhere('salaries.position', 'like', '%' . $search . '%');
            }
        )
            : $salaries;

        $salaries = ($this->sortBy && $this->sortDirection) ? $salaries->orderBy($this->sortBy, $this->sortDirection) : $salaries;

        $salaries = $salaries->paginate($this->paginate);//dd($salaries);
        return view('livewire.payroll-accounting.salary.index-component', ['salaries' => $salaries]);
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
        $this->salary = Salary::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->salary->save();
        $this->salary = new Salary;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->salary = Salary::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $salary = Salary::findOrFail($id);

        $salary->delete();
        $this->salary = new Salary;

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
        $this->salary = new Salary;
    }

    public function deleteQuestion($id)
    {
        $this->salary = Salary::findOrFail($id);

        if ($this->salary->status_delete) {
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
