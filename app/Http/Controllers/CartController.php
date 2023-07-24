<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\WareHouse;
class CartController extends Controller
{
    public function cart(){
        return view('pages.cart.cart');
    }
    public function cart_quantity(Request $request){
        $data = $request->all();

        $cart_quantity = WareHouse::where('ware_house_id',$data['id'])->first();
        if($data['quantity'] > $cart_quantity->ware_house_quantity){
            return response()->json(array('success' => false));
        }
        return response()->json(array('success' => true));
    }
}