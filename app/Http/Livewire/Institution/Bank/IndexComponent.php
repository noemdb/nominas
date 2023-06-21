<?php

namespace App\Http\Livewire\Institution\Bank;

use App\Http\Livewire\Common\PaginateTrait;
use App\Http\Livewire\Common\WithSortingTrait;
use App\Models\Institution\Bank;
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

    public Bank $bank;
    public $list_comment;
    public $list_institution;
    public $list_account_type;
    public $showModal = false;
    public $modeCreate = false;
    public $modeEdit = false;
    public $modeShow = false;

    public function mount()
    {
        $this->bank = new Bank;
        $this->list_institution = Bank::list_institution();
        $this->list_comment = Bank::COLUMN_COMMENTS;
        $this->list_account_type = Bank::list_account_type();
    }

    public function render()
    {
        $search = $this->search;
        $banks = Bank::select('banks.*');

        $banks = (!empty($search)) ? $banks->Where(
            function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('description', 'like', '%' . $search . '%');
            }
        )
            : $banks;

        $banks = ($this->sortBy && $this->sortDirection) ? $banks->orderBy($this->sortBy, $this->sortDirection) : $banks;

        $banks = $banks->paginate($this->paginate);
        return view('livewire.institution.bank.index-component', ['banks' => $banks]);
    }
}
