<?php

namespace App\Http\Livewire\Institution\Autority;
// touch 'app/Http/Livewire/Institution/AutorityRules.php'
// touch 'app/Http/Livewire/Common/WithSortingTrait.php'

use App\Http\Livewire\Institution\Autority\AuthorityRules;
use App\Models\Institution\Authority;
use Livewire\Component;

class IndexComponent extends Component
{
    use AuthorityRules;

    public Authority $authority;
    public $list_comment;
    public $showModal = false;

    public function mount()
    {
        $this->authority = new Authority;
        $this->list_comment = Authority::COLUMN_COMMENTS;
    }

    public function render()
    {
        $authorities = Authority::all();
        return view('livewire.institution.autority.index-component', ['authorities' => $authorities]);
    }

    public function save()
    {
        $this->validate();
        $this->authority->save();
        $this->authority = new Authority;
    }
}
