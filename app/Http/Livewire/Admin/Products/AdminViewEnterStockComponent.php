<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use App\Models\Receipt;
use App\Models\Product;
use App\Models\ProductWarehouse;

class AdminViewEnterStockComponent extends Component
{
    public $receipt_id;

    public function mount($receipt_id)
    {
        $this->receipt_id = $receipt_id;
    }

    public function importWareHouse()
    {
        $receipt = Receipt::find($this->receipt_id);
        $receipt->status = "complete";
        $receipt->save();
        foreach ($receipt->detailReceipt as $item) {
            $product = Product::find($item->product->id);
            $product->quantity = $product->quantity + $item->quantity;
            $product->can_sell = $product->can_sell + $item->quantity;
            $product->save();
            $warehouse = ProductWarehouse::where('product_id',$item->product_id)->where('warehouse_id',$receipt->warehouse_id)->first();
            if ($warehouse) {
                $warehouse->quantity = $warehouse->quantity + $item->quantity;
                $warehouse->save();
            } else {
                $warehouse = new ProductWarehouse();
                $warehouse->quantity = $item->quantity;
                $warehouse->product_id = $item->product_id;
                $warehouse->warehouse_id  = $receipt->warehouse_id;
                $warehouse->save();
            }
        }
    }

    public function render()
    {
        $receipt = Receipt::find($this->receipt_id);
        return view('livewire.admin.products.admin-view-enter-stock-component',['receipt'=>$receipt])->layout('admlayouts.base');
    }
}
