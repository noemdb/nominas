<?php

namespace App\Http\Livewire\Institution;

trait WithSortingTrait
{

    public $sortBy = '';
    public $sortDirection = 'asc';

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


}

?>
