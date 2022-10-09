@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ DANH MỤC BÀI VIẾT
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
            <th>Tên danh mục bài viết</th>
            <th>Mô tả danh mục bài viết</th>
            <th>Hiển thị</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_post as $key =>$post)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$post->category_post_name}}</td>
            <td>{{$post->category_post_desc}}</td>
            <td><span class="text-ellipsis">
              <?php
                if($post->category_post_status==1){
                ?>   
                  <a href="{{URL::to('/unactive-post/'.$post->category_post_id)}}"> <span class="fa-thumbs-styling fa fa-thumbs-up"></span></a>
               <?php }else {
               ?>  
                <a href="{{URL::to('/active-post/'.$post->category_post_id)}}"> <span class="fa-thumbs-styling fa fa-thumbs-down"></span></a>
                <?php
              }?>
            </span></td>
            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
            <td>
              <a href="{{URL::to('/edit-post/'.$post->category_post_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa bài viết này?')" href="{{URL::to('/delete-post/'.$post->category_post_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>

   

    </div>
    
  </div>
</div>
@endsection