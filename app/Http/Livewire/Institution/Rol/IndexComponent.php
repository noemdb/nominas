<?php

namespace App\Http\Livewire\Institution\Rol;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Institution\Rol;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IndexComponent extends Component
{
    // use RolRules;
    use Actions;
    use WithSortingTrait;
    use WithPagination;
    use PaginateTrait;

    public Rol $rol;
    public $list_comment;
    public $list_areas;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->rol = new Rol;
        $this->list_comment = Rol::COLUMN_COMMENTS;
        $this->list_areas = Rol::list_area();
    }

    public function render()
    {
        $search = $this->search;
        $rols = Rol::select('rols.*');

        $rols = (!empty($search)) ? $rols->Where(
            function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('description', 'like', '%' . $search . '%');
            }
        )
            : $rols;

        $rols = ($this->sortBy && $this->sortDirection) ? $rols->orderBy($this->sortBy, $this->sortDirection) : $rols;

        $rols = $rols->paginate($this->paginate);
        return view('livewire.institution.rol.index-component', ['rols' => $rols]);
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
        $this->rol = Rol::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->rol->save();
        $this->rol = new Rol;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->rol = Rol::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $rol = Rol::findOrFail($id);

        $rol->delete();
        $this->rol = new Rol;

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
        $this->rol = new Rol;
    }

    public function deleteQuestion($id)
    {
        $this->rol = Rol::findOrFail($id);

        if ($this->rol->status_delete) {
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
