@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      THÔNG TIN KHÁCH HÀNG
    </div>
    
    <div class="table-responsive">
    <?php
		$message=Session::get('message');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>';
			Session::put('message',null);
		}
	?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên khách hàng</th>
            
            <th>Số điện thoại</th>
            
            <th>Email</th>
            
            
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
  
          <tr>
          <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
           
          </tr>
      
        </tbody>
      </table>
    </div>
    
  </div>


</div>


<br><br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      THÔNG TIN VẬN CHUYỂN HÀNG HÓA
    </div>
    
    <div class="table-responsive">
    <?php
		$message=Session::get('message');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>';
			Session::put('message',null);
		}
	?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên người nhận hàng</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Ghi chú nhận hàng</th>
            <th>Hình thức thanh toán</th>
            
            
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
       
          <tr>
          <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_notes}}</td>
            <td>
              <?php
                if($shipping->shipping_method==1){
                  echo ('Tiền mặt');
      
                }
                else echo('Chuyển khoản')
              ?>
            </td>
            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
         
          </tr>
       
        </tbody>
      </table>
    </div>
    
  </div>


</div>
<br> <br>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       CHI TIẾT ĐƠN HÀNG
    </div>
   
    <div class="table-responsive">
    <?php
		$message=Session::get('message');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>';
			Session::put('message',null);
		}
	?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Số thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng kho</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá</th>
           <th>Mã giảm giá</th>
            <th>Tổng tiền</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php $i=0; $total_money=0;?>
        @foreach($order_details as $key =>$or_detail)
          <?php 
            $i++;
            $total_money+=$or_detail->product_price*$or_detail->product_quantity;
          ?>
          <tr class="color_qty_{{$or_detail->product_id}}">
            
            <td><label><i>{{$i}}</i></label></td>
            <td>{{$or_detail->product_name}}</td>
            <td>{{$or_detail->pro_quantity}}</td>
            <td><img src="{{URL::to('public/uploads/product/'.$or_detail->product_image)}}" alt="" height="100" width="100"></td>
            <td>
            {{$or_detail->product_quantity}}
            <input type="hidden" class="order_qty_storage_{{$or_detail->product_id}}" value="{{$or_detail->pro_quantity}}" name="order_qty_storage">
              <input class="order_qty_{{$or_detail->product_id}}" type="hidden" min="1" value="{{$or_detail->product_quantity}}" name="product_sales_quantity">
              <input type="hidden" name="order_product_id" class="order_checkout_quantity" value="{{$or_detail->product_id}}" >

            </td>
            <td>{{number_format($or_detail->product_price, 0, '.', '.'). ' VNĐ'}}</td>
            <td>
              <?php
                if($or_detail->product_coupon!='0'){
                  echo($or_detail->product_coupon);
                }  
                else{
                  echo('Không có mã giảm giá');
                }
              ?>
            </td>
            <td>
                {{number_format($or_detail->product_price*$or_detail->product_quantity, 0, '.', '.'). ' VNĐ'}}
            </td>
            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
           
          </tr>
        @endforeach
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
         
          <td>Giảm giá: 
            
          </td>
          <td>
              <?php
                if($coupon_condition==1){
                    $total_coupon=($total_money*$coupon_number)/100;

                }else{
                  $total_coupon=$coupon_number;
                }
              ?>
          {{number_format($total_coupon, 0, '.', '.'). ' VNĐ'}}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
         
          <td>Phí vận chuyển: 
          
          </td>
          <td>
              
          {{number_format($or_detail->product_feeship, 0, '.', '.'). ' VNĐ'}}</td>
        </tr>

        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <?php
            $total_coupon=0;
          ?>
          <td>Tổng cộng</td>
          <td>
              <?php
                if($coupon_condition==1){
                    $total_coupon=($total_money*$coupon_number)/100;

                }else{
                  $total_coupon=$coupon_number;
                }
              ?>
          {{number_format($total_money-$total_coupon+$or_detail->product_feeship, 0, '.', '.'). ' VNĐ'}}</td>
        </tr>

        <tr>
          <td colspan="3">Tình trạng đơn hàng</td>
        </tr>
        <tr>
  
          <td colspan="3">
            @foreach($order as $key => $ord)
            @if($ord->order_status==1)
            <form action="">
              {{csrf_field()}}
              <select  class="form-control order_details">
                <option id="{{$ord->order_id}}" selected value="1">Đơn hàng mới</option>
                <option id="{{$ord->order_id}}"  value="4">Xác nhận đơn hàng</option>
                <option id="{{$ord->order_id}}"  value="2">Đã giao hàng và tính tiền</option>
                <option id="{{$ord->order_id}}"  value="3">Hủy đơn</option>
                
              </select>
            </form>
            @elseif($ord->order_status==2)
            <form action="">
            {{csrf_field()}}
              <select disabled class="form-control order_details">
                <option id="{{$ord->order_id}}"  value="1">Đơn hàng mới</option>
                <option id="{{$ord->order_id}}"  value="4">Xác nhận đơn hàng</option>
                <option id="{{$ord->order_id}}"  selected value="2">Đã giao hàng và tính tiền</option>
                <option id="{{$ord->order_id}}"  value="3">Hủy đơn</option>
              </select>
            </form>
            @elseif($ord->order_status==3)
            <form action="">
            {{csrf_field()}}
              <select class="form-control order_details">
                <option id="{{$ord->order_id}}"  value="1">Đơn hàng mới</option>
                <option id="{{$ord->order_id}}"  value="4">Xác nhận đơn hàng</option>
                <option id="{{$ord->order_id}}"  value="2">Đã giao hàng và tính tiền</option>
                <option id="{{$ord->order_id}}"  selected value="3"> Đã hủy đơn</option>
              </select>
            </form>
            @else
            <form action="">
            {{csrf_field()}}
              <select class="form-control order_details">
                <option id="{{$ord->order_id}}"  value="1">Đơn hàng mới</option>
                <option id="{{$ord->order_id}}" selected   value="4">Xác nhận đơn hàng</option>
                <option id="{{$ord->order_id}}"  value="2">Đã giao hàng và tính tiền</option>
                <option id="{{$ord->order_id}}"  value="3"> Đã hủy đơn</option>
              </select>
            </form>
            @endif
            @endforeach
          </td>
        </tr>
        <tr>
          <!-- <td> -->
            <!-- <a class="btn btn-warning" target="blank" href="{{URL('/print-order/'.$or_detail->order_id)}}"><i class="fa fa-print"> In đơn hàng</i> </a> -->
          <!-- </td> -->
          <td colspan="2">
            <a class="btn btn-danger" href="{{URL::to('/manage-order/')}}">Trở về</a>
          </td>
        </tr>
        </tbody>
      </table>
      
    </div>
    
  </div>
</div>
@endsection