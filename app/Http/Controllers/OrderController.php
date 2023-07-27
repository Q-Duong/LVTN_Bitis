<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Receiver;
use App\Models\Statistics;
use App\Models\WareHouse;
use Carbon\Carbon;
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
        $order->receiver_id = $receiver->receiver_id;
        $order->save();

        return Redirect::to('admin/order/add/'.$order -> order_id)->with('success', 'Thêm chi tiết đơn hàng');
    }
    function add_order_detail($order_id){
        $order = Order::find($order_id);
        $getAllCategory=Category::orderBy('category_id','asc')->get();
        return view('admin.Order.add_order_detail')->with(compact('order','getAllCategory'));
    }
    function save_order_detail(Request $request){
        $data = $request->all();
        $order_detail = new OrderDetail();
        $order_detail -> order_detail_quantity = $data['order_detail_quantity'];
        $order_detail -> ware_house_id  = $data['ware_house_id'];
        $order_detail -> order_id = $data['order_id'];
        $order_detail -> save();
        return response()->json(array('success' => true,'message' => 'Thêm chi tiết đơn hàng thành công'));
    }
    function delete_order_detail(Request $request)
    {
        $data = $request->all();
        $order_detail = OrderDetail::find($data['order_detail_id']);
        $order_detail->delete();
        return response()->json(array('success' => true, 'message' => 'Xóa chi tiết đơn hàng thành công'));
    }
    function load_order_detail(Request $request){
        $data = $request->all();
        $order_total = 0;
        $getAllOrderDetail = OrderDetail::where('order_id',$data['order_id'])->orderBy('order_detail_id','DESC')->get();
        foreach($getAllOrderDetail as $key => $order_detail){
            $ware_house = WareHouse::find($order_detail -> ware_house_id);
            $order_total += $ware_house->product->product_price * $order_detail -> order_detail_quantity;
        }
        $html = view('admin.Order.load_order_detail')->with(compact('getAllOrderDetail'))->render();
        return response()->json(array('success' => true,'order_total' => $order_total, 'html' => $html));
    }
    function save_order_admin(Request $request,$order_id){
        $data = $request->all();

        $order = Order::find($order_id);
        $order->order_total = $data['order_total'];
        $order->order_status = $data['order_status'];
        $order->order_payment_type = $data['order_payment_type'];
        $order->order_is_paid = $data['order_is_paid'];
        $order->save();

        $receiver = Receiver::find($order->receiver_id);
        $receiver->receiver_first_name = $data['receiver_first_name'];
        $receiver->receiver_last_name = $data['receiver_last_name'];
        $receiver->receiver_phone = $data['receiver_phone'];
        $receiver->receiver_email = $data['receiver_email'];
        $receiver->receiver_note = $data['receiver_note'];
        $receiver->save();
        return Redirect::route('list-order')->with('success', 'cập nhật đơn hàng thành công');
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
            if($data['order_status'] == 2 || $data['order_status'] == 3){
                $order_detail = OrderDetail::where('order_id',$order->order_id)->get();
                foreach ($order_detail as $key => $orderDetails) { 
                    $wareHouse = WareHouse::find($orderDetails->ware_house_id);
                    $wareHouse->ware_house_quantity = $wareHouse->ware_house_quantity - $orderDetails->order_detail_quantity;
                    $wareHouse->save();
                }
                $order->order_status = $data['order_status'];
                $order->order_is_paid = $data['order_is_paid'];
                $order->save();
            }else{
                $order->order_status = $data['order_status'];
                $order->order_is_paid = $data['order_is_paid'];
                $order->save();
            }
        }elseif($order->order_status == 1){
            if($data['order_status'] == 2 ){
                $order_detail = OrderDetail::where('order_id',$order->order_id)->get();
                foreach ($order_detail as $key => $orderDetails) { 
                    $wareHouse = WareHouse::find($orderDetails->ware_house_id);
                    $wareHouse->ware_house_quantity = $wareHouse->ware_house_quantity - $orderDetails->order_detail_quantity;
                    $wareHouse->save();
                }
                $order->order_status = $data['order_status'];
                $order->order_is_paid = $data['order_is_paid'];
                $order->save();
            }else{
                $order->order_status = $data['order_status'];
                $order->order_is_paid = $data['order_is_paid'];
                $order->save();
            }
        }else{
            if($data['order_status'] == 3){
                $order->order_status = $data['order_status'];
                $order->order_is_paid = $data['order_is_paid'];
                $order->save();
            }else{
                $order_detail = OrderDetail::where('order_id',$order->order_id)->get();
                foreach ($order_detail as $key => $orderDetails) { 
                    $wareHouse = WareHouse::find($orderDetails->ware_house_id);
                    $wareHouse->ware_house_quantity = $wareHouse->ware_house_quantity + $orderDetails->order_detail_quantity;
                    $wareHouse->save();
                }
                $order->order_status = $data['order_status'];
                $order->order_is_paid = $data['order_is_paid'];
                $order->save();
            }
        }
        
        $order_date =Carbon::now('Asia/Ho_Chi_Minh')->toDateString();	
		$statistic = Statistics::where('order_date',$order_date)->get();
		
		if($statistic){
			$statistic_count = $statistic->count();	
		}else{
			$statistic_count = 0;
		}	
		if($order->order_status == 3 ){
            $total_quantity = 0;
            $order_detail = OrderDetail::where('order_id',$order->order_id)->get();
                foreach ($order_detail as $key => $orderDetails) { 
                    $total_quantity += $orderDetails -> order_detail_quantity;
                }
			if($statistic_count>0){
				$statistic_update = Statistics::where('order_date',$order_date)->first();
				$statistic_update->total_price += $order->order_total;
				$statistic_update->total_quantity += $total_quantity;
				$statistic_update->total_sale = $statistic_update->total_sale + 1;
				$statistic_update->save();
			}else{
				$statistic_new = new Statistics();
				$statistic_new->order_date = $order_date;
				$statistic_new->total_price = $order->order_total;
				$statistic_new->total_quantity =  $total_quantity;
				$statistic_new->total_sale = 1;
				$statistic_new->save();
			}
		}
        
        return Redirect()->back()->with('success','Cập nhật thành công');
    }
    function delete_order($order_code){
        $order=Order::where('order_code',$order_code)->first();
        $receiver=Receiver::find($order->receiver_id);
        $receiver->delete();
        return redirect()->back()->with('success','Xóa thành công');
    }
    //Validate
}