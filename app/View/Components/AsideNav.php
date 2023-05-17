<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AsideNav extends Component
{
    public $links;
    public $isNested;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($links, $isNested = false)
    {
        $this->links = $links;
        $this->isNested = $isNested;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.aside-nav');
    }
}
