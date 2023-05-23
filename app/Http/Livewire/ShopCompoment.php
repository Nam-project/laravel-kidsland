<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use Illuminate\Support\Facades\Auth;

class ShopCompoment extends Component
{
    use WithPagination;

    public $sorting;
    public $pagesize;

    public $fromPrice;
    public $toPrice;
    public $minPrice;
    public $maxPrice;

    public $categoryInputs = [];

    protected $queryString = ['categoryInputs'];

    public function mount()
    {
        $this->sorting = 'default';
        $this->pagesize = 15;
        if (Auth::check()) {
            Cart::instance('cart')->restore(Auth::user()->email);
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->restore(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
    }

    public function rangePrice()
    {
        $this->minPrice = $this->fromPrice;
        $this->maxPrice = $this->toPrice;
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

    public function render()
    {
        if ($this->sorting == 'price') {
            if ($this->categoryInputs) {
                $product = Product::whereHas('subcategory.category', function ($query) {
                    $query->whereIn('id', $this->categoryInputs);
                })
                ->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
            }else {
                $product = Product::orderBy('regular_price', 'DESC')->paginate($this->pagesize);
            }
        } else if ($this->sorting == 'price_desc') {
            if ($this->categoryInputs) {
                $product = Product::whereHas('subcategory.category', function ($query) {
                    $query->whereIn('id', $this->categoryInputs);
                })
                ->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
            } else {
                $product = Product::orderBy('regular_price', 'ASC')->paginate($this->pagesize);
            }
        } else if ($this->sorting == 'orderby_new') {
            if ($this->categoryInputs) {
                $product = Product::whereHas('subcategory.category', function ($query) {
                    $query->whereIn('id', $this->categoryInputs);
                })
                ->orderBy('created_at', 'DESC')->paginate($this->pagesize);
            } else {
                $product = Product::orderBy('created_at', 'DESC')->paginate($this->pagesize);
            }
        } else if ($this->sorting == 'orderby_old') {
            if ($this->categoryInputs) {
                $product = Product::whereHas('subcategory.category', function ($query) {
                    $query->whereIn('id', $this->categoryInputs);
                })
                ->orderBy('created_at', 'ASC')->paginate($this->pagesize);
            } else {
                $product = Product::orderBy('created_at', 'ASC')->paginate($this->pagesize);
            }
        } else {
            if ($this->categoryInputs) {
                $product = Product::whereHas('subcategory.category', function ($query) {
                    $query->whereIn('id', $this->categoryInputs);
                })
                ->paginate($this->pagesize);
            }else {
                $product = Product::paginate($this->pagesize);
            }
        }

        $categories = Category::all();

        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wishlist')->store(Auth::user()->email);
        }

        return view('livewire.shop-compoment', ['products'=>$product,'categories'=>$categories])->layout("layouts.base");
    }
}
