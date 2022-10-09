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
                <?php
                  
                    $content=Cart::content();
					$total=0;
					$tong_von=0;

                  
                ?>
				<?php
		$message=Session::get('message');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>';
			Session::put('message',null);
		}
	?>
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
                        @foreach($content as $v_content)
							
						<tr>
							<td class="cart_product">
								<a href=""><img width="70" src="{{('public/uploads/product/'.$v_content->options->image)}}" alt=""></a>
							</td>
							<td class="cart_description" style="width:25%">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>ID: {{$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price, 0, '.', '.'). ' VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="post">
                                        {{csrf_field()}}
                                        <input min="1" style="width:50px;" class="cart_quantity_input" type="number" name="quantity" value="{{$v_content->qty}}" >
                                        <input type="hidden" value="{{$v_content->rowId}}" name="row_Id" class="">
										<input type="hidden" value="{{$v_content->id}}" name="id" class="">
                                        <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                    </form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									
                                    <?php

                                        $subtotal=$v_content->price * $v_content->qty;
										$total+=$subtotal;
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
		</div>
	</section> <!--/#cart_items-->


    <section id="do_action">
		<div class="container container col-sm-12">
			
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							
							<li>Tổng tiền giỏ hàng <span>
								<?php
									
								echo(number_format($total, 0, '.', '.'). ' VNĐ');
							
								?>
							</span></li>
							
						</ul>
						<?php
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if($customer_id!=NULL &&$shipping_id==Null){
										
									
								?>
								<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Đặt hàng</a>
								<?php
									}elseif($customer_id!=Null && $shipping_id!=Null){
										
								?>
								<a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Đặt hàng</a>
								<?php
									}else{ 	?>
								<a  class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Đặt hàng</a>
										<?php }?>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection