<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Redirect;
session_start();
class CartController extends Controller
{
    public function gio_hang(){
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.cart_ajax')->with('category_product',$category_product)->with('brand_product',$brand_product);
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $val['product_qty']+=$data['cart_product_qty'];
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

    }  

    public function save_cart(Request $request){
        $product_id=$request->product_id_hidden;
        $quantity=$request->qty;
        $product_info=DB::table('tbl_product')->where('product_id',$product_id)->first();
        $ware=DB::table('tbl_ware')->where('product_id',$product_id)->get();
        foreach($ware as $wa){
            $product_prices=$wa->product_prices;
        }
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        $data['id']=$product_info->product_id;
        $data['qty']=$quantity;
        $data['name']=$product_info->product_name;
        $data['price']=$product_info->product_price;
        $data['weight']=$product_info->product_price;
        $data['options']['image']=$product_info->product_image;
        Cart::add($data);
        Cart::setGlobalTax(0);
        Session::put('message','Thêm sản phẩm vào giỏ hàng thành công!');
        return redirect()->back();
       
        // return Redirect::to('/show-cart');
        // Cart::destroy();
    }
    public function show_cart(){
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('post',$post);
    }
    public function delete_to_cart($rowId){
            Cart::update($rowId,0);
            return redirect()->back();
    }
    public function update_cart_quantity(Request $request){
        $rowId=$request->row_Id;
        $qty=$request->quantity;
        $product_id=$request->id;
        $product_sl=DB::table('tbl_product')->where('product_id',$product_id)->orderby('product_sold','desc')->get();
        foreach($product_sl as $pro){
            $pro_quanti = $pro->product_quantity;
        }
        if($qty <= $pro_quanti){
            Cart::update($rowId,$qty);
            Session::put('message','Cập nhật số lượng sản phẩm thành công!');
            return redirect()->back();
        }else{
            Cart::update($rowId,$pro_quanti);
            Session::put('message','Xin lỗi! Số lượng đặt hàng không thể quá '.$pro_quanti.' sản phẩm');
            return redirect()->back();
        }
    }
}
