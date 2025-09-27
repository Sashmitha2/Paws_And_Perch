<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth; // ✅ Correct


//#[Layout('layouts.customer')]
class HomePage extends Component
{

    public function mount()
    {
        if (!Auth::check() || Auth::user()->role !== 'Customer') {
            abort(403, 'Unauthorized access');
        }
    }

    public function render()
    {
       return view('livewire.home-page')->layout('layouts.app'); // ✅ Correct;

    }
}
