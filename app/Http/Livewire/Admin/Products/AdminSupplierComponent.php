<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use App\Models\Wards;
use App\Models\City;
use App\Models\Province;
use App\Models\Supplier;
use Livewire\WithPagination;

class AdminSupplierComponent extends Component
{
    use WithPagination;

    public $show_supplier;
    public $show_editsupplier;

    public $city_id;
    public $province_id;
    public $ward_id;
    public $name;
    public $email;
    public $address;
    public $phone;

    public $itemId;

    public function mount()
    {
        $this->itemId = 0;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'ward_id' => 'required',
            'email' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric'
        ]);
    }

    public function addSupplier()
    {
        $this->validate([
            'ward_id' => 'required',
            'name' => 'required|unique:suppliers',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric'
        ]);
        $supplier = new Supplier();
        $supplier->name = $this->name;
        $supplier->email = $this->email;
        $supplier->address = $this->address;
        $supplier->phone = $this->phone;
        $supplier->ward_id = $this->ward_id;
        $supplier->save();
        $this->reset('name','email','phone','address','ward_id','province_id','city_id');
        $this->show_supplier = 0;
        session()->flash('message', 'Thêm nhà cung cấp thành công.');
    }

    public function valueEdit($id)
    {
        $this->itemId = $id;
        $supplier = Supplier::find($id);
        $this->name = $supplier->name;
        $this->email = $supplier->email;
        $this->address = $supplier->address;
        $this->phone = $supplier->phone;
        $this->city_id = $supplier->ward->province->city->matp;
        $this->province_id = $supplier->ward->province->maqh;
        $this->ward_id = $supplier->ward_id;
    }

    public function resetValueEdit()
    {
        $this->reset('itemId','name','email','address','phone','city_id','province_id','ward_id');
    }

    public function updateSupplier($supplier_id)
    {
        $this->validate([
            'ward_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric'
        ]);
        $supplier = Supplier::find($supplier_id);
        $supplier->name = $this->name;
        $supplier->email = $this->email;
        $supplier->address = $this->address;
        $supplier->phone = $this->phone;
        $supplier->ward_id = $this->ward_id;
        $supplier->save();
        $this->resetValueEdit();
        session()->flash('message', 'Cập nhật thành công.');
    }

    public function deleteSupplier($supplier_id)
    {
        $supplier = Supplier::find($supplier_id);
        if ($supplier) {
            $supplier->delete();
        }
        session()->flash('message', 'Xóa nhà cung cấp thành công!');
    }

    public function render()
    {
        $suppliers = Supplier::paginate(6);
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

        return view('livewire.admin.products.admin-supplier-component',['suppliers'=>$suppliers,'cities'=>$cities,'provinces'=>$provinces,'wards'=>$wards])->layout('admlayouts.base');
    }
}
