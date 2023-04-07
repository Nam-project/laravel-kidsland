<?php

namespace App\Http\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AdminAddHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $link;
    public $status;
    public $image;

    public function mount()
    {
        $this->status = 0;
    }

    public function storeSlider()
    {
        $slider = new HomeSlider();
        $slider->link = $this->link;
        $slider->status = $this->status;
        if($this->link) {
            if ($this->image) {
                $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
                $this->image->storeAs('sliders', $imageName);
                $slider->image = $imageName;
                // Tiếp tục xử lý lưu ảnh và tạo bản ghi
            }else {
                $slider->image = NULL;
            }
        
            // Do something if the record does not exist
            $slider->save();
            session()->flash('massage', 'Tạo Slider thành công');
        }else {
            session()->flash('massage', 'Vui lòng điền đủ thông tin');
        }
    }

    public function render()
    {
        return view('livewire.admin.slider.admin-add-home-slider-component')->layout('admlayouts.base');
    }
}
