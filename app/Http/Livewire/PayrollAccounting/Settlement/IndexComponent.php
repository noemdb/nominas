<?php

namespace App\Http\Livewire\PayrollAccounting\Settlement;
//livewire.payroll-accounting.settlement.index-component

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Employee;
use App\Models\Institution\Currency;
use App\Models\Payroll\Settlement;
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

    public Settlement $settlement;
    public $list_comment;
    public $list_employee,$list_currency,$list_frequency;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->settlement = new Settlement();
        $this->list_comment = Settlement::COLUMN_COMMENTS;
        $this->list_employee = Employee::list_employee();
        $this->list_currency = Currency::list_currency();
        // $this->list_frequency = Settlement::list_frequency();
    }

    public function render()
    {
        $search = $this->search;
        $settlements = Settlement::select('settlements.*')
        ->join('employees', 'employees.id', '=', 'settlements.employee_id')
        // ->join('institutions', 'institutions.id', '=', 'employees.institution_id')
        ;

        $settlements = (!empty($search)) ? $settlements->Where(
            function ($query) use ($search) {
                $query->orWhere('employees.ci', 'like', '%' . $search . '%');
                $query->orWhere('employees.name', 'like', '%' . $search . '%');
                // $query->orWhere('institutions.company_name', 'like', '%' . $search . '%');
                // $query->orWhere('settlements.position', 'like', '%' . $search . '%');
            }
        )
            : $settlements;

        $settlements = ($this->sortBy && $this->sortDirection) ? $settlements->orderBy($this->sortBy, $this->sortDirection) : $settlements;

        $settlements = $settlements->paginate($this->paginate);//dd($settlements);
        return view('livewire.payroll-accounting.settlement.index-component', ['settlements' => $settlements]);
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
        $this->settlement = Settlement::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->settlement->save();
        $this->settlement = new Settlement;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->settlement = Settlement::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $settlement = Settlement::findOrFail($id);

        $settlement->delete();
        $this->settlement = new Settlement;

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
        $this->settlement = new Settlement;
    }

    public function deleteQuestion($id)
    {
        $this->settlement = Settlement::findOrFail($id);

        if ($this->settlement->status_delete) {
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
