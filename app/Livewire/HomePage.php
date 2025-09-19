<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

//#[Layout('layouts.customer')]
class HomePage extends Component
{
    public function render()
    {
       return view('livewire.home-page')->layout('layouts.app'); // ✅ Correct;

    }
}
