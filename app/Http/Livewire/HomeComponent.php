<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HomeSlider;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;
use Cart;
use Illuminate\Support\Facades\Auth;

class HomeComponent extends Component
{
    use WithPagination;
    public $per_page = 18;

    public function loadMore()
    {
        $this->per_page += 18;
    }

    public function mount()
    {
        if (Auth::check()) {
            Cart::instance('cart')->restore(Auth::user()->email);
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->restore(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        // session()->flash('success_message', 'Item added in Cart');
        $this->emitTo('cart-count-component','refreshComponent');
        toastr()->success('Bạn đã thêm sản phẩm vào giỏ hàng thành công!', 'Thành công!', ['closeButton' => true]);
        return redirect()->back();
    }

    public function storeBuy($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name,1, $product_price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component','refreshComponent');
        return redirect()->route('product.cart');
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name,1, $product_price)->associate('App\Models\Product');
    }

    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                return;
            }
        }
    }

    // public function searchBrand($brand_id)
    // {
    //     session()->put('brand', $brand_id);
    // }

    public function render()
    {
        $sliders = HomeSlider::where('status', 1)->get();
        $category = Category::all();
        $products = Product::latest()->paginate($this->per_page);
        $saleProducts =Product::where('sale_price','>',0)->inRandomOrder()->get()->take(6);
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.home-component', ['sliders'=>$sliders, 'category'=>$category, 'products'=>$products,'saleProducts'=>$saleProducts])->layout('layouts.base');
    }
}
