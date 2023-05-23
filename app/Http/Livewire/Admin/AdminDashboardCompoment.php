<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminDashboardCompoment extends Component
{
    public $data = [500, 700, 900, 300, 600, 400];

    public function updateData()
    {
        // Cập nhật dữ liệu biểu đồ
        $this->data = [200, 400, 600, 800, 1000, 1200];
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard-compoment')->layout('admlayouts.base');
    }

    public function goToCategories()
    {
        return redirect()->route('admin.categories');
    }
}
