<?php

namespace App\Http\Livewire\Common;

trait PaginateTrait
{
    public $paginate = 10;
    public $paginate_list = ['1','10','25','50','100','500','1000'];
    public function updatingSearch()
    {
        $this->resetPage();
    }
}

?>
