<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\ProductWareHouse;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class AdminOrderComponent extends Component
{
    use WithPagination;
    public function updateOrderStatus($order_id, $status)
    {
        $order = Order::find($order_id);
        $order->status = $status;
        if ($status == "delivered") {
            foreach ($order->detailOrder as $item) {
                $productwarehouse = ProductWareHouse::where('product_id',$item->product_id)->get();
                $item_quantity = $item->count;
                foreach ($productwarehouse as $value) {
                    if ($item_quantity > 0) {
                        $value->quantity = $value->quantity - $item_quantity;
                        if ($value->quantity < 0) {
                            $item_quantity = abs($value->quantity);
                            $value->quantity = 0;
                        }else {
                            $item_quantity = 0;
                        }
                    }
                    $value->save();
                }
                $item->product->quantity = $item->product->quantity - $item->count;
                $item->product->save();
            }
            $order->delivered_date = DB::raw('CURRENT_DATE');

        } else if($status == "canceled") {
            $order->canceled_date = DB::raw('CURRENT_DATE');
        } else if($status == "shipping") {
            $order->shipping_date = DB::raw('CURRENT_DATE');
        }
        $order->save();
        session()->flash('order_massage','Cập nhật trạng thái đơn hàng thành công !');
    }

    public function dowloadInvoice($order_id)
    {
        return redirect()->route('download.invoice', ['order_id' =>$order_id]);
    }

    public function render()
    {
        $orders = Order::orderBy('created_at','DESC')->paginate(10);
        return view('livewire.admin.order.admin-order-component',['orders'=>$orders])->layout('admlayouts.base');
    }
}
