@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Thêm bài viết
                          
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
                                <form role="form" action="{{URL::to('/save-new-feed')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài viết</label>
                                    <input required type="text" name="newfeed_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                    <textarea required style="resize:none" rows="5" name="newfeed_desc" class="form-control" id="ckeditor1" placeholder="Mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung bài viết</label>
                                    <textarea required style="resize:none" rows="5" name="newfeed_content" class="form-control" id="ckeditor2" placeholder="Nội dung danh mục"></textarea>
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                                    <input required type="file" name="newfeed_image" class="form-control" id="exampleInputEmail1">
                                </div>
                                
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục bài viết</label>
                                    <select name="category_newfeed" class="form-control input-sm m-bot15">
                                        @foreach($category_post as $key =>$category)
                                            <option value="{{$category->category_post_id}}">{{$category->category_post_name}} </option>
                                        @endforeach
                        
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="newfeed_status" class="form-control input-sm m-bot15">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn </option>
                        
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_category_newfeed" class="btn btn-info">Thêm tin tức</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection