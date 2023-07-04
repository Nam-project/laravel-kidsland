<?php

namespace App\Http\Livewire\Admin\Productwarehouse;

use Livewire\Component;
use App\Models\Product;
use App\Models\DetailOrder;
use App\Models\DetailReceipt;
use Livewire\WithPagination;

class AdminProductWareHouseComponent extends Component
{
    use WithPagination;

    public function getProductOrderCounts($product_id)
    {
        $orderCount = DetailOrder::where('product_id', $product_id)
                        ->whereHas('order', function ($query) {
                            $query->whereIn('status', ['shipping', 'ordered']);
                        })
                        ->sum('count');
        return $orderCount;
    }

    public function getProductReceiptCounts($product_id)
    {
        $receiptCount = DetailReceipt::where('product_id', $product_id)
                        ->whereHas('receipt', function ($query) {
                            $query->where('status','confirm');
                        })
                        ->sum('quantity');
        return $receiptCount;
    }

    public function render()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        
        return view('livewire.admin.productwarehouse.admin-product-ware-house-component',['products'=>$products])->layout('admlayouts.base');
    }
}
