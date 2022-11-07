@extends('normal_layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Lịch sử mua hàng của bạn</h2>

    <div class="col-sm-12">
                <div class="productinfo text-center">
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
                        echo('<td style="color:#2db914;">Chưa xác nhận</td>');
                        elseif($ord->order_status==2)
                        echo('<td style="color:blue;">Đã giao hàng và tính tiền</td>');
                        elseif($ord->order_status==4)
                        echo('<td style="color:yellow;">Đã xác nhận đơn hàng</td>');
                        else   echo('<td style="color:red;">Đã hủy đơn</td>');
                        ?>
                            <td>{{number_format($ord->order_total, 0, '.', '.'). ' VNĐ'}}</td>

                                <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
                                <td>
                                    <a href="{{URL::to('/chitiet-lichsu/'.$ord->order_id)}}" class="active styling-edit"
                                        ui-toggle-class=""><i class="fa fa-eye text-success text-active"></i></a>

                                </td>
                                <!-- <td class="cart_delete">
								    <a onclick="return confirm('Bạn có chắc là muốn HỦY đơn hàng này?')" class="cart_quantity_delete" href=""><i>Hủy đơn</i></a>
							    </td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    
            </div>
        </div>
    </div>


</div><!--features_items-->

<!--/category-tab-->




@endsection