<?php

namespace App\Http\Livewire\Institution;

trait WithSortingTrait
{
    public $search = '';
    public $sortBy = '';
    public $sortDirection = 'asc';
    public $paginate = 10;
    public $paginate_list = ['1','10','25','50','100','500','1000'];

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortBy === $field
            ? $this->reverseSort()
            : 'asc';

        $this->sortBy = $field;
    }

    public function reverseSort()
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }

    public function getSortBy ($sortBy,$sortDirection)
    {
        $this->sortBy = $sortBy;
        $this->sortDirection = ($sortDirection == 'asc') ? 'desc':'asc';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function cleanSearch()
    {
        $this->search = null;
    }
}

?>
