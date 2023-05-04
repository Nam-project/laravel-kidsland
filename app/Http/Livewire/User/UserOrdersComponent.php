<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Order;
use App\Models\Evaluate;
use App\Models\DetailOrder;
use Illuminate\Support\Facades\Auth;

class UserOrdersComponent extends Component
{
    public $status;
    public $viewEvaluate;
    public $star;
    public $content;

    public function mount()
    {
        $this->status = 'all';
        $this->detail_order_id = 1;
    }

    public function addEvaluates($detail_order_id)
    {
        $this->validate([
            'star' => 'required',
            'content' => 'required'
        ]);
        $evaluate = new Evaluate();
        $evaluate->star = $this->star;
        $evaluate->content = $this->content;
        $evaluate->detail_orders_id = $detail_order_id;
        $evaluate->user_id = Auth::user()->id;
        $evaluate->save();

        $detailOrder = DetailOrder::find($detail_order_id);
        $detailOrder->rstatus = true;
        $detailOrder->save();
    }

    public function statusOrder($status)
    {
        $this->status = $status;
    }

    public function render()
    {
        if ($this->status == 'all') {
            $orders = Order::orderBy('created_at', 'DESC')->where('user_id',Auth::user()->id)->paginate(10);
        }else {
            $orders = Order::orderBy('created_at', 'DESC')->where('user_id',Auth::user()->id)->where('status',$this->status)->paginate(10);
        }
        return view('livewire.user.user-orders-component',['orders'=>$orders])->layout('layouts.base');
    }
}
