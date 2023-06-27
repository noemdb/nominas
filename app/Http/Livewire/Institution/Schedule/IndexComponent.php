<?php

namespace App\Http\Livewire\Institution\Schedule;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Institution\Schedule;
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

    public Schedule $schedule;
    public $list_comment;
    public $list_areas;
    public $list_type;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->schedule = new Schedule;
        $this->list_comment = Schedule::COLUMN_COMMENTS;
        $this->list_areas = Schedule::list_area();
        $this->list_type = Schedule::list_type();
    }
    public function render()
    {
        $search = $this->search;
        $schedules = Schedule::select('schedules.*');

        $schedules = (!empty($search)) ? $schedules->Where(
            function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('description', 'like', '%' . $search . '%');
            }
        )
            : $schedules;

        $schedules = ($this->sortBy && $this->sortDirection) ? $schedules->orderBy($this->sortBy, $this->sortDirection) : $schedules;

        $schedules = $schedules->paginate($this->paginate);
        return view('livewire.institution.schedule.index-component', ['schedules' => $schedules]);
    }
}
