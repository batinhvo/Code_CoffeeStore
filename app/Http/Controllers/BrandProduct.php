<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Models\Post;
use App\Models\CategoryPost;
class BrandProduct extends Controller
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
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.brand.add_brand_product');
    }
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product=DB::table('tbl_brand')->get();
        $manager_brand_product=view('admin.brand.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.brand.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data=array();
        $data['brand_name']=$request->brand_product_name;
        $data['brand_desc']=$request->brand_product_desc;
        $data['brand_status']=$request->brand_product_status;

        DB::table('tbl_brand')->insert($data);
        Session::put('message','Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Hiển thị thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Ẩn thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        $edit_brand_product=DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product=view('admin.brand.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.brand.edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
       $data=array();
       $data['brand_name']=$request->brand_product_name;
       $data['brand_desc']=$request->brand_product_desc;

       DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
       Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
       return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

      // end function admin page
    public function show_brand_home($brand_id){
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $brand_name=DB::table('tbl_brand')->where('brand_id',$brand_id)->get();
        $product_by_id=DB::table('tbl_product')->where('brand_id',$brand_id)->where('product_status','1')->orderby('product_id','desc')->get();
        return view('pages.brand.show_brand')->with('category_product',$category_product)->with('brand_product',$brand_product)
        ->with('product_by_id',$product_by_id)->with('brand_name',$brand_name)->with('post',$post);
    }
}
