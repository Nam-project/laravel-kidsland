<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductDetails;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $slug;
    public $qty;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name,$this->qty, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function increaseQuantity() {
        $this->qty++;
    }

    public function decreseQuantity() {
        if($this->qty > 1) {
            $this->qty--;
        }
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $productdetail = ProductDetails::where('product_id',$product->id)->first();
        $related_products = Product::where('subcategory_id', $product->subcategory_id)->limit(5)->get();
        return view('livewire.details-component', ['product'=>$product, 'related_products'=>$related_products, 'productdetail'=>$productdetail])->layout('layouts.base');
    }
}
