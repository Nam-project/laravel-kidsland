<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class AdminProductComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.admin.products.admin-product-component',['products'=>$products])->layout('admlayouts.base');
    }
}
