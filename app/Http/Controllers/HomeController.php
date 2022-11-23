<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use Session;
use App\Models\Slider;
use App\Models\Post;
use App\Models\Product;
use App\Models\CategoryPost;
use App\Models\Coupon;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function autocomplete_ajax(Request $request){
        $data=$request->all();
        if($data['query']){
            $product=Product::where('product_status',1)->where('product_name','LIKE','%'.$data['query'].'%')->get();
            $output='<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($product as $key =>$val){
                $output.='
                    <li class="li_search_ajax"><a href="#">'.$val->product_name.'</a></li>
                ';
            }
            $output.='</ul>';
            echo $output;
        }
    }

    public function chatbot(Request $request){
        $data=$request->all();
        if($data['value']){
            $chat = DB::table('tbl_chatbot')->where('chatbot_queries','LIKE','%'.$data['value'].'%')->get();
            $output='Sorry! You so crazy^^';
            foreach($chat as $key => $val){
                $output=$val->chatbot_replies;
            }
            echo $output;
            
        }
    }

    public function index(){
        $slider=Slider::where('slider_status',1)->orderBy('slider_id','DESC')->get();
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        // $all_product=DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('product_id','desc')->get();
        // $manager_product=view('admin.all_product')->with('all_product',$all_product);
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->paginate(6);
        return view('pages.home')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('all_product',$all_product)
        ->with('slider',$slider)->with('post',$post);
    }

    public function lichsu($customer_id){
        $slider=Slider::where('slider_status',1)->orderBy('slider_id','DESC')->get();
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->paginate(6);
        $order=DB::table('tbl_order')->where('customer_id',$customer_id)->get();
        return view('pages.checkout.lichsu')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('all_product',$all_product)
        ->with('slider',$slider)->with('post',$post)->with('order',$order);
    }

    public function chitiet_lichsu($order_id){
        $slider=Slider::where('slider_status',1)->orderBy('slider_id','DESC')->get();
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->paginate(6);
        $order=DB::table('tbl_order')->where('order_id',$order_id)->get();
        foreach($order as $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
              

        $order=DB::table('tbl_order')->where('order_id',$order_id)->get();
        foreach($order as $key=> $ord){
            $customer_id=$ord->customer_id;
            $shipping_id=$ord->shipping_id;
        }
        $shipping=DB::table('tbl_shipping')->where('shipping_id',$shipping_id)->get();
        $customer=DB::table('tbl_customer')->where('customer_id',$customer_id)->get();
        $order_details=DB::table('tbl_order')  
        ->join('tbl_order_detail','tbl_order_detail.order_id','=','tbl_order.order_id')
        ->join('tbl_product','tbl_order_detail.product_id','=','tbl_product.product_id')
        ->where('tbl_order.order_id',$order_id)
        ->select('tbl_order_detail.*','tbl_product.product_price as pro_price','product_image')
        ->get();
        foreach($order_details as $key => $order_d){
            $product_coupon=$order_d->product_coupon;
        }
        if($product_coupon!='0'){
            $coupon=Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition=$coupon->coupon_condition;
            $coupon_number=$coupon->coupon_number;
        }
        else{
            $coupon_condition=2;
            $coupon_number=0;
        }

        return view('pages.checkout.chitiet_lichsu')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('all_product',$all_product)
        ->with('slider',$slider)->with('post',$post)->with('order',$order)->with('customer',$customer)->with('shipping',$shipping)->with('order_details',$order_details)
        ->with('coupon_number',$coupon_number)->with('coupon_condition',$coupon_condition);
    }


    public function all_product(){
        $slider=Slider::where('slider_status',1)->orderBy('slider_id','DESC')->get();
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->paginate(30);
        return view('pages.product.all_product')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('all_product',$all_product)
        ->with('slider',$slider)->with('post',$post);
    }

    public function all_product_sx(Request $request){
        // $slider=Slider::where('slider_status',1)->orderBy('slider_id','DESC')->get();
        // $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        // $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        // $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->paginate(30);
        // return view('pages.product.all_product')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('all_product',$all_product)
        // ->with('slider',$slider)->with('post',$post);
        $masa=$request->sapxep;
        echo $masa;
    }

    public function search(Request $request){
        $keywords=$request->keywords;
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $search_product=DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();
        $search_pro = strlen($search_product);
        return view('pages.product.search')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('search_product',$search_product)->with('post',$post)->with('keyword',$keywords)->with('search',$search_pro);
    }

    public function send_mail(){
        $to_name = "Diep Vi Day";
        $to_email = "vib1809209@student.ctu.edu.vn";//send to this email

        $data = array("name"=>"Mail từ tài khoản khách hàng","body"=>"Mail khơi khơi"); //body of mail.blade.php
    
        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail nhé');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
         //return Redirect::to('/')->with('message','');
    }

    
}
