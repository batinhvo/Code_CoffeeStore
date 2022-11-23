<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
</head>
<body>
<style>  
    body{ font-family:DejaVu Sans; margin: -10px 400px 0px 400px}
    table, th, td{
        border:1px solid black;
        padding: 5px;
    }
    table{
        border-collapse:collapse;
        }
</style>
<div class="col-sm-4" style="background-color: aliceblue;">
@foreach($order as $key =>$ord)
    <h1><center>HÓA ĐƠN BÁN LẺ</center></h1>
    <p   style="margin-left:20px;"><b>Tên cửa hàng:</b> CoffeeStore</p>
    <p   style="margin-left:20px;"><b>Ngày lập hóa đơn:</b> {{$ord->created_at}}</p>
    
    <p   style="margin-left:20px;"><b><i>Thông tin khách hàng</i></b></p>
    <table class="table-styling"   style="margin-left:20px;">
        
            <tr>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
            </tr>
        @foreach($customer as $key => $cus)
            <tr>
                <td>{{$cus->customer_name}}</td>
                <td>{{$cus->customer_phone}}</td>
                <td>{{$cus->customer_email}}</td>
            </tr>
        @endforeach
    </table>

    <p   style="margin-left:20px;"><b><i>Thông tin nhận hàng</i></b></p>
        <table class="table-styling"   style="margin-left:20px;">
            @foreach($shipping as $key => $shipping)
                <tr>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Ghi chú</th>
                </tr>
                <tr>
                    <td>{{$shipping->shipping_name}}</td>
                    <td>{{$shipping->shipping_address}}</td>
                    <td>{{$shipping->shipping_phone}}</td>
                    <td>{{$shipping->shipping_notes}}</td>
                </tr>
            @endforeach
        </table>

        <p   style="margin-left:20px;"><b><i>Chi tiết đơn hàng</i></b></p>
        <table class="table-styling"   style="margin-left:20px;">
       
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Mã giảm giá</th>
                <th>Tổng tiền</th>
            </tr>
        <?php
            $total=0;
            $coupon_condition=0;
            $total_coupon=0;
        ?>
        @foreach($order_details as $key => $product)
        <?php
        if($product->product_coupon!='0'){
            $product_coupon=$product->product_coupon;
        }else{
            $product_coupon='Không có mã giảm giá';
        }
        
            $subtotal=$product->product_price*$product->product_quantity;
            $total+=$subtotal;
        ?>
        <tr>
            <td>{{$product->product_name}}</td>
            <td>{{$product->product_quantity}}</td>
            <td>{{number_format($product->product_price, 0, '.', '.'). 'đ'}}</td>
            <td>{{$product_coupon}}</td>
            <td>{{number_format($subtotal, 0, '.', '.'). 'đ'}}</td>
        </tr>
        <?php
                if($coupon_condition==1){
                    $total_coupon=($total*$coupon->$coupon_number)/100;
                }else{
                    $total_coupon=$coupon_number;
                }
        ?>
        @endforeach
        <tr>
      
        <td colspan="5">
            <p>Giảm giá: {{number_format($total_coupon, 0, '.', '.'). 'đ'}}</p>
            <p>Phí vận chuyển: {{number_format($product->product_feeship, 0, '.', '.'). 'đ'}}</p>
            <p><b>Tổng tiền: {{number_format($total-$total_coupon+$product->product_feeship, 0, '.', '.'). 'đ'}}</b></p>
        </td>
            
       
    </tr>
    
    </table>
    
    </table>
    
    
    
</div>
<br><br>
<a href="{{URL::to('/lichsu/'.$ord->customer_id)}}"><button style="    width: 75px;
    height: 30px;
    font-size: 18px;
    color: white;
    background: brown;
    margin-left:300px">Trở về</button></a>
@endforeach
</body>
</html>