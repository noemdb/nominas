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
    // use BankRules;
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
}
