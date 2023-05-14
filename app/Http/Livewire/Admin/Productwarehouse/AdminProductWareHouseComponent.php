<?php

namespace App\Http\Livewire\Admin\Productwarehouse;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class AdminProductWareHouseComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::paginate(10);
        
        return view('livewire.admin.productwarehouse.admin-product-ware-house-component',['products'=>$products])->layout('admlayouts.base');
    }
}
