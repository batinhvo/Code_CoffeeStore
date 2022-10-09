<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CategoryPost;
use App\Models\Gallery;
use File;
use App\Models\Product;
use App\Models\Comment;
session_start();
class ProductController extends Controller
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
    public function delete_comment($comment_id){
        $comment=Comment::find($comment_id);
        $comment->delete();
        Session::put('message','Xóa bình luận thành công');
        return Redirect::to('all-comment');
    }
    public function reply_comment(Request $request){
        $data=$request->all();
        $comment=new Comment();
        $comment->comment=$data['comment'];
        $comment->comment_product_id=$data['comment_product_id'];
        $comment->comment_parent_id=$data['comment_id'];
        $comment->comment_name='Admin';
        $comment->comment_status=1;
        $comment->save();
    }
    public function allow_comment(Request $request){
        $data=$request->all();
        $comment=Comment::find($data['comment_id']);
        $comment_status=$data['comment_status']==0 ? 1:0;
        $comment->comment_status=$comment_status;
        $comment->save();

    }
    public function all_comment(){
        $comment=Comment::with('product')->where('comment_parent_id',0)->orderby('comment_id','desc')->paginate(5);
        $comment_reply=Comment::with('product')->where('comment_parent_id','>',0)->orderby('comment_id','asc')->get();
        return view('admin.comment.all_comment')->with(compact('comment','comment_reply'));
    }
    public function send_comment(Request $request){
        $product_id=$request->product_id;
        $comment_name=$request->comment_name;
        $comment_content=$request->comment_content;
        $comment=new Comment();
        $comment->comment_name=$comment_name;
        $comment->comment=$comment_content;
        $comment->comment_product_id=$product_id;
        $comment->comment_status=0;
        $comment->comment_parent_id=0;
        $comment->save();
    }
    public function load_comment(Request $request){
        $product_id=$request->product_id;
        $comment=Comment::where('comment_product_id',$product_id)->where('comment_parent_id',0)->where('comment_status',1)->orderby('comment_id','desc')->get();
        $comment_reply=Comment::where('comment_product_id',$product_id)->where('comment_parent_id','>',0)->where('comment_status',1)->orderby('comment_id','asc')->get();
        $output='';
        foreach($comment as $key=>$com){
            $output.='
            <div class="row style_comment">
							<div class="col-md-2">
								
								<img width="100%" src="'.url('/public/frontend/images/avatar.webp').'" alt="" class="img img-responsive img-thumbnail">
							</div>
							<div class="col-md-10">
								<p style="color:green;">'.$com->comment_name.'</p>
                                
                                <p style="color:black;">'.$com->comment_date.'</p>
								<p>'.$com->comment.'</p>
							</div>
						</div>
                        <p></p>';
                        foreach($comment_reply as $key=>$com_rep){
                            if($com_rep->comment_parent_id==$com->comment_id){
                                $output.='
                                <div class="row style_comment reply_comment" style="margin:5px 40px; background:#f7cce8;">
                                            <div class="col-md-2">
                                                
                                                <img width="100%" src="'.url('/public/frontend/images/admin.jpg').'" alt="" class="img img-responsive img-thumbnail">
                                            </div>
                                            <div class="col-md-10">
                                                <p style="color:green;">Admin</p>
                                                
                                                <p style="color:black;">'.$com_rep->comment_date.'</p>
                                                <p>'.$com_rep->comment.'</p>
                                            </div>
                                        </div>
                                        <p></p>
                                ';
                            }

                           
                        }
        }
        echo $output;
    }
    public function add_product(){
        $this->AuthLogin();
        $category_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        
        return view('admin.product.add_product')->with('category_product',$category_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('product_id','desc')->paginate(10);
        $manager_product=view('admin.product.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.product.all_product',$manager_product);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data=array();
        $data['product_name']=$request->product_name;
        $data['product_price']=$request->product_price;
        $data['product_quantity']=$request->product_quantity;
        $data['product_desc']=$request->product_desc;
        $data['product_content']=$request->product_content;
        $data['category_id']=$request->category_product;
        $data['brand_id']=$request->brand_product;
        $data['product_status']=$request->product_status;
        $data['product_sold']=$request->product_sold;
        $path='public/uploads/product/';
        $path_gallery='public/uploads/gallery/';
        $get_image=$request->file('product_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image=$name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product/',$new_image);
            File::copy($path.$new_image,$path_gallery.$new_image);
            $data['product_image']=$new_image;
         
        }
        $pro_id=DB::table('tbl_product')->insertGetId($data);
        $gallery=new Gallery();
        $gallery->gallery_image=$new_image;
        $gallery->gallery_name=$new_image;
        $gallery->product_id=$pro_id;
        $gallery->save();

        
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('all-product');
       
    }

    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Hiển thị sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Ẩn sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $category_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $edit_product=DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product=view('admin.product.edit_product')->with('edit_product',$edit_product)->with('category_product',$category_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.product.edit_product',$manager_product);
    }
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
       $data=array();
       $data['product_name']=$request->product_name;
       $data['product_price']=$request->product_price;
       $data['product_quantity']=$request->product_quantity;
       $data['product_desc']=$request->product_desc;
       $data['product_content']=$request->product_content;
       $data['category_id']=$request->category_product;
       $data['brand_id']=$request->brand_product;
       $data['product_sold']=$request->product_sold;
       $path='public/uploads/product/';
       $path_gallery='public/uploads/gallery/';
       
       $get_image=$request->file('product_image');
       if($get_image){
           $get_name_image=$get_image->getClientOriginalName();
           $name_image=current(explode('.',$get_name_image));
           $new_image=$name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
           $get_image->move('public/uploads/product',$new_image);
           File::copy($path.$new_image,$path_gallery.$new_image);
           $data['product_image']=$new_image;
           $gallery=Gallery::where('product_id',$product_id);
           $gallery->delete();
           $gallery=new Gallery();
           $gallery->gallery_image=$new_image;
           $gallery->gallery_name=$new_image;
           $gallery->product_id=$product_id;
           $gallery->save();
           DB::table('tbl_product')->where('product_id',$product_id)->update($data);
           Session::put('message','Cập nhật sản phẩm thành công');
           return Redirect::to('all-product');
       }
   
       DB::table('tbl_product')->where('product_id',$product_id)->update($data);
       Session::put('message','Cập nhật sản phẩm thành công');
       return Redirect::to('all-product');

       
    }

    public function delete_product($product_id){
        $this->AuthLogin();
        $product=Product::find($product_id);
     
        unlink('public/uploads/product/'.$product->product_image);
        $product->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }

    //end admin page
    public function detail_product($product_id){
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        $gallery=Gallery::where('product_id',$product_id)->get();
        $detail_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_id',$product_id)->get();

        foreach ($detail_product as $key=> $value){
            $category_id=$value->category_id;
            $category_name=$value->category_name;
            $product_name=$value->product_name;
            
        }
        $relate_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_category_product.category_id',$category_id)->whereNotIn('product_id',[$product_id])->paginate(3);   
        
        return view('pages.product.detail_product')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('detail_product',$detail_product)
        ->with('relate_product',$relate_product)->with('post',$post)->with('gallery',$gallery)->with('category_name',$category_name)
        ->with('product_name',$product_name)->with('category_id',$category_id);
    }
}
