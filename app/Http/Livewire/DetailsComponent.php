<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\DetailOrder;
use App\Models\Evaluate;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Cart;

class DetailsComponent extends Component
{
    public $slug;
    public $qty;

    public $evaluate_5;
    public $evaluate_4;
    public $evaluate_3;
    public $evaluate_2;
    public $evaluate_1;

    public $content;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;
        $this->numberOfReviews();
        // dd($this->evaluate_5);
    }

    public function numberOfReviews()
    {
        $product = Product::where('slug', $this->slug)->first();
        $this->evaluate_5 = DB::table('evaluates')
            ->join('detail_orders', 'evaluates.detail_orders_id', '=', 'detail_orders.id')
            ->where('evaluates.star', 5)
            ->where('detail_orders.product_id', $product->id)
            ->where('detail_orders.rstatus', 1)
            ->count();
        $this->evaluate_4 = DB::table('evaluates')
            ->join('detail_orders', 'evaluates.detail_orders_id', '=', 'detail_orders.id')
            ->where('evaluates.star', 4)
            ->where('detail_orders.product_id', $product->id)
            ->where('detail_orders.rstatus', 1)
            ->count();
        $this->evaluate_3 = DB::table('evaluates')
            ->join('detail_orders', 'evaluates.detail_orders_id', '=', 'detail_orders.id')
            ->where('evaluates.star', 3)
            ->where('detail_orders.product_id', $product->id)
            ->where('detail_orders.rstatus', 1)
            ->count();
        $this->evaluate_2 = DB::table('evaluates')
            ->join('detail_orders', 'evaluates.detail_orders_id', '=', 'detail_orders.id')
            ->where('evaluates.star', 2)
            ->where('detail_orders.product_id', $product->id)
            ->where('detail_orders.rstatus', 1)
            ->count();
        $this->evaluate_1 = DB::table('evaluates')
            ->join('detail_orders', 'evaluates.detail_orders_id', '=', 'detail_orders.id')
            ->where('evaluates.star', 1)
            ->where('detail_orders.product_id', $product->id)
            ->where('detail_orders.rstatus', 1)
            ->count();
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name,$this->qty, $product_price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component','refreshComponent');
        toastr()->success('', 'Thêm vào giỏ hàng thành công');
        return redirect()->back();
    }

    public function storeBuy($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name,$this->qty, $product_price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component','refreshComponent');
        return redirect()->route('product.cart');
    }

    public function increaseQuantity() {
        $this->qty++;
    }

    public function decreseQuantity() {
        if($this->qty > 1) {
            $this->qty--;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'content' => 'required'
        ]);
    }

    public function addComment()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }else{
            $this->validate([
                'content' => 'required'
            ]);
            $product = Product::where('slug', $this->slug)->first();
            $comment = new Comment();
            $comment->content =$this->content;
            $comment->product_id = $product->id;
            $comment->user_id  = Auth::user()->id;
            $comment->save();
            $this->reset('content');
        }
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $productdetail = ProductDetails::where('product_id',$product->id)->first();
        $related_products = Product::where('subcategory_id', $product->subcategory_id)->limit(5)->get();
        $detailOrder = DetailOrder::where('product_id',$product->id)->where('rstatus', 1)->get();
        $avg_evaluate = number_format(DB::table('evaluates')
                ->join('detail_orders', 'evaluates.detail_orders_id', '=', 'detail_orders.id')
                ->where('detail_orders.product_id', $product->id)
                ->avg('star'), 1);
        $comments = Comment::where('product_id',$product->id)->orderBy('created_at','DESC')->get();
        return view('livewire.details-component', ['product'=>$product, 'related_products'=>$related_products, 'productdetail'=>$productdetail, 'detailOrder'=>$detailOrder, 'avg_evaluate'=>$avg_evaluate,'comments'=>$comments])->layout('layouts.base');
    }
}
