@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Thêm vận chuyển
                          
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
                                <form>
                                    {{csrf_field()}}
                                
                                <div class="form-group">
                                <label for="exampleInputPassword1">Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                        <option value="">-Chọn thành phố-</option>
                                        @foreach($city as $key =>$ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_thanhpho}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Chọn quận huyện</label>

                                <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                         <option value="">-Chọn quận huyện-</option>
                                       
                        
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    <option value="">-Chọn xã phường-</option>
                          
                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                                    <input required type="number" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                                
                            </form>
                            </div>
                            <br>
                            <div id="load_delivery">
                                
                            </div>

                        </div>
                    </section>

            </div>
  <script type="text/javascript">
    $(document).ready(function() {

        fetch_delivery();

        function fetch_delivery() {
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{url('/select-feeship')}}',
                method: 'POST',
                data: {
                    _token: _token
                },
                success: function(data) {
                    $('#load_delivery').html(data);
                }
            });

        }

        $(document).on('blur', '.feeship_edit', function() {
            // alert('đã blur');
            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/update-delivery')}}',
                method: 'POST',
                data: {
                    feeship_id: feeship_id,
                    fee_value: fee_value,
                    _token: _token
                },
                success: function(data) {
                    fetch_delivery();
                }
            });
        });

        $('.add_delivery').click(function() {
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{url('/insert-delivery')}}',
                method: 'POST',
                data: {
                    city: city,
                    province: province,
                    wards: wards,
                    fee_ship: fee_ship,
                    _token: _token
                },
                success: function(data) {
                    alert('Thêm phí vận chuyện thành công');
                    fetch_delivery();
                }
            });

        });


        $('.choose').change(function() {
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            // alert(matp);
            // alert(_token);
            if (action == 'city') {
                result = 'province';
            } else {
                result = 'wards';
            }
            $.ajax({
                url: '{{url('/select-delivery')}}',
                method: 'POST',
                data: {
                    action: action,
                    ma_id: ma_id,
                    _token: _token
                },
                success: function(data) {
                    $('#' + result).html(data);
                }
            });
        });
    })
    </script>
@endsection