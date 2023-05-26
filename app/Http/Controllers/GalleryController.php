<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Gallery;
use App\Models\Product;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class GalleryController extends Controller
{
    function add_gallery(){
        return view('admin.Product.add_gallery');
    }
    function save_gallery(Request $request){
        $data=$request->all();
    }
}
