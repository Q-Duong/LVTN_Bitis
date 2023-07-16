<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    function send_rating(Request $request){
        $data=$request->all();

        $rating = new Rating();
        $rating->rating_comment = $data['comment'];
        $rating->rating_star = $data['rating'];
        $rating->product_id = $data['product_id'];
        $rating->user_id=Auth::id();
        $rating->rating_status =0;
         
        $rating->save();

        return Redirect::back()->with('success', 'Thêm đánh giá thành công');
    }   
  
}
 