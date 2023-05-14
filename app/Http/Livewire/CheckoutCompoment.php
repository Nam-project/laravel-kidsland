<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Wards;
use App\Models\City;
use App\Models\Province;
use App\Models\Order;
use App\Models\DetailOrder;
use App\Models\Transaction;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutCompoment extends Component
{

    public $city_id;
    public $province_id;
    public $ward_id;
    public $name;
    public $phone;
    public $address;

    public $thankyou;

    public $payment;
    
    public function mount(Request $request)
    {
        $this->payment = "cod";
        if ($request->has('vnp_ResponseCode')) {
            $responseCode = $request->input('vnp_ResponseCode');
            $order_id = intval(preg_replace('/\D/', '', $request->input('vnp_TxnRef')));
            $order = Order::find($order_id);
            if ($responseCode == '00') {
                foreach ($order->detailOrder as $item) {
                    $item->product->can_sell = $item->product->can_sell - $item->count;
                    $item->product->save();
                }
                $this->makeTransaction($order_id,'paypal','approved');
                $this->resetCart();
                return redirect()->route('thankyou');
            } else {
                if ($order) {
                    $order->delete();
                }
            }
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'ward_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric'
        ]);
    }

    public function placeOrder()
    {
        // dd(session()->get('checkout')['subtotal']);
        $this->validate([
            'ward_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric'
        ]);

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->ward_id = $this->ward_id;
        $order->name = $this->name;
        $order->phone =  $this->phone;
        $order->address = $this->address;
        $order->save();

        foreach(Cart::instance('cart')->content() as $item)
        {
            $orderItem = new DetailOrder();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->count = $item->qty;
            $orderItem->save();
            if ($this->payment == 'cod') {
                $product = Product::find($item->id);
                $product->can_sell = $product->can_sell - $orderItem->count;
                $product->save();
            }
        }

        if ($this->payment == 'cod') {
            $this->makeTransaction($order->id,'cod','pending');
        }

        $this->thankyou = 1;

        // vnPay
        if ($this->payment == 'vnpay') {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('checkout');
            $vnp_TmnCode = "SR4U6ZON";//Mã website tại VNPAY 
            $vnp_HashSecret = "ZFVOGTSNRWHQOTZMJEZAGNLFTOEPAECH"; //Chuỗi bí mật

            $vnp_TxnRef = 'MaDH'.$order->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Test VNPAY';
            $vnp_Amount = session()->get('checkout')['subtotal'] * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
            // $vnp_ExpireDate = $_POST['txtexpire'];
            //Billing
            
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            return redirect()->away($vnp_Url);
        }

        // end vnPay
        $this->resetCart();
    }

    public function makeTransaction($order_id, $mode, $status)
    {
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->order_id = $order_id;
        $transaction->mode = $mode;
        $transaction->status = $status;
        $transaction->save();
    }

    public function verifyForCheckout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }else if($this->thankyou){
            return redirect()->route('thankyou');
        }else if(!session()->get('checkout')){
            return redirect()->route('product.cart');
        }
    }

    public function resetCart()
    {
        Cart::instance('cart')->destroy();
        Cart::instance('cart')->store(Auth::user()->email);
        session()->forget('checkout');
    }

    public function render()
    {
    
        $this->verifyForCheckout();

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
        
        return view('livewire.checkout-compoment',['cities'=>$cities,'provinces'=>$provinces,'wards'=>$wards])->layout("layouts.base");
    }
}
