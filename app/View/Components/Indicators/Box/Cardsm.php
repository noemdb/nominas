<?php

namespace App\View\Components\Indicators\Box;

use Illuminate\View\Component;

class Cardsm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $header = null,
        public ?string $count = null,
        public ?string $description = null,
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
        return view('components.indicators.box.cardsm');
    }
}

/*
header
count
description
*/
