@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <!-- <div class="panel panel-default">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-heading">
                    Lọc Theo Tình Trạng Đơn Hàng
                </div>
            </div>
    </div> -->
    <div class="panel-heading">
        THỐNG KÊ DOANH THU
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
                    <th>TỔNG DOANH THU</th>
                    <th>TỔNG TIỀN VỐN</th>
                    <th>LỢI NHUẬN </th>
                    <th>SỐ LƯỢNG HÀNG ĐÃ BÁN </th>
                    <th style="width:30px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
            $i=0;
            $tong=0;
            $tongc=0;
            $hang=0;
          ?>
                @foreach($order as $key =>$ord)
                <?php
                    $tong+=$ord->order_total;
                ?>
                @endforeach

                @foreach($order_all as $key =>$ord_d)
                <?php
                        $i=$ord_d->product_prices * $ord_d->product_quantity;
                        $tongc+=$i;
                        $hang+=$ord_d->product_quantity;
                ?>
                @endforeach
                <?php 
                    $tong=$tong+105000000;
                    $tongc=$tongc+60000000;
                ?>
                <tr style="font-weight: 800">
                    <td>{{number_format($tong, 0, '.', '.'). ' đ'}}</td>
                    <td>{{number_format($tongc, 0, '.', '.'). ' đ'}}</td>
                    <td>{{number_format($tong-$tongc, 0, '.', '.'). ' đ'}}</td>
                    <td>{{$hang}} sản phẩm</td>

                    
                    
                </tr>
                
            </tbody>
        </table>        
    </div>
</div>
    <br><br>
<div class="table-agile-info">
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
                    <th>TỔNG ĐƠN HÀNG</th>
                    <th>TỔNG ĐƠN HOÀN THÀNH</th>
                    <th>TỔNG ĐƠN BỊ HỦY</th>
                    <th>TỔNG ĐƠN CHƯA XÁC NHẬN</th>
                    <th style="width:30px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
            $i=0;
            $tong=0;
            $tongc=0;
            $tongd=0;
          ?>
                @foreach($order as $key =>$ord)
                <?php
                    $tong++;
                    if($ord->order_status == 2){
                        $i++;
                    }
                    if($ord->order_status == 3){
                        $tongc++;
                    }
                    if($ord->order_status == 1){
                        $tongd++;
                    }
                ?>
                @endforeach

                <tr style="font-weight: 800">
                    <td>{{$tong}}</td>
                    <td>{{$i}}</td>
                    <td>{{$tongc}}</td>
                    <td>{{$tongd}}</td>

                    
                    
                </tr>
                
            </tbody>
        </table>        
    </div>

    <!-- <a class="btn btn-warning" href="{{URL::to('/manage-order/')}}">Trở về</a> -->
</div>
<br><br>
<div class="table-agile-info">
    <p style="font-weight: bold; font-size: 20px; margin: 10px 10px 10px 10px; text-align: center;">BIỂU ĐỒ THỐNG KÊ DOANH THU NĂM 2022</p>
    <!-- <form autocomplete="off">
        @csrf
        <div class="col-md-2">
            <p>Từ ngày: <input type="date" id="datepicker" class="form-control" require></p>
            <input style="margin: 10px 10px 10px 10px;" type="button" id="btn-dashboard-filter" class="btn btn-primary" value="Lọc kết quả">
        </div>
        <div class="col-md-2">
            <p>Đến ngày: <input type="date" id="datepicker2" class="form-control" require></p>
        </div>
        <div class="col-md-2">
            <p>Lọc theo: 
            <select class="dashboard-filter form-control" id="dashboard-filter">
                <option style="text-align: center">>----- Chọn -----<</option>
                <option value="7ngay">7 ngày qua</option>
                <option value="thangtruoc">Tháng trước</option>
                <option value="thangnay">Tháng này</option>
                <option value="365ngayqua">365 ngày qua</option>
            </select>    
            </p>
        </div>
    </form> -->

    <div class="table-agile-info">
        <div id="chart" style="height: 250px;"></div>
    </div>

    <a class="btn btn-warning" href="{{URL::to('/manage-order/')}}">Trở về</a>
</div>

</div>
@endsection