@extends('normal_layout')
@section('content')
<section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
				  <li class="active">Thông tin vận chuyển</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix" style="width:100%;">
						<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one">
								<form method="post" action="{{URL::to('/login_checkout')}}">
									{{csrf_field()}}
									@foreach($customer as $key =>$cus)
									<input required class="shipping_email" name="ship_email" type="email" value="{{$cus->customer_email}}">
									<input required class="shipping_name"  name="ship_name"  type="text" value="{{$cus->customer_name}}">
									<input required class="shipping_phone"  name="ship_phone" type="text" value="{{$cus->customer_phone}}">
									@endforeach
									<input required class="shipping_address"   name="ship_address" type="text" placeholder="Địa chỉ">
                                    <textarea required class="shipping_notes"   name="ship_note"  placeholder="Ghi chú đơn hàng của bạn" rows="7"></textarea>
									@if(Session::get('fee'))
										<input required value="{{Session::get('fee')}}" class="order_fee"  name="order_fee" type="hidden" placeholder="Địa chỉ">
									@else
										<input required value="30000" class="order_fee"   name="order_fee" type="hidden" placeholder="Địa chỉ">
									@endif

									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key =>$cou)
											<input required value="{{$cou['coupon_code']}}" class="order_coupon"   name="order_coupon" type="hidden" placeholder="Địa chỉ">
										@endforeach
									@else
										<input required value="0" class="order_coupon"   name="order_coupon" type="hidden" placeholder="Địa chỉ">
									@endif
		
									

                                   
									<div class="">
										<div class="form-group">
											<label for="exampleInputPassword1">Chọn hình thức thanh toán</label>

											<select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
												<option value="1">Tiền mặt</option>
												<option value="0">Qua chuyển khoản</option>
								
											</select>
										</div>

               						</div>
									   <input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order">
								</form>
							
							
							</div>
							
						</div>
					</div>
				
					
				</div>
			</div>
	

			
	</div>
</section> <!--/#cart_items-->


	
@endsection
