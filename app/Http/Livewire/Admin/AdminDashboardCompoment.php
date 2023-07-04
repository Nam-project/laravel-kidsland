<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class AdminDashboardCompoment extends Component
{
    public $by_date;
    public $data = [];
    public $start;
    public $end;
    public $total;
    public $filterStart;
    public $filterEnd;

    public $categoryId;

    public function mount()
    {
        $this->by_date = 30;
    }

    public function refresh()
    {
        $this->dispatchBrowserEvent('reload-script', $this->data);
    }

    public function loadDataChart()
    {
        if ( $this->categoryId == 0) {
            $orderData = Order::selectRaw('DATE(updated_at) as date, SUM(total) as revenue')
            ->whereBetween('updated_at', [$this->start, $this->end])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            $this->total = Order::whereBetween('updated_at', [$this->start, $this->end])->sum('total');
        } else {
            $categoryId = $this->categoryId;
            $orderData = Order::whereHas('detailOrder.product.subcategory.category', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            })->selectRaw('DATE(updated_at) as date, SUM(total) as revenue')
                ->whereBetween('updated_at', [$this->start, $this->end])
                ->groupBy('date')
                ->orderBy('date')
                ->get();
            $this->total = Order::whereHas('detailOrder.product.subcategory.category', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            })->whereBetween('updated_at', [$this->start, $this->end])->sum('total');
        }
        
        $formattedData = [];
        foreach ($orderData as $order) {
            $formattedData[] = [
                'date' => Carbon::parse($order->date)->format('M d'),
                'revenue' => $order->revenue,
            ];
        }
        $this->data = $formattedData;
    }

    public function filterResults()
    {
        $this->by_date = 0;
        $this->start = $this->filterStart;
        $this->end = $this->filterEnd;
    }

    public function render()
    {  
        switch ($this->by_date) {
            case 7:
                $this->end = Carbon::now();
                $this->start = Carbon::now()->subDays(7);
                $this->loadDataChart();
                $this->refresh();
                break;
            case 90:
                $this->end = Carbon::now()->subDays(30);
                $this->start = Carbon::now()->subDays(60);
                $this->loadDataChart();
                $this->refresh();
                break;
            case 365:
                $this->end = Carbon::now();
                $this->start = Carbon::now()->subDays(365);
                $this->loadDataChart();
                $this->refresh();
                break;
            case 30:
                $this->end = Carbon::now();
                $this->start = Carbon::now()->subDays(30);
                $this->loadDataChart();
                $this->refresh();
                break;
            default :
                $this->loadDataChart();
                $this->refresh();
                break;
        }

        $quantity_order = Order::where('status', 'ordered')->get()->count();
        $quantity_user = User::where('utype','USR')->get()->count();
        $quantity_product = Product::all()->count();
        $growth_rate = 100*(Order::whereBetween('updated_at', [Carbon::now()->subDays(30), Carbon::now()])->sum('total') - Order::whereBetween('updated_at', [Carbon::now()->subDays(60), Carbon::now()->subDays(30)])->sum('total'))/Order::whereBetween('updated_at', [Carbon::now()->subDays(60), Carbon::now()->subDays(30)])->sum('total');


        $categories = Category::all();

        return view('livewire.admin.admin-dashboard-compoment',
                ['data'=>$this->data,'growth_rate'=>$growth_rate, 'quantity_order'=>$quantity_order,
                'quantity_user'=>$quantity_user, 'quantity_product'=>$quantity_product, 'categories'=>$categories])
                ->layout('admlayouts.base');
    }

    public function goToCategories()
    {
        return redirect()->route('admin.categories');
    }
}
