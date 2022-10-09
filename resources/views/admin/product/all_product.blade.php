@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ SẢN PHẨM
    </div>
    
    <div class="table-responsive">
    <?php
		$message=Session::get('message');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>';
			Session::put('message',null);
		}
	?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng tồn</th>
            <th>Hình sản phẩm</th>
            <th>Thư viện ảnh</th>
            <th>Số lượng đã bán</th>
    
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Hiển thị</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key =>$cate_pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$cate_pro->product_name}}</td>
            <td>{{$cate_pro->product_price}}</td>
            <td>{{$cate_pro->product_quantity}}</td>
            <td><img src="public/uploads/product/{{$cate_pro->product_image}}" alt="" height="100" width="100"></td>
            <td><a href="{{('add-gallery/'.$cate_pro->product_id)}}"><i class="fa fa-pencil-square-o text-success text-active"></i></a></td>
            <td>{{$cate_pro->product_sold}}</td>
            <td>{{$cate_pro->category_name}}</td>
            <td>{{$cate_pro->brand_name}}</td>
            <td><span class="text-ellipsis">
              <?php
                if($cate_pro->product_status==1){
                ?>   
                  <a href="{{URL::to('/unactive-product/'.$cate_pro->product_id)}}"> <span class="fa-thumbs-styling fa fa-thumbs-up"></span></a>
               <?php }else {
               ?>  
                <a href="{{URL::to('/active-product/'.$cate_pro->product_id)}}"> <span class="fa-thumbs-styling fa fa-thumbs-down"></span></a>
                <?php
              }?>
            </span></td>
            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
            <td>
              <a href="{{URL::to('/edit-product/'.$cate_pro->product_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này?')" href="{{URL::to('/delete-product/'.$cate_pro->product_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-sm-7 text-right text-center-xs">
      <ul class="pagination pagination-sm m-t-none m-b-none">
    
            
      </ul>
    </div>
  </div>
</div>
@endsection