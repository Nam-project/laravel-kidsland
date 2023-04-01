<?php

namespace App\Http\Livewire\Admin\Subcategory;

use Livewire\Component;
use App\Models\SubCategory;
use Livewire\WithPagination;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class AdminSubCategoryComponent extends Component
{
    use WithPagination;
    
    public function deleteSubCategory($id)
    {
        $namesubcategory;
        $subcategory = SubCategory::find($id);
        if($subcategory)
        {
            $namesubcategory = $subcategory->name;
            $subcategory->delete();
            session()->flash('massage', 'Xóa danh mục con '.$namesubcategory.' thành công!');
        }

        if(session('tasks_url')){
            return redirect(session('tasks_url'));
        }
        
        return redirect()->route('admin.subcategory');
    }

    public function render()
    {
        $subcategories = SubCategory::paginate(10);
        Session::put('tasks_url', request()->fullUrl());
        return view('livewire.admin.subcategory.admin-sub-category-component',['subcategories'=>$subcategories])->layout('admlayouts.base');
    }
}
