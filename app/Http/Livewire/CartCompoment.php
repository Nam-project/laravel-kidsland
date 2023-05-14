<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use App\Models\Coupon;
use App\Models\Product;
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
        $product = Cart::instance('cart')->Get($rowId);
        $item = Product::find($product->id);
        if ($product->qty != $item->can_sell) {
            $qty = $product->qty + 1;
            Cart::instance('cart')->update($rowId, $qty);
            $this->emitTo('cart-count-component','refreshComponent');
        }
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->Get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function destroy($rowId)
    {
        $cart = Cart::instance('cart')->content()->where('rowId',$rowId);
        if($cart->isNotEmpty())
        {
            Cart::instance('cart')->remove($rowId);
        }
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function destroyAll()
    {
        Cart::instance('cart')->remove();
        $this->emitTo('cart-count-component','refreshComponent');
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
                'value' => $coupon->value,
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
                $this->discount = session()->get('coupon')['value'];
            }
            else
            {
                
                $this->discount = (number_format(str_replace(',', '', Cart::instance('cart')->subtotal), 0, '.', '') * session()->get('coupon')['value'])/100;
            }
            $this->subtotalAfterDiscount =number_format(str_replace(',', '', Cart::instance('cart')->subtotal), 0, '.', '') - $this->discount;

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
        if (!Cart::instance('cart')->count() > 0) {
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
                'subtotal' => number_format(str_replace(',', '', Cart::instance('cart')->subtotal), 0, '.', '')
            ]);
        }
    }

    public function render()
    {
        // dd(number_format(str_replace(',', '', Cart::instance()->subtotal), 0, '.', ''));
        // dd(Cart::count());
        if(session()->has('coupon'))
        {
            if (session()->get('coupon')['value'] > 0) {
                $this->calculateDiscounts();
            }
            else
            {
                session()->forget('coupon');
            }
        }
        $this->setAmountForCheckout();

        // dd(Cart::store(Auth::user()->email));
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
        }
        
        $coupons = Coupon::all();

        return view('livewire.cart-compoment',['coupons'=>$coupons])->layout("layouts.base");
    }
}
