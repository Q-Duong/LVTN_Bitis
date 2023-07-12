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
    public function search(Request $request){
        $keywords = $request->keywords_submit;

        $product =  Product::where('product_slug','like','%'.$keywords.'%')->get(); 

        return view('pages.product.search')->with(compact('keywords','product'));

    }

    public function search_autocomplete(Request $request){

        $data = $request->all();

        if($data['query']){

            $product = Product::where('product_name','LIKE','%'.$data['query'].'%')->inRandomOrder('product_id')->limit(5)->get();

            $output = '
            <ul  class="dropdown-menu">
                <li class="li_search_ajax">Gợi ý tìm kiếm</li>'
            ;

            foreach($product as $key => $val){
               $output .= '
               <li class="li_search_ajax"><a href="'.url('/product/'.$val->product_slug).'" ><i class="fas fa-search"></i>'.$val->product_name.'</a></li>
               ';
            }

            $output .= '</ul>';
            echo $output;
        }else{
            $output = '
            <ul  class="dropdown-menu">
                <li class="li_search_ajax">Gợi ý tìm kiếm</li>'
            ;
            $output .= '</ul>';
            echo $output;
        }  
    }
}


   