@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Thêm mã giảm giá
                          
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
                                <form role="form" action="{{URL::to('/save-coupon')}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input required type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input required type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng mã</label>
                                    <input required min="1" type="number" name="coupon_time" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tính năng mã</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15">
                                        <option value="1">Giảm theo %</option>
                                        <option value="0">Giảm theo tiền </option>
                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhập số % hoặc tiền giảm</label>
                                    <input min="1" required type="number" name="coupon_number" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                            
                            
                                
                                <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã giảm giá</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection