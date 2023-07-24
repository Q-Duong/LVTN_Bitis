<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\WareHouse;
class CartController extends Controller
{
    public function cart(){
        return view('pages.cart.cart');
    }
}