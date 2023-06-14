<?php

namespace App\Http\Livewire\Institution\Autority;
// touch 'app/Http/Livewire/Institution/AutorityRules.php'
// touch 'app/Http/Livewire/Common/WithSortingTrait.php'

use App\Models\Institution\Authority;
use Livewire\Component;

class IndexComponent extends Component
{
    public $list_comment;
    public $showModal = false;

    public function mount() {
        $this->list_comment = Authority::COLUMN_COMMENTS;
    }

    public function render()
    {
        $authorities = Authority::all();
        return view('livewire.institution.autority.index-component', ['authorities' => $authorities]);
    }
}
