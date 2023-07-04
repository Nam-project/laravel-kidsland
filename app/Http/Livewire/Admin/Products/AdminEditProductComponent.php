<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductDetails;
use Carbon\Carbon;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Brand;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
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
    public $newimage;
    public $product_id;

    public $images;
    public $newimages;

    public $category_id;


    public function mount($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $productdetail = ProductDetails::where('product_id', $product->id)->first();

        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->image = $product->image;
        $this->images = explode(",",$product->images);
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->quantity = $product->quantity;
        $this->SKU = $product->SKU;
        $this->featured = $product->featured;
        $this->stock_status = $product->stock_status;
        $this->subcategory_id = $product->subcategory_id;
        $this->brand_id = $product->brand_id;
        $this->size = $productdetail->size;
        $this->suitable_age = $productdetail->suitable_age;
        $this->user_manual = $productdetail->user_manual;
        $this->preserve = $productdetail->preserve;
        $this->product_id = $product->id;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'quantity' => 'numeric',
            'SKU' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required'
        ]);

        if ($this->newimage) {
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:jpeg,png',
            ]);
        }
    }

    public function updateProduct()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'numeric',
            'quantity' => 'numeric',
            'SKU' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required'
        ]);

        if ($this->newimage) {
            $this->validate([
                'newimage' => 'required|mimes:jpeg,png',
            ]);
        }

        $product = Product::find($this->product_id);
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

        if ($this->newimage) 
        {
            if($this->image) {
                $imagePath = 'assets/imgs/products/' . $this->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $imageName = Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->newimage->storeAs('products', $imageName);
            $product->image = $imageName;
            // Tiếp tục xử lý lưu ảnh và tạo bản ghi
        }

        if($this->newimages)
        {
            if ($product->images) {
                $images = explode(",",$product->images);
                foreach ($images as $img) {
                    if ($img) {
                        unlink('assets/imgs/products/'.$img);
                    }
                }
            }

            $imagesname = '';
            foreach ($this->newimages as $key=>$img) {
                $imgName = Carbon::now()->timestamp.$key.'.'.$img->extension();
                $img->storeAs('products', $imgName);
                $imagesname = $imagesname.','.$imgName;
            }
            $product->images = $imagesname;
        }

        $product->save();
        session()->flash('massage', 'Cập nhật sản phẩm thành công');
        $detailproduct = ProductDetails::where('product_id', $this->product_id)->first();

        $detailproduct->size = $this->size;
        $detailproduct->suitable_age = $this->suitable_age;
        $detailproduct->user_manual = $this->user_manual;
        $detailproduct->preserve = $this->preserve;
        
        $detailproduct->save();

        return redirect()->route('admin.products');
    }

    public function render()
    {
        $category = Category::all();
        $subcategories = SubCategory::all();
        if ($this->category_id) {
            $subcategories = SubCategory::where('category_id',$this->category_id)->get();
        }
        $brands = Brand::all();
        return view('livewire.admin.products.admin-edit-product-component',['category'=>$category,'subcategories'=>$subcategories, 'brands'=>$brands])->layout('admlayouts.base');
    }
}
