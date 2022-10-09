<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();
class DeliveryController extends Controller
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
    public function delivery(Request $request){
        $this->AuthLogin();
        $city=City::orderby('matp','ASC')->get();
      
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function select_delivery(Request $request){
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
    public function insert_delivery(Request $request){
        $data=$request->all();
        $fee_ship =new Feeship();
        $fee_ship->fee_matp=$data['city'];
        $fee_ship->fee_maqh=$data['province'];
        $fee_ship->fee_maxp=$data['wards'];
        $fee_ship->fee_ship=$data['fee_ship'];
        $fee_ship->save();
    }
    public function select_feeship(){
        $fee_ship=Feeship::orderby('fee_id','DESC')->get();
        $output='';
        $output.='<div class="table-responsive"> 
            <table class="table table-bordered">
                <thread>
                    <tr>
                        <th>Tên thành phố</th>
                        <th>Tên quận huyện</th>
                        <th>Tên xã phường</th>
                        <th>Phí ship</th>
                    </tr>
                </thread>
                <tbody>
                ';
                foreach($fee_ship as $key =>$fee){
                    $output.='
                    <tr>
                        <td>'.$fee->city->name_thanhpho.'</td>
                        <td>'.$fee->province->name_quanhuyen.'</td>
                        <td>'.$fee->wards->name_xaphuong.'</td>
                        <td contenteditable data-feeship_id="'.$fee->fee_id.'" class="feeship_edit">'.number_format($fee->fee_ship,0,'','.').'</td>
                    </tr>
                    ';
                }
                    
        $output.='
                </tbody>
            </table>
            </div>

        ';
        echo $output;
    }
    public function update_delivery(Request $request){
        $data=$request->all();
        $fee_ship = Feeship::find($data['feeship_id']);
        $fee_value=rtrim($data['fee_value'],'.');
        $fee_ship->fee_ship=$fee_value;
        $fee_ship->save();
    }
}
