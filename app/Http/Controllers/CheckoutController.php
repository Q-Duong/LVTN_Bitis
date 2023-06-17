<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Models\User;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use App\Models\Receiver;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function checkout(){

        $city = City::orderby('city_name','ASC')->get();
    	return view('pages.checkout.checkout')->with(compact('city'));
    }
    public function select_address(Request $request){
        $data = $request->all();
    	if($data['action']){
    		$result = '';
    		if($data['action']=="city"){
    			$select_district = District::where('city_id',$data['select_id'])->orderby('district_name','ASC')->get();
    				$result.='<option>--Chọn quận / huyện--</option>';
    			foreach($select_district as $key => $district){
    				$result.='<option value="'.$district->district_id.'">'.$district->district_name.'</option>';
    			}
    		}else{
    			$select_ward = Ward::where('district_id',$data['select_id'])->orderby('ward_name','ASC')->get();
    			$result.='<option>--Chọn phường / xã--</option>';
    			foreach($select_ward as $key => $ward){
    				$result.='<option value="'.$ward->ward_id.'">'.$ward->ward_name.'</option>';
    			}
    		}
    		return response()->json(array('result'=>$result));
    	}
    }
    public function save_checkout_information(Request $request){
        $data = $request->all();
       
        $order_code = substr(md5(microtime()),rand(0,26),20);
        $order = new Order();
        $order -> order_code = $order_code;
        $order -> order_total = 0;
        $order -> order_status = 1;
        $order -> order_is_paid = 0;
        $order -> order_payment_type = 0;
        $order -> save();

        $receiver= new Receiver();
        $receiver -> receiver_first_name = $data['receiver_first_name'];
        $receiver -> receiver_last_name = $data['receiver_last_name'];
        $receiver -> receiver_phone = $data['receiver_phone'];
        $receiver -> receiver_email = $data['receiver_email'];
        $receiver -> receiver_note = $data['receiver_note'];
        $receiver -> receiver_address = $data['receiver_address'];
        $receiver -> city_id = $data['city_id'];
        $receiver -> district_id = $data['district_id'];
        $receiver -> ward_id = $data['ward_id'];
        $receiver -> order_id = $order -> order_id;
        $receiver -> save();

        foreach($request->cart as $key=>$cart){
            $order_detail = new OrderDetail();
            $order_detail -> order_id = $order -> order_id;
            $order_detail -> order_detail_quantity = $cart['quantity'];
            $order_detail -> ware_house_id = $cart['id'];
            $order_detail->save();
        }
        $code=$order->order_code;
        return response()->json(array('code'=>$code));
        
    }
    public function payment($order_code){
        $code=$order_code;
        return view('pages.checkout.payment')->with(compact('code'));
    }
    function execPostRequest($url, $data){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momo(Request $request){
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = "10000";
        $orderId = time() . "";
        $returnUrl = "https://2d51-2001-ee0-4fc2-ab80-7069-f35b-c286-6e00.ap.ngrok.io/checkout/f1827dc684144f3aed3d";
        $notifyurl = "https://2d51-2001-ee0-4fc2-ab80-7069-f35b-c286-6e00.ap.ngrok.io/checkout/f1827dc684144f3aed3d";
        
        $bankCode = "SML";
        
        $requestId = time() . "";
        $requestType = "payWithMoMoATM";
        $extraData = "";
       
        $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderId."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        
        $data =  array('partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'bankCode' => $bankCode,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result,true);  // decode json
                
       return Redirect::to($jsonResult['payUrl']);
    }

	public function order_place(Request $request){
        //Insert payment_method
     
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //Insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //Insert order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if($data['payment_method']==1){

            echo 'Thanh toán thẻ ATM';

        }else{
            Cart::destroy();

            $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

            $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();
           
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('category_post',$category_post)->with('category_post',$category_post);

        }
        
        //return Redirect::to('/payment');
    }

    
    

    public function confirm_order(Request $request){
        $data = $request->all();

        if($data['order_coupon']!='no'){
            $coupon = Coupon::where('coupon_code',$data['order_coupon'])->first();
            $coupon->coupon_used = $coupon->coupon_used.','.Session::get('customer_id');
            $coupon->coupon_time = $coupon->coupon_time - 1;
            $coupon_mail = $coupon->coupon_code;
            $coupon->save();
        }else{
            $coupon_mail = 'không sử dụng mã';
        }

        $this->checkOrder($request);

        $shipping = new Shipping();
        $shipping->shipping_first_name = $data['shipping_first_name'];
        $shipping->shipping_last_name = $data['shipping_last_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->matp = $data['city'];
        $shipping->maqh = $data['province'];
        $shipping->maxp = $data['wards'];

        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);

        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');;
        $order->created_at = $today;
        $order->order_date = $order_date;
        $order->save();
        
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->product_fee_ship =  $data['order_fee_ship'];
                $order_details->save();
            }
        }


        //send mail confirm
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');

        $title_mail = "Đơn hàng xác nhận ngày".' '.$now;

        $customer = Customer::find(Session::get('customer_id'));
            
        $data['email'][] = $customer->customer_email;
        //Lấy giỏ hàng
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart_mail){
            $cart_array[] = array(
                'product_name' => $cart_mail['product_name'],
                'product_price' => $cart_mail['product_price'],
                'product_qty' => $cart_mail['product_qty']
            );
            }
        }
        $shipping_array = array(
            'customer_first_name' => $customer->customer_first_name,
            'customer_last_name' => $customer->customer_last_name,
            'shipping_first_name' => $data['shipping_first_name'],
            'shipping_last_name' => $data['shipping_last_name'],
            'shipping_email' => $data['shipping_email'],
            'shipping_phone' => $data['shipping_phone'],
            'shipping_address' => $data['shipping_address'],
            'shipping_notes' => $data['shipping_notes'],
            'shipping_method' => $data['shipping_method']
            
        );
        //Lấy mã giảm giá, Lấy coupon code
        $ordercode_mail = array(
            'coupon_code' => $coupon_mail,
            'order_code' => $checkout_code,
        );

        Mail::send('pages.mail.mail_order',  ['cart_array'=>$cart_array, 'shipping_array'=>$shipping_array ,'code'=>$ordercode_mail] , function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);//send this mail with subject
            $message->from($data['email'],'AppleStore');//send from this mail
        });
        
        Session::forget('coupon');
        Session::forget('cart');
        
   }

   public function handcash(){
    $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

    $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();
    return view('pages.checkout.handcash')->with('category',$cate_product)->with('category_post',$category_post);
   }
   //Validation
   public function checkOrder(Request $request){
    $this-> validate($request,
    [
        'shipping_first_name' => 'required',
        'shipping_last_name' => 'required',
        'shipping_email' => 'required|email|unique:users,email',
        'shipping_phone' => 'required|numeric|digits_between:10,10',
        'shipping_address' => 'required',
    ],
    [
        'shipping_first_name.required' =>'Vui lòng điền họ và tên lót',
        'shipping_last_name.required' =>'Vui lòng điềny tên',
        'shipping_email.required' =>'Vui lòng điền email',
        'shipping_phone.required' =>'Vui lòng điền số điện thoại',
        'shipping_address.required' =>'Vui lòng điền địa chỉ',
        'shipping_email.email' =>'Vui lòng kiểm tra lại email',
        'shipping_phone.digits_between' =>'Vui lòng kiểm tra lại số điện thoại',
        'shipping_phone.numeric' =>'Vui lòng kiểm tra lại số điện thoại',
        
    ]);
}

}