<?php

namespace App\Http\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Category;

class AdminEditBrandsComponent extends Component
{
    public $name;
    public $origin;
    public $brand_id;
    public $category_id;

    public function mount($brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::where('id', $brand_id)->first();
        $this->name = $brand->name;
        $this->origin = $brand->origin;
        $this->brand_id = $brand->id;
        $this->category_id = $brand->category_id;
    }

    public function updateBrand()
    {
        $brand = Brand::find($this->brand_id);
        $brand->name = $this->name;
        $brand->origin = $this->origin;
        $brand->category_id = $this->category_id;
        $brand->save();
        session()->flash('massage', 'Cập nhật thương hiệu thành công!');
        if(session('tasks_url')){
            return redirect(session('tasks_url'));
        }
        
        return redirect()->route('admin.brands');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.brand.admin-edit-brands-component',['categories'=>$categories])->layout('admlayouts.base');
    }
}
