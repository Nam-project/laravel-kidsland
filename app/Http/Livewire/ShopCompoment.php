<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopCompoment extends Component
{
    use WithPagination;

    public $sorting;
    public $pagesize;

    public function mount()
    {
        $this->sorting = 'default';
        $this->pagesize = 15;
    }

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
        if ($this->sorting == 'price') {
            $product = Product::orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        } else if ($this->sorting == 'price_desc') {
            $product = Product::orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        } else if ($this->sorting == 'orderby_new') {
            $product = Product::orderBy('created_at', 'DESC')->paginate($this->pagesize);
        } else if ($this->sorting == 'orderby_old') {
            $product = Product::orderBy('created_at', 'ASC')->paginate($this->pagesize);
        } else {
            $product = Product::paginate($this->pagesize);
        }
        return view('livewire.shop-compoment', ['products'=>$product])->layout("layouts.base");
    }
}
