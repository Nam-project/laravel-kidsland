<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopCompoment extends Component
{
    use WithPagination;

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        // session()->flash('success_message', 'Item added in Cart');
        $count_cart = Cart::count();
        toastr()->success('', 'Thêm vào giỏ hàng thành công');
        return redirect()->back();
    }

    public function render()
    {
        $product = Product::paginate(18);
        return view('livewire.shop-compoment', ['products'=>$product])->layout("layouts.base");
    }
}
