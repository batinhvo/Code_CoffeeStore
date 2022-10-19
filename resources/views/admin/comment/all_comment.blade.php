@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ BÌNH LUẬN
    </div>
   <div id="notify_comment">

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
            <th>Duyệt</th>
            <th>Tên người gửi</th>

            <th>Bình luận</th>
            <th>Ngày gửi</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Quản lý</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($comment as $key =>$com)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>
                @if($com->comment_status==0)
                    <input data-comment_status="0" data-comment_id="{{$com->comment_id}}" id="{{$com->comment_product_id}}" type="button" class="btn btn-xs btn-primary comment_duyet_btn" value="Hiện bình luận">
                @else
                <input data-comment_status="1" data-comment_id="{{$com->comment_id}}" id="{{$com->comment_product_id}}"  type="button" class="btn btn-xs btn-danger comment_duyet_btn" value="Ẩn bình luận">
                @endif
            </td>
            <td>{{$com->comment_name}}</td>
            <td>{{$com->comment}} <br>
            <style>
              ul.list_rep li{
                list-style-type:decimal;
                color:blue;
                margin:5px 20px;
              }
            </style>
           
                @if($com->comment_status==1)
                <ul class="list_rep">
            Trả lời:
              @foreach($comment_reply as $key=>$com_rep)
                @if($com_rep->comment_parent_id==$com->comment_id)
                <li> {{$com_rep->comment}}</li>
                @endif
              @endforeach
            </ul>
                <textarea class="reply-comment_{{$com->comment_id}} form-control" rows="3"></textarea> <br>
                <button data-product_id="{{$com->comment_product_id}}" data-comment_id="{{$com->comment_id}}" class="btn-reply-comment pull-right">Trả lời</button>
                @endif
                
               
            </td>
           <td>{{$com->comment_date}}</td>
           <td>{{$com->product->product_name}}</td>
           <td><img src="public/uploads/product/{{$com->product->product_image}}" alt="" height="100" width="100"></td>
            <!-- <td><span class="text-ellipsis">26.08.2000</span></td> -->
            <td>
              <a href="" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa bình luận này?')" href="{{URL::to('/delete-comment/'.$com->comment_id)}}" class="active styling-edit"  ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-sm-7 text-right text-center-xs">
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                          
                                 {!!  $comment->links('pages.paginate') !!}
                            </ul>
    </div>
    
  </div>
</div>
@endsection