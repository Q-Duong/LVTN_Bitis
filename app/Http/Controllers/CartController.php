<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Alert;
use App\Models\Product;
use Carbon\Carbon;
session_start();

class CartController extends Controller
{
    public function add_cart_ajax(Request $request){
        // Session::forget('cart');
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                    // $flag=$val['product_id'];
                    // break;
                }
            }
            // if($is_avaiable!=0 && $flag==$data['cart_product_id']){
            //     $cart['product_qty']=$data['cart_product_qty']+1;
            //     Session::put('cart',$cart);
            // }
            
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_slug' => $data['cart_product_slug'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_slug' => $data['cart_product_slug'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

    }   

    public function cart(){
        return view('pages.cart.cart');
    }

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){
                        $cart[$session]['product_qty'] = $qty;
                        Session::put('cart',$cart);
                        return redirect()->back()->with('success','Cập nhật số lượng  thành công'); 
                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                        return redirect()->back()->with('error','Cập nhật số lượng thất bại. Vui lòng chọn số lượng nhỏ hơn');
                    }
                }
            }
        }
        
    }

    public function delete_product($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            Session::forget('coupon');
            return redirect()->back()->with('success','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('error','Xóa sản phẩm thất bại');
        }

    }

    public function  count_cart_products(){
        $total=0;
        $output ='';
        foreach(Session::get('cart') as $key => $cart){
            $count=(int)($cart['product_qty']);
            $total += $count;
            
        }
        if($total>0){
            $output .= '<span>'.$total.'</span>';
        }else{
            $output .='';
        }
        echo $output;
    }

}