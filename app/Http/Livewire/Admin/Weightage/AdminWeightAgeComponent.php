<?php

namespace App\Http\Livewire\Admin\Weightage;

use Livewire\Component;
use App\Models\WeightAge;
use Livewire\WithPagination;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class AdminWeightAgeComponent extends Component
{
    use WithPagination;
    
    public function deleteWeightAge($id)
    {
        $name;
        $weightage = WeightAge::find($id);
        if($weightage)
        {
            $name = $weightage->name;
            $weightage->delete();
            session()->flash('massage', 'Xóa '.$name.' thành công!');
        }

        if(session('tasks_url')){
            return redirect(session('tasks_url'));
        }
        
        return redirect()->route('admin.weightage');
    }

    public function render()
    {
        $weightage = WeightAge::paginate(10);
        Session::put('tasks_url', request()->fullUrl());
        return view('livewire.admin.weightage.admin-weight-age-component',['weightage'=>$weightage])->layout('admlayouts.base');
    }
}
