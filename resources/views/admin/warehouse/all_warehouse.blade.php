@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ ĐƠN HÀNG NHẬP KHO
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
            <th>Tên sản phẩm</th>
            <th>Nguồn cung cấp</th>
            <th>Địa chỉ lấy hàng</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Ngày sản xuất</th>
            <th>Ngày hết hạn</th>
            <th>Ngày nhập</th>
            <th>Ngày cập nhật</th>
            <th>Tổng tiền</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
           @foreach($warehouse as $key =>$ware)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$ware->product_name}}</td>
            <td>{{$ware->brand_name}}</td>
            <td>{{$ware->address_product}}</td>
            <td>{{$ware->product_quanti}}</td>  
            <td>{{number_format($ware->product_prices,0,',','.')}}đ</td>
            <td>{{$ware->NSX}}</td>
            <td>{{$ware->NHH}}</td>
            <td>{{$ware->create_at}}</td>   
            <td>{{$ware->create_update}}</td> 
            <td>{{number_format($ware->product_quanti * $ware->product_prices,0,',','.')}}đ</td>    
            <td>
              <a href="{{URL::to('/edit-warehouse/'.$ware->warehouse_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này?')" href="{{URL::to('/delete-warehouse/'.$ware->warehouse_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection