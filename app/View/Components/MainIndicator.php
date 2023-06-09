<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MainIndicator extends Component
{
    public $title;
    public $value;
    public $unit;
    public $isPositive;
    public $comparativePercentageValue;
    public $comparativePercentageTimePeriod;
    public $description;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $value, $unit, $comparativePercentageValue, $comparativePercentageTimePeriod, $description = "")
    {
        $this->title = $title;
        $this->value = $value;
        $this->unit = $unit;
        $this->isPositive = intval($value, 10) > 0;
        $this->comparativePercentageValue = $comparativePercentageValue;
        $this->comparativePercentageTimePeriod = $comparativePercentageTimePeriod;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.main-indicator');
    }
}
