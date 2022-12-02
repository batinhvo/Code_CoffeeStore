@extends('admin_layout')
@section('admin_content')
<?php
    $roles=Session::get('roles');
?>
@if($roles == 1)
<div class="row">
    <div  class="col-sm-3">
        <div style="background:#3e9ba5; color:white;" class="text-center bg-light card">
            <div class="card-body">
                <h4 class="card-title">Tổng Doanh Số</h4>
                <p class="card-text">
                {{number_format($sum-2159000, 0, '.', '.'). ' VNĐ'}}
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
<!-- <div class="row">
    <p class="title_Thongke" style="
  font-weight: bold;
    font-size: 20px;
    margin: 10px 10px 10px 10px;
    text-align: center;
    color: currentColor;">BIỂU ĐỒ THỐNG KÊ DOANH SỐ</p>
    <form autocomplete="off">
        @csrf
        <div class="col-md-2">
            <p>Từ ngày: <input type="date" id="datepicker" class="form-control" require></p>
            <input style="margin: 10px 10px 10px 10px;" type="button" id="btn-dashboard-filter" class="btn btn-primary" value="Lọc kết quả">
        </div>
        <div class="col-md-2">
            <p>Đến ngày: <input type="date" id="datepicker2" class="form-control" require></p>
        </div>
        <div class="col-md-2">
            <p>Lọc theo: 
            <select class="dashboard-filter form-control" id="dashboard-filter">
                <option style="text-align: center">>----- Chọn -----<</option>
                <option value="7ngay">7 ngày qua</option>
                <option value="thangtruoc">Tháng trước</option>
                <option value="thangnay">Tháng này</option>
                <option value="365ngayqua">365 ngày qua</option>
            </select>    
            </p>
        </div>
    </form>

    <div class="col-md-12">
        <div id="chart" style="height: 250px;"></div>
    </div>
</div> -->
@else
<div class="row">
    <div  class="col-sm-3">
        <div style="background:#3e9ba5; color:white;" class="text-center bg-light card">
            <div class="card-body">
                <h4 class="card-title">Tổng Doanh Số</h4>
            </div>
        </div>
    </div> 
        <div class="col-sm-3">
        <div style="background:#af2330; color:white;" class="text-center bg-light card">
            <div class="card-body">
                <h4 class="card-title">Đơn Hàng</h4>
            </div>
        </div>
    </div>

<div class="col-sm-3">
        <div style="background:#156a17; color:white;" class="text-center bg-light card">
            <div class="card-body">
                <h4 class="card-title">Bài Viết</h4>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div style="background:#a18f15; color:white;" class="text-center card bg-light ">
            <div class="card-body">
                <h4 class="card-title">Sản Phẩm</h4>
        </div>
    </div>
</div>
@endif
                  
                
@endsection