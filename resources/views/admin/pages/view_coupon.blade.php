@extends('admin.master')
@section('title')
Danh Sách Mã - HPBOOK ADMIN
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
                                        <li class="breadcrumb-item active">Mã Giảm Giá</li>
                                        <li class="breadcrumb-item active">Danh Sách Mã</li>
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
                                    <h4 class="m-t-0 header-title mb-4"><b>Danh Sách Mã</b></h4>
                                   
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Mã</th>
                                            <th>Giảm Giá</th>
                                            <th>Ngày Hêt Hạn</th>
                                            <th>Trạng Thái</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($coupon as $value)
                                        <tr>
                                            <td>#{!!$value->id!!}</td>
                                            <td>{!!$value->code!!}</td>
                                            <td>{!!$value->discount*100!!}%</td>
                                            <td>@php
                                                $date = date_create($value->expiry_date);
                                                echo date_format($date,"d/m/Y");
                                            @endphp</td>
                                            <td>
                                                @if($value->status==1)
                                                    Đã kích hoạt
                                                @else
                                                    Chưa kích hoạt
                                                @endif
                                            </td>
                                            <td>
                                                <span class="action">
                                                    <a class="iconViewCate text-success" href="{!!url('/admin/edit-coupon',$value->id)!!}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fas fa-edit"></i></a>                 
                                                    <a onclick="return confirm('Bạn có chắc muốn xóa không?');" class="iconViewCate text-danger" href="{!!url('/admin/delete-coupon',$value->id)!!}" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fas fa-trash"></i></a>
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