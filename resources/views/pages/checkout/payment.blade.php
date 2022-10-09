@extends('normal_layout')
@section('content')
<section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div>
           
            <div class="table-responsive cart_info">
                <?php
                  
                    $content=Cart::content();
                   
                  
                ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        @foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img width="50" src="{{('public/uploads/product/'.$v_content->options->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price, 0, '.', '.'). ' VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="post">
                                        {{csrf_field()}}
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->qty}}"  size="2">
                                        <input type="hidden" value="{{$v_content->rowId}}" name="row_Id" class="">
                                        <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                    </form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
                                    <?php
                                        $subtotal=$v_content->price * $v_content->qty;
                                        echo(number_format($subtotal, 0, '.', '.'). ' VNĐ');
                                    ?>
                                </p>
							</td>
							<td class="cart_delete">
								<a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này?')" class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        @endforeach

						
					</tbody>
				</table>
			</div>
            <h4 style="font-size:20px; margin:40px 0;">Chọn hình thức thanh toán</h4>
            <form action="{{URL::to('/order-place')}}" method="post">
                {{csrf_field()}}
                <div class="payment-options">
                        <span>
                            <label><input name="payment_option" value="1" type="checkbox">Trả bằng thẻ ATM</label>
                        </span>
                        <span>
                            <label><input name="payment_option" value="2" type="checkbox">Trả khi nhận hàng</label>
                        </span>
                        <hr>
                        <input type="submit"  value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-lg">
                        
                </div>
            </form>
		</div>
	</section> <!--/#cart_items-->
@endsection