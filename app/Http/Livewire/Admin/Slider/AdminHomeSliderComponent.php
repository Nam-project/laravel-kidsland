<?php

namespace App\Http\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\HomeSlider;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;

class AdminHomeSliderComponent extends Component
{
    use WithPagination;

    public function deleteSlider($id)
    {
        $slider = HomeSlider::find($id);
        if($slider)
        {
            if($slider->image) {
                $imagePath = 'assets/imgs/sliders/' . $slider->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $slider->delete();
            session()->flash('massage', 'Xóa slider thành công!');
            if(session('tasks_url')){
                return redirect(session('tasks_url'));
            }
            
            return redirect()->route('admin.categories');
        }  
    }

    public function render()
    {
        $slider = HomeSlider::paginate(10);
        Session::put('tasks_url', request()->fullUrl());
        return view('livewire.admin.slider.admin-home-slider-component', ['slider'=>$slider])->layout('admlayouts.base');
    }
}
