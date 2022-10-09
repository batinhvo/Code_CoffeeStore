@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ SLIDER
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
            <th>Tên slide</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Tình trạng</th>
            
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_slide as $key =>$slide)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$slide->slider_name}}</td>
            <td><img src="public/uploads/slider/{{$slide->slider_image}}" alt=""  width="300"></td>
            <td>{{$slide->slider_desc}}</td>
            <td><span class="text-ellipsis">
              <?php
                if($slide->slider_status==1){
                ?>   
                  <a href="{{URL::to('/unactive-slider/'.$slide->slider_id)}}"> <span class="fa-thumbs-styling fa fa-thumbs-up"></span></a>
               <?php }else {
               ?>  
                <a href="{{URL::to('/active-slider/'.$slide->slider_id)}}"> <span class="fa-thumbs-styling fa fa-thumbs-down"></span></a>
                <?php
              }?>
            </span></td>
            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
            <td>
             
              <a onclick="return confirm('Bạn có chắc là muốn xóa slide này?')" href="{{URL::to('/delete-slide/'.$slide->slider_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection