<?php

namespace App\Http\Livewire\PayrollAccounting\Incentive;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Payroll\Incentive;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IndexComponent extends Component
{
    // use IncentiveRules;
    use Actions;
    use WithSortingTrait;
    use WithPagination;
    use PaginateTrait;

    public Incentive $incentive;
    public $list_comment;
    // public $list_institution;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->incentive = new Incentive;
        // $this->list_institution = Institution::list_institution();
        $this->list_comment = Incentive::COLUMN_COMMENTS;
    }
    public function render()
    {
        $search = $this->search;
        $incentives = Incentive::select('incentives.*', 'employees.name as employee_name')->join('employees', 'employees.id', '=', 'incentives.employee_id');

        $incentives = (!empty($search)) ? $incentives->Where(
            function ($query) use ($search) {
                $query->orWhere('incentives.type', 'like', '%' . $search . '%');
                $query->orWhere('incentives.description', 'like', '%' . $search . '%');
                $query->orWhere('incentives.amount', 'like', '%' . $search . '%');
                $query->orWhere('incentives.frequency', 'like', '%' . $search . '%');
                $query->orWhere('incentives.date', 'like', '%' . $search . '%');
                $query->orWhere('employees.name', 'like', '%' . $search . '%');
                $query->orWhere('employees.id', 'like', '%' . $search . '%');
            }
        )
            : $incentives;

        $incentives = ($this->sortBy && $this->sortDirection) ? $incentives->orderBy($this->sortBy, $this->sortDirection) : $incentives;

        $incentives = $incentives->paginate($this->paginate);
        return view('livewire.payroll-accounting.incentive.index-component', ['incentives' => $incentives]);
    }
}
