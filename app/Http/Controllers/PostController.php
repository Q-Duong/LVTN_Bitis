<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\CategoryType;
use Carbon\Carbon;
use App\Http\Requests;
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
        $post->post_status=$data['post_status'];
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
        $data=$request->all();
        $post=Post::find($post_id);
        $post->post_title=$data['post_title'];
        $post->post_slug=$data['post_slug'];
        $post->post_content=$data['post_content'];
        $post->post_status=$data['post_status'];
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
        return Redirect::to('list-post')->with('success','Cập nhật bài viết thành công');
    }


    //Customer Frontend

    // public function show_category_details($category_slug){
    //     $getAllListCategory=Category::orderBy('category_id','ASC')->get();
    //     $getAllListCategoryType=CategoryType::orderBy('category_type_id','ASC')->get();
    //     $category = Category::where('category_slug',$category_slug)->first();
    //     $getAllListProductCategory = Product::where('category_id',$category->category_id)->orderBy('product_id','ASC')->get();

    //     return view('pages.category.show_category')->with(compact('getAllListCategory','getAllListCategoryType','getAllListProductCategory','category'));
    // }

    public function show_post($post_slug){
        $getAllListCategory=Category::orderBy('category_id','ASC')->get();
        $getAllListCategoryType=CategoryType::orderBy('category_type_id','ASC')->get();
        $getAllListCategoryPost=CategoryPost::orderBy('category_post_id','ASC')->get();
        $post=Post::where('post_slug',$post_slug)->first();

        return view('pages.blog.blog_details')->with(compact('getAllListCategory','getAllListCategoryType','getAllListCategoryPost','post'));
    }
    
}
 