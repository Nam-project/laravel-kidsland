<?php

namespace App\Http\Livewire\Admin\Weightage;

use Livewire\Component;
use App\Models\WeightAge;
use App\Models\Category;

class AdminAddWeightAgeComponent extends Component
{
    public $name;
    public $category_id;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:weight_ages',
            'category_id' => 'required'
        ]);   
    }

    public function storeWeightAge()
    {
        $this->validate([
            'name' => 'required|unique:weight_ages',
            'category_id' => 'required'
        ]);
        $weightage = new WeightAge();
        $weightage->name = $this->name;
        $weightage->category_id = $this->category_id;
        $weightage->save();
        session()->flash('massage', 'Tạo danh mục con thành công');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.weightage.admin-add-weight-age-component',['categories'=>$categories])->layout('admlayouts.base');
    }
}
