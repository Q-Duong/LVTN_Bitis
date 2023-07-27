<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;

class CategoryPostController extends Controller
{
    function add_category_post(){
        return view('admin.CategoryPost.add_category_post');
    }
    function edit_category_post($category_post_id){
        $edit_value=CategoryPost::find($category_post_id);
        return view('admin.CategoryPost.edit_category_post')->with(compact('edit_value'));
    }
    function list_category_post(){
        $getAllListCategoryPost=CategoryPost::orderBy('category_post_id','ASC')->get();
        return view('admin.CategoryPost.list_category_post')->with(compact('getAllListCategoryPost'));
    }
    function save_category_post(Request $request){
        $this->checkCategoryPost($request);
        $data=$request->all();
        $category_post=new CategoryPost();
        $category_post->category_post_name=$data['category_post_name'];
        $category_post->category_post_slug=$data['category_post_slug'];
        $category_post->category_post_status=1;
        $name=CategoryPost::where('category_post_name',$data['category_post_name'])->exists();
        if($name){
            return Redirect()->back()->with('error','Danh mục đã tồn tại, vui lòng kiểm tra lại')->withInput();
        }
        $category_post->save();
        return Redirect()->back()->with('success','Thêm danh mục thành công');
    }
    function delete_category_post($category_post_id){
        $category_post=CategoryPost::find($category_post_id);
        $category_post->delete();
        return Redirect()->back()->with('success','Xóa danh mục sản phẩm thành công');
    }
    function update_category_post(Request $request,$category_post_id){
        $this->checkUpdateCategoryPost($request);
        $data=$request->all();
        // dd($data);
        $category_post=CategoryPost::find($category_post_id);
        $category_post->category_post_name=$data['category_post_name'];
        $category_post->category_post_slug=$data['category_post_slug'];
        $category_post->save();
        return Redirect::to('admin/category-post/list')->with('success','Cập nhật danh mục sản phẩm thành công');
    }


    //Customer Frontend

    public function show_category_post($category_post_slug){
        $category_post_id=CategoryPost::where('category_post_slug',$category_post_slug)->first();
        $post = Post::where('category_post_id',$category_post_id->category_post_id)->get();
        return view('pages.blog.category_blog')->with(compact('post'));
    }
    public function checkCategoryPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'category_post_name' => 'required|unique:category_post,category_post_name',
                'category_post_slug' =>'required'
            ],
            [
                'category_post_name.required' => 'Vui lòng nhập thông tin',
                'category_post_name.unique' => 'Danh mục đã tồn tại vui lòng nhập lại',
                'category_post_slug.required'=>'Vui lòng nhập lại tên'
            ]
        );
    }
    public function checkUpdateCategoryPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'category_post_name' => 'required',
                'category_post_slug' =>'required'
            ],
            [
                'category_post_name.required' => 'Vui lòng nhập thông tin',
                'category_post_slug.required'=>'Vui lòng nhập lại tên'
            ]
        );
    }
}
 