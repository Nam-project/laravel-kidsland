<?php

namespace App\Http\Livewire\Admin\Coupon;

use Livewire\Component;
use App\Models\Coupon;

class AdminAddCouponComponent extends Component
{

    public $code;
    public $type;
    public $quantity;
    public $cart_value;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'code'=>'required|unique:coupons',
            'type'=>'required',
            'quantity'=>'required|numeric',
            'cart_value'=>'required|numeric'
        ]);   
    }

    public function storeCoupon()
    {
        $this->validate([
            'code'=>'required|unique:coupons',
            'type'=>'required',
            'quantity'=>'required|numeric',
            'cart_value'=>'required|numeric'
        ]);
        $coupon = new Coupon();
        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->quantity = $this->quantity;
        $coupon->cart_value = $this->cart_value;
        $coupon->save();
        session()->flash('massage', 'Tạo phiếu giảm giá thành công');
    }

    public function render()
    {
        return view('livewire.admin.coupon.admin-add-coupon-component')->layout('admlayouts.base');
    }
}
