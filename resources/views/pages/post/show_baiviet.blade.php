@extends('normal_layout')
@section('content')
<div class="features_items"><!--features_items-->
                    @foreach($newfeed as $key=> $all_newfeed)
						<h2 class="title text-center">{{$all_newfeed->post_title}}</h2>
					@endforeach
					
                    @foreach($newfeed as $key=>$all_newfeed)
                    <div class="product-image-wrapper">
                           
                           <div class="single-products">
                                  {!!$all_newfeed->post_content!!}
                                 
                           </div>
                      
                          
                       </div>
                    @endforeach
               
                    

</div><!--features_items-->

<!--/category-tab-->




@endsection