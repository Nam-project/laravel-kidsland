<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Wards;
use App\Models\City;
use App\Models\Province;
use App\Models\Order;
use App\Models\DetailOrder;
use Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutCompoment extends Component
{

    public $city_id;
    public $province_id;
    public $ward_id;
    public $name;
    public $phone;
    public $address;

    public $thankyou;
    
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'ward_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric'
        ]);
    }

    public function placeOrder()
    {
        $this->validate([
            'ward_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric'
        ]);

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->ward_id = $this->ward_id;
        $order->name = $this->name;
        $order->phone =  $this->phone;
        $order->address = $this->address;
        $order->save();

        foreach(Cart::content() as $item)
        {
            $orderItem = new DetailOrder();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->count = $item->qty;
            $orderItem->save();
        }

        $this->thankyou = 1;
        Cart::destroy();
        session()->forget('checkout');

    }

    public function verifyForCheckout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }else if($this->thankyou){
            return redirect()->route('thankyou');
        }else if(!session()->get('checkout')){
            return redirect()->get('product.cart');
        }
    }

    public function render()
    {

        $this->verifyForCheckout();

        $cities = City::orderby('matp','ASC')->get();

        if ($this->city_id) {
            $provinces = Province::where('matp', $this->city_id)->get();
        }else {
            $provinces = [];
        }

        if ($this->province_id) {
            $wards = Wards::where('maqh', $this->province_id)->get();
        }else {
            $wards = [];
        }
        
        return view('livewire.checkout-compoment',['cities'=>$cities,'provinces'=>$provinces,'wards'=>$wards])->layout("layouts.base");
    }
}
