<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;
class SliderController extends Controller
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
    public function manage_banner(){
        $this->AuthLogin();
        $all_slide=Slider::orderby('slider_id','DESC')->get();
        return view('admin.slider.list_slider')->with(compact('all_slide'));
    }
    public function add_slider(){
        $this->AuthLogin();
        return view('admin.slider.add_slider');
    }
    public function insert_slider(Request $request){
        $this->AuthLogin();
        $data=$request->all();
       
        
        $get_image=$request->file('slider_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image=current(explode('.',$get_name_image));
            $new_image=$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider',$new_image);
           $slider=new Slider();
           $slider->slider_name=$data['slider_name'];
           $slider->slider_image=$new_image;
           $slider->slider_status=$data['slider_status'];
           $slider->slider_desc=$data['slider_desc'];
           $slider->save();
           Session::put('message','Thêm slider thành công');
           return Redirect::to('manage-banner');
        }
        else{
            Session::put('message','Bạn chưa thêm hình ảnh');
            return Redirect::to('add-slider');
        }
      
    }
    public function unactive_slider($slider_id){
        $this->AuthLogin();
        $slider=Slider::where('slider_id',$slider_id)->first();
        $slider->slider_status=0;
        $slider->save();
        Session::put('message','Ẩn slider thành công');
        return Redirect::to('manage-banner');
    }
    public function active_slider($slider_id){
        $this->AuthLogin();
        $slider=Slider::where('slider_id',$slider_id)->first();
        $slider->slider_status=1;
        $slider->save();
        Session::put('message','Hiển thị slider thành công');
        return Redirect::to('manage-banner');
    }
    public function delete_slider($slider_id){
        $this->AuthLogin();
        $slider=Slider::where('slider_id',$slider_id)->first();
    
        $slider->delete();
        Session::put('message','Xóa slider thành công');
        return Redirect::to('manage-banner');
    }
}
