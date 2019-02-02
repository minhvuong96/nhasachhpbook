<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{!!url('/admin/index')!!}">
                        <i class="fi-air-play"></i>{{-- <span class="badge badge-danger badge-pill pull-right">3</span>  --}}
                        <span> Trang Chủ </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="fi-bar-graph-2"></i><span> Thống kê doanh thu </span> <span
                                class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        @php
                            $report = DB::table('reports')->groupBy('year')->select('year')->get();
                            //Truy vấn lấy các năm trong bảng reports ra. Ví dụ có 2 năm 2018-2019 thì lấy cả 2 ra
                        @endphp
                        {{-- Có bao nhiêu năm chạy bấy nhiêu lần. Ứng với từng $report là $value --}}
                        @foreach($report as $value)
                            <li><a href="{!!url('/admin/report-year',$value->year)!!}">{!!$value->year!!}</a></li>
                            {{-- Khi người dùng ấn vào năm 2018 thì sẽ chuyển đến router với url như trên và kèm theo biến $year --}}
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="fas fa-book"></i><span> Danh Mục Sách</span> <span
                                class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{!!url('/admin/add-category')!!}">Thêm Danh Mục</a></li>
                        <li><a href="{!!url('/admin/view-categories')!!}">Danh Sách Danh Mục</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="fab fa-elementor"></i></i>
                        <span> Quản lý đơn hàng</span>@if($countNewOrder + $countNewOrderCOD !=0)
                            <span class="badge badge-danger badge-pill noti-icon-badge">{!!$countNewOrder + $countNewOrderCOD!!}</span>
                        @endif <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="javascript: void(0);">+ Đơn Trả Trước @if($countNewOrder!=0)
                                    <span class="badge badge-danger badge-pill noti-icon-badge">{!!$countNewOrder!!}</span>
                                @endif <span class="menu-arrow"></span></a>
                            {{--Đơn hàng trả trước--}}
                            <ul class="nav-third-level" aria-expanded="false">
                                <li><a href="{!!url('/admin/new-order')!!}">- Đơn Hàng Mới ({!!$countNewOrder!!})</a>
                                </li>
                                <li><a href="{!!url('/admin/received-order')!!}">- Đã Tiếp Nhận </a></li>
                                <li><a href="{!!url('/admin/delivered-order')!!}">- Đang Vận Chuyển </a></li>
                                <li><a href="{!!url('/admin/view-order')!!}">- Đơn Đã Giao</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript: void(0);">+ Đơn Trả Sau @if($countNewOrderCOD !=0)
                                    <span class="badge badge-danger badge-pill noti-icon-badge">{!!$countNewOrderCOD!!}</span>
                                @endif <span class="menu-arrow"></span></a>
                            {{--đơn hàng cod--}}
                            <ul class="nav-third-level" aria-expanded="false">
                                <li><a href="{!!url('/admin/new-order-cod')!!}">- Đơn Hàng Mới ({!!$countNewOrderCOD!!}
                                        )</a></li>
                                <li><a href="{!!url('/admin/received-order-cod')!!}">- Đã Tiếp Nhận </a></li>
                                <li><a href="{!!url('/admin/delivered-order-cod')!!}">- Đang Vận Chuyển </a></li>
                                <li><a href="{!!url('/admin/view-order-cod')!!}">- Đơn Đã Giao</a></li>
                            </ul>
                        </li>
                        <li><a href="{!!url('/admin/cancellation-order')!!}">+ Đơn Hàng Bị Hủy</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i
                                class="fas fa-book-open"></i><span> Quản Lý Sách </span>@if($countOutOfStock!=0)
                            <span class="badge badge-danger badge-pill noti-icon-badge">{!!$countOutOfStock!!}</span>
                        @endif

                        <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{!!url('/admin/add-product')!!}">Thêm Sách</a></li>
                        <li><a href="{!!url('/admin/view-products')!!}">Sách Tồn</a></li>
                        <li><a href="{!!url('/admin/out-of-stock')!!}">Hết Hàng ({!!$countOutOfStock!!})</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i
                                class="fas fa-comments"></i><span> Bình Luận </span>@if($countNewComment!=0)
                            <span class="badge badge-danger badge-pill noti-icon-badge">{!!$countNewComment!!}</span>
                        @endif<span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{!!url('/admin/view-comments')!!}">Danh Sách Bình Luận</a></li>
                        <li><a href="{!!url('/admin/new-comments')!!}">Bình Luận Mới ({!!$countNewComment!!})</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="fas fa-user-edit"></i><span> Tác Giả </span> <span
                                class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{!!url('/admin/add-author')!!}">Thêm Tác Giả</a></li>
                        <li><a href="{!!url('/admin/view-authors')!!}">Danh Sách Tác Giả</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="fas fa-archive"></i><span> Nhà Xuất Bản </span> <span
                                class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{!!url('/admin/add-publisher')!!}">Thêm Nhà Xuất Bản</a></li>
                        <li><a href="{!!url('/admin/view-publishers')!!}">Danh Sách Nhà Xuất Bản</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="fas fa-newspaper"></i><span> Bài Viết </span> <span
                                class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{!!url('/admin/add-news')!!}">Thêm Bài Viết</a></li>
                        <li><a href="{!!url('/admin/view-news')!!}">Danh Sách Bài Viết</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="fas fa-images"></i><span> Quảng Cáo </span> <span
                                class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{!!url('/admin/add-slider')!!}">Thêm Slider</a></li>
                        <li><a href="{!!url('/admin/view-sliders')!!}">Danh Sách Slider</a></li>
                        <li><a href="{!!url('/admin/add-banner')!!}">Thêm Banner</a></li>
                        <li><a href="{!!url('/admin/view-banners')!!}">Danh Sách Banner</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="mdi mdi-google-photos"></i><span> Mã Giảm Giá </span> <span
                                class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{!!url('/admin/add-coupon')!!}">Thêm Mã</a></li>
                        <li><a href="{!!url('/admin/view-coupon')!!}">Danh Sách Mã</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="fas fa-users"></i><span> Phân Quyền </span> <span
                                class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{!!url('/admin/view-users')!!}">Thành Viên</a></li>
                        <li><a href="{!!url('/admin/view-roles')!!}">Chức Danh</a></li>
                        <li><a href="{!!url('/admin/view-permissions')!!}">Quyền Hạn</a></li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->
</div>