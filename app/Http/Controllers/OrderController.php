<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    function add_order()
    {
        return view('admin.Order.add_order');
    }
    function save_order(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $order = new Order();
        $order_code = substr(md5(microtime()), rand(0, 26), 20);
        $order->order_code = $order_code;
        $order->order_total = $data['order_total'];
        $order->order_status = $data['order_status'];
        $order->order_payment_type = $data['order_payment_type'];
        $order->order_is_paid = 0;
        $order->save();
        return Redirect()->back()->with('success', 'Thêm đơn thành công');
    }
    
}