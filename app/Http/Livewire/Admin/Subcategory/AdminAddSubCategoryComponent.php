<?php

namespace App\Http\Livewire\Admin\Subcategory;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\Category;


class AdminAddSubCategoryComponent extends Component
{
    public $name;
    public $slug;
    public $category_id;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function storeSubCategory()
    {
        $subcategory = new SubCategory();
        $subcategory->name = $this->name;
        $subcategory->slug = $this->slug;
        $subcategory->category_id = $this->category_id;
        if (SubCategory::where('name', '=', $this->name)->exists()) {
            // Do something if the record exists
            session()->flash('error', 'Danh mục con đã tồn tại');
        } else {
            if($this->name && $this->category_id)
            {
                $subcategory->save();
                session()->flash('massage', 'Tạo danh mục con thành công');
            }else {
                session()->flash('error', 'Vui lòng điền đủ thông tin');
            }
        }
    }


    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.subcategory.admin-add-sub-category-component',['categories'=>$categories])->layout('admlayouts.base');
    }
}
