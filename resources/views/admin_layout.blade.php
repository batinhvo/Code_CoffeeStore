<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>Quản Lý</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEri{{asset('public/backend/csson, Motorola web design')}}" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}">

    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('public/backend/js/morris.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{URL::to('/dashboard')}}" class="logo">
                    Quản lý
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <?php
                                $admin_image=Session::get('admin_image');
                                echo('<img alt="" src="public/uploads/admin/'.$admin_image.'">');
                            ?>
                            
                            <span class="username">
                                <?php
                    $admin_name=Session::get('admin_name');
                    if($admin_name){
                        echo $admin_name;
                    }
	            ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">

                        <li class="sub-menu">
                            <a href="{{URL::to('/dashboard')}}">
                                <i class="fa fa-tachometer"></i>
                                <span>Tổng Quan</span>
                            </a>

                        </li>

                        <!-- <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Slider</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-slider')}}">Thêm Slider</a></li>

                            </ul>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-banner')}}">Liệt Kê Slider</a></li>

                            </ul>
                        </li> -->

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Quản lý kho hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-warehouse')}}">Thêm đơn nhập hàng</a></li>

                            </ul>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-warehouse')}}">Liệt kê đơn hàng nhập</a></li>

                            </ul>
                        </li>


                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Quản lý Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>

                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Quản lý khuyến mãi</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
                                <li><a href="{{URL::to('/all-coupon')}}">Liệt kê mã giảm giá</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Quản lý Vận chuyển</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/delivery')}}">Thêm phí vận chuyển</a></li>
                                <li><a href="{{URL::to('/all-delivery')}}">Liệt kê phí vận chuyển</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
                            </ul>
                        </li>
                        
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương hiệu sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Quản lý Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                            </ul>
                        </li>

                        <!-- <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh Mục Bài Viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-post')}}">Thêm Danh Mục Bài Viết</a></li>

                            </ul>
                            <ul class="sub">
                                <li><a href="{{URL::to('/all-post')}}">Liệt Kê Danh Mục Bài Viết</a></li>

                            </ul>
                        </li> -->

                        <!-- <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Bài Viết</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-new-feed')}}">Thêm Bài Viết</a></li>

                            </ul>
                            <ul class="sub">
                                <li><a href="{{URL::to('/all-new-feed')}}">Liệt Kê Bài Viết</a></li>

                            </ul>
                        </li> -->
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Quản lý Bình luận</span>
                            </a>
                            <ul class="sub">

                                <li><a href="{{URL::to('/all-comment')}}">Liệt kê bình luận</a></li>
                            </ul>
                        </li>
                        <?php
                            $roles=Session::get('roles');
                         ?>
                        @if($roles == 1)
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Quản lý Nhân Viên</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-manage')}}">Thêm Nhân Viên</a></li>
                                <li><a href="{{URL::to('/all-manage')}}">Liệt kê Nhân Viên</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                
                
                @yield('admin_content')
            </section>
            <!-- footer -->
            <!-- <div class="footer">
                <div class="wthree-copyright">
                    <p>©Design by DiepVi <a href="{{URL::to('/')}}">DiepVi Shop</a></p>
                </div>
            </div> -->
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/js/scripts.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{asset('public/backend/js/flot-chart/excanvas.min.js')}}"></script><![endif]-->
    <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>

    <script type="text/javascript">

    
    $(document).ready(function() {
        // chart30daysonder();
        // var chart = new Morris.Bar({
        // element: 'chart',
        // lineColors: ['#819C79', '#fc8710', '#ff6541', '#A4AD03', '#766856'],
        // parseTime: false,
        // hideHover: 'auto',
        // xkey:  'quantity',
        // ykeys:['order','sales','profit',],
        // // behaveLikeLine: true,
        // labels: ['Đơn hàng','doanh số','lợi nhuận',]
        
        // });

        chart30daysonder();
        new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            { y: 'Tháng 01', a: 350000},
            { y: 'Tháng 02', a: 1540000},
            { y: 'Tháng 03', a: 5400000},
            { y: 'Tháng 04', a: 897500},
            { y: 'Tháng 05', a: 5642000},
            { y: 'Tháng 06', a: 1200000},
            { y: 'Tháng 07', a: 650000},
            { y: 'Tháng 08', a: 2800000},
            { y: 'Tháng 09', a: 1562000},
            { y: 'Tháng 10', a: 8870000},
            { y: 'Tháng 11', a: 75},
            { y: 'Tháng 12', a: 50},
        ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Doanh thu']
        });

        function chart30daysonder(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/days-order')}}',
                method: 'POST',
                dateType: "JSON",
                data:{_token:_token},

                success:function(data){
                    chart.setData(data);
                }
            });
        }

        $('.dashboard-filter').change(function(){
            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/dashboard-filter')}}',
                method: 'POST',
                dateType: "JSON",
                data:{_token:_token,dashboard_value:dashboard_value},

                success:function(data){
                    chart.setData(data);
                }
            });
        });
        
        $('#btn-dashboard-filter').click(function(){
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();
            // var from_date = '2022-08-28';
            // var to_date = '2022-10-05';
            $.ajax({
                url:'{{url('/filter-by-date')}}',
                method: 'POST',
                dateType: "JSON",
                data:{from_date:from_date,to_date:to_date,_token:_token},
                
                success:function(data){ 
                    chart.setData(data);
                }
            });
        });
        
    });

    

   



    $('.comment_duyet_btn').click(function() {
        var comment_status = $(this).data('comment_status');
        var comment_id = $(this).data('comment_id');
        var comment_product_id = $(this).attr('id');
        // alert(comment_status);
        // alert(comment_id);
        // alert(comment_product_id);
        if (comment_status == 0) {
            var alert = 'Hiện bình luận thành công';
        } else {
            var alert = 'Ẩn bình luận thành công';
        }
        $.ajax({
            url: '{{url('/allow-comment')}}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                comment_id: comment_id,
                comment_status: comment_status,
                comment_product_id: comment_product_id
            },
            success: function(data) {
                location.reload();
                $('#notify_comment').html('<span class="text text-alert">' + alert + '</span>');

            }
        });

    });

    $('.btn-reply-comment').click(function() {
        var comment_id = $(this).data('comment_id');
        var comment = $('.reply-comment_' + comment_id).val();

        var comment_product_id = $(this).data('product_id');

        // alert(comment);
        // alert(comment_id);
        // alert(comment_product_id);


        $.ajax({
            url: '{{url('/reply-comment')}}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                comment_id: comment_id,
                comment: comment,
                comment_product_id: comment_product_id
            },
            success: function(data) {
                location.reload();
                $('.reply-comment_' + comment_id).val('');
                $('#notify_comment').html(
                    '<span class="text text-alert">Trả lời bình luận thành công</span>');

            }
        });
    });
    </script>

    <script type="text/javascript">
    $('.order_details').change(function() {
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();

        quantity = [];
        $("input[name='product_sales_quantity']").each(function() {
            quantity.push($(this).val());

        });
        order_product_id = [];
        $("input[name='order_product_id']").each(function() {
            order_product_id.push($(this).val());

        });
        if (order_status == '4') {
            check = 0
            for (i = 0; i < order_product_id.length; i++) {
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
                // var order_qty_=$('.order_qty_'+order_product_id[i]).val();
                // alert(quantity[i]);
                // alert(order_qty_storage);
                if (parseInt(quantity[i]) > parseInt(order_qty_storage)) {
                    check = check + 1;
                    if (check == 1) {
                        alert('Số lượng bán trong kho không đủ');
                    }

                    $('.color_qty_' + order_product_id[i]).css('background', '#cd10104f')
                }
            }

            if (check == 0) {
                $.ajax({
                    url: '{{url('/update-order-quantity ')}}',
                    method: 'POST',
                    data: {
                        order_product_id: order_product_id,
                        order_status: order_status,
                        quantity: quantity,
                        order_id: order_id,
                        _token: _token
                    },
                    success: function(data) {
                        alert("Thay đổi tình trạng đơn hàng thành công");
                        location.reload();
                    }
                });
            }
        }
        if (order_status == '2') {
            check = 0
            for (i = 0; i < order_product_id.length; i++) {
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
                // var order_qty_=$('.order_qty_'+order_product_id[i]).val();
                // alert(quantity[i]);
                // alert(order_qty_storage);
                if (parseInt(quantity[i]) > parseInt(order_qty_storage)) {
                    check = check + 1;
                    if (check == 1) {
                        alert('Số lượng không đủ để giao');
                    }

                    $('.color_qty_' + order_product_id[i]).css('background', '#cd10104f')
                }
            }
            if (check == 0) {
                $.ajax({
                    url: '{{url('/update-order-quantity')}}',
                    method: 'POST',
                    data: {
                        order_product_id: order_product_id,
                        order_status: order_status,
                        quantity: quantity,
                        order_id: order_id,
                        _token: _token
                    },
                    success: function(data) {
                        alert("Thay đổi tình trạng đơn hàng thành công");
                        location.reload();
                    }
                });
            }
        }
        if (order_status != '2' && order_status != '4') {
            $.ajax({
                url: '{{url('/update-order-quantity')}}',
                method: 'POST',
                data: {
                    order_product_id: order_product_id,
                    order_status: order_status,
                    quantity: quantity,
                    order_id: order_id,
                    _token: _token
                },
                success: function(data) {
                    alert("Thay đổi tình trạng đơn hàng thành công");
                    location.reload();
                }
            });
        }




    });
    </script>

  

    <script type="text/javascript">
    $(document).ready(function() {
        load_gallery();

        function load_gallery() {
            var pro_id = $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);
            $.ajax({
                url: '{{url('/select-gallery')}}',
                method: 'POST',
                data: {
                    pro_id: pro_id,
                    _token: _token
                },
                success: function(data) {
                    $('#gallery_load').html(data);
                }
            });
        }
        $('#file').change(function() {
            var error = '';
            var files = $('#file')[0].files;
            if (files.length > 6) {
                error += '<p>Bạn chỉ chọn tối đa 5 ảnh</p>';
            } else if (files.length == '') {
                error += '<p>Bạn không được bỏ trống ảnh</p>';
            }
            if (error == '') {

            } else {
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                return false;
            }
        });

        $(document).on('click', '.delete-gallery', function() {
            var gal_id = $(this).data('gal_id');
            var _token = $('input[name="_token"]').val();
            if (confirm('Bạn muốn xóa hình ảnh này không?')) {
                $.ajax({
                    url: '{{url('/deletes-gallery')}}',
                    method: 'POST',
                    data: {
                        gal_id: gal_id,
                        _token: _token
                    },
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Xóa Hình Ảnh Thành Công</span>');
                    }
                });
            }
            // alert(gal_id);
            // alert(_token);

        });

        $(document).on('change', '.file_image', function() {
            var gal_id = $(this).data('gal_id');
            var image = document.getElementById('file-' + gal_id).files[0];
            var form_data = new FormData();
            form_data.append("file", document.getElementById('file-' + gal_id).files[0]);
            form_data.append("gal_id", gal_id);

            $.ajax({
                url: '{{url('/update-gallery')}}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    load_gallery();
                    $('#error_gallery').html(
                        '<span class="text-danger">Cập Nhật Hình Ảnh Thành Công</span>');
                }
            });

            // alert(gal_id);
            // alert(_token);

        });
    });
    </script>
    <script>
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
    </script>
    <!-- morris JavaScript -->
    <script>
    $(document).ready(function() {
        //BOX BUTTON SHOW AND CLOSE
        jQuery('.small-graph-box').hover(function() {
            jQuery(this).find('.box-button').fadeIn('fast');
        }, function() {
            jQuery(this).find('.box-button').fadeOut('fast');
        });
        jQuery('.small-graph-box .box-close').click(function() {
            jQuery(this).closest('.small-graph-box').fadeOut(200);
            return false;
        });

        //CHARTS
        function gd(year, day, month) {
            return new Date(year, month - 1, day).getTime();
        }

        graphArea2 = Morris.Area({
            element: 'hero-area',
            padding: 10,
            behaveLikeLine: true,
            gridEnabled: false,
            gridLineColor: '#dddddd',
            axes: true,
            resize: true,
            smooth: true,
            pointSize: 0,
            lineWidth: 0,
            fillOpacity: 0.85,
            data: [{
                    period: '2015 Q1',
                    iphone: 2668,
                    ipad: null,
                    itouch: 2649
                },
                {
                    period: '2015 Q2',
                    iphone: 15780,
                    ipad: 13799,
                    itouch: 12051
                },
                {
                    period: '2015 Q3',
                    iphone: 12920,
                    ipad: 10975,
                    itouch: 9910
                },
                {
                    period: '2015 Q4',
                    iphone: 8770,
                    ipad: 6600,
                    itouch: 6695
                },
                {
                    period: '2016 Q1',
                    iphone: 10820,
                    ipad: 10924,
                    itouch: 12300
                },
                {
                    period: '2016 Q2',
                    iphone: 9680,
                    ipad: 9010,
                    itouch: 7891
                },
                {
                    period: '2016 Q3',
                    iphone: 4830,
                    ipad: 3805,
                    itouch: 1598
                },
                {
                    period: '2016 Q4',
                    iphone: 15083,
                    ipad: 8977,
                    itouch: 5185
                },
                {
                    period: '2017 Q1',
                    iphone: 10697,
                    ipad: 4470,
                    itouch: 2038
                },

            ],
            lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
            xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });


    });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
    <script type="text/javascript">
    $(window).load(function() {

        $('#mycalendar').monthly({
            mode: 'event',

        });

        $('#mycalendar2').monthly({
            mode: 'picker',
            target: '#mytarget',
            setWidth: '250px',
            startHidden: true,
            showTrigger: '#mytarget',
            stylePast: true,
            disablePast: true
        });

        switch (window.location.protocol) {
            case 'http:':
            case 'https:':
                // running on a server, should be good.
                break;
            case 'file:':
                alert('Just a heads-up, events will not work when run locally.');
        }

    });
    </script>
    <!-- //calendar -->
</body>

</html>