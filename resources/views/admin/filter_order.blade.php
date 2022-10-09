@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-heading">
                    Lọc Theo Tình Trạng Đơn Hàng
                </div>
            </div>
        </div>

        <div class="row select-order">

            <div class="col-sm-3">
                <a href="{{URL::to('/filter-order/1')}}" class="btn btn-success mt-3">Đơn hàng mới</a>

            </div>
            <div class="col-sm-3">
                 <a href="{{URL::to('/filter-order/4')}}" class="btn btn-warning mt-3">Đã xác nhận</a>

            </div>
            <div class="col-sm-3">
                 <a href="{{URL::to('/filter-order/2')}}" class="btn btn-primary mt-3">Đã giao hàng</a>

            </div>
            <div class="col-sm-3">
                 <a href="{{URL::to('/filter-order/3')}}" class="btn btn-danger mt-3">Đã hủy đơn</a>

            </div>
        </div>
        <div class="panel-heading">
            LIỆT KÊ ĐƠN HÀNG
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

                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng </th>
                        <th>Tình trạng đơn hàng</th>
                        <td>Tổng tiền</td>

                        <!-- <th>Ngày thêm</th> -->
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            $i=0;
          ?>
                    @foreach($order as $key =>$ord)
                    <?php
              $i++;
            ?>
                    <tr>
                        <td><label><i>{{$i}}</i></label></td>
                        <td>{{$ord->order_code}}</td>
                        <td>{{$ord->created_at}}</td>

                        <?php
                  if($ord->order_status==1) 
                  echo('<td style="color:#2db914;">Đơn hàng mới</td>');
                   elseif($ord->order_status==2)
                   echo('<td style="color:blue;">Đã giao hàng và tính tiền</td>');
                   elseif($ord->order_status==4)
                   echo('<td style="color:yellow;">Đã xác nhận đơn hàng</td>');
                   else   echo('<td style="color:red;">Đã hủy đơn</td>');
                ?>
                    <td>{{number_format($ord->order_total, 0, '.', '.'). ' VNĐ'}}</td>

                        <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
                        <td>
                            <a href="{{URL::to('/view-order/'.$ord->order_id)}}" class="active styling-edit"
                                ui-toggle-class=""><i class="fa fa-eye text-success text-active"></i></a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      
        
    </div>
    <a class="btn btn-warning" href="{{URL::to('/manage-order/')}}">Trở về</a>
</div>
@endsection