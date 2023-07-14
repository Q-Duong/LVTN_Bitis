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
   public function search_autocomplete(Request $request){

    $data = $request->all();

    if($data['query']){

        $product = Product::where('product_name','LIKE','%'.$data['query'].'%')->inRandomOrder('product_id')->limit(10)->get();

        $output = '
        <ul  class="dropdown-menu">
            <li class="li_search_ajax">Gợi ý tìm kiếm</li>'
        ;

        foreach($product as $key => $val){
           $output .= '
           <li class="li_search_ajax"><a href="'.url('/products/'.$val->product_slug).'" ><i class="fas fa-search"></i>'.$val->product_name.'</a></li>
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
public function search(Request $request){
    $keywords = $request->keywords_submit;
    $search_product =  Product::where('product_name','like','%'.$keywords.'%')->get(); 
    return view('pages.product.search')->with(compact('search_product'));

}
}


   