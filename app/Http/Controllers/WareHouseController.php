<?php

namespace App\Http\Controllers;
use App\Models\Size;
use App\Models\Color;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class WareHouseController extends Controller
{
    function add_ware_house(){
        $getAllCategory=Category::orderBy('category_id','asc')->get();
        $getAllSize=Size::orderBy('size_id','asc')->get();
        $getAllColor=Color::orderBy('color_id','asc')->get();
        return view('admin.WareHouse.add_warehouse')->with(compact('getAllSize','getAllColor','getAllCategory'));
    }
}
