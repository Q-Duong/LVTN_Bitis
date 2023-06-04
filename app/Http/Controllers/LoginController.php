<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;

class LoginController extends Controller
{
    public function login_checkout(){
        $getAllListCategory=Category::orderBy('category_id','ASC')->get();
        $getAllListCategoryType=CategoryType::orderBy('category_type_id','ASC')->get();
    	return view('pages.login.login_checkout')->with(compact('getAllListCategory','getAllListCategoryType'));
    }

    public function create_customer(){

        $category_post = CategoryPost::where('category_post_status','1')->orderBy('category_post_id','ASC')->get();

        $cate_product = CategoryProduct::where('category_product_status','1')->orderby('category_product_id','ASC')->get();

    	return view('pages.checkout.create_customer')->with('category',$cate_product)->with('category_post',$category_post);
    }
}
