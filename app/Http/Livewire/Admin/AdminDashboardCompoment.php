<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminDashboardCompoment extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-dashboard-compoment')->layout('admlayouts.base');
    }

    public function goToCategories()
    {
        return redirect()->route('admin.categories');
    }
}
