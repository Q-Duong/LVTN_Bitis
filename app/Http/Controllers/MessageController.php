<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    function save_message(Request $request){
        $data = $request->all();
        //dd($data);
        $mess=new Message();
        $mess->message_name=$data['message_name'];
        $mess->message_email=$data['message_email'];
        $mess->message_content=$data['message_content'];
        $mess->save();
        return Redirect()->back()->with('success',' Tin nhắn thành công');
    }
    function list_message(){
        $getAllMessage=Message::orderBy('message_id','ASC')->get();
        return view('admin.Message.list_message')->with(compact('getAllMessage'));
    }
    function delete_message($mess_id){
        $message=Message::find($mess_id);
        $message->delete();
        return redirect()->back()->with('success','Xóa tin nhắn thành công');
    }
}
 