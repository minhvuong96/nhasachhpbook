@extends('admin.master')
@section('title')
Bình Luận Mới - HPBOOK ADMIN
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
                        <li class="breadcrumb-item active">Bình Luận</li>
                        <li class="breadcrumb-item active">Bình Luận Mới</li>
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
                    <h4 class="m-t-0 header-title mb-4"><b>Bình Luận Mới</b></h4>
                    
                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sách</th>
                            <th>Khách Hàng</th>
                            <th>Nội Dung</th>
                            <th>Trạng Thái</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($newComment as $item)
                        <tr id="{!!$item['id']!!}">
                            <td>{!!$item['id']!!}</td>
                            <td><a href="{!!url('/chi-tiet',$item['product']['alias'])!!}">{!!$item['product']['name']!!}</a></td>
                            <td>{!!$item['user']['name']!!}</td>
                            <td>{!!$item['content']!!}</td>
                            @if($item['status'] ==1)
                                <td>Đã Duyệt</td>   
                            @else
                                <td>Chờ Phê Duyệt</td>
                            @endif
                            <td>
                                <span class="action">
                                    <a class="btn btn-success iconViewCate text-success approvalComment" href="javascript:void(0)" data-id="{!!$item['id']!!}" >Duyệt</a>                 
                                    <a onclick="return confirm('Bạn có chắc muốn xóa không?');" class="btn btn-danger iconViewCate text-danger deleteComment" data-id="{!!$item['id']!!}" href="javascript:void(0)">Xóa</a>
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
        <script type="text/javascript" src="admin_public/js/approvalCommentAjax.js"></script>
@endsection