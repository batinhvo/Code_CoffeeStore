@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ PHÍ SHIP
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
            <th>Địa chỉ</th>
            <th>Mức phí</th>
        
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($delivery as $key =>$cou)
            @foreach($city as $key => $ci)
                @if($cou->fee_matp == $ci->matp)
                @foreach($town as $key => $to)
                    @if($cou->fee_maqh == $to->maqh)
                    @foreach($xa as $key => $x)
                        @if($cou->fee_maxp == $x->xaid)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$x->name_xaphuong}} - {{$to->name_quanhuyen}} - {{$ci->name_thanhpho}}</td>
                            <td>{{number_format($cou->fee_ship,0,',','.')}}đ</td>
                            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
                            <td>
                            <a href="{{URL::to('/edit-delivery/'.$cou->fee_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a onclick="return confirm('Bạn có chắc là muốn xóa mã giảm giá này?')"  class="active styling-edit"  ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                @endif
            @endforeach
            @endif
          @endforeach
         @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection