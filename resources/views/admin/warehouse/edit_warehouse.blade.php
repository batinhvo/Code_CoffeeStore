@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Cập nhật đơn hàng nhập kho
                        </header>
                        <?php
		$message=Session::get('message');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>';
			Session::put('message',null);
		}
	?>
                        <div class="panel-body">
                            <div class="position-center">
                            @foreach($edit_warehouse as $key => $value)
                                <form role="form" action="{{URL::to('/update-warehouse/'.$value->warehouse_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <select name="product_id" class="form-control input-sm m-bot15">
                                        <option value="">---Chọn tên sản phẩm---</option>
                                        @foreach($product as $key => $pro)
                                            @if($pro->product_id==$value->product_id)
                                                <option selected value="{{$pro->product_id}}">{{$pro->product_name}} </option>
                                            @else
                                                <option value="{{$pro->product_id}}">{{$pro->product_name}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Nguồn cung cấp</label>
                                    <select name="brand_product" class="form-control input-sm m-bot15">
                                        <option value="">---Chọn tên nguồn cung cấp---</option>
                                        @foreach($brand_product as $key => $brand)
                                            @if($brand->brand_id==$value->brand_id)
                                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}} </option>
                                            @else
                                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}} </option>
                                            @endif
                                        @endforeach
                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ lấy hàng</label>
                                    <input required type="text" name="address_product" class="form-control" id="exampleInputEmail1" value="{{$value->address_product}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input required type="number" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$value->product_prices}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input required type="number" name="product_quantity" class="form-control" id="exampleInputEmail1" value="{{$value->product_quanti}}">                                    
                                </div>
                                <button type="submit" name="edit_warehouse" class="btn btn-info">Cập nhật đơn nhập</button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection