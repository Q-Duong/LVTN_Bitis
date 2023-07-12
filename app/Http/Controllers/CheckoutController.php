<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use App\Models\Receiver;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\WareHouse;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function checkout(Request $request){
        
        if(empty($request->sessionId)){
            $order_total = 0;
            $receiver= new Receiver();
            $receiver -> save();

            $order_code = substr(md5(microtime()),rand(0,26),20);
            $order = new Order();
            $order -> order_code = $order_code;
            $order -> order_status = 0;
            $order -> order_is_paid = 0;
            $order -> order_payment_type = 0;
            $order -> receiver_id = $receiver->receiver_id;
            $order -> save();

            foreach($request->cart as $key => $cart){
                $order_detail = new OrderDetail();
                $ware_house = WareHouse::find($cart['id']);
                $order_total += $ware_house -> product -> product_price;
                $order_detail -> order_id = $order -> order_id;
                $order_detail -> order_detail_quantity = $cart['quantity'];
                $order_detail -> ware_house_id = $cart['id'];
                $order_detail->save();
            }
            
            $order -> order_total = $order_total;
            $order -> save();

            return response()->json(array('order_code'=>$order_code,'route'=>'checkout'));
        }else{
            $order_code = $request->sessionId['sessionId'];
            return response()->json(array('order_code'=>$order_code,'route'=>'payment'));
        }
    }
    public function checkout_step_1($order_code){
        $code = $order_code;
        $order = Order::where('order_code',$order_code)->first();
        $order_detail = OrderDetail::where('order_id',$order->order_id)->first();
        $receiver = Receiver::find($order->receiver_id);
        $city = City::orderby('city_name','ASC')->get();
        if($receiver->city_id != null){
            $district = District::where('city_id',$receiver->city_id)->orderby('district_name','ASC')->get();
            $ward = Ward::where('district_id',$receiver->district_id)->orderby('ward_name','ASC')->get();
            return view('pages.checkout.checkout')->with(compact('code','order','order_detail','receiver','city','district','ward'));
        }
        return view('pages.checkout.checkout')->with(compact('code','city','order','order_detail','receiver'));
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
        $order = Order::find($data['order_id']);
        $receiver = Receiver::find($order->receiver_id);
        $receiver -> receiver_first_name = $data['receiver_first_name'];
        $receiver -> receiver_last_name = $data['receiver_last_name'];
        $receiver -> receiver_phone = $data['receiver_phone'];
        $receiver -> receiver_email = $data['receiver_email'];
        $receiver -> receiver_note = $data['receiver_note'];
        $receiver -> receiver_address = $data['receiver_address'];
        $receiver -> city_id = $data['city_id'];
        $receiver -> district_id = $data['district_id'];
        $receiver -> ward_id = $data['ward_id'];
        $receiver -> save();

        $order_code = $order -> order_code;
        return response()->json(array('order_code'=>$order_code));
        
    }
    public function payment($order_code){
        $code=$order_code;
        return view('pages.checkout.payment')->with(compact('code'));
    }
    public function payment_method(Request $request){
        $data = $request->all();
        
        if($data['payment_method'] == 'cash'){
            $order = Order::where('order_code',$data['order_code'])->first();
            $order -> order_status = 0;
            $order -> save();
            return response()->json(array('url'=>'handcash','type'=>'cash'));
        }else{
            $order = Order::where('order_code',$data['order_code'])->first();
            $url =  $this -> momo($order);
            // $order -> order_status = 1;
            // $order -> save();
            
            return response()->json(array('url'=>$url,'type'=>'momo'));
        }
    }
    public function handcash(){
        return view('pages.checkout.handcash');
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
    public function momo($order){
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = (string)$order -> order_total;
        $orderId = $order -> order_code;
        $returnUrl = "https://b5fa-42-115-103-118.ap.ngrok.io/handcash";
        $notifyurl = "https://b5fa-42-115-103-118.ap.ngrok.io/handcash";
        
        $extraData = "merchantName=MoMo Partner";
        $requestId = time() . "";
        $requestType = "captureMoMoWallet";
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        
        $data =  array('partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result,true);  
        // decode json
       return $jsonResult['payUrl'];
    }

    public function query_transaction(){
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $requestId = time() . "";
        $requestType = "transactionStatus";

        $orderId = "945e294403e9445";// Mã đơn hàng cần kiểm tra trạng thái

        $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&orderId=".$orderId."&requestType=".$requestType;
        
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        
        $data = array('partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'orderId' => $orderId,
            'requestType' => $requestType,
            'signature' => $signature);
        $result =  $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
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