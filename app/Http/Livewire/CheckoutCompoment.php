<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CheckoutCompoment extends Component
{
    public function render()
    {
        return view('livewire.checkout-compoment')->layout("layouts.base");
    }
}
