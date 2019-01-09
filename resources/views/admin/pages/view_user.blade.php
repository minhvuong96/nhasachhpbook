@extends('admin.master')
@section('title')
Danh Sách Thành Viên - HPBOOK ADMIN
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
                                        <li class="breadcrumb-item active">Thành Viên</li>
                                        <li class="breadcrumb-item active">Danh Sách Thành Viên</li>
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
                                    <h4 class="m-t-0 header-title mb-4"><b>Danh Sách Thành Viên</b></h4>
                                   
                                    <table id="datatable" class="table table-bordered">
                                        <thead>

                                        <tr>
                                            <th>ID</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Điện Thoại</th>
                                            <th>Địa Chỉ</th>
                                            <th>Level</th>
                                            <th>Thao Tác</th> 
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user as $item)
                                        <tr>
                                            <td>{!!$item->id!!}</td>
                                            <td>{!!$item->name!!}</td>
                                            <td>{!!$item->email!!}</td>
                                            @if(isset($item->phone))
                                                <td>{!!$item->phone!!}</td>
                                            @else
                                                <td>None</td>
                                            @endif
                                            @if(isset($item->address))
                                                <td>{!!$item->address!!}</td>
                                            @else
                                                <td>None</td>
                                            @endif
                                            @if($item->id == 3)
                                                <td>SuperAdmin</td>
                                            @elseif($item->admin==1)
                                                <td>Admin</td>
                                            @else
                                                <td>Member</td>
                                            @endif
                                            @if(Auth::user()->id ==3)
                                            <td>
                                                <span class="action">
                                                    <a class="iconViewCate text-success" href="{!!url('/admin/edit-user', $item->id)!!}" data-toggle="tooltip" data-placement="top" title="Sửa thành viên"><i class="fas fa-edit"></i></i></a>                 
                                                    <a onclick="return confirm('Bạn có chắc muốn xóa không?');" class="iconViewCate text-danger" href="{!!url('/admin/delete-user', $item->id)!!}" data-toggle="tooltip" data-placement="top" title="Xóa thành viên"><i class="fas fa-trash"></i></a>
                                                </span>
                                            </td>
                                            @elseif( (Auth::user()->admin ==1) && (($item->admin !=1) || Auth::user()->id == $item->id ) )
                                               <td>
                                                    <span class="action">
                                                        <a class="iconViewCate text-success" href="{!!url('/admin/edit-user', $item->id)!!}" data-toggle="tooltip" data-placement="top" title="Sửa thành viên"><i class="fas fa-edit"></i></i></a>                 
                                                        <a onclick="return confirm('Bạn có chắc muốn xóa không?');" class="iconViewCate text-danger" href="{!!url('/admin/delete-user', $item->id)!!}" data-toggle="tooltip" data-placement="top" title="Xóa thành viên"><i class="fas fa-trash"></i></a>
                                                    </span>
                                                </td>
                                            @else
                                                <td>Bạn không có quyền thực hiện</td>
                                            @endif
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