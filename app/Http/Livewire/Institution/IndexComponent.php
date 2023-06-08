<?php

namespace App\Http\Livewire\Institution;

use App\Models\Institution;
use Livewire\Component;

class IndexComponent extends Component
{
    public $showModal=false;
    public $list_comment;
    public $list_type;
    public $list_legal_status;

    public function mount()
    {
        $this->list_type = Institution::list_type();
        $this->list_legal_status = Institution::list_legal_status();
        $this->list_comment = Institution::COLUMN_COMMENTS;
    }

    public function render()
    {
        $institutions = Institution::all();
        return view('livewire.institution.index-component',[
            'institutions' => $institutions
        ]);
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
