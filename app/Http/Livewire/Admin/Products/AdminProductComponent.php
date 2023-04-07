<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class AdminProductComponent extends Component
{
    use WithPagination;

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $nameproduct = $product->name;
            if($product->image) {
                $imagePath = 'assets/imgs/products/' . $product->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $product->delete();
            session()->flash('massage', 'Xóa sản phẩm '.$nameproduct.' thành công!');
        }
        if(session('tasks_url')){
            return redirect(session('tasks_url'));
        }
        return redirect()->route('admin.products');
    }

    public function render()
    {
        $products = Product::paginate(10);
        Session::put('tasks_url', request()->fullUrl());
        return view('livewire.admin.products.admin-product-component',['products'=>$products])->layout('admlayouts.base');
    }
}
