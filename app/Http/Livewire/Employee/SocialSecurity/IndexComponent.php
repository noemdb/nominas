<?php

namespace App\Http\Livewire\Employee\SocialSecurity;
//livewire.employee.social-security.index-component

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Employee;
use App\Models\Employee\SocialSecurity;
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

    public SocialSecurity $social_security;
    public $list_comment;
    public $list_employee;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->social_security = new SocialSecurity;
        $this->list_comment = SocialSecurity::COLUMN_COMMENTS;
        $this->list_employee = Employee::list_employee();
    }

    public function render()
    {
        $search = $this->search;
        $social_securities = SocialSecurity::select('social_securities.*')->join('employees', 'employees.id', '=', 'social_securities.employee_id');

        $social_securities = (!empty($search)) ? $social_securities->Where(
            function ($query) use ($search) {
                $query->orWhere('employees.ci', 'like', '%' . $search . '%');
                $query->orWhere('employees.name', 'like', '%' . $search . '%');
                $query->orWhere('social_securities.company_name', 'like', '%' . $search . '%');
                $query->orWhere('social_securities.position', 'like', '%' . $search . '%');
            }
        )
            : $social_securities;

        $social_securities = ($this->sortBy && $this->sortDirection) ? $social_securities->orderBy($this->sortBy, $this->sortDirection) : $social_securities;

        $social_securities = $social_securities->paginate($this->paginate);
        return view('livewire.employee.social-security.index-component', ['social_securities' => $social_securities]);
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
        $this->social_security = SocialSecurity::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->social_security->save();
        $this->social_security = new SocialSecurity;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->social_security = SocialSecurity::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $social_security = SocialSecurity::findOrFail($id);

        $social_security->delete();
        $this->social_security = new SocialSecurity;

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
        $this->social_security = new SocialSecurity;
    }

    public function deleteQuestion($id)
    {
        $this->social_security = SocialSecurity::findOrFail($id);

        if ($this->social_security->status_delete) {
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
