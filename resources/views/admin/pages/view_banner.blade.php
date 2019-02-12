@extends('admin.master')
@section('title')
Danh Sách Banner - HPBOOK ADMIN
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
                                        <li class="breadcrumb-item active">Quảng Cáo</li>
                                        <li class="breadcrumb-item active">Danh Sách Banner</li>
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
                                    <h4 class="m-t-0 header-title mb-4"><b>Danh Sách Banner</b></h4>
                                   
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Hình Ảnh</th>
                                            <th>Đường Dẫn</th>
                                            <th>Vị Trí</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($banner as $item)
                                        <tr>
                                            <td>{!!$item['id']!!}</td>
                                            <td><img src="admin_public/upload/banners/{!!$item['image']!!}" style="width=100px; height:75px;" alt="{!!$item['image']!!}"></td>
                                            <td>{!!$item['link']!!}</td>
                                            @if($item['position']==1)
                                                <td>Left Top</td>
                                            @elseif($item['position']==2)
                                                <td>Top</td>
                                            @elseif($item['position']==3)
                                                <td>Bot</td>
                                            @endif
                                            
                                            <td>
                                                <span class="action">
                                                    <a class="iconViewCate text-success" href="{!!url('/admin/edit-banner',$item['id'])!!}" data-toggle="tooltip" data-placement="top" title="Sửa banner"><i class="fas fa-edit"></i></a>                 
                                                    <a onclick="return confirm('Bạn có chắc muốn xóa không?');" class="iconViewCate text-danger" href="{!!url('/admin/delete-banner',$item['id'])!!}" data-toggle="tooltip" data-placement="top" title="Xóa banner"><i class="fas fa-trash"></i></a>
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