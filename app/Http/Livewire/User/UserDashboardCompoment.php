<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class UserDashboardCompoment extends Component
{
    public function render()
    {
        return view('livewire.user.user-dashboard-compoment')->layout('layouts.base');
    }
}
