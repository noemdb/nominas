<?php

namespace App\View\Components\Elements\Crud;

use Illuminate\View\Component;

class sortBy extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $field = null,
        public ?string $sortBy = null,
        public ?string $sortDirection = null,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.elements.crud.sort-by');
    }
}
