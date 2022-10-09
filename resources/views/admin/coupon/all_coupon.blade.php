@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ MÃ GIẢM GIÁ
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
            <th>Tên Mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng giảm giá</th>
            <th>Điều kiện giảm giá</th>
            <th>Số giảm</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key =>$cou)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$cou->coupon_name}}</td>
            <td>{{$cou->coupon_code}}</td>
            <td>{{$cou->coupon_time}}</td>
            
            <td><span class="text-ellipsis">
              <?php
                if($cou->coupon_condition==1){
                ?>   
                  {Giảm theo %}
               <?php }else {
               ?>  
                Giảm theo tiền
                <?php
              }?>
            </span></td>

            <td><span class="text-ellipsis">
              <?php
                if($cou->coupon_condition==1){
                ?>   
                  Giảm {{$cou->coupon_number}}%
               <?php }else {
               ?>  
                Giảm {{number_format($cou->coupon_number,0,'','.')}} vnđ
                <?php
              }?>
            </span></td>
            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
            <td>
              <!-- <a href="{{URL::to('/edit-coupon/'.$cou->coupon_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a> -->
              <a onclick="return confirm('Bạn có chắc là muốn xóa mã giảm giá này?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection