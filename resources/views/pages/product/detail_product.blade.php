@extends('normal_layout')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb" style="background:none;">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="{{url('/danh-muc-san-pham/'.$category_id)}}">{{$category_name}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$product_name}}</li>
  </ol>
</nav>
@foreach($detail_product as $key => $detail)
	<div class="product-details">	
		<div class="col-sm-5">
			<ul id="imageGallery">
				@foreach($gallery as $key =>$gal)
				<li data-thumb="{{URL::to('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{URL::to('public/uploads/gallery/'.$gal->gallery_image)}}">
					<img width="100%" src="{{URL::to('public/uploads/gallery/'.$gal->gallery_image)}}" />
				</li>
				@endforeach
			</ul>

		</div>
		<div class="col-sm-7">
			<div class="product-information"><!--/product-information-->
				<img src="images/product-details/new.jpg" class="newarrival" alt="" />
				<h2>{{$detail->product_name}}</h2>
				<p>Mã ID: {{$detail->product_id}}</p>
				<img src="" alt="" />
				<form action="{{URL::to('/save-cart')}}" method="post">
					{{csrf_field()}}
					<span>
						<span>{{number_format($detail->product_price, 0, '.', '.'). ' VNĐ'}}</span>
						<label>Số lượng:</label>
						<input type="number" name="qty" max="{{$detail->product_quantity}}" value="1" min="1"  />
						<input type="hidden" name="product_id_hidden" value="{{$detail->product_id}}"  />
						<button type="submit" class="btn btn-fefault cart">
							<i class="fa fa-shopping-cart"></i>
							Thêm giỏ hàng
						</button>
					</span>
				</form>
				<p><b>Tình trạng:</b>
				<span style="font-size:15px; color:#F79F8E;">
				<?php
					if($detail->product_quantity>0)
					echo('Còn Hàng');
					else echo('Hết Hàng');
				?></p>
				</span>
				<p><b>Hàng sẵn có:</b>{{$detail->product_quantity}} </p>
				<p><b>Thương hiệu:</b> {{$detail->brand_name}}</p>
				<p><b>Danh mục:</b> {{$detail->category_name}}</p>
				<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
			</div><!--/product-information-->
		</div>
	</div><!--/product-details-->


	<div class="category-tab shop-details-tab"><!--category-tab-->
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li ><a href="#details" data-toggle="tab">Mô tả</a></li>
				<li ><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
			
				<li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane fade " id="details" >
				<p>{{$detail->product_desc}}</p>
				

			</div>
			
			<div class="tab-pane fade" id="companyprofile" >
				<p>{{$detail->product_content}}</p>
			
				
			</div>
			
			
			
			<div class="tab-pane fade active in" id="reviews" >
				<div class="col-sm-12">
					<ul>
						<li><a href=""><i class="fa fa-user"></i>Admin</a></li>
						<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
						<li><a href=""><i class="fa fa-calendar-o"></i>07 Apr 2022</a></li>
					</ul>
					<style>
						.style_comment{
							border:1px solid #ddd;
							border-radius:10px;
							background:#F0F0E9;
							color:#8b5858;
						}
					</style>
					<form >
						@csrf
						<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$detail->product_id}}">
						<div id="comment_show"></div>
						
						
					</form>

					<p><b>Viết Đánh Giá</b></p>
					<?php
						$customer_name = Session::get('customer_name');			
					?>
					<form action="#">
						<span>
							<input class="comment_name" style="width:100%; margin-left:0;" type="text" placeholder="Tên người bình luận" value="{{$customer_name}}"/>
							
						</span>
						<textarea placeholder="Nội dung bình luận" name="comment" class="comment_content"></textarea>
						<div id="notify_comment">
						
						</div>
						<?php
							$customer_id = Session::get('customer_id');
							if($customer_id!=NULL){			
						?>
						<!-- <b>Đánh giá sao: </b> <img src="images/product-details/rating.png" alt="" /> -->
						<button type="button" class="btn btn-default pull-right send-comment">
							Gửi bình luận
						</button>
						<?php
						}else{ 	?>
							<a onclick="return confirm('Bạn cần phải ĐĂNG NHẬP hoặc ĐĂNG KÝ TÀI KHOẢN để có thể bình luận sản phẩm!')" href="{{URL::to('/login-checkout')}}"><i class="fa fa-times"></i>
							<button type="button" class="btn btn-default pull-right">
							Gửi bình luận
						</button></a>
						<?php }?>
						
					</form>
				</div>
			</div>
			
		</div>
	</div><!--/category-tab-->
	@endforeach
	<div class="recommended_items"><!--recommended_items-->
		<h2 class="title text-center">Sản phẩm liên quan</h2>
		
		<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="item active">	
					@foreach($relate_product as $key=> $product)
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
								<form>
									@csrf
									<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
									<input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
									<input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
									<input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
									<input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

									<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
										<img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" height="250" width="200" alt="" />
										<h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
										<p>{{$product->product_name}}</p>

									
									</a>
									<button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
									</form>
								</div>
							
							</div>
						</div>
					</div>
					@endforeach
					
					
					
				</div>

				
				
			</div>
					
		</div>
		<div class="col-sm-7 text-right text-center-xs">
			<ul class="pagination pagination-sm m-t-none m-b-none">
			
					{!!  $relate_product->links('pages.paginate') !!}
			</ul>
		</div>
	</div><!--/recommended_items-->
@endsection