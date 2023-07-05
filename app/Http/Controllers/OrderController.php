<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Receiver;
use App\Models\WareHouse;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    function add_order()
    {
        $getAllCategory=Category::orderBy('category_id','asc')->get();
        $getAllWareHouse = WareHouse::orderBy('ware_house_id')->get();
        return view('admin.Order.add_order')->with(compact('getAllWareHouse','getAllCategory'));
    }
    function save_order(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $order = new Order();
        $order_code = substr(md5(microtime()), rand(0, 26), 20);
        $order->order_code = $order_code;
        $order->order_total = 0;
        $order->order_status = $data['order_status'];
        $order->order_payment_type = $data['order_payment_type'];
        $order->order_is_paid = $data['order_is_paid'];
        $order->order_total=$data['total'];
        $order->save();
        $receiver = new Receiver();
        $receiver->receiver_first_name = $data['receiver_first_name'];
        $receiver->receiver_last_name = $data['receiver_last_name'];
        $receiver->receiver_phone = $data['receiver_phone'];
        $receiver->receiver_email = $data['receiver_email'];
        $receiver->receiver_note = $data['receiver_note'];
        $receiver->order_id = $order->order_id;
        $receiver->save();
        foreach ($data['ware_house_id'] as $key => $warehoue) {
            $order_detail = new OrderDetail();
            $order_detail->order_detail_quantity = $data['order_detail_quantity'][$key];
            $order_detail->ware_house_id = $data['ware_house_id'][$key];
            $order_detail->order_id = $order->order_id;
            $order_detail->save();
        }
        return Redirect()->back()->with('success', 'Thêm đơn thành công');
    }
    function list_order()
    {
        $getListOrder = Order::orderBy('order_id','desc')->get();
        return view('admin.Order.list_order')->with(compact('getListOrder'));
    }
    function edit_order($order_code){
        $order = Order::where('order_code',$order_code)->first();
        $receiver = Receiver::where('order_id',$order->order_id)->first();
        $order_detail = OrderDetail::where('order_id',$order->order_id)->get();
        return view('admin.order.edit_order')->with(compact('order','receiver','order_detail'));
    }
    function update_order(Request $request,$order_code){
        $data = $request->all();
        
        $order = Order::where('order_code',$order_code)->first();
        $order->order_status = $data['order_status'];
        $order->order_payment_type = $data['order_payment_type'];
        $order->save();
        return Redirect()->back()->with('success','Cập nhật thành công');
        
    }

}