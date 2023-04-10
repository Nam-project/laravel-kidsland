<?php

namespace App\Http\Livewire\Admin\Coupon;

use Livewire\Component;
use App\Models\Coupon;
use Livewire\WithPagination;

class AdminCouponComponent extends Component
{
    use WithPagination;

    public function deleteCoupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        if ($coupon) {
            $coupon->delete();
            session()->flash('massage', 'Xóa phiếu giảm giá thành công!');
        }
    }

    public function render()
    {
        $coupons = Coupon::paginate(10);
        return view('livewire.admin.coupon.admin-coupon-component',['coupons'=>$coupons])->layout('admlayouts.base');
    }
}
