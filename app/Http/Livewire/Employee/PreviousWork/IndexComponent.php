<?php

namespace App\Http\Livewire\Employee\PreviousWork;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Employee;
use App\Models\Employee\PreviousWork;
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

    public PreviousWork $previous_works;
    public $list_comment;
    public $list_employee;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;


    public function mount()
    {
        $this->previous_works = new PreviousWork;
        $this->list_comment = PreviousWork::COLUMN_COMMENTS;
        $this->list_employee = Employee::list_employee();
    }

    public function render()
    {
        $search = $this->search;
        $previousWorks = PreviousWork::select('previous_works.*')->join('employees', 'employees.id', '=', 'previous_works.employee_id');

        $previousWorks = (!empty($search)) ? $previousWorks->Where(
            function ($query) use ($search) {
                $query->orWhere('employees.ci', 'like', '%' . $search . '%');
                $query->orWhere('employees.name', 'like', '%' . $search . '%');
                $query->orWhere('previous_works.company_name', 'like', '%' . $search . '%');
                $query->orWhere('previous_works.position', 'like', '%' . $search . '%');
            }
        )
            : $previousWorks;

        $previousWorks = ($this->sortBy && $this->sortDirection) ? $previousWorks->orderBy($this->sortBy, $this->sortDirection) : $previousWorks;

        $previousWorks = $previousWorks->paginate($this->paginate);
        return view('livewire.employee.previous-work.index-component', ['previousWorks' => $previousWorks]);
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
        $this->previous_works = PreviousWork::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->previous_works->save();
        $this->previous_works = new PreviousWork;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->previous_works = PreviousWork::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $previous_works = PreviousWork::findOrFail($id);

        $previous_works->delete();
        $this->previous_works = new PreviousWork;

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
        $this->previous_works = new PreviousWork;
    }

    public function deleteQuestion($id)
    {
        $this->previous_works = PreviousWork::findOrFail($id);

        if ($this->previous_works->status_delete) {
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
