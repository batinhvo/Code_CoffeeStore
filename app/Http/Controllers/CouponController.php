<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();
class CouponController extends Controller
{
    public function insert_coupon(){
        return view('admin.coupon.insert_coupon');
    }
    public function save_coupon(Request $request){
        $data=$request->all();
        $coupon=new Coupon();
        $coupon->coupon_name=$data['coupon_name'];
        $coupon->coupon_number=$data['coupon_number'];
        $coupon->coupon_condition=$data['coupon_condition'];
        $coupon->coupon_time=$data['coupon_time'];
        $coupon->coupon_code=$data['coupon_code'];
        $coupon->save();
        Session::put('message','Thêm mã giảm giá thành công');
        return Redirect::to('all-coupon');
    
    }
    public function all_coupon(){
        $coupon=Coupon::orderby('coupon_id','desc')->get();
        return view('admin.coupon.all_coupon')->with(compact('coupon'));
    }
    public function delete_coupon($coupon_id){
        $coupon=Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('all-coupon');

    }
    public function delete_coupon_home(){
        Session::forget('coupon');
        return redirect()->back();
    }
}

