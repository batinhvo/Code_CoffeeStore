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
            <th>Vai trò</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($admin as $key =>$ad)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$ad->admin_name}}</td>
            <td><img src="public/uploads/admin/avt143.webp" alt="" height="100" width="100"></td>
            <td>{{$ad->admin_email}}</td>
            <td>{{$ad->admin_phone}}</td>
            <td><span class="text-ellipsis">
              <?php
                if($ad->roles==1){
                ?>   
                  <a onclick="return confirm('Bạn có chắc là muốn thay đổi tài khoản này từ Quản lý->Nhân viên ?')" href="{{URL::to('/unactive-admin/'.$ad->admin_id)}}">
                  <input type="button" class="btn btn-xs btn-primary comment_duyet_btn" value="Quản lý">
                  </a>
               <?php }else {
               ?>  
                <a onclick="return confirm('Bạn có chắc là muốn thay đổi tài khoản này từ Nhân viên->Quản lý ?')" href="{{URL::to('/active-admin/'.$ad->admin_id)}}">
                  <input type="button" class="btn btn-xs btn-primary comment_duyet_btn" value="Nhân viên">
                </a>
                <?php
              }?>
            </span></td>
            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
            <td>
             
              <a onclick="return confirm('Bạn có chắc là muốn xóa thông tin nhân viên này?')" href="{{URL::to('/delete-admin/'.$ad->admin_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>

         @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection