<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductDetails;
use Carbon\Carbon;
use App\Models\SubCategory;
use App\Models\Brand;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $image;
    public $description;
    public $regular_price;
    public $sale_price;
    public $quantity;
    public $SKU;
    public $featured;
    public $stock_status;
    public $subcategory_id;
    public $brand_id;
    public $size;
    public $suitable_age;
    public $user_manual;
    public $preserve;
    public $images;

    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
        $this->quantity = 0;
        $this->sale_price = 0;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:products',
            'slug' => 'required|unique:products',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'quantity' => 'numeric',
            'SKU' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg',
            'subcategory_id' => 'required',
            'brand_id' => 'required'
        ]);
    }

    public function addProduct()
    {
        $this->validate([
            'name' => 'required|unique:products',
            'slug' => 'required|unique:products',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'quantity' => 'numeric',
            'SKU' => 'required',
            'image' => 'required|mimes:jpeg,png',
            'subcategory_id' => 'required',
            'brand_id' => 'required'
        ]);

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->quantity = $this->quantity;
        $product->SKU = $this->SKU;
        $product->featured = $this->featured;
        $product->stock_status = $this->stock_status;
        $product->subcategory_id = $this->subcategory_id;
        $product->brand_id = $this->brand_id;
        $product->stock_status = $this->stock_status;

        if ($this->image) {
            $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
            $this->image->storeAs('products', $imageName);
            $product->image = $imageName;
            // Tiếp tục xử lý lưu ảnh và tạo bản ghi
        }else {
            $product->image = NULL;
        }

        if ($this->images) {
            $imagesname = '';
            foreach($this->images as $key => $image) {
                $imgName = Carbon::now()->timestamp.$key.'.'.$image->extension();
                $image->storeAs('products',$imgName);
                $imagesname = $imagesname . ',' . $imgName;
            }
            $product->images = $imagesname;
        }

        $product->save();
        session()->flash('massage', 'Tạo sản phẩm thành công');
        $detailproduct = new ProductDetails();
        if (isset($product->id)) {
            $detailproduct->size = $this->size;
            $detailproduct->suitable_age = $this->suitable_age;
            $detailproduct->user_manual = $this->user_manual;
            $detailproduct->preserve = $this->preserve;
            $detailproduct->product_id	 = $product->id;
        
            $detailproduct->save();
        }

        return redirect()->route('admin.addproduct');
    }

    public function render()
    {
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('livewire.admin.products.admin-add-product-component',['subcategories'=>$subcategories, 'brands'=>$brands])->layout('admlayouts.base');
    }
}
