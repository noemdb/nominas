<?php

namespace App\Livewire;

use Livewire\Component;

class LoadingIndicator extends Component
{
    public $isLoaded = false;

    public function setLoaded()
    {
        $this->isLoaded = true;
        $this->dispatch('component-loaded');
    }

    public function render()
    {
        return view('livewire.loading-indicator');
    }
}
