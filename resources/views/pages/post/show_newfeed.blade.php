@extends('normal_layout')
@section('content')
<div class="features_items"><!--features_items-->
                    @foreach($title as $key=> $all_title)
						<h2 class="title text-center">{{$all_title->category_post_name}}</h2>
					@endforeach
					
                    @foreach($newfeed as $key=>$all_newfeed)
                    <div class="product-image-wrapper">
                           
                           <div class="single-products">
                                   <div class="text-center">
                                       
                                      

                                       
                                           <img style="float:left;" width="40%" src="{{URL::to('public/uploads/post/'.$all_newfeed->post_image)}}" height="250" width="200" alt="" />
                                          <hr>
                                          <h4 style="color:#a52323; font-size:18px;">{{$all_newfeed->post_title}}</h4>
                                           <p>{!!$all_newfeed->post_desc!!}</p>

                                        <a class="btn btn-warning" href="{{URL::to('/bai-viet/'.$all_newfeed->post_id)}}">
                                            Xem Bài Viết
                                        </a>
                                      
                                      
                                   </div>
                                 
                           </div>
                      
                          
                       </div>
                    @endforeach
                    <div class="col-sm-7 text-right text-center-xs">
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                          
                                 {!!  $newfeed->links('pages.paginate') !!}
                            </ul>
                        </div>
                    

</div><!--features_items-->

<!--/category-tab-->




@endsection