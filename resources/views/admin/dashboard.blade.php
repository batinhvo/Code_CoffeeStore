@extends('admin_layout')
@section('admin_content')
<div class="row">
                    <div  class="col-sm-3">
                        <div style="background:#3e9ba5; color:white;" class="text-center bg-light card">
                            <div class="card-body">
                                <h4 class="card-title">Tổng Doanh Số</h4>
                                <p class="card-text">
                                {{number_format($sum, 0, '.', '.'). ' VNĐ'}}
                                </p>
                                <a href="{{URL::to('/statistical')}}" class="btn btn-warning">Chi Tiết</a>
                            </div>
                        </div>
                    </div> 
                     <div class="col-sm-3">
                        <div style="background:#af2330; color:white;" class="text-center bg-light card">
                            <div class="card-body">
                                <h4 class="card-title">Đơn Hàng</h4>
                                <p class="card-text">{{$order}}</p>
                                <a href="{{URL::to('/manage-order/')}}" class="btn btn-warning">Chi Tiết</a>
                            </div>
                        </div>
                    </div>

                <div class="col-sm-3">
                        <div style="background:#156a17; color:white;" class="text-center bg-light card">
                            <div class="card-body">
                                <h4 class="card-title">Bài Viết</h4>
                                <p class="card-text">{{$post}}</p>
                                <a href="{{URL::to('/all-new-feed/')}}" class="btn btn-warning">Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div style="background:#a18f15; color:white;" class="text-center card bg-light ">
                            <div class="card-body">
                                <h4 class="card-title">Sản Phẩm</h4>
                                <p class="card-text">{{$product}}</p>
                                <a href="{{URL::to('/all-product/')}}" class="btn btn-warning">Chi Tiết</a>
                            </div>
                        </div>
                    </div>
</div>
                 
                
@endsection