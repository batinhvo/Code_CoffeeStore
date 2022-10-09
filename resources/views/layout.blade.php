<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | CoffeeStore</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" 
	integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" 
	crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0123456789</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> batinh@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('/trang-chu')}}"><img class="logo" src="{{URL::to('public/frontend/images/logo.png')}}" alt=""/></a>
						</div>
						<h4 style="margin-top: 15px;">Hân hạnh phục vụ!</h4>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
							
								<li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
								<?php
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if($customer_id!=NULL && $shipping_id==Null){
										
									
								?>
								<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
									}elseif($customer_id!=Null && $shipping_id!=Null){

								?>
								<li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
									}else{ 	?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
										<?php }?>
								

								<li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								<?php
									$customer_id = Session::get('customer_id');
									$customer_name=Session::get('customer_name');
									if($customer_id!=NULL){
										
									
								?>
								
								
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> {{$customer_name}} (Đăng xuất) </a></li>
								
								<?php
									}else{ 	?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
										<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
								<li><a href="#">Sản phẩm<i></i></a>
                                    <!-- <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="{{URL::to('/show-cart')}}">Cart</a></li> 
										<li><a href="login.html">Login</a></li> 
                                    </ul> -->
                                </li> 
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
									
                                    <ul role="menu" class="sub-menu">
										@foreach ($post as $key =>$all_post)
                                       	 <li><a href="{{URL::to('/danh-muc-bai-viet/'.$all_post->category_post_id)}}">{{$all_post->category_post_name}}</a></li>
										@endforeach
                                    </ul>
									
                                </li> 
								<li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a></li>
								<!-- <li><a href="contact-us.html">Liên hệ</a></li> -->
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form autocomplete="off" action="{{URL::to('/tim-kiem')}}" method="post">
							{{csrf_field()}}
							<div class="search_box pull-right">
								<input type="text" id="keywords" name="keywords" placeholder="Tìm kiếm sản phẩm"/>
								<button type="submit" style="" name="search_item" class="btn btn-sm search_item" value="Tìm kiếm">Tìm kiếm </button>
								<div id="search-ajax"></div>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<?php
								$i=0;
							?>
							@foreach($slider as $key =>$slide)
							<?php $i++; ?>
							<div class="item {{$i==1? 'active':''}}">
								
								<div class="col-sm-12">
								<img src="public/uploads/slider/{{$slide->slider_image}}" alt=""  class="img " height="340px" width="100%">
								
								</div>
							</div>
							
							
							@endforeach
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach($category_product as $key =>$category)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$category->category_id)}}">{{$category->category_name}}</a></h4>
								</div>
								
							</div>
							@endforeach
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu sản phẩm</h2>
							@foreach($brand_product as $key => $brand)
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
								</ul>
							</div>
							@endforeach
						</div><!--/brands_products-->
						
						
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">

					@yield('content')

					
					
				</div>
			</div>
		</div>
	</section>

	<!-- chatbox -->
	<!-- <session>
		<button class="chat_icon">
			<i class="fas fa-comments"></i>
		</button>
		<div class="chat_box">
			<div class="title">
				Hỗ trợ khách hàng
				<button class="exit" onclick="closeBtn()"><i class="fas fa-times"></i></button>
			</div>
			<div class="form">
				<div class="bot-inbox inbox">
					<div class="icon">
						<i class="fas fa-user"></i>
					</div>
					<div class="msg-header">
						<p class="word-break" >Xin chào! CoffeeStore có thể giúp gì cho bạn ạ?</p>
					</div>
				</div>		
			</div>
			<div class="typing-field">
				<div class="input-data">
					<input id="data" type="text" placeholder="Nhập vào đây..." required>
					<button id="send-btn">Gửi</button>
				</div>
			</div>
		</div>
	</session> -->
	
	<!-- /chatbox -->
	
	<footer id="footer"><!--Footer-->
		
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Dịch Vụ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Giúp đỡ trực tuyến</a></li>
								<li><a href="#">Liên hệ</a></li>
								<li><a href="#">Tình trạng đơn hàng</a></li>
								<li><a href="#">Thay đổi vị trí</a></li>
							
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Cà phê hạt</a></li>
								<li><a href="#">Cà phê xay</a></li>
								<li><a href="#">Dụng cụ pha chế</a></li>
																
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Chính sách an ninh</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Điều khoản sử dụng</a></li>
								<li><a href="#">Chính sách tư nhân</a></li>
								<li><a href="#">Chính sách hoàn trả</a></li>
								<li><a href="#">Hệ thống thanh toán</a></li>
						
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Về người mua</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Thông tin shop </a></li>
								<li><a href="#">Sự nghiệp</a></li>
								<li><a href="#">Vị trí cửa hàng</a></li>
								<li><a href="#">Chương trình liên kết</a></li>
								
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Liên hệ</h2>
							<form action="#" class="searchform">
								<div class="searchdiv">
								<input type="text" placeholder="Email của bạn" />
								<button type="submit" class="btn btn-default"><i class="fas fa-arrow-alt-circle-right"></i></button>
								</div>
								<p>Nhận các bản cập nhật gần đây nhất từ ​​trang web của chúng tôi và được cập nhật chính bạn ...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2022 CoffeeStore.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="#">Bá Tính</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
   
	<script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
	<script type="text/javascript">

			

			// chatbox mới tạo ở đây nè
			$(document).ready(function(){
			$('.chat_icon').click(function(event){
				$('.chat_box').toggleClass('active');
			});
			$('.exit').click(function(event){
				$('.chat_box').toggleClass('active');
			});
			$('#send-btn').on("click", function(){
               	var $value = $("#data").val();
				$msg = '<div class="user-inbox inbox"><div class="msg-header"><p class="word-break">'+ $value +'</p></div></div>';
	            $(".form").append($msg);
				$("#data").val('');

			//xử lý ajax bắt đầu
			var value = $value;
				
				if(value!=''){
					var _token = $('input[name="_token"]').val();
					$.ajax({
					url: '{{url('/chatbot')}}',
					type: 'POST',
					data:{_token:_token,value:value},
					success:function(data){
						$reply = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header" id="msg-header"><p class="word-break">'+ data +'</p></div></div>'
						$(".form").append($reply);
                        $(".form").scrollTop($(".form")[0].scrollHeight);
					}
				});	
				}else{
					$('#msg-header').fadeOut();
				}
			});
		});
		// /chatbox
		

		
		$('#keywords').keyup(function(){
			var query =$(this).val();
			
			if(query!=''){
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/autocomplete-ajax')}}',
                    method: 'POST',
					data:{query:query,_token:_token},
					success:function(data){
						$('#search-ajax').fadeIn();
						$('#search-ajax').html(data);

					}
				});
			}
			else{
				$('#search-ajax').fadeOut();
			}
		});
		$(document).on('click','.li_search_ajax',function(){
			$('#keywords').val($(this).text());
			$('#search-ajax').fadeOut();
		});
			
				
			 

				
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				var id=$(this).data('id_product');
				var product_id_hidden =$('.cart_product_id_'+id).val();
				// var cart_product_name =$('.cart_product_name_'+id).val();
				// var cart_product_image =$('.cart_product_image_'+id).val();
				// var cart_product_price =$('.cart_product_price_'+id).val();
				var qty =$('.cart_product_qty_'+id).val();
			
				var _token = $('input[name="_token"]').val();
			 

				$.ajax({
					url: '{{url('/save-cart')}}',
                    method: 'POST',
					data:{product_id_hidden:product_id_hidden,qty:qty,_token:_token},
					success:function(data){
						swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/show-cart')}}";
                            });

					}
				});
			});
		});
	</script>
	
		<!-- Messenger Plugin chat Code -->
		<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "111032414943733");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<!-- <script>
  window.fbAsyncInit = function() {
	FB.init({
	  xfbml            : true,
	  version          : 'v13.0'
	});
  };

  (function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
	fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk')); -->
</script>

<style>
        .rw-conversation-container .rw-header {background-color: brown}
        .rw-conversation-container .rw-messages-container .rw-message .rw-client {background-color: brown}
        .rw-launcher{background-color: brown; margin-bottom: 50px;}
      </style>
<script>!(function () {
            let e = document.createElement("script"),
              t = document.head || document.getElementsByTagName("head")[0];
            (e.src =
              "https://cdn.jsdelivr.net/npm/rasa-webchat/lib/index.js"),
              // Replace 1.x.x with the version that you want
              (e.async = !0),
              (e.onload = () => {
                window.WebChat.default(
                  {
                    initPayload: '/greet',
                    customData: { language: "en" },
                    socketUrl: "http://localhost:5005",
                    title: "Hỗ trợ khách hàng",
                    subtitle: "Hân hạnh phục vụ!!!"
                    // add other props here
                  },
                  null
                );
              }),
              t.insertBefore(e, t.firstChild);
          })();
</script>

</body>
</html>