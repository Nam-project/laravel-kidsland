<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class SearchComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pagesize;

    public $search;

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
        $this->fill(request()->only('search'));
        $this->minPrice = Product::min('regular_price');
        $this->maxPrice = Product::max('regular_price');
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

    public function rangePrice()
    {
        $this->minPrice = $this->fromPrice;
        $this->maxPrice = $this->toPrice;
    }

    public function render()
    {
        $categories = Category::all();
        switch ($this->sorting) {
            case 'price':
                    if ($this->categoryInputs) {
                        $product = Product::where('name','like','%'.$this->search.'%')
                            ->whereHas('subcategory.category', function ($query) {
                                $query->whereIn('id', $this->categoryInputs);
                            })->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                            ->orderBy('regular_price', 'DESC')
                        ->paginate($this->pagesize);
                    }else {
                        $product = Product::where('name','like','%'.$this->search.'%')
                        ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                        ->orderBy('regular_price', 'DESC')
                        ->paginate($this->pagesize);
                    }
                break;
            case 'price_desc':
                if ($this->categoryInputs) {
                    $product = Product::where('name','like','%'.$this->search.'%')
                        ->whereHas('subcategory.category', function ($query) {
                            $query->whereIn('id', $this->categoryInputs);
                        })->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                        ->orderBy('regular_price', 'ASC')
                    ->paginate($this->pagesize);
                }else {
                    $product = Product::where('name','like','%'.$this->search.'%')
                    ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                    ->orderBy('regular_price', 'ASC')
                    ->paginate($this->pagesize);
                }
                break;
            case 'orderby_new':
                if ($this->categoryInputs) {
                    $product = Product::where('name','like','%'.$this->search.'%')
                        ->whereHas('subcategory.category', function ($query) {
                            $query->whereIn('id', $this->categoryInputs);
                        })->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                        ->orderBy('created_at', 'DESC')
                    ->paginate($this->pagesize);
                }else {
                    $product = Product::where('name','like','%'.$this->search.'%')
                    ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                    ->orderBy('created_at', 'DESC')
                    ->paginate($this->pagesize);
                }
                break;
            case 'orderby_old':
                if ($this->categoryInputs) {
                    $product = Product::where('name','like','%'.$this->search.'%')
                        ->whereHas('subcategory.category', function ($query) {
                            $query->whereIn('id', $this->categoryInputs);
                        })->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                        ->orderBy('created_at', 'ASC')
                    ->paginate($this->pagesize);
                }else {
                    $product = Product::where('name','like','%'.$this->search.'%')
                    ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                    ->orderBy('created_at', 'ASC')
                    ->paginate($this->pagesize);
                }
                break;
            default:
                    if ($this->categoryInputs) {
                    $product = Product::where('name','like','%'.$this->search.'%')
                        ->whereHas('subcategory.category', function ($query) {
                            $query->whereIn('id', $this->categoryInputs);
                        })->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                    ->paginate($this->pagesize);
                    }else {
                        $product = Product::where('name','like','%'.$this->search.'%')
                        ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                        ->paginate($this->pagesize);
                    }
                break;
        }
        // if ($this->sorting == 'price') {
        //     $product = Product::where('name','like','%'.$this->search.'%')->orderBy('regular_price', 'DESC')
        //         ->whereHas('subcategory.category', function ($query) {
        //             $query->whereIn('id', $this->categoryInputs);
        //         })->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
        //     ->paginate($this->pagesize);
        // } else if ($this->sorting == 'price_desc') {
        //     $product = Product::where('name','like','%'.$this->search.'%')->orderBy('regular_price', 'ASC')
        //         ->whereHas('subcategory.category', function ($query) {
        //             $query->whereIn('id', $this->categoryInputs);
        //         })->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
        //     ->paginate($this->pagesize);
        // } else if ($this->sorting == 'orderby_new') {
        //     $product = Product::where('name','like','%'.$this->search.'%')->orderBy('created_at', 'DESC')
        //         ->whereHas('subcategory.category', function ($query) {
        //             $query->whereIn('id', $this->categoryInputs);
        //         })->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
        //     ->paginate($this->pagesize);
        // } else if ($this->sorting == 'orderby_old') {
        //     $product = Product::where('name','like','%'.$this->search.'%')->orderBy('created_at', 'ASC')
        //         ->whereHas('subcategory.category', function ($query) {
        //             $query->whereIn('id', $this->categoryInputs);
        //         })->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
        //     ->paginate($this->pagesize);
        // } else {
        //     if ($this->categoryInputs) {
        //     $product = Product::where('name','like','%'.$this->search.'%')
        //         ->whereHas('subcategory.category', function ($query) {
        //             $query->whereIn('id', $this->categoryInputs);
        //         })->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
        //     ->paginate($this->pagesize);
        //     }else {
        //         $product = Product::where('name','like','%'.$this->search.'%')
        //         ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
        //         ->paginate($this->pagesize);
        //     }
        // }
        return view('livewire.search-component', ['products'=>$product,'categories'=>$categories])->layout("layouts.base");
    }
}
