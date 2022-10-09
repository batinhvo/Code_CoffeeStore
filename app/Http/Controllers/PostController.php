<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Models\Coupon;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();
class PostController extends Controller
{
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
           return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_post(){
        $this->AuthLogin();
        return view('admin.post.add_post');
    }
    public function save_post(Request $request){
        $this->AuthLogin();
        $data=$request->all();
        $post=new CategoryPost();
        $post->category_post_name=$data['post_name'];
        $post->category_post_status=$data['post_status'];
        $post->category_post_desc=$data['post_desc'];
        $post->save();
        Session::put('message','Thêm danh mục tin tức thành công');
        return Redirect::to('all-post');
        
    }
    public function all_post(){
        $this->AuthLogin();
        $all_post=CategoryPost::orderby('category_post_id','desc')->get();
        return view('admin.post.all_post')->with(compact('all_post'));
    }
    public function unactive_post($post_id){
        $post=CategoryPost::where('category_post_id',$post_id)->first();
        $post->category_post_status=0;
        $post->save();
        Session::put('message','Ẩn danh mục tin tức thành công');
        return Redirect::to('all-post');
    }
    public function active_post($post_id){
        $post=CategoryPost::where('category_post_id',$post_id)->first();
        $post->category_post_status=1;
        $post->save();
        Session::put('message','Hiển thị danh mục tin tức thành công');
        return Redirect::to('all-post');
    }
    public function edit_post($post_id){
        $post=CategoryPost::where('category_post_id',$post_id)->get();
        return view('admin.post.edit_post')->with(compact('post'));
    }
    public function update_post(Request $request,$post_id){
        $data=$request->all();
        $post=CategoryPost::where('category_post_id',$post_id)->first();
        $post->category_post_name=$data['post_name'];
        $post->category_post_desc=$data['post_desc'];
        $post->save();
        Session::put('message','Cập nhật danh mục tin tức thành công');
        return Redirect::to('all-post');

        
    }
    public function delete_post($post_id){
        $post=CategoryPost::where('category_post_id',$post_id)->first();
        $post->delete();
        Session::put('message','Xóa danh mục tin tức thành công');
        return Redirect::to('all-post');
    }
    public function show_post($post_id){
        
    }
}

