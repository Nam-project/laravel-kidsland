<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class AdminEditCategoryComponent extends Component
{
    use WithFileUploads;
    public $category_slug;
    public $category_id;
    public $name;
    public $slug;
    public $image;
    public $newimage;

    public function mount($category_slug)
    {
        $this->category_slug = $category_slug;
        $category = Category::where('slug', $category_slug)->first();
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->image = $category->image;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required'
        ]);   
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        $category = Category::find($this->category_id);
        $category->name = $this->name;
        $category->slug = $this->slug;
        if ($this->newimage) {
            if($this->image) {
                $imagePath = 'assets/imgs/categories/' . $this->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $imageName = Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->newimage->storeAs('categories', $imageName);
            $category->image = $imageName;
            // Tiếp tục xử lý lưu ảnh và tạo bản ghi
        }
        $category->save();
        session()->flash('massage', 'Cập nhật danh mục thành công!');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')->layout('admlayouts.base');
    }
}
