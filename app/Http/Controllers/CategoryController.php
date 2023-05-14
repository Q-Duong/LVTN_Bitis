<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Account;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    function add_category(){
        return view('admin.CategoryProduct.add_category');
    }
    function list_category(){
        return view('admin.CategoryProduct.all_category');
    }
}
 