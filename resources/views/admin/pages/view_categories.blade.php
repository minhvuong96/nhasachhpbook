@extends('admin.master')
@section('title')
Danh Sách Danh Mục - HPBOOK ADMIN
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
                                        <li class="breadcrumb-item active">Danh Mục</li>
                                        <li class="breadcrumb-item active">Danh Sách Danh Mục</li>
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
                                    <h4 class="m-t-0 header-title mb-4"><b>Danh Sách Danh Mục</b></h4>
                                   
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tên</th>
                                            <th>Danh Mục Cha</th>
                                            <th>Thao Tác</th>    
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cate as $item)
                                        <tr>
                                            <td>{!!$item['id']!!}</td>
                                            <td>{!!$item['name']!!}</td>
                                            @if($item['parent_id']==0)
                                            <td>None</td>
                                            @else
                                            <td>
                                                @php
                                                    $cate_parent = DB::table('categories')->where('id',$item['parent_id'])->first();
                                                    echo $cate_parent->name;
                                                @endphp
                                            </td>
                                            @endif
                                            <td>
                                                <span class="action">
                                                    <a class="iconViewCate text-success" href="{!!url('/admin/edit-categories',$item['id'])!!}" data-toggle="tooltip" data-placement="top" title="Sửa danh mục"><i class="fas fa-edit"></i></a>                 
                                                    <a onclick="return confirm('Bạn có chắc muốn xóa không?');" class="iconViewCate text-danger" href="{!!url('/admin/delete-categories',$item['id'])!!}" data-toggle="tooltip" data-placement="top" title="Xóa danh mục"><i class="fas fa-trash"></i></a>
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