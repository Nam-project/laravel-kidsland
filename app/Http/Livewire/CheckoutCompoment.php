<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Wards;
use App\Models\City;
use App\Models\Province;
use Cart;

class CheckoutCompoment extends Component
{

    public $city_id;
    public $province_id;
    

    public function render()
    {
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
