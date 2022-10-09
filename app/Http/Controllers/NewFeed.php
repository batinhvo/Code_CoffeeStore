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
class NewFeed extends Controller
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
    public function add_new_feed(){
        $this->AuthLogin();
        $category_post=CategoryPost::orderby('category_post_id','desc')->get();
        return view('admin.post.add_new_feed')->with(compact('category_post'));
    }
    public function save_new_feed(Request $request){
        $this->AuthLogin();
        $data=$request->all();
        $post=new Post();
        $post->post_title=$data['newfeed_name'];
        $post->post_content=$data['newfeed_content'];
        $post->category_post_id=$data['category_newfeed'];
        $post->post_status=$data['newfeed_status'];
        $post->post_desc=$data['newfeed_desc'];

        $get_image=$request->file('newfeed_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image=$name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $post->post_image=$new_image;
            $post->save();
            Session::put('message','Thêm bài viết thành công');
            return Redirect::to('all-new-feed');
        }
       else{
        Session::put('message','Vui lòng thêm hình ảnh');
        return redirect()->back();
       }
        
    }
    public function delete_newfeed($post_id){
        $post=Post::where('post_id',$post_id)->first();
        $post_image=$post->post_image;
        if($post_image){
            $path='public/uploads/post/'.$post_image;
            unlink($path);
        }
        $post->delete();
        Session::put('message','Xóa bài viết thành công');
        return Redirect::to('all-new-feed');
    }
    public function all_new_feed(){
        $this->AuthLogin();
        $all_post=Post::orderby('post_id','desc')->get();
        return view('admin.post.all_new_feed')->with(compact('all_post'));
    }
    public function unactive_newfeed($post_id){
        $post=Post::where('post_id',$post_id)->first();
        $post->post_status=0;
        $post->save();
        Session::put('message','Ẩn bài viết thành công');
        return Redirect::to('all-new-feed');
    }
    public function active_newfeed($post_id){
        $post=Post::where('post_id',$post_id)->first();
        $post->post_status=1;
        $post->save();
        Session::put('message','Hiển thị bài viết thành công');
        return Redirect::to('all-new-feed');
    }
    public function edit_newfeed($post_id){
        $post=Post::where('post_id',$post_id)->get();
        $category_post=CategoryPost::orderby('category_post_id','desc')->get();
        return view('admin.post.edit_newfeed')->with(compact('post','category_post'));
    }
    public function update_newfeed(Request $request,$post_id){
        $this->AuthLogin();
       $data=$request->all();
       $post=Post::where('post_id',$post_id)->first();
       $post->post_title=$data['newfeed_name'];
       $post->post_content=$data['newfeed_content'];
       $post->category_post_id=$data['category_newfeed'];
      
       $post->post_desc=$data['newfeed_desc'];

      
       
       $get_image=$request->file('newfeed_image');
       if($get_image){
           $get_name_image=$get_image->getClientOriginalName();
           $name_image=current(explode('.',$get_name_image));
           $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
           $get_image->move('public/uploads/post',$new_image);
           $post->post_image=$new_image;
           $post->save();
           Session::put('message','Cập nhật bài viết thành công');
           return Redirect::to('all-new-feed');
       }
       $post->save();
       
       Session::put('message','Cập nhật bài viết thành công');
       return Redirect::to('all-new-feed');

       
    }
    public function show_newfeed($post_id){
        $newfeed=Post::where('post_status',1)->where('category_post_id',$post_id)->orderBy('post_id','DESC')->paginate(2);
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $title=CategoryPost::where('category_post_id',$post_id)->get();
        
        
        return view('pages.post.show_newfeed')->with('category_product',$category_product)->with('brand_product',$brand_product)
        ->with('post',$post)->with('newfeed',$newfeed)->with('title',$title);
    }
    public function bai_viet($post_id){
        $newfeed=Post::where('post_status',1)->where('post_id',$post_id)->orderBy('post_id','DESC')->get();
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $title=CategoryPost::where('category_post_id',$post_id)->get();
        
        
        return view('pages.post.show_baiviet')->with('category_product',$category_product)->with('brand_product',$brand_product)
        ->with('post',$post)->with('newfeed',$newfeed)->with('title',$title);
    }
   
}
