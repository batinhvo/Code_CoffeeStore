<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Admin_Role;
use App\Models\Role;
use App\Http\Requests;
use Session;
use DB;
use Carbon;
use Illuminate\Support\Facades\Redirect;
class AuthController extends Controller
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

    public function save_warehouse(Request $request){
        $this->AuthLogin();
        $data=array();
        $data['product_id']=$request->product_id;
        $data['brand_id']=$request->brand_product;
        $data['product_prices']=$request->product_price;
        $data['address_product']=$request->address_product;
        $data['product_quanti']=$request->product_quantity;
        $data['NSX']=$request->NSX;
        $data['NHH']=$request->NHH;
        $data['create_at']= date('Y-m-d');
        $product_id=$request->product_id;
        $product_sl=DB::table('tbl_product')->where('product_id',$product_id)->get();
        foreach($product_sl as $pro){
            $pro_sl_old = $pro->product_quantity;
        }
        $proslu = $pro_sl_old + $request->product_quantity;
        $prod=array();
        $prod['product_quantity']=$proslu;
        DB::table('tbl_ware')->insert($data);
        DB::table('tbl_product')->where('product_id',$product_id)->update($prod);
        Session::put('message','Thêm đơn hàng nhập kho thành công');
        return Redirect::to('manage-warehouse');
    }

    public function update_warehouse(Request $request,$warehouse_id){
        $this->AuthLogin();
        $data=array();
        $data['product_id']=$request->product_id;
        $data['brand_id']=$request->brand_product;
        $data['product_prices']=$request->product_price;
        $data['address_product']=$request->address_product;
        $data['product_quanti']=$request->product_quantity;
        $data['NSX']=$request->NSX;
        $data['NHH']=$request->NHH;
        $data['create_update']= date('Y-m-d');
        $product_sl=DB::table('tbl_ware')->where('warehouse_id',$warehouse_id)->get();
        foreach($product_sl as $pro){
            $pro_sl_old = $pro->product_quanti;
        }
        $product=DB::table('tbl_product')->where('product_id',$request->product_id)->get();
        foreach($product as $prod){
            $pro_sl = $prod->product_quantity;
        }
        $sl=$request->product_quantity - $pro_sl_old;
        if($sl > 0){
            $pro_sl += $sl;
        }else if($sl < 0){
            $pro_sl -= abs($sl); 
        }
        DB::table('tbl_ware')->where('warehouse_id',$warehouse_id)->update($data);
        $prod=array();
        $prod['product_quantity']=$pro_sl;
        DB::table('tbl_product')->where('product_id',$request->product_id)->update($prod);
        Session::put('message','Cập nhật đơn hàng nhập kho thành công');
        return Redirect::to('manage-warehouse');
    }

    public function add_warehouse(){
        $this->AuthLogin();
        $category_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $product=DB::table('tbl_product')->orderby('product_id','desc')->get();
        return view('admin.warehouse.add_warehouse')->with('category_product',$category_product)->with('brand_product',$brand_product)->with('product',$product);
    }

    public function edit_warehouse($warehouse_id){
        $this->AuthLogin();
        $edit_warehouse=DB::table('tbl_ware')->where('warehouse_id',$warehouse_id)->get();
        $product=DB::table('tbl_product')->orderby('product_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $warehouse=view('admin.warehouse.edit_warehouse')->with('edit_warehouse',$edit_warehouse)->with('brand_product',$brand_product)
        ->with('product',$product);
        return view('admin_layout')->with('admin.warehouse.edit_warehouse',$warehouse);
    }

    public function manage_warehouse(){
        $this->AuthLogin();
        $admin=Admin::orderby('admin_id','desc')->get();
        $ware_all=DB::table('tbl_ware')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_ware.brand_id')
        ->join('tbl_product','tbl_product.product_id','=','tbl_ware.product_id')->get();
        return view('admin.warehouse.all_warehouse')->with(compact('admin'))->with('warehouse',$ware_all);
    }

    public function delete_warehouse($warehouse_id){
        $this->AuthLogin();
        $ware_all=DB::table('tbl_ware')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_ware.brand_id')
        ->join('tbl_product','tbl_product.product_id','=','tbl_ware.product_id')->where('warehouse_id',$warehouse_id)->get();
        foreach($ware_all as $ware){
            $product_id=$ware->product_id;
            $quantity=$ware->product_quantity - $ware->product_quanti;
        }
        DB::table('tbl_ware')->where('warehouse_id',$warehouse_id)->delete();
        $data=array();
        $data['product_quantity']=$quantity;
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Xóa đơn hàng nhập kho thành công');
        return Redirect::to('manage-warehouse');
    }

    public function delete_admin($admin_id){
        DB::table('tbl_admin')->where('admin_id',$admin_id)->delete();
        return redirect()->back();
    }

    public function add_manage(){
        $this->AuthLogin();
        return view('admin.manage.add_manage');
    }
    public function all_manage(){
        $this->AuthLogin();
        $admin=Admin::orderby('admin_id','desc')->get();

        return view('admin.manage.all_manage')->with(compact('admin'));
    }

    public function active_admin($admin_id){
        $this->AuthLogin();
        if($admin_id == 1){
            Session::put('message','Không thể thay đổi tài khoản này!!!');
            return redirect()->back();
        }else{
            DB::table('tbl_admin')->where('admin_id',$admin_id)->update(['roles'=>1]);
            return redirect()->back();
        }
        
    }

    public function unactive_admin($admin_id){
        $this->AuthLogin();
        if($admin_id == 1){
            Session::put('message','Không thể thay đổi tài khoản này!!!');
            return redirect()->back();
        }else{
            DB::table('tbl_admin')->where('admin_id',$admin_id)->update(['roles'=>2]);
            return redirect()->back();
        }
    }

    public function register_auth(){
        $this->AuthLogin();
        return view('admin.custom_auth.register');
    }
    public function register(Request $request){
        $this->AuthLogin();
        $data=$request->all();
        $admin = new Admin();
        $admin->admin_name=$data['admin_name'];
        $admin->admin_phone=$data['admin_phone'];
        $admin->admin_email=$data['admin_email'];
        $admin->admin_password=md5($data['admin_password']);
        $get_image=$request->file('admin_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image=$name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            // $get_image->move('public/uploads/admin/',$new_image);
            $admin->admin_image=$new_image;
        }
        $admin->roles=$data['roles'];
        
        $admin->save();
        
        return redirect('/all-manage')->with('message','Đăng kí tài khoản nhân viên thành công');
    }
    
}
