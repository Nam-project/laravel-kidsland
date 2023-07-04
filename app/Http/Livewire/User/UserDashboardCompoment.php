<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserDashboardCompoment extends Component
{
    public $name;

    public function mount()
    {
        $this->name = Auth::user()->name;
    }

    public function render()
    {

        return view('livewire.user.user-dashboard-compoment')->layout('layouts.base');
    }
}
