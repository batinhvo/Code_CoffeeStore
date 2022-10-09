@extends('normal_layout')
@section('content')
<div class="features_items"><!--features_items-->
                    @foreach($brand_name as $key=> $show_brand)
						<h2 class="title text-center">Thương hiệu {{$show_brand->brand_name}}</h2>
					@endforeach
						@foreach($product_by_id as $key =>$product)
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
                           
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

						@endforeach
						

</div><!--features_items-->

<!--/category-tab-->




@endsection