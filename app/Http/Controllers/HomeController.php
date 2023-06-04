<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Product;
use App\Models\Banner;
use App\Models\ProductType;
use App\Models\CategoryPost;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(){
    	$getAllListCategory=Category::orderBy('category_id','ASC')->get();
        $getAllListCategoryType=CategoryType::orderBy('category_type_id','ASC')->get();
        $getAllListCategoryPost=CategoryPost::orderBy('category_post_id','ASC')->get();
        $getAllBanner=Banner::get();
    	return view('pages.home')->with(compact('getAllListCategory','getAllListCategoryType','getAllBanner','getAllListCategoryPost'));
    }

    
}
