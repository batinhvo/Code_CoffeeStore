@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Cập nhật danh mục bài viết
                          
                        </header>
                        <?php
		$message=Session::get('message');
		if($message){
			echo '<span class="text-alert">'.$message.'</span>';
			Session::put('message',null);
		}
	?>
                        <div class="panel-body">
                            @foreach($post as $key =>$all_post)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-post/'.$all_post->category_post_id)}}" method="post">
                                        {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                                        <input required type="text" value="{{$all_post->category_post_name}}" name="post_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả danh mục bài viết</label>
                                        <textarea required style="resize:none" rows="5" name="post_desc" class="form-control" id="exampleInputPassword1" > {{$all_post->category_post_desc}}</textarea>
                                    </div>
                                    <button type="submit" name="add_post" class="btn btn-info">Cập nhật danh mục bài viết</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection