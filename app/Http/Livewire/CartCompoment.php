<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartCompoment extends Component
{
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

    public function render()
    {
        return view('livewire.cart-compoment')->layout("layouts.base");
    }
}
