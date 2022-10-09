@extends('normal_layout')
@section('content')
<section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
               
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                     
                        <?php
                            $total=0;
                        ?>
                        @foreach(Session::get('cart') as $key=> $cart)
                        <?php
                            $subtotal=$cart['product_price']*$cart['product_qty'];
                            $total+=$subtotal;
                        ?>
						<tr>
							<td class="cart_product">
								<a href=""><img width="50" src="{{('public/uploads/product/'.$cart['product_image'])}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>{{$cart['product_name']}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($cart['product_price'],0,',','.')}} đ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="post">
                                        
                                        <input class="cart_quantity_input" min="1" type="number" name="quantity" value="{{$cart['product_qty']}}"  size="2">
                                       
                                        <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                    </form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
                                {{number_format($subtotal,0,',','.')}} đ
                                </p>
							</td>
							<td class="cart_delete">
								<a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này?')" class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/')}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        @endforeach

						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->


    <section id="do_action">
		<div class="container container col-sm-12">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng tiền  <span> {{number_format($total,0,',','.')}} đ</span></li>
							<li>Thuế <span></span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Tiền sau giảm <span></span></li>
						</ul>
					
								<a class="btn btn-default check_out" href="">Thanh toán</a>
							
		
									
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection