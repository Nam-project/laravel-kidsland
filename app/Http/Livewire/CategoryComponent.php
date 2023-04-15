<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use Cart;

class CategoryComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pagesize;
    public $category_slug;

    public function mount($category_slug)
    {
        $this->sorting = 'default';
        $this->pagesize = 15;
        $this->category_slug = $category_slug;
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
        
        $category = Category::where('slug',$this->category_slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;
        // $products = Product::whereHas('subcategory', function ($query) use ($category_id) {
        //     $query->where('category_id', $category_id);
        // })->get();

        if ($this->sorting == 'price') {
            $product = Product::whereHas('subcategory', function ($query) use ($category_id) 
            {
                $query->where('category_id', $category_id);
            })->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        } else if ($this->sorting == 'price_desc') {
            $product = Product::whereHas('subcategory', function ($query) use ($category_id) 
            {
                $query->where('category_id', $category_id);
            })->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        } else if ($this->sorting == 'orderby_new') {
            $product = Product::whereHas('subcategory', function ($query) use ($category_id) 
            {
                $query->where('category_id', $category_id);
            })->orderBy('created_at', 'DESC')->paginate($this->pagesize);
        } else if ($this->sorting == 'orderby_old') {
            $product = Product::whereHas('subcategory', function ($query) use ($category_id) 
            {
                $query->where('category_id', $category_id);
            })->orderBy('created_at', 'ASC')->paginate($this->pagesize);
        } else {
            $product = Product::whereHas('subcategory', function ($query) use ($category_id) 
            {
                $query->where('category_id', $category_id);
            })->paginate($this->pagesize);
        }
        return view('livewire.category-component', ['products'=>$product])->layout("layouts.base");
    }
}
