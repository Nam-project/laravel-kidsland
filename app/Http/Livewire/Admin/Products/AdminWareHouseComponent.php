<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use App\Models\Wards;
use App\Models\City;
use App\Models\Province;
use App\Models\WareHouse;
use Livewire\WithPagination;

class AdminWareHouseComponent extends Component
{
    use WithPagination;

    public $showwarehouse;
    public $show_editWarehouse;

    public $city_id;
    public $province_id;
    public $ward_id;
    public $name;
    public $address;
    public $phone;

    public $itemId;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'ward_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric'
        ]);
    }

    public function addWarehouse()
    {
        $this->validate([
            'ward_id' => 'required',
            'name' => 'required|unique:ware_houses',
            'address' => 'required',
            'phone' => 'required|numeric'
        ]);
        $warehouse = new WareHouse();
        $warehouse->name = $this->name;
        $warehouse->address = $this->address;
        $warehouse->phone = $this->phone;
        $warehouse->ward_id = $this->ward_id;
        $warehouse->save();
        $this->reset('name','phone','address','ward_id','province_id','city_id');
        $this->showwarehouse = 0;
        session()->flash('message', 'Thêm nhà cung cấp thành công.');
    }

    public function resetValueEdit()
    {
        $this->reset('itemId','name','address','phone','city_id','province_id','ward_id');
    }

    public function valueEdit($id)
    {
        $this->itemId = $id;
        $warehouse = Warehouse::find($id);
        $this->name = $warehouse->name;
        $this->address = $warehouse->address;
        $this->phone = $warehouse->phone;
        $this->city_id = $warehouse->ward->province->city->matp;
        $this->province_id = $warehouse->ward->province->maqh;
        $this->ward_id = $warehouse->ward_id;
    }

    public function updateWareHouse($warehouse_id)
    {
        $this->validate([
            'ward_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric'
        ]);
        $warehouse = WareHouse::find($warehouse_id);
        $warehouse->name = $this->name;
        $warehouse->address = $this->address;
        $warehouse->phone = $this->phone;
        $warehouse->ward_id = $this->ward_id;
        $warehouse->save();
        $this->resetValueEdit();
        session()->flash('message', 'Cập nhật thành công.');
    }

    public function deleteWarehouse($warehouse_id)
    {
        $warehouse = WareHouse::find($warehouse_id);
        if ($warehouse) {
            $warehouse->delete();
        }
        session()->flash('message', 'Xóa nhà cung cấp thành công!');
    }

    public function render()
    {
        $warehouses = WareHouse::paginate(6);
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
        return view('livewire.admin.products.admin-ware-house-component',['warehouses'=>$warehouses,'cities'=>$cities,'provinces'=>$provinces,'wards'=>$wards])->layout('admlayouts.base');
    }
}
