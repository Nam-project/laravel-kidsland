<?php

namespace App\Http\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $slider_id;
    public $link;
    public $status;
    public $image;
    public $newimage;

    public function mount($slider_id)
    {
        $this->slider_id = $slider_id;
        $slider = HomeSlider::find($slider_id);
        $this->link = $slider->link;
        $this->status = $slider->status;
        $this->image = $slider->image;
    }

    public function updateSlider()
    {
        $slider = HomeSlider::find($this->slider_id);
        $slider->link = $this->link;
        $slider->status = $this->status;
        if ($this->newimage) {
            if($this->image) {
                $imagePath = 'assets/imgs/sliders/' . $this->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $imageName = Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->newimage->storeAs('sliders', $imageName);
            $slider->image = $imageName;
            // Tiếp tục xử lý lưu ảnh và tạo bản ghi
        }
        $slider->save();
        session()->flash('massage', 'Cập nhật Slider thành công!');
        if(session('tasks_url')){
            return redirect(session('tasks_url'));
        }
        
        return redirect()->route('admin.homeslider');
    }

    public function render()
    {
        return view('livewire.admin.slider.admin-edit-home-slider-component')->layout('admlayouts.base');
    }
}
