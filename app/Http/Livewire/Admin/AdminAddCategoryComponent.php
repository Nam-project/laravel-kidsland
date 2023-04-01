<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AdminAddCategoryComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $image;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function storeCategory()
    {
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        
        if (Category::where('name', '=', $this->name)->exists()) {
            // Do something if the record exists
            session()->flash('massage', 'Danh mục đã tồn tại');
        } else {
            if ($this->image) {
                $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
                $this->image->storeAs('categories', $imageName);
                $category->image = $imageName;
                // Tiếp tục xử lý lưu ảnh và tạo bản ghi
            }else {
                $category->image = NULL;
            }
            if($this->name) {
                // Do something if the record does not exist
                $category->save();
                session()->flash('massage', 'Tạo danh mục thành công');
            }else {
                session()->flash('massage', 'Vui lòng điền đủ thông tin');
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('admlayouts.base');
    }
}
