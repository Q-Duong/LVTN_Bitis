<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Product;
use App\Models\ProductType;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(){
    	$getAllListCategory=Category::orderBy('category_id','ASC')->get();
        $getAllListCategoryType=CategoryType::orderBy('category_type_id','ASC')->get();

    	return view('pages.home')->with(compact('getAllListCategory','getAllListCategoryType'));
    }

    
}
