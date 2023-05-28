<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\SubCategory;
use Cart;

class CategoryComponent extends Component
{
    use WithPagination;

    public $sorting;
    public $pagesize;
    public $category_slug;

    public $fromPrice;
    public $toPrice;
    public $minPrice;
    public $maxPrice;

    public $subcategory_slug;

    public $brandInputs = [];

    protected $queryString = ['brandInputs'];

    public $showCategory;


    public function mount($category_slug, $subcategory_slug=null)
    {
        if (session()->has('brand')) {
            $this->brandInputs = [session()->get('brand')];
            session()->forget('brand');
        }
        $this->sorting = 'default';
        $this->pagesize = 15;
        $this->category_slug = $category_slug;
        $this->subcategory_slug = $subcategory_slug;
        $this->minPrice = Product::min('regular_price');
        $this->maxPrice = Product::max('regular_price');
        
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        // session()->flash('success_message', 'Item added in Cart');
        $count_cart = Cart::count();
        toastr()->success('', 'Thêm vào giỏ hàng thành công');
        return redirect()->back();
    }

    public function rangePrice()
    {
        $this->minPrice = $this->fromPrice;
        $this->maxPrice = $this->toPrice;
    }

    public function render()
    {
        $categories = Category::all();
        $category = "";
        $category_id = null;
        $subcategory_id = null;
        if ($this->subcategory_slug) {
            $subcategory = SubCategory::where('slug', $this->subcategory_slug)->first();
            $subcategory_id = $subcategory->id;
            $category = $subcategory->category;
        }else {
            $category = Category::where('slug',$this->category_slug)->first();
            $category_id = $category->id;
        }

        // dd($category);
        
        // $products = Product::whereHas('subcategory', function ($query) use ($category_id) {
        //     $query->where('category_id', $category_id);
        // })->get();

        if ($this->sorting == 'price') {
            if ($this->subcategory_slug) {
                $product = Product::where('subcategory_id',$subcategory_id)
                ->when($this->brandInputs, function($q){
                    $q->whereIn('brand_id',$this->brandInputs);
                })
                ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                ->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
            }else {
                $product = Product::whereHas('subcategory', function ($query) use ($category_id) 
                {
                    $query->where('category_id', $category_id);
                })->when($this->brandInputs, function($q){
                    $q->whereIn('brand_id',$this->brandInputs);
                })
                ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                ->orderBy('regular_price', 'DESC')->paginate($this->pagesize);
            }
        } else if ($this->sorting == 'price_desc') {
            if ($this->subcategory_slug) {
                $product = Product::where('subcategory_id',$subcategory_id)
                ->when($this->brandInputs, function($q){
                    $q->whereIn('brand_id',$this->brandInputs);
                })
                ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                ->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
            }else {
                $product = Product::whereHas('subcategory', function ($query) use ($category_id) 
                {
                    $query->where('category_id', $category_id);
                })->when($this->brandInputs, function($q){
                    $q->whereIn('brand_id',$this->brandInputs);
                })
                ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                ->orderBy('regular_price', 'ASC')->paginate($this->pagesize);
                
            }
        } else if ($this->sorting == 'orderby_new') {
            if ($this->subcategory_slug) {
                $product = Product::where('subcategory_id',$subcategory_id)
                ->when($this->brandInputs, function($q){
                    $q->whereIn('brand_id',$this->brandInputs);
                })
                ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                ->orderBy('created_at', 'DESC')->paginate($this->pagesize);
            }else {
                $product = Product::whereHas('subcategory', function ($query) use ($category_id) 
                {
                    $query->where('category_id', $category_id);
                })->when($this->brandInputs, function($q){
                    $q->whereIn('brand_id',$this->brandInputs);
                })
                ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                ->orderBy('created_at', 'DESC')->paginate($this->pagesize);
                
            }
        } else if ($this->sorting == 'orderby_old') {
            if ($this->subcategory_slug) {
                $product = Product::where('subcategory_id',$subcategory_id)
                ->when($this->brandInputs, function($q){
                    $q->whereIn('brand_id',$this->brandInputs);
                })
                ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                ->orderBy('created_at', 'ASC')->paginate($this->pagesize);
            }else {
                $product = Product::whereHas('subcategory', function ($query) use ($category_id) 
                {
                    $query->where('category_id', $category_id);
                })
                ->when($this->brandInputs, function($q){
                    $q->whereIn('brand_id',$this->brandInputs);
                })
                ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                ->orderBy('created_at', 'ASC')->paginate($this->pagesize);
                
            }
        } else {
            if ($this->subcategory_slug) {
                $product = Product::where('subcategory_id',$subcategory_id)
                ->when($this->brandInputs, function($q){
                    $q->whereIn('brand_id',$this->brandInputs);
                })
                ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                ->paginate($this->pagesize);
            }else {
                $product = Product::whereHas('subcategory', function ($query) use ($category_id) 
                {
                    $query->where('category_id', $category_id);
                })->when($this->brandInputs, function($q){
                    $q->whereIn('brand_id',$this->brandInputs);
                })
                ->whereBetween('regular_price', [$this->minPrice, $this->maxPrice])
                ->paginate($this->pagesize);
            }
        }
        return view('livewire.category-component', ['products'=>$product, 'category'=>$category, 'subcategory_slug'=>$this->subcategory_slug, 'categories'=>$categories])->layout("layouts.base");
    }
}
