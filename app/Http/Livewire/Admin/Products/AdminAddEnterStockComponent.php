<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\WareHouse;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\DetailReceipt;
use Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class AdminAddEnterStockComponent extends Component
{
    use WithPagination;

    public $show_products;
    public $supplier_id;
    public $warehouse_id;
    public $product;
    public $qty;
    public $price;
    public $note;

    public $check_payment;

    public function mount()
    {
        $this->viewQuantityProducts();
        $this->viewPriceProducts();
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'supplier_id' => 'required',
            'note' => 'required',
            'warehouse_id' => 'required'
        ]);
    }

    public function storeReceipt()
    {  
        $this->validate([
            'supplier_id' => 'required',
            'note' => 'required',
            'warehouse_id' => 'required'
        ]);
        if (Cart::instance('receipt')->count() > 0) {
            $receipt = new Receipt();
            $receipt->total = number_format(str_replace(',', '', Cart::instance('receipt')->subtotal), 0, '.', '');
            $receipt->status = 'confirm';
            $receipt->suppliers_id = $this->supplier_id;
            $receipt->warehouse_id = $this->warehouse_id;
            $receipt->user_id = Auth::user()->id;
            $receipt->note = $this->note;
            $receipt->save();
            foreach (Cart::instance('receipt')->content() as $item) {
                $detail_receipt = new DetailReceipt();
                $detail_receipt->price = $item->price;
                $detail_receipt->quantity = $item->qty;
                $detail_receipt->product_id = $item->id;
                $detail_receipt->receipt_id = $receipt->id;
                $detail_receipt->save();
            }
            
            Cart::instance('receipt')->destroy();
            return redirect()->route('admin.viewreceipts',['receipt_id'=>$receipt->id]);
        }
    }

    public function viewQuantityProducts()
    {
        foreach ( Cart::instance('receipt')->content() as $item) {
            $this->qty[$item->rowId] = $item->qty;
        }
    }

    public function viewPriceProducts()
    {
        foreach ( Cart::instance('receipt')->content() as $item) {
            $this->price[$item->rowId] = $item->price;
        }
    }

    public function resetSupplierId()
    {
        $this->reset('supplier_id');
    }

    public function resetWareHouseId()
    {
        $this->reset('warehouse_id');
    }

    public function storeProductReceipt($product_id,$product_name,$product_price)
    {
        Cart::instance('receipt')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->reset('product');
        $this->viewQuantityProducts();
        $this->viewPriceProducts();
    }

    public function updateReceipt($rowId)
    {
        if ($this->qty[$rowId] > 0) {
            Cart::instance('receipt')->update($rowId, $this->qty[$rowId]);
            $this->viewQuantityProducts();
        }
    }

    public function updatePrice($rowId)
    {
        Cart::instance('receipt')->update($rowId ,['price' => $this->price[$rowId]]);
        $this->viewPriceProducts();
    }

    public function destroyReceipt($rowId)
    {
        $receipt = Cart::instance('receipt')->content()->where('rowId',$rowId);
        if($receipt->isNotEmpty())
        {
            Cart::instance('receipt')->remove($rowId);
        }
    }

    public function render()
    {
        $receipt = Cart::instance('receipt')->content();
        $supplier = '';
        if ($this->supplier_id) {
            $supplier = Supplier::find($this->supplier_id);
        }

        $warehouse = '';
        if ($this->warehouse_id) {
            $warehouse = WareHouse::find($this->warehouse_id);
        }

        if ($this->product) {
            $products = Product::where('name','like','%'.$this->product.'%')->take(5)->get();
        }else {
            $products = Product::take(5)->get();
        }
        $list_products = Product::paginate(6);
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();

        $totalQuantity = 0;

        foreach (Cart::instance('receipt')->content() as $item) {
            $totalQuantity += $item->qty;
        }

        return view('livewire.admin.products.admin-add-enter-stock-component',['totalQuantity'=>$totalQuantity,'warehouses'=>$warehouses,'warehouse'=>$warehouse,'list_products'=>$list_products,'receipt'=>$receipt,'suppliers'=>$suppliers,'supplier'=>$supplier,'products'=>$products])->layout('admlayouts.base');
    }
}
