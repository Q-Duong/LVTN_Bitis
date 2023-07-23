<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Delivery;
use App\Models\District;
use App\Models\Ward;
use App\Models\Receiver;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\WareHouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {

        if (empty($request->sessionId)) {
            $order_total = 0;
            $receiver = new Receiver();
            $receiver->save();
            $order_code = substr(md5(microtime()), rand(0, 26), 20);
            $order = new Order();
            $order->order_code = $order_code;
            $order->order_status = 0;
            $order->order_is_paid = 0;
            $order->order_payment_type = 0;
            $order->receiver_id = $receiver->receiver_id;
            $order->save();
            foreach ($request->cart as $key => $cart) {
                $order_detail = new OrderDetail();
                $ware_house = WareHouse::find($cart['id']);
                $order_total += $ware_house->product->product_price * $cart['quantity'];
                $order_detail->order_id = $order->order_id;
                $order_detail->order_detail_quantity = $cart['quantity'];
                $order_detail->ware_house_id = $cart['id'];
                $order_detail->save();
            }
            $order->order_total = $order_total;
            $order->save();
            return response()->json(array('order_code' => $order_code, 'route' => 'checkout'));
        } else {
            return response()->json(array('order_code' => $request->sessionId['sessionId'], 'route' => 'payment'));
        }
    }
    public function member_checkout(Request $request)
    {
        if (Auth::user()->role != 0) {
            if (empty($request->sessionId)) {
                $order_total = 0;
                $delivery = Delivery::where('user_id', Auth::id())->first();
                if ($delivery != null) {
                    $receiver = new Receiver();
                    $receiver->receiver_first_name = $delivery->delivery_first_name;
                    $receiver->receiver_last_name = $delivery->delivery_last_name;
                    $receiver->receiver_phone = $delivery->delivery_phone;
                    $receiver->receiver_email = $delivery->delivery_email;
                    $receiver->receiver_address = $delivery->delivery_address;
                    $receiver->city_id = $delivery->city_id;
                    $receiver->district_id = $delivery->district_id;
                    $receiver->ward_id = $delivery->ward_id;
                    $receiver->save();
                } else {
                    $receiver = new Receiver();
                    $receiver->receiver_first_name = Auth::user()->profile->profile_firstname;
                    $receiver->receiver_last_name = Auth::user()->profile->profile_lastname;
                    $receiver->receiver_phone = Auth::user()->profile->profile_phone;
                    $receiver->receiver_email = Auth::user()->profile->profile_email;
                    $receiver->save();
                }
                $order_code = substr(md5(microtime()), rand(0, 26), 20);
                $order = new Order();
                $order->order_code = $order_code;
                $order->order_status = 0;
                $order->order_is_paid = 0;
                $order->order_payment_type = 0;
                $order->user_id = Auth::id();
                $order->receiver_id = $receiver->receiver_id;
                $order->save();

                foreach ($request->cart as $key => $cart) {
                    $order_detail = new OrderDetail();
                    $ware_house = WareHouse::find($cart['id']);
                    $order_total += $ware_house->product->product_price * $cart['quantity'];
                    $order_detail->order_id = $order->order_id;
                    $order_detail->order_detail_quantity = $cart['quantity'];
                    $order_detail->ware_house_id = $cart['id'];
                    $order_detail->save();
                }
                $order->order_total = $order_total;
                $order->save();
                return response()->json(array('order_code' => $order_code, 'route' => 'checkout'));
            } else {
                return response()->json(array('order_code' => $request->sessionId['sessionId'], 'route' => 'payment'));
            }
        } else {
            Auth::logout();
            return response()->json(array('role' => 0, 'route' => 'member/login'));
        }

    }
    public function checkout_step_1($order_code)
    {
        $order = Order::where('order_code', $order_code)->first();
        $getAllOrderDetail = OrderDetail::where('order_id', $order->order_id)->get();
        $city = City::orderby('city_name', 'ASC')->get();
        if ($order->receiver->city_id != null) {
            $district = District::where('city_id', $order->receiver->city_id)->orderby('district_name', 'ASC')->get();
            $ward = Ward::where('district_id', $order->receiver->district_id)->orderby('ward_name', 'ASC')->get();
            return view('pages.checkout.checkout')->with(compact('order', 'getAllOrderDetail', 'city', 'district', 'ward'));
        }
        return view('pages.checkout.checkout')->with(compact('city', 'order', 'getAllOrderDetail'));
    }
    public function select_address(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $result = '';
            if ($data['action'] == "city") {
                $select_district = District::where('city_id', $data['select_id'])->orderby('district_name', 'ASC')->get();
                $result .= '<option>--Chọn quận / huyện--</option>';
                foreach ($select_district as $key => $district) {
                    $result .= '<option value="' . $district->district_id . '">' . $district->district_name . '</option>';
                }
            } else {
                $select_ward = Ward::where('district_id', $data['select_id'])->orderby('ward_name', 'ASC')->get();
                $result .= '<option>--Chọn phường / xã--</option>';
                foreach ($select_ward as $key => $ward) {
                    $result .= '<option value="' . $ward->ward_id . '">' . $ward->ward_name . '</option>';
                }
            }
            return response()->json(array('result' => $result));
        }
    }
    public function save_checkout_information(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationInfomation(), $this->messageInfomation());
        if ($validator->fails()) {
            return response()->json(array('errors' => true, 'validator' => $validator->errors()));
        }
        $data = $request->all();
        // dd($data);
        $order = Order::find($data['order_id']);
        $receiver = Receiver::find($order->receiver_id);
        $receiver->receiver_first_name = $data['receiver_first_name'];
        $receiver->receiver_last_name = $data['receiver_last_name'];
        $receiver->receiver_phone = $data['receiver_phone'];
        $receiver->receiver_email = $data['receiver_email'];
        $receiver->receiver_note = $data['receiver_note'];
        $receiver->receiver_address = $data['receiver_address'];
        $receiver->city_id = $data['city_id'];
        $receiver->district_id = $data['district_id'];
        $receiver->ward_id = $data['ward_id'];
        $receiver->save();
        $order_code = $order->order_code;
        return response()->json(array('order_code' => $order_code));

    }
    public function payment($order_code)
    {
        $order = Order::where('order_code', $order_code)->first();
        if (
            $order->receiver->city_id == null ||
            $order->receiver->district_id == null ||
            $order->receiver->ward_id == null ||
            $order->receiver->receiver_address == null
        ) {
            return Redirect::to('checkout/' . $order_code);
        } else {
            $code = $order_code;
            return view('pages.checkout.payment')->with(compact('code'));
        }
    }
    public function payment_method(Request $request)
    {
        $data = $request->all();

        if ($data['payment_method'] == 'cash') {
            $order = Order::where('order_code', $data['order_code'])->first();
            $order->order_status = 1;
            $order->save();
            $order_detail = OrderDetail::where('order_id',$order->order_id)->get();
            Mail::send('pages.mail.mail_order',array('order'=>$order,'order_detail'=>$order_detail),function($message) use ($order){
                $message->to($order -> receiver -> receiver_email)->subject('Thông báo đơn hàng');
                $message->from('tminhan398@gmail.com','Bitis');
            });
            return response()->json(array('url' => 'handcash', 'type' => 'cash'));
        } else {
            $order = Order::where('order_code', $data['order_code'])->first();
            $order->order_status = 1;
            $order->order_payment_type = 1;
            $order->order_is_paid = 1;
            $order->save();
            $order_detail = OrderDetail::where('order_id', $order->order_id)->get();
            Mail::send('pages.mail.mail_order', array('order' => $order, 'order_detail' => $order_detail), function ($message) use ($order) {
                $message->to($order->receiver->receiver_email)->subject('Thông báo đơn hàng');
                $message->from('tminhan398@gmail.com', 'Bitis');
            });
            $url = $this->momo($order);
            return response()->json(array('url' => $url, 'type' => 'momo'));
        }
    }
    public function handcash()
    {
        return view('pages.checkout.handcash');
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momo($order)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = (string) $order->order_total;
        $orderId = $order->order_code;
        $redirectUrl = "https://b5fa-42-115-103-118.ap.ngrok.io/handcash";
        $ipnUrl = "https://b5fa-42-115-103-118.ap.ngrok.io/handcash";
        $extraData = "merchantName=MoMo Partner";
        $requestId = time() . "";
        $requestType = "captureWallet";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data =  array(
            'partnerCode' => $partnerCode,
            "storeId" => "MomoTestStore",
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);
        // decode json
        return $jsonResult['payUrl'];
    }

    public function momotest()
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = "10000";
        $orderId = time() . "";
        $redirectUrl = "https://b5fa-42-115-103-118.ap.ngrok.io/handcash";
        $ipnUrl = "https://b5fa-42-115-103-118.ap.ngrok.io/handcash";

        $extraData = "merchantName=MoMo Partner";
        $requestId = time() . "";
        $requestType = "captureWallet";
        // $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&redirectUrl=" . $redirectUrl . "&ipnUrl=" . $ipnUrl . "&extraData=" . $extraData;
        // $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
            "storeId" => "MomoTestStore",
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);
        // decode json
        dd($jsonResult);
        return $jsonResult['payUrl'];
    }

    public function query_transaction()
    {
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $requestId = time() . "";
        $requestType = "transactionStatus";

        $orderId = "945e294403e9445"; // Mã đơn hàng cần kiểm tra trạng thái

        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&orderId=" . $orderId . "&requestType=" . $requestType;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'orderId' => $orderId,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true); // decode json
    }

    //Validation
    public static function getValidationInfomation()
    {
        $rules = [
            'receiver_first_name' => 'required',
            'receiver_last_name' => 'required',
            'receiver_phone' => 'required|numeric|digits_between:10,10',
            'receiver_email' => 'required|email|max:255',
            'receiver_address' => 'required',
            'ward_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'city_id' => 'required|numeric',
        ];
        return $rules;
    }
    public static function messageInfomation()
    {
        $message = [
            'receiver_first_name.required' => 'Vui lòng điền họ và tên lót',
            'receiver_last_name.required' => 'Vui lòng điền tên',
            'receiver_email.required' => 'Vui lòng điền email',
            'receiver_email.email' => 'Email không hợp lệ.',
            'receiver_phone.required' => 'Vui lòng điền số điện thoại',
            'receiver_phone.numeric' => 'Số điện thoại phải là số.',
            'receiver_phone.digits_between' => 'Vui lòng kiểm tra số điện thoại.',
            'receiver_address.required' => 'Vui lòng điền địa chỉ',
            'ward_id.required' => 'Vui lòng chọn xã/phường',
            'district_id.required' => 'Vui lòng chọn quận/huyện',
            'city_id.required' => 'Vui lòng chọn tỉnh/thành phố',
            'ward_id.numeric' => 'Vui lòng chọn xã/phường',
            'district_id.numeric' => 'Vui lòng chọn quận/huyện',
            'city_id.numeric' => 'Vui lòng chọn tỉnh/thành phố',
        ];
        return $message;
    }
}