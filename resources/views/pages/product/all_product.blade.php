@extends('normal_layout')
@section('content')
<div class="features_items"><!--features_items-->

        <!-- <div class="search_box" style="width: 200px">
        <form action="{{URL::to('/sap-xep')}}" method="post">
            {{csrf_field()}}
            <div class="search_box">
                <select name="sort_select"  class="form-control input-sm m-bot15 payment_select">
                    <option value="1">Giá tăng dần</option>
                    <option value="2">Giá giảm dần</option>
                </select>
                <button type="submit" style="" name="search_item" class="btn btn-sm search_item">OK</button>
                <div id="search-ajax"></div>

            </div>
        </form>
        </div> -->

        

        <h2 class="title text-center">SẢN PHẨM CỦA CỬA HÀNG</span></h2>
        @foreach($all_product as $key =>$product)
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