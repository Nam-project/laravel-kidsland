<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;

class AdminEnterStockComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.products.admin-enter-stock-component')->layout('admlayouts.base');
    }
}
