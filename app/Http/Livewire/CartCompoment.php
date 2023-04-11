<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use App\Models\Coupon;

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
        $coupon = Coupon::where('code',$this->couponCode)->where('cart_value', '<=', Cart::instance('cart')->subtotal())->first();
        if(!$coupon)
        {
            session()->flash('coupon_massage', 'Mã giảm giá không hợp lệ!');
            return;
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'cart_value' => $coupon->cart_value,
            'quantity' => $coupon->quantity,
        ]);
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
                $this->discount = ( Cart::instance('cart')->subtotal * session()->get('coupon')['cart_value'] )/100;
            }
            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;

        }
    }

    public function render()
    {
        if(session()->has('coupon'))
        {
            // if (Cart::instance('cart')->subtotal < ) 
            // {
            //     # code...
            // }
        }
        return view('livewire.cart-compoment')->layout("layouts.base");
    }
}
