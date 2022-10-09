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
			
			<div class="register-req">
				<p>Đăng kí hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
				
					<div class="col-sm-12 clearfix">
						<div class="table-responsive cart_info">
						<?php
						
							$content=Cart::content();
							$total=0;

						
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
								<td class="total">Tổng tiền</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							@foreach($content as $v_content)
								
							<tr>
								<td class="cart_product">
									<a href=""><img width="80" src="{{('public/uploads/product/'.$v_content->options->image)}}" alt=""></a>
								</td>
								<td class="cart_description">
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
											<input min="1" style="width:50px;" class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->qty}}" >
											<!-- <input type="hidden" value="{{$v_content->rowId}}" name="row_Id" class=""> -->
											<!-- <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm"> -->
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
							<tr>
							<td></td>
							<td>
				
							</td>
							<td></td> <td></td>
							<td>
								<form method="post" action="{{URL::to('/check-coupon')}}">
									{{csrf_field()}}
									<input name="coupon" type="text" class="form-control" placeholder="Nhập mã giảm giá">
									<input type="submit" class="btn btn-default check_out" value="Tính mã giảm giá" name="check_coupon">
								</form>
							</td>
						</tr>
						
						
						</tbody>
					</table>
				</div>
					</div>
				</div>
			</div>
	

			
	</div>
</section> <!--/#cart_items-->
<section id="do_action">
		<div class="container container col-sm-12">
			
			<div class="row">
			<div class="col-sm-6">
						<div class="bill-to">
							
							<div>
								
								<form>
                                    {{csrf_field()}}
                                
                                <div class="form-group">
                                <label for="exampleInputPassword1">Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                        <option value="">-Chọn thành phố-</option>
                                        @foreach($city as $key =>$ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_thanhpho}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Chọn quận huyện</label>

                                    <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                         <option value="">-Chọn quận huyện-</option>
                                       
                        
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    <option value="">-Chọn xã phường-</option>
                          
                        
                                    </select>
                                </div>
                               
                               
								<input style="float:right;" type="button" class="btn btn-primary btn-sm calculate_delivery" value="Tính phí vận chuyển">
                            </form>
							
							</div>
							
						</div>
					</div>
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng  <span>{{Cart::subtotal(0,'','.').' VNĐ'}}</span></li>
							<li>Thuế <span>{{Cart::tax(0,'','.').' VNĐ'}}</span></li>
							@if(Session::get('fee'))
							<li><a  class="cart_quantity_delete" href="{{URL::to('/delete-fee')}}"><i class="fa fa-times"></i></a>Phí vận chuyển <span>{{number_format(Session::get('fee'), 0, '.', '.'). ' VNĐ'}}</span></li>
							<?php $total_fee=Session::get('fee'); ?>
							@endif
							<li> <a  class="cart_quantity_delete" href="{{URL::to('/delete-coupon-home')}}"><i class="fa fa-times"></i></a>Giảm giá:   <?php
									if(Session::get('coupon')){
										foreach(Session::get('coupon') as $key=>$cou){
											if($cou['coupon_condition']==1){
												echo($cou['coupon_number'].'%');
												// $total_coupon=(Cart::total()*$cou['coupon_number'])/100;
												// echo($total_coupon);
											
												
												
											}
										}
									}
							?> <span><?php
									if(Session::get('coupon')){
										foreach(Session::get('coupon') as $key=>$cou){
											if($cou['coupon_condition']==1){
												$total_coupon=$total*$cou['coupon_number']/100;
												echo(number_format($total_coupon, 0, '.', '.'). ' VNĐ');
											}
											else{
												$total_coupon=$cou['coupon_number'];
												echo(number_format($total_coupon, 0, '.', '.'). ' VNĐ');
											}
										}
									}
									if(!Session::get('coupon')){
										$total_coupon=0;
										echo(number_format($total_coupon, 0, '.', '.'). ' VNĐ');
									}
							?></span></li>
							<li>Thành tiền <span>
								<?php
									if(Session::get('coupon') && Session::get('fee'))
								echo(number_format($total-$total_coupon+Session::get('fee'), 0, '.', '.'). ' VNĐ');
								else if(Session::get('coupon') && !Session::get('fee'))
								echo(number_format($total-$total_coupon, 0, '.', '.'). ' VNĐ');
								else if(!Session::get('coupon') && Session::get('fee'))
								echo(number_format($total+Session::get('fee'), 0, '.', '.'). ' VNĐ');
								else 
								echo(number_format($total, 0, '.', '.'). ' VNĐ');
								?>
							</span></li>
							
						</ul>
						<a  class="btn btn-default check_out" href="{{URL::to('/info-delivery')}}">Thanh toán</a>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	
@endsection
