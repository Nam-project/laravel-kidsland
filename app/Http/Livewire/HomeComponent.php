<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HomeSlider;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;
use Cart;

class HomeComponent extends Component
{
    use WithPagination;
    public $per_page = 18;

    public function loadMore()
    {
        $this->per_page += 18;
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
        $sliders = HomeSlider::where('status', 1)->get();
        $category = Category::all();
        $products = Product::latest()->paginate($this->per_page);
        $saleProducts =Product::where('sale_price','>',0)->inRandomOrder()->get()->take(6);
        return view('livewire.home-component', ['sliders'=>$sliders, 'category'=>$category, 'products'=>$products,'saleProducts'=>$saleProducts])->layout('layouts.base');
    }
}
