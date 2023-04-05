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

    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
        $this->quantity = 0;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function addProduct()
    {
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

        if (isset($this->name) && isset($this->sale_price) && isset($this->SKU)) {
            if (Product::where('name', '=', $this->name)->exists()) {
                // Do something if the record exists
                session()->flash('massage', 'Sản phẩm đã tồn tại');
            } else { 
                if ($this->image) {
                    $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
                    $this->image->storeAs('products', $imageName);
                    $product->image = $imageName;
                    // Tiếp tục xử lý lưu ảnh và tạo bản ghi
                }else {
                    $product->image = NULL;
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
                
            }
        } else {
            session()->flash('massage', 'Vui lòng điền đủ thông tin!');
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
