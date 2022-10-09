@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Cập Nhật Bài Viết
                          
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
                                <form role="form" action="{{URL::to('/update-newfeed/'.$all_post->post_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài viết</label>
                                    <input value="{{$all_post->post_title}}" required type="text" name="newfeed_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                    <textarea required style="resize:none" rows="5" name="newfeed_desc" class="form-control" id="ckeditor1" placeholder="Mô tả danh mục">{{$all_post->post_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung bài viết</label>
                                    <textarea required style="resize:none" rows="5" name="newfeed_content" class="form-control" id="ckeditor2" placeholder="Nội dung danh mục">{{$all_post->post_content}}</textarea>
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                                    <input  type="file" name="newfeed_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/post/'.$all_post->post_image)}}" alt="" width="100" height="100">
                                </div>
                                
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục bài viết</label>
                                    <select name="category_newfeed" class="form-control input-sm m-bot15">
                                        @foreach($category_post as $key =>$category)
                                            @if($category->category_post_id==$all_post->category_post_id)
                                                <option selected value="{{$category->category_post_id}}">{{$category->category_post_name}} </option>
                                            @else
                                                <option value="{{$category->category_post_id}}">{{$category->category_post_name}} </option>
                                            @endif
                                        @endforeach
                        
                                    </select>
                                </div>
                                
                               
                                
                                <button type="submit" name="add_category_newfeed" class="btn btn-info">Cập nhật bài viết</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection