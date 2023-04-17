<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CartCompoment extends Component
{
    public $coupon_code;
    public $couponCode;
    public $discount;
    public $subtotalAfterDiscount;
    public $totalAfterDiscount;
    
    public function increaseQuantity($rowId)
    {
        $product = Cart::Get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::Get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
    }

    public function destroy($rowId)
    {
        $cart = Cart::content()->where('rowId',$rowId);
        if($cart->isNotEmpty())
        {
            Cart::remove($rowId);
        }
    }

    public function getCartCount()
    {
        $count = Cart::count();
        return response()->json(['count' => $count]);
    }

    public function destroyAll()
    {
        Cart::remove();
    }

    public function applyCouponCode()
    {
        $coupon = Coupon::where('code',$this->couponCode)->first();
        if(!$coupon)
        {
            session()->flash('coupon_massage', 'Mã giảm giá không hợp lệ!');
            return;
        }else 
        {
            session()->put('coupon', [
                'code' => $coupon->code,
                'type' => $coupon->type,
                'cart_value' => $coupon->cart_value,
                'quantity' => $coupon->quantity,
            ]);
            $this->coupon_code = null;
        }

    }

    public function calculateDiscounts()
    {
        if (session()->has('coupon')) 
        {
            if (session()->get('coupon')['type'] == 'fixed') 
            {
                $this->discount = session()->get('coupon')['cart_value'];
            }
            else
            {
                
                $this->discount = (number_format(str_replace(',', '', Cart::instance()->subtotal), 0, '.', '') * session()->get('coupon')['cart_value'])/100;
            }
            $this->subtotalAfterDiscount =number_format(str_replace(',', '', Cart::instance()->subtotal), 0, '.', '') - $this->discount;

        }
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
    }

    public function checkout()
    {
        if (Auth::check()) {
            return redirect()->route('checkout');
        }else {
            return redirect()->route('login');
        }
    }

    public function setAmountForCheckout()
    {
        if (!Cart::count() > 0) {
            session()->forget('checkout');
            return;
        }

        if (session()->has('coupon')) {
            session()->put('checkout', [
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount
            ]);
        }
        else {
            session()->put('checkout', [
                'discount' => 0,
                'subtotal' => number_format(str_replace(',', '', Cart::instance()->subtotal), 0, '.', '')
            ]);
        }
    }

    public function render()
    {

        // dd(number_format(str_replace(',', '', Cart::instance()->subtotal), 0, '.', ''));
        // dd(Cart::count());
        if(session()->has('coupon'))
        {
            if (session()->get('coupon')['quantity'] > 0) {
                $this->calculateDiscounts();
            }
            else
            {
                session()->forget('coupon');
            }
        }
        $this->setAmountForCheckout();
        return view('livewire.cart-compoment')->layout("layouts.base");
    }
}
