<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class AdminCategoryComponent extends Component
{
    use WithPagination;

    public function deleteCategory($id)
    {
        $namecategory;
        $category = Category::find($id);
        if($category)
        {
            $namecategory = $category->name;
            if($category->image) {
                $imagePath = 'assets/imgs/categories/' . $category->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $category->delete();
            session()->flash('massage', 'Xóa danh mục '.$namecategory.' thành công!');
            if(session('tasks_url')){
                return redirect(session('tasks_url'));
            }
            
            return redirect()->route('admin.categories');
        }  
    }

    public function render()
    {
        $categories = Category::paginate(10);
        Session::put('tasks_url', request()->fullUrl());
        return view('livewire.admin.admin-category-component',['categories'=>$categories])->layout('admlayouts.base');
    }
}
