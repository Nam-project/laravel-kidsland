<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use App\Models\Receipt;

class AdminEnterStockComponent extends Component
{
    public $sorting;

    public function mount()
    {
        $this->sorting = 'all';
    }

    public function sortingReceipt($sorting)
    {
        $this->sorting = $sorting;
    }

    public function render()
    {
        if ($this->sorting == 'all') {
            $receipts = Receipt::all();
        }else {
            $receipts = Receipt::where('status',$this->sorting)->get();
        }
        return view('livewire.admin.products.admin-enter-stock-component',['receipts'=>$receipts])->layout('admlayouts.base');
    }
}
