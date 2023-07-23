<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Statistics;
use App\Models\User;
use Carbon\Carbon;

class DashBoardController extends Controller
{
    function index(){
        $product_count = Product::get()->count();
        $post_count= Post::get()->count();
        $order_count = Order::get()->count();
        $app_customer = User::where('role',2)->get()->count();
        // dd($product_count);
        return view('admin.dashboard')->with(compact('product_count','post_count','order_count','app_customer'));
    }
    function get_statistics_in_month(){
        $firstThisMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $getStatistics = Statistics::whereBetween('order_date',[$firstThisMonth,$now])->orderBy('order_date','ASC')->get();
        foreach($getStatistics as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'price' => $val->total_price,
                'sales' => $val->total_sale,
                'quantity' => $val->total_quantity
            );
        }
        dd($chart_data);
        $data = $chart_data;
        return response($data); 
    }
    function get_statistics_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $getStatistics = Statistics::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach($getStatistics as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'price' => $val->total_price,
                'sales' => $val->total_sale,
                'quantity' => $val->total_quantity
            );
        }
        $data = $chart_data;
        return response($data); 
    }
}
 