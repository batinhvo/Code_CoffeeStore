<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Http\Requests;
use Session;
use App\Models\Order;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
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

    public function days_order(){
        $quantity = 100;
        $profit = 50;
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = DB::table('tbl_order')
        ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
        ->whereBetween('tbl_order.created_at', [$sub30days, $now])
        ->orderBy('tbl_order.created_at', 'ASC')->get();
        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->created_at,
                'order' => $val->order_total,
                'sales' => $val->product_prices * $val->product_quantity,
                'profit' => $profit,
                'quantity' => $quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){
        $quantity = 100;
        $profit = 50;
        $data = $request->all();

        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7ngay'){
            $get = DB::table('tbl_order')
            ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
            ->whereBetween('tbl_order.created_at', [$sub7days, $now])
            ->orderBy('tbl_order.created_at', 'ASC')->get();
        }elseif($data['dashboard_value'] == 'thangtruoc'){
            $get = DB::table('tbl_order')
            ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
            ->whereBetween('tbl_order.created_at', [$dau_thangtruoc, $cuoi_thangtruoc])
            ->orderBy('tbl_order.created_at', 'ASC')->get();
        }elseif($data['dashboard_value'] == 'thangnay'){
            $get = DB::table('tbl_order')
            ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
            ->whereBetween('tbl_order.created_at', [$dauthangnay, $now])
            ->orderBy('tbl_order.created_at', 'ASC')->get();
        }
        elseif($data['dashboard_value'] == '365ngayqua'){
        $get = DB::table('tbl_order')
        ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
        ->whereBetween('tbl_order.created_at', [$sub365days, $now])
        ->orderBy('tbl_order.created_at', 'ASC')->get();
        }

        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->created_at,
                'order' => $val->order_total,
                'sales' => $val->product_prices * $val->product_quantity,
                'profit' => $profit,
                'quantity' => $quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = DB::table('tbl_order')
        ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
        ->whereBetween('tbl_order.created_at', [$from_date, $to_date])
        ->orderBy('tbl_order.created_at', 'ASC')->get();
       

        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->created_at,
                'order' => $val->order_total,
                'sales' => $val->product_prices * $val->product_quantity,
                'profit' => $profit,
                'quantity' => $quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin();
        $order=Order::count();
        $post=Post::count();
        $product=Product::count();
        $sum=Order::where('order_status',2)->sum('order_total');
        return view('admin.dashboard')->with(compact('sum','order','post','product'));
    }

    public function dashboard(Request $request){
        $admin_email=$request->admin_email;
        $admin_password=md5($request->admin_password);
        $result= DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            Session::put('admin_image',$result->admin_image);
            return Redirect::to('/dashboard');
        }
        else {
            Session::put('message','Mật khẩu hoặc tài khoản bị sai');
            return Redirect::to('/admin');
        }
    }

    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        Session::put('admin_image',null);
        return Redirect::to('/admin');
    }
}

