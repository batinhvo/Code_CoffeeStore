@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Thêm Nhân Viên
                          
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
                                
                                <form role="form" action="{{URL::to('/register')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Nhân Viên</label>
                                    <input required type="text" name="admin_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình Nhân Viên</label>
                                    <input required type="file" name="admin_image" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input required type="email" name="admin_email" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Điện thoại</label>
                                    <input required maxlength="10" type="text" name="admin_phone" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input required type="password" name="admin_password" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chức vụ</label>
                                    <select name="roles" class="form-control input-sm m-bot15">
                                        <option value="1">Quản lý</option>
                                        <option value="2">Nhân viên</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_manage" class="btn btn-info">Thêm Nhân Viên</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection