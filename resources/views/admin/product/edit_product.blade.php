@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Cập nhật sản phẩm
                          
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
                                @foreach($edit_product as $key =>$pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input required type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input required type="number" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$pro->product_price}}" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng tồn</label>
                                    <input required type="number" name="product_quantity" class="form-control" id="exampleInputEmail1" value="{{$pro->product_quantity}}" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input  type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" alt="" width="100" height="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng đã bán</label>
                                    <input required type="number" name="product_sold" class="form-control" id="exampleInputEmail1" value="{{$pro->product_sold}}" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea required style="resize:none" rows="5" name="product_desc" class="form-control" id="exampleInputPassword1"  placeholder="Mô tả danh mục">{{$pro->product_desc}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea required style="resize:none" rows="5" name="product_content" class="form-control" id="suanoidungsanpham"  placeholder="Nội dung danh mục">{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="category_product" class="form-control input-sm m-bot15">
                                        @foreach($category_product as $key =>$category)
                                            @if($category->category_id==$pro->category_id)
                                                <option selected value="{{$category->category_id}}">{{$category->category_name}} </option>
                                            @else
                                                <option value="{{$category->category_id}}">{{$category->category_name}} </option>
                                            @endif
                                        @endforeach
                        
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                    <select name="brand_product" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key =>$brand)
                                            @if($brand->brand_id==$pro->brand_id)
                                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}} </option>
                                            @else
                                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}} </option>
                                            @endif
                                        @endforeach
                        
                                    </select>
                                </div>
                                
                                
                                <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection