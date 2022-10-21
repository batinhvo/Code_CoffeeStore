@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Cập nhật phí vận chuyển
                          
                        </header>
                        <?php
		$message=Session::get('message');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>';
			Session::put('message',null);
		}
	?>
                        <div class="panel-body">
                        @foreach($delivery as $key =>$cou)
                                @foreach($city as $key => $ci)  
                                    @foreach($town as $key => $to)
                                        @foreach($xa as $key => $x)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-deliverys/'.$cou->fee_id)}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input required type="text" value="{{$x->name_xaphuong}} - {{$to->name_quanhuyen}} - {{$ci->name_thanhpho}}" name="fee_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Phí vận chuyển</label>
                                    <input required style="number" name="fee_ship" class="form-control" id="exampleInputPassword1" value="{{$cou->fee_ship}}">
                                </div>
                          
                                
                                <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật phí vận chuyển</button>
                            </form>
                            </div>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection