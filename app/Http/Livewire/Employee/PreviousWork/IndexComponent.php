<?php

namespace App\Http\Livewire\Employee\PreviousWork;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Employee\PreviousWork;
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

    public PreviousWork $previousWork;
    public $list_comment;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;


    public function mount()
    {
        $this->previousWork = new PreviousWork;
        $this->list_comment = PreviousWork::COLUMN_COMMENTS;
    }

    public function render()
    {
        $search = $this->search;
        $previousWorks = PreviousWork::select('previous_works.*');

        $previousWorks = (!empty($search)) ? $previousWorks->Where(
            function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('description', 'like', '%' . $search . '%');
            }
        )
            : $previousWorks;

        $previousWorks = ($this->sortBy && $this->sortDirection) ? $previousWorks->orderBy($this->sortBy, $this->sortDirection) : $previousWorks;

        $previousWorks = $previousWorks->paginate($this->paginate);
        return view('livewire.employee.previous-work.index-component', ['previousWorks' => $previousWorks]);
    }
}
