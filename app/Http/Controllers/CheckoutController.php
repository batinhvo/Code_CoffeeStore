<?php

namespace App\Http\Controllers;
use App\Models\Coupon;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\CategoryPost;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();
class CheckoutController extends Controller
{
    public function info_delivery(){
        $city=City::where('matp',Session::get('matp'))->first();
        $province=Province::where('maqh',Session::get('maqh'))->first();
        $wards=Wards::where('xaid',Session::get('maxp'))->first();
        
        $shipping_address= $wards->name_xaphuong.', '.$province->name_quanhuyen.', '.$city->name_thanhpho;
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $customer_id = Session::get('customer_id');
        $customer = DB::table('tbl_customer')->where('customer_id', $customer_id)->get();
        return view('pages.checkout.delivery')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('post',$post)->with('customer',$customer)->with('shipping_address',$shipping_address);
    //    $customer_id = Session::get('customer_id');
    //    echo '<pre>';
    //     print_r($request);
    //    echo '</pre>';
    }

    public function confirm_order(Request $request){
        $data=$request->all();
        $city=City::where('matp',Session::get('matp'))->first();
        $province=Province::where('maqh',Session::get('maqh'))->first();
        $wards=Wards::where('xaid',Session::get('maxp'))->first();
        
        
        $shipping_address=$data['shipping_address'];
        $shipping=new Shipping ();
        $shipping->shipping_name=$data['shipping_name'];
        $shipping->shipping_email=$data['shipping_email'];
        $shipping->shipping_phone=$data['shipping_phone'];
        $shipping->shipping_address=$shipping_address;
        $shipping->shipping_notes=$data['shipping_notes'];
        $shipping->shipping_method=$data['shipping_method'];
        $shipping->save();

        $shipping_id=$shipping->shipping_id;
 
        $checkout_code =substr(md5(microtime()),rand(0,26),5);
        $order=new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id=$shipping_id;
        $order->order_status=1;
        $order->order_code=$checkout_code;

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at=now();
        $sum= (int)str_replace(',','',Cart::total());
        if($data['order_coupon']=='0'){
            $order_total=$sum+(int)$data['order_fee'];
        }
        else{
            $coupon=Coupon::where('coupon_code',$data['order_coupon'])->first();

            if($coupon->coupon_condition==0){
                $order_total=$sum-$coupon->coupon_number+(int)$data['order_fee'];
            }
            else{
                $order_total=$sum-$sum/100*$coupon->coupon_number+(int)$data['order_fee'];
            }
            $coupon->coupon_time=$coupon->coupon_time-1;
            $coupon->save();
        }
        

        $order->order_total=$order_total;

        $order->save();
        $order_id=$order->order_id;
        
        $content=Cart::content();
        foreach($content as $key =>$v_content){
            $product_id=$v_content->id;
        }
        $warehouse=DB::table('tbl_ware')->where('product_id',$product_id)->get();
        foreach($warehouse as $ware){
            $product_prices=$ware->product_prices;
        }
        if($content){
            foreach($content as $key =>$v_content){
                $product_id=$v_content->id;
                $order_details= new OrderDetails();
                $order_details->order_id=$order_id;
                $order_details->product_id=$v_content->id;
                $order_details->product_name=$v_content->name;
                $order_details->product_price=$v_content->price;
                $warehouse=DB::table('tbl_ware')->where('product_id',$product_id)->get();
                foreach($warehouse as $ware){
                    $product_prices=$ware->product_prices;
                }
                $order_details->product_prices=$product_prices;
                $order_details->product_quantity=$v_content->qty;
                $order_details->product_coupon=$data['order_coupon'];
                $order_details->product_feeship=$data['order_fee'];
                
                $order_details->save();
            }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Cart::destroy();


    }

    public function delete_fee(){
        Session::forget('fee');
        return redirect()->back();
    }
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
           return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function calculate_fee(Request $request){

        $data=$request->all();
        Session::put('matp',$data['matp']);
        Session::put('maqh',$data['maqh']);
        Session::put('maxp',$data['maxp']);
        if($data['matp']){
            $feeship=Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_maxp',$data['maxp'])->get();
            if($feeship){
                $count_feeship=$feeship->count();
                if($count_feeship>0){
                    foreach($feeship as $key =>$fee){
                        Session::put('fee',$fee->fee_ship);
                        Session::save();
                    }
                }
                else{
                    Session::put('fee',30000);
                    Session::save();
                }
            }
            
        }
    }
    public function select_delivery_home(Request $request){
        $data=$request->all();
        if($data['action']){
            $output='';
            if($data['action']=="city"){
                $select_province=Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                $output.='<option> ---Chọn quận huyện---</option>';
                foreach($select_province as $key=>$province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }
                
            }
            else{
                $select_wards=Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option> ---Chọn xã phường---</option>';
                foreach($select_wards as $key=>$wards){
                    $output.='<option value="'.$wards->xaid.'">'.$wards->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }
    public function login_checkout(){
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('post',$post);
    }

    public function login(){
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('post',$post);
    }

    public function add_customer (Request $request){
        $data=array();
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['customer_password']=md5($request->customer_password);
        $data['customer_phone']=$request->customer_phone;
        $phone = strlen($request->customer_phone);
        $pass = strlen($request->customer_password);
        $pa = ctype_digit($request->customer_phone);
        if($phone < 10 || $phone > 11 || $pa != 1){
            Session::put('message','Số điện thoại không đúng!');
            return redirect()->back();
        }else if($pass < 8){
            Session::put('message','Mật khẩu quá ngắn! Vui lòng nhập mật khẩu dài hơn 8 ký tự.');
            return redirect()->back();
        }else if($pass > 20){
            Session::put('message','Mật khẩu quá dài!');
            return redirect()->back();
        }else{
            $customer_id= DB::table('tbl_customer')->insertGetId($data);
            Session::put('customer_id',$customer_id);
            Session::put('customer_name',$request->customer_name);
            return Redirect('/trang-chu');
        }
        
    }

    public function checkout(){
        $post=CategoryPost::where('category_post_status',1)->orderBy('category_post_id','DESC')->get();
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $city=City::orderby('matp','ASC')->get();
        return view('pages.checkout.checkout')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('city',$city)->with('post',$post);
    }
    public function save_checkout(Request $request){
        $data=array();
        $data['shipping_name']=$request->ship_name;
        $data['shipping_email']=$request->ship_email;
        $data['shipping_note']=$request->ship_note;
        $data['shipping_phone']=$request->ship_phone;
        $data['shipping_address']=$request->ship_address;
        $shipping_id= DB::table('tbl_shipping')->insertGetId($data);
        
        Session::put('shipping_id',$shipping_id);
        return Redirect('/payment');
    }
   
    public function logout_checkout(){
        Session::flush();
         return Redirect::to('/login-checkout');
    }
    public function login_customer (Request $request){
        $email=$request->email_account;
        $password=md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        
        if($result){
            Session::put('customer_id',$result->customer_id);
            Session::put('customer_name',$result->customer_name);
            return Redirect('/trang-chu');
        }if($result == []){
            Session::put('message','Vui lòng điền đầy đủ Tên đăng nhập và mật khẩu!');
            return Redirect('/login-checkout');
        }else{
            Session::put('message','Mật khẩu hoặc tên đăng nhập không đúng!');
            return Redirect('/login-checkout');
        }
        
    }

    public function payment(){
        $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('category_product',$category_product)->with('brand_product',$brand_product);
    }
    public function order_place(Request $request){
        //insert payment
        $data=array();
        $data['payment_method']=$request->payment_option;
        $data['payment_status']='Đang chờ xử lý';
        $payment_id= DB::table('tbl_payment')->insertGetId($data);

        // insert order
        $content=Cart::content();
        $order_data=array();
        $order_data['customer_id']=Session::get('customer_id');
        $order_data['shipping_id']=Session::get('shipping_id');
        $order_data['payment_id']=$payment_id;
        $order_data['order_total']=Cart::total(0,'','.');
        $order_data['order_status']='Đang chờ xử lý';
        $order_id= DB::table('tbl_order')->insertGetId($order_data);

        //insert order_detail
        foreach($content as $v_content){
            $order_detail_data=array();
            $order_detail_data['order_id']=$order_id;
            $order_detail_data['product_id']=$v_content->id;
            $order_detail_data['product_name']=$v_content->name;
            $order_detail_data['product_price']=$v_content->price;
            $order_detail_data['product_quantity']=$v_content->qty;
            DB::table('tbl_order_detail')->insert($order_detail_data);
            
        }
        if($data['payment_method']==1){

        }
        elseif($data['payment_method']==2){
            $category_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
            $brand_product=DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
            Cart::destroy();
            return view('pages.checkout.handcash')->with('category_product',$category_product)->with('brand_product',$brand_product);
            
        }
        
   
        //return Redirect('/payment');
    }
    public function manage_order(){
        $this->AuthLogin();
        $all_order=DB::table('tbl_order')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
       
        ->orderby('order_id','desc')->get();
        $manager_order=view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }
    public function edit_order($order_id){
        $this->AuthLogin();
        $order_by_id=DB::table('tbl_order')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->where('tbl_order.order_id',$order_id)
        ->get();

        $order_detail=DB::table('tbl_order')  
        ->join('tbl_order_detail','tbl_order_detail.order_id','=','tbl_order.order_id')
        ->join('tbl_product','tbl_order_detail.product_id','=','tbl_product.product_id')
        ->where('tbl_order.order_id',$order_id)
        ->select('tbl_order_detail.*','tbl_product.product_price as pro_price','product_image')
        ->get();
        $manager_order=view('admin.view_order')->with('order_by_id',$order_by_id)->with('order_detail',$order_detail);
        return view('admin_layout')->with('admin.view_order',$manager_order);
    }
    public function check_coupon(Request $request){
        $data=$request->all();
        $coupon=Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon=$coupon->count();
            if($count_coupon>0){
                if($coupon->coupon_time==0){
                    return redirect()->back()->with('message','Mã giảm giá đã dùng hết');
                }
                $count_session=Session::get('coupon');
                if($count_session){
                    $is_available=0;
                    if($is_available==0){
                        $cow[]=array(
                            'coupon_code'=>$coupon->coupon_code,
                            'coupon_condition'=>$coupon->coupon_condition,
                            'coupon_number'=>$coupon->coupon_number
                        );
                        Session::put('coupon',$cow);
                    }
                }
                else{
                    $cow[]=array(
                        'coupon_code'=>$coupon->coupon_code,
                        'coupon_condition'=>$coupon->coupon_condition,
                        'coupon_number'=>$coupon->coupon_number
                    );
                    Session::put('coupon',$cow);
                }
                Session::save();
                return redirect()->back()->with('message','Lấy mã giảm giá thành công');
            }
        }
        else{
            return redirect()->back()->with('message','Mã giảm giá không đúng');
        }
    }
}
