<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    function send_comment(Request $request){
        $data=$request->all();

        $rating = new Rating();
        $rating->rating_star = $data['rating_star'];
        $rating->rating_comment = $data['rating_comment'];
        $rating->product_id = $data['product_id'];
        $rating->user_id = Auth::user()->id;
        $rating->rating_status = 0;
        $rating->save();
        return response()->json(array('message'=>'Đánh giá thành công'));
    }   

    function add_rating(Request $request){
        $data=$request->all();
dd($data);
 
    }   
}
 