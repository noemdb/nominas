<?php

namespace App\View\Components\Skeleton;

use Illuminate\View\Component;

class Table extends Component
{
    public $rows;

    public function __construct($rows = 5)
    {
        $this->rows = $rows;
    }

    public function render()
    {
        return view('components.skeleton.table');
    }
}
