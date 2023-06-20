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

    // use AuthorityRules;
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
}
