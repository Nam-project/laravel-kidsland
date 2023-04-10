<?php

namespace App\Http\Livewire\Admin\Subcategory;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\Category;

class AdminEditSubCategoryComponent extends Component
{
    public $subcategory_slug;
    public $subcategory_id;
    public $name;
    public $slug;
    public $category_id;

    public function mount($subcategory_slug)
    {
        $this->subcategory_slug = $subcategory_slug;
        $category = SubCategory::where('slug', $subcategory_slug)->first();
        $this->subcategory_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->category_id = $category->category_id;
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
            'category_id' => 'required'
        ]);   
    }

    public function updateSubCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'category_id' => 'required'
        ]);
        $subcategory = SubCategory::find($this->subcategory_id);
        $subcategory->name = $this->name;
        $subcategory->slug = $this->slug;
        $subcategory->category_id = $this->category_id;
        $subcategory->save();
        session()->flash('massage', 'Cập nhật danh mục thành công!');
        if(session('tasks_url')){
            return redirect(session('tasks_url'));
        }
        
        return redirect()->route('admin.subcategory');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.subcategory.admin-edit-sub-category-component',['categories'=>$categories])->layout('admlayouts.base');
    }
}
