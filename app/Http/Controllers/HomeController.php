<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Post;
use App\Models\Rating;
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

   public function add_rating(Request $request){
    $data = $request->all();
    
    $rating = new Rating();
    $rating->rating_star = $data['rating_star'];
    $rating->rating_comment = $data['rating_comment'];
    $rating->product_id=$data['product_id'];
    $rating->user_id=6;

    $rating->save();
    return Redirect()->back()->with('success','Đã đánh giá thành công sản phẩm');
   }

    public function send_comment(Request $request){
        $data = $request->all();

        $comment = new Rating();
        $comment->rating_star = $data['star'];
        $comment->rating_comment = $data['comment'];
        $comment->product_id=$data['product_id'];
        $comment->user_id=Auth::user()->id;
        $comment->rating_status=1;

        $comment->save();
        return response()->json(array('success' => true));
    }  
   
}


   