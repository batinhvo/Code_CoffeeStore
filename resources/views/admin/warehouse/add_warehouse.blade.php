@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Thêm đơn hàng nhập kho
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
                                <form role="form" action="{{URL::to('/save-warehouse')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <select name="product_id" class="form-control input-sm m-bot15">
                                        <option value="">---Chọn tên sản phẩm---</option>
                                        @foreach($product as $key =>$pro)
                                            <option value="{{ $pro->product_id }}">{{$pro->product_name}} </option>
                                        @endforeach
                        
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Nguồn cung cấp</label>
                                    <select name="brand_product" class="form-control input-sm m-bot15">
                                        <option value="">---Chọn tên nguồn cung cấp---</option>
                                        @foreach($brand_product as $key =>$brand)
                                            <option value="{{ $brand->brand_id }}">{{$brand->brand_name}} </option>
                                        @endforeach
                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ lấy hàng</label>
                                    <input required type="text" name="address_product" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input required type="number" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input required type="number" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Số lượng">                                    
                                </div>
                                <button type="submit" name="add_warehouse" class="btn btn-info">Thêm đơn nhập</button>
                            </form>
                            </div>
                        </div>
                    </section>

            </div>
@endsection