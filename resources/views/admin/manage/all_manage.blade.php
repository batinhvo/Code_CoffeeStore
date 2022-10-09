@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ NHÂN VIÊN
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
            <th>Tên Nhân Viên</th>
            <th>Hình nhân viên</th>
            <th>Email</th>
            <th>Điện Thoại</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($admin as $key =>$ad)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$ad->admin_name}}</td>
            <td><img src="public/uploads/admin/{{$ad->admin_image}}" alt="" height="100" width="100"></td>
            <td>{{$ad->admin_email}}</td>
            <td>{{$ad->admin_phone}}</td>
           
            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
           
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection