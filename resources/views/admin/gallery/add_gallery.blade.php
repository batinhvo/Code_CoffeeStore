@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Thêm thư viện ảnh
                          
                        </header>
                        <?php
		$message=Session::get('message');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>';
			Session::put('message',null);
		}
	?>
                            <form enctype="multipart/form-data" method="post" action="{{url('/insert-gallery/'.$pro_id)}}">
                            @csrf
                                <div class="row">
                                            <div class="col-md-3">

                                            </div>
                                            <div class="col-md-6">
                                                <input id="file" type="file" class="form-control" name="file[]" accept="image/*" multiple>
                                                <span id="error_gallery"></span>
                                            </div>
                                             <div class="col-md-3">
                                                <input type="submit" name="upload" value="Tải Ảnh" class="btn btn-success ">
                                            </div>
                                        </div>
                                <div class="panel-body">
                            </form>
                           <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                           <form>
                                @csrf
                                <div id="gallery_load">
                                    
                                </div>
                           </form>

                        </div>
                    </section>

            </div>
@endsection