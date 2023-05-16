<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavigationMenuTwo extends Component
{
    public string $header;

    public function render()
    {
        return view('livewire.navigation-menu-two');
    }
}
