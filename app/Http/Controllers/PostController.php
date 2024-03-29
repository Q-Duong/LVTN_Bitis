<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    function add_post(){
        $getAllListCategoryPost=CategoryPost::get();
        return view('admin.Post.add_post')->with(compact('getAllListCategoryPost'));
    }
    function edit_post($post_id){
        $edit_value=Post::find($post_id);
        $getAllListCategoryPost=CategoryPost::get();
        return view('admin.Post.edit_post')->with(compact('edit_value','getAllListCategoryPost'));
    }
    function list_post(){
        $getAllListPost=Post::orderBy('post_id','ASC')->get();
        return view('admin.Post.list_post')->with(compact('getAllListPost'));
    }
    function save_post(Request $request){
        $data=$request->all();
    
        $post=new Post();
        $post->post_title=$data['post_title'];
        $post->post_slug=$data['post_slug'];
        $post->post_content=$data['post_content'];
        $post->category_post_id = $data['category_post_id'];
        $name=Post::where('post_title',$data['post_title'])->exists();
        if($name){
            return Redirect()->back()->with('error','Danh mục đã tồn tại, vui lòng kiểm tra lại')->withInput();
        }
        $get_image = request('post_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/post/'), $new_image);
            $post->post_image = $new_image;
        }
        $post->save();
        return Redirect()->back()->with('success','Thêm danh mục sản phẩm thành công');
    }
    function delete_post($post_id){
        $post=Post::find($post_id);
        $post->delete();
        return Redirect()->back()->with('success','Xóa danh mục sản phẩm thành công');
    }
    function update_post(Request $request,$post_id){
        $this->checkPostUpdateAdmin($request);
        $data=$request->all();
        $post=Post::find($post_id);
        $post->post_title=$data['post_title'];
        $post->post_slug=$data['post_slug'];
        $post->post_content=$data['post_content'];
        $post->category_post_id = $data['category_post_id'];
        $get_image = request('post_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/post/'), $new_image);
            $post->post_image = $new_image;
        }
        $post->save();
        return Redirect::to('admin/post/list')->with('success','Cập nhật bài viết thành công');
    }


    //Customer Frontend

    public function show_post($post_slug){
        $post=Post::where('post_slug',$post_slug)->first();
        return view('pages.blog.blog_details')->with(compact('post'));
    }
    public function checkPostAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'category_post_id' => 'required',
                'post_title' => 'required',
                'post_content' => 'required',
                'post_image' => 'image',
                'post_slug'=>'required'
            ],
            [
                'category_post_id.required' => 'Vui lòng chọn danh mục cần thêm',
                'post_title.required' => 'Vui lòng nhập thông tin',
                'post_content.required' => 'Vui lòng nhập thông tin',
                'post_image.image' => 'Vui lòng chọn file hình',
                'post_slug.required' => 'Vui lòng nhập tên'
            ]
        );
    }
    public function checkPostUpdateAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'category_post_id' => 'required',
                'post_title' => 'required',
                'post_content' => 'required',
                'post_slug'=>'required'
            ],
            [
                'category_post_id.required' => 'Vui lòng chọn danh mục cần thêm',
                'post_title.required' => 'Vui lòng nhập thông tin',
                'post_content.required' => 'Vui lòng nhập thông tin',
                'post_slug.required' => 'Vui lòng nhập tên'
            ]
        );
    }
}
 