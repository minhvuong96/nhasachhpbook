@extends('admin.master')
@section('title')
    Đơn Hàng Mới - HPBOOK ADMIN
@endsection
@section('css')
    <!-- DataTables -->
    <link href="admin_public/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="admin_public/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <!-- Responsive datatable examples -->
    <link href="admin_public/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                            <li class="breadcrumb-item active">Đơn Hàng Trả Trước</li>
                            <li class="breadcrumb-item active">Đơn Hàng Đang Vận Chuyển</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        @include('admin.blocks.message')
                        <h4 class="m-t-0 header-title mb-4"><b>Danh Sách Đơn Hàng</b></h4>

                        <table id="datatable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Mã Đơn</th>
                                <th>Tên Khách Hàng</th>
                                <th>Email</th>
                                <th>Ngày Đặt Hàng</th>
                                <th>Tổng Tiền</th>
                                <th>Hình Thức Thanh Toán</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transaction as $item)
                                <tr>
                                    <td>{!!$item->id!!}</td>
                                    <td>{!!$item->user->name!!}</td>
                                    <td>{!!$item->user->email!!}</td>
                                    <td>@php
                                            $dateOrder = date("d/m/Y H:i:s",strtotime($item->created_at));
                                            echo $dateOrder;
                                        @endphp</td>
                                    <td>{!!number_format($item->amount_total,0,',','.')!!} đ</td>
                                    <td>
                                        @if($item->payment==1)
                                            Thẻ tín dụng
                                        @elseif($item->payment==2)
                                            Chuyển khoản
                                        @else
                                            COD
                                        @endif
                                    </td>
                                    <td>
                                                <span class="action">
                                                        <a class="iconViewCate btn btn-success"
                                                           href="{!!url('/admin/approval-order',$item->id)!!}">Chi Tiết</a>
                                                </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="admin_public/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="admin_public/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="admin_public/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="admin_public/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="admin_public/plugins/datatables/jszip.min.js"></script>
    <script src="admin_public/plugins/datatables/pdfmake.min.js"></script>
    <script src="admin_public/plugins/datatables/vfs_fonts.js"></script>
    <script src="admin_public/plugins/datatables/buttons.html5.min.js"></script>
    <script src="admin_public/plugins/datatables/buttons.print.min.js"></script>
    <!-- Responsive examples -->
    <script src="admin_public/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="admin_public/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').DataTable();

            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf']
            });

            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        });

    </script>
@endsection