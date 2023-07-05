<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Post;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
    	$getAllListNewProduct=Product::where('product_tag',1)->inRandomOrder('product_id')->limit(8)->get();
        $getAllListSaleProduct=Product::where('product_tag',3)->inRandomOrder('product_id')->limit(8)->get();
        $getAllBanner=Banner::get();
        $getAllPost=Post::inRandomOrder('post_id')->get();
    	return view('pages.home')->with(compact('getAllListSaleProduct','getAllListNewProduct','getAllBanner','getAllPost'));
    }

    public function wistlist(){
       return view('pages.wistlist.wistlist');
   }
   
}


   