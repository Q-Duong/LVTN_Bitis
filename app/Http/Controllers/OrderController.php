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
        $receiver = new Receiver();
        $receiver->receiver_first_name = $data['receiver_first_name'];
        $receiver->receiver_last_name = $data['receiver_last_name'];
        $receiver->receiver_phone = $data['receiver_phone'];
        $receiver->receiver_email = $data['receiver_email'];
        $receiver->receiver_note = $data['receiver_note'];
        $receiver->save();

        $order = new Order();
        $order_code = substr(md5(microtime()), rand(0, 26), 20);
        $order->order_code = $order_code;
        $order->order_total = 0;
        $order->order_status = $data['order_status'];
        $order->order_payment_type = $data['order_payment_type'];
        $order->order_is_paid = $data['order_is_paid'];
        $order->order_total = $data['total'];
        $order->receiver_id = $receiver->receiver_id;
        $order->save();
        
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
        $order_detail = OrderDetail::where('order_id',$order->order_id)->get();
        return view('admin.order.edit_order')->with(compact('order','order_detail'));
    }
    function update_order_detail_quantity(Request $request){
        $data = $request->all();
        $checkQuantity = WareHouse::find($data['ware_house_id']);
        if($checkQuantity -> ware_house_quantity >= $data['order_detail_quantity']){
            $order_detail = OrderDetail::find($data['order_detail_id']);
            $product_price = $order_detail -> wareHouse -> product -> product_price;
            $total_price_details = $product_price * $order_detail->order_detail_quantity;
            $sub_total = $product_price * $data['order_detail_quantity'];

            $order = Order::find($data['order_id']);
            $order->order_total = $order->order_total - $total_price_details + $sub_total;
            $order->save();

            $order_detail->order_detail_quantity = $data['order_detail_quantity'];
            $order_detail->save();

            return response()->json(array('message'=>'Cập nhật số lượng thành công','order_detail_id'=>$data['order_detail_id'],'sub_total'=>$sub_total,'order_total'=>$order->order_total,'status'=>'success'));
        }else{
            return response()->json(array('message'=>'Số lượng trong kho không đủ. Vui lòng kiểm tra lại!','status'=>'error'));
        }
    }
    function update_order(Request $request,$order_code){
        $data = $request->all();
        $order = Order::where('order_code',$order_code)->first();
        if($order->order_status == 0){
            if($data['order_status'] == 1){
                $order_detail = OrderDetail::where('order_id',$order->order_id)->get();
                foreach ($order_detail as $key => $orderDetails) { 
                    $wareHouse = WareHouse::find($orderDetails->ware_house_id);
                    $wareHouse->ware_house_quantity = $wareHouse->ware_house_quantity - $orderDetails->order_detail_quantity;
                    $wareHouse->save();
                }
                $order->order_status = $data['order_status'];
                $order->save();
            }else{
                $order->order_status = $data['order_status'];
                $order->save();
            }
        }else{
            if($data['order_status'] == 2){
                $order->order_status = $data['order_status'];
                $order->save();
            }else{
                $order_detail = OrderDetail::where('order_id',$order->order_id)->get();
                foreach ($order_detail as $key => $orderDetails) { 
                    $wareHouse = WareHouse::find($orderDetails->ware_house_id);
                    $wareHouse->ware_house_quantity = $wareHouse->ware_house_quantity + $orderDetails->order_detail_quantity;
                    $wareHouse->save();
                }
                $order->order_status = $data['order_status'];
                $order->save();
            }
        }
        
        return Redirect()->back()->with('success','Cập nhật thành công');
        
    }

}