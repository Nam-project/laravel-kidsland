<?php

namespace App\Http\Livewire\Admin\Coupon;

use Livewire\Component;
use App\Models\Coupon;

class AdminEditCouponComponent extends Component
{
    public $code;
    public $type;
    public $quantity;
    public $cart_value;
    public $coupon_id;

    public function mount($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->quantity = $coupon->quantity;
        $this->cart_value = $coupon->cart_value;
        $this->coupon_id = $coupon->id;

    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'code'=>'required',
            'type'=>'required',
            'quantity'=>'required|numeric',
            'cart_value'=>'required|numeric'
        ]);   
    }

    public function updateCoupon()
    {
        $this->validate([
            'code'=>'required',
            'type'=>'required',
            'quantity'=>'required|numeric',
            'cart_value'=>'required|numeric'
        ]);
        $coupon = Coupon::find($this->coupon_id);
        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->quantity = $this->quantity;
        $coupon->cart_value = $this->cart_value;
        $coupon->save();
        session()->flash('massage', 'Cập nhật phiếu giảm giá thành công');
    }
    public function render()
    {
        return view('livewire.admin.coupon.admin-edit-coupon-component')->layout('admlayouts.base');
    }
}
