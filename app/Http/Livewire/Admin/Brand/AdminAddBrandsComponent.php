<?php

namespace App\Http\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use App\Models\Category;

class AdminAddBrandsComponent extends Component
{
    public $name;
    public $origin;
    public $category_id;

    public function storeBrand()
    {
        $brand = new Brand();
        $brand->name = $this->name;
        $brand->origin = $this->origin;
        $brand->category_id = $this->category_id;
        if (Brand::where('name', '=', $this->name)->exists()) {
            // Do something if the record exists
            session()->flash('error', 'Thương hiệu đã tồn tại');
        } else {
            if($this->name && $this->origin && $this->category_id)
            {
                $brand->save();
                session()->flash('massage', 'Tạo thương hiệu thành công');
            }else {
                session()->flash('error', 'Vui lòng điền đủ thông tin');
            }
        }
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.brand.admin-add-brands-component',['categories'=>$categories])->layout('admlayouts.base');
    }
}
