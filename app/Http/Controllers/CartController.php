<?php
namespace App\Http\Controllers;
class CartController extends Controller
{
    public function cart(){
        return view('pages.cart.cart');
    }
}