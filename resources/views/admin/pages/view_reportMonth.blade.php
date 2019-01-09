@extends('admin.master')
@section('title')
Doanh Thu Tháng {!!$report->month!!} Năm {!!$report->year!!} - HPBOOK
@endsection

@section('css')
<!-- DataTables -->
        <link href="admin_public/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="admin_public/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="admin_public/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="content">
        <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">

                            <ol class="breadcrumb float-left">
                                <li class="breadcrumb-item"><a href="{!!url('/admin/index')!!}">Trang Chủ</a></li>
                                <li class="breadcrumb-item"><a href="{!!url('/admin/report-year',$report->year)!!}">Thống Kê Năm {!!$report->year!!}</a></li>
                                <li class="breadcrumb-item active">Tháng {!!$report->month!!} </li>
                            </ol>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h5 class="m-0 d-print-none">Chi Tiết Tháng {!!$report->month!!}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="clearfix pt-5">
                                        <h6 class="text-muted">Tổng cộng:</h6>
                                        <p class="mt-2"><b>Số đơn hàng:</b> {!!$report->countTransaction!!} đơn hàng</p>
                                        <p><b>Doanh thu:</b> {!!number_format($report->sumTransaction,0,',','.') !!} đ</p>
                                        <p><b>Giá trị đơn hàng trung bình: </b> {!!number_format($report->avgTransaction,0,',','.') !!} đ</p>
                                        <p><b>Số sản phẩm bán được:</b> {!!$report->sumQuantity!!} sản phẩm</p>
                                    </div>

                                </div>
                            </div>
                            <div class="row mt-0 mb-5">
                                <div class="col-md-12">
                                    <h6 class="text-muted">Danh sách chi tiết:</h6>
                                    <div class="table-responsive">
                                        <table class="table mt-4">
                                            <thead>
                                            <tr class="text-center">
                                                
                                                <th>Ngày</th>
                                                <th>Số Đơn Hàng</th>
                                                <th>Số Sản Phẩm Bán Được</th>
                                                <th>Doanh Thu</th>
                                                
                                            </tr>
                                        </thead>
                                            <tbody>
                                                @foreach($data as $value)

                                                <tr class="text-center">
                                                
                                                    <th>@php
                                                            $date = date("d/m/Y",strtotime($value['date']));
                                                            echo $date;
                                                        @endphp</th>
                                                    <th>{!!$value['countTransaction']!!} đơn hàng</th>
                                                    <th>{!!$value['sumQuantity']!!} sản phẩm</th>
                                                    <th>{!!number_format($value['sumTransaction'],0,',','.')!!} đ</th>
                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="hidden-print mt-4 mb-4">
                                <div class="text-right">
                                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> In </a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- end row -->
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
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>
@endsection