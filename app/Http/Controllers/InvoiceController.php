<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function downloadInvoice($order_id)
    {
        $order = Order::find($order_id);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('admlayouts.generate-invoice', $data);
        $todayDate = Carbon::now()->format('d-m-Y');

        return $pdf->download('invoice'.$order_id.'-'.$todayDate.'.pdf');
    }
}
