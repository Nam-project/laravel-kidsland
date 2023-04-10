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

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:sub_categories',
            'slug' => 'required|unique:sub_categories',
            'category_id' => 'required'
        ]);   
    }

    public function storeSubCategory()
    {
        $this->validate([
            'name' => 'required|unique:sub_categories',
            'slug' => 'required|unique:sub_categories',
            'category_id' => 'required'
        ]);
        $subcategory = new SubCategory();
        $subcategory->name = $this->name;
        $subcategory->slug = $this->slug;
        $subcategory->category_id = $this->category_id;
        $subcategory->save();
        session()->flash('massage', 'Tạo danh mục con thành công');
    }


    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.subcategory.admin-add-sub-category-component',['categories'=>$categories])->layout('admlayouts.base');
    }
}
