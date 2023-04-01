<?php

namespace App\Http\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class AdminBrandsComponent extends Component
{
    use WithPagination;

    public function deleteBrand($id)
    {
        $namebrand;
        $brand = Brand::find($id);
        if($brand)
        {
            $namebrand = $brand->name;
            $brand->delete();
            session()->flash('massage', 'Xóa thương hiệu '.$namebrand.' thành công!');
        }

        if(session('tasks_url')){
            return redirect(session('tasks_url'));
        }
        
        return redirect()->route('admin.brands');
    }

    public function render()
    {
        $brands = Brand::paginate(10);
        Session::put('tasks_url', request()->fullUrl());
        return view('livewire.admin.brand.admin-brands-component',['brands'=>$brands])->layout('admlayouts.base');
    }
}
