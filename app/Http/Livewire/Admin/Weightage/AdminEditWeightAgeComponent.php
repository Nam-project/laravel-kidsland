<?php

namespace App\Http\Livewire\Admin\Weightage;

use Livewire\Component;
use App\Models\WeightAge;
use App\Models\Category;

class AdminEditWeightAgeComponent extends Component
{
    public $weightage_id;
    public $name;
    public $category_id;

    public function mount($weightage_id)
    {
        $this->weightage_id = $weightage_id;
        $weightage = WeightAge::find($weightage_id);
        $this->weightage_id = $weightage->id;
        $this->name = $weightage->name;
        $this->category_id = $weightage->category_id;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'category_id' => 'required'
        ]);   
    }

    public function updateWeightAge()
    {
        $this->validate([
            'name' => 'required',
            'category_id' => 'required'
        ]);
        $weightage = WeightAge::find($this->weightage_id);
        $weightage->name = $this->name;
        $weightage->category_id = $this->category_id;
        $weightage->save();
        session()->flash('massage', 'Cập nhật thành công!');
        if(session('tasks_url')){
            return redirect(session('tasks_url'));
        }
        
        return redirect()->route('admin.subcategory');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.weightage.admin-edit-weight-age-component', ['categories'=>$categories])->layout('admlayouts.base');
    }
}
