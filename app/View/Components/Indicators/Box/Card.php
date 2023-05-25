<?php

namespace App\View\Components\Indicators\Box;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $description;
    public $count;
    public $porc;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$description,$count,$porc)
    {
        $this->title = $title;
        $this->description = $description;
        $this->count = $count;
        $this->porc = $porc;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.indicators.box.card');
    }
}
