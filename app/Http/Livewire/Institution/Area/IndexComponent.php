<?php

namespace App\Http\Livewire\Institution\Area;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Institution\Area;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IndexComponent extends Component
{

    // use AreaRules;
    use Actions;
    use WithSortingTrait;
    use WithPagination;
    use PaginateTrait;

    public Area $area;
    public $list_comment;
    public $list_institution;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->area = new Area;
        $this->list_institution = Area::list_institution();
        $this->list_comment = Area::COLUMN_COMMENTS;
    }

    public function render()
    {
        $search = $this->search;
        $areas = Area::select('areas.*');

        $areas = (!empty($search)) ? $areas->Where(
            function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('description', 'like', '%' . $search . '%');
            }
        )
            : $areas;

        $areas = ($this->sortBy && $this->sortDirection) ? $areas->orderBy($this->sortBy, $this->sortDirection) : $areas;

        $areas = $areas->paginate($this->paginate);
        return view('livewire.institution.area.index-component', ['areas' => $areas]);
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
        $this->area = Area::findOrFail($id);
        $this->openModal('show');
    }

    public function save()
    {
        $this->validate();
        $this->area->save();
        $this->area = new Area;
        $this->showModal = false;
        $this->notification()->success(
            $title = 'Felicitaciones!',
            $description = 'Registro guardado exitósamente.'
        );
    }

    public function edit($id)
    {
        $this->area = Area::findOrFail($id);
        $this->openModal('edit');
    }

    public function delete($id)
    {
        $area = Area::findOrFail($id);

        $area->delete();
        $this->area = new Area;

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
        $this->area = new Area;
    }

    public function deleteQuestion($id)
    {
        $this->area = Area::findOrFail($id);

        if ($this->area->status_delete) {
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
